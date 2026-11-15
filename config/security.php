<?php
/**
 * Security, RBAC & Helper Utilities
 * Zippy Enterprises Private Limited
 */

require_once __DIR__ . '/config.php';
require_once __DIR__ . '/database.php';

class Security {
    // Generate CSRF token
    public static function csrfToken(): string {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    // Render hidden CSRF input field
    public static function csrfField(): string {
        $token = self::csrfToken();
        return '<input type="hidden" name="csrf_token" value="' . htmlspecialchars($token, ENT_QUOTES, 'UTF-8') . '">';
    }

    // Verify CSRF token
    public static function verifyCsrf(?string $token = null): bool {
        if ($token === null) {
            $token = $_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        }
        if (empty($_SESSION['csrf_token']) || empty($token)) {
            return false;
        }
        return hash_equals($_SESSION['csrf_token'], $token);
    }

    // Sanitize string
    public static function clean(mixed $data): string {
        if (is_null($data)) return '';
        return htmlspecialchars(trim((string)$data), ENT_QUOTES, 'UTF-8');
    }

    // Authentication Guard
    public static function check(): bool {
        return !empty($_SESSION['user_id']);
    }

    public static function user(): ?array {
        if (!self::check()) return null;
        return $_SESSION['user'] ?? null;
    }

    public static function role(): ?string {
        return $_SESSION['user']['role'] ?? null;
    }

    public static function requireAuth(string $redirect = '/login.php'): void {
        if (!self::check()) {
            $_SESSION['flash_error'] = 'Please log in to access this enterprise portal area.';
            header("Location: {$redirect}");
            exit;
        }
    }

    public static function requireRole(string|array $roles, string $redirect = '/login.php'): void {
        self::requireAuth($redirect);
        $userRole = self::role();
        $allowed = is_array($roles) ? $roles : [$roles];

        if (!in_array($userRole, $allowed, true)) {
            $_SESSION['flash_error'] = 'Unauthorized access: You do not have permission for this portal section.';
            header("Location: {$redirect}");
            exit;
        }
    }

    // Audit Logging
    public static function logAudit(string $action, string $details = ''): void {
        try {
            $db = Database::getConnection();
            $userId = $_SESSION['user_id'] ?? null;
            $ip = $_SERVER['REMOTE_ADDR'] ?? '127.0.0.1';
            
            $stmt = $db->prepare("INSERT INTO audit_logs (user_id, action, ip_address, details, created_at) VALUES (:uid, :action, :ip, :details, datetime('now'))");
            if (Database::getDriver() === 'mysql') {
                $stmt = $db->prepare("INSERT INTO audit_logs (user_id, action, ip_address, details, created_at) VALUES (:uid, :action, :ip, :details, NOW())");
            }
            $stmt->execute([
                ':uid'     => $userId,
                ':action'  => $action,
                ':ip'      => $ip,
                ':details' => $details
            ]);
        } catch (Exception $e) {
            // Silently fail to avoid breaking user workflows
            error_log("Audit log failed: " . $e->getMessage());
        }
    }

    // Flash notifications
    public static function setFlash(string $type, string $message): void {
        $_SESSION['flash_' . $type] = $message;
    }

    public static function getFlash(string $type): ?string {
        $key = 'flash_' . $type;
        if (!empty($_SESSION[$key])) {
            $msg = $_SESSION[$key];
            unset($_SESSION[$key]);
            return $msg;
        }
        return null;
    }

    // Notifications helper
    public static function createNotification(int $userId, string $title, string $message, ?string $link = null): void {
        try {
            $db = Database::getConnection();
            $sql = Database::getDriver() === 'mysql' 
                ? "INSERT INTO notifications (user_id, title, message, link, is_read, created_at) VALUES (?, ?, ?, ?, 0, NOW())"
                : "INSERT INTO notifications (user_id, title, message, link, is_read, created_at) VALUES (?, ?, ?, ?, 0, datetime('now'))";
            $stmt = $db->prepare($sql);
            $stmt->execute([$userId, $title, $message, $link]);
        } catch (Exception $e) {
            error_log("Notification failed: " . $e->getMessage());
        }
    }
}

// Global short helper for HTML escaping
function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}
