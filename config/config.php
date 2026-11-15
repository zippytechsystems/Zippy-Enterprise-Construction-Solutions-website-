<?php
/**
 * ZIPPY ENTERPRISES PRIVATE LIMITED
 * Enterprise Construction Management Platform Configuration
 * Hostinger Production & Local Environment Compatible
 * Domain: zippyenterpriseconstructions.in
 */

// Application Environment
defined('APP_NAME') or define('APP_NAME', 'Zippy Enterprises Private Limited');
defined('APP_TAGLINE') or define('APP_TAGLINE', 'Building Your Vision. Delivering Excellence.');

// Dynamic APP_URL: Resolves to production domain or local server
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || ($_SERVER['SERVER_PORT'] ?? 80) == 443) ? "https://" : "http://";
$hostName = $_SERVER['HTTP_HOST'] ?? 'zippyenterpriseconstructions.in';
defined('APP_URL') or define('APP_URL', $protocol . $hostName);
defined('APP_ENV') or define('APP_ENV', 'production'); // 'development' or 'production'

// Company Contact & Legal Info
define('COMPANY_NAME', 'Zippy Enterprises Private Limited');
define('COMPANY_DOMAIN', 'zippyenterpriseconstructions.in');
define('COMPANY_CIN', 'U45200TG2020PTC145892');
define('COMPANY_GSTIN', '36AABCZ1234F1Z8');
define('COMPANY_PHONE', '+91 95424 39498');
define('COMPANY_PHONE_ALT', '+91 95424 39498');
define('COMPANY_EMAIL', 'zippyconstructions@gmail.com');
define('COMPANY_SALES_EMAIL', 'zippyconstructions@gmail.com');
define('COMPANY_WHATSAPP', '916302690251');
define('COMPANY_ADDRESS', 'Sneha Apartment, HMT Nagar, Nacharam, Hyderabad, Telangana 500076, India');

/**
 * Hostinger MySQL Database Configuration
 * On Hostinger hPanel:
 * 1. Go to Databases -> MySQL Databases
 * 2. Create database (e.g. u123456789_zippy)
 * 3. Create user (e.g. u123456789_admin) and set password
 * 4. Replace below values with your Hostinger credentials, or define them via environment variables.
 */
define('DB_HOST', getenv('DB_HOST') ?: 'localhost'); // Hostinger MySQL Host (always localhost)
define('DB_PORT', getenv('DB_PORT') ?: '3306');
define('DB_DATABASE', getenv('DB_DATABASE') ?: 'zippy_construction_db');
define('DB_USERNAME', getenv('DB_USERNAME') ?: 'root');
define('DB_PASSWORD', getenv('DB_PASSWORD') ?: '');

// Document Storage
define('UPLOAD_DIR', __DIR__ . '/../uploads/');
define('MAX_UPLOAD_SIZE', 15 * 1024 * 1024); // 15MB

// Session settings
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_samesite', 'Lax');
    session_start();
}
