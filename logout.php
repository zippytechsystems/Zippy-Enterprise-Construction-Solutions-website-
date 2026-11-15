<?php
/**
 * Logout Handler
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';

if (Security::check()) {
    $userId = Security::user()['id'] ?? null;
    Security::logAudit('LOGOUT', "User #{$userId} logged out.");
}

// Clear session
$_SESSION = [];
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}
session_destroy();

header('Location: login.php');
exit;
