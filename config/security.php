<?php
/**
 * Security & Helper Utilities
 * Zippy Enterprises Private Limited
 */

require_once __DIR__ . '/config.php';

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
}

// Global short helper for HTML escaping
function e(?string $string): string {
    return htmlspecialchars($string ?? '', ENT_QUOTES, 'UTF-8');
}
