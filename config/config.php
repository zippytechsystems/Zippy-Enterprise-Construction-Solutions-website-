<?php
/**
 * ZIPPY ENTERPRISES PRIVATE LIMITED
 * Enterprise Construction Management Platform Configuration
 * Hostinger & Production Compatible
 */

// Application Environment
defined('APP_NAME') or define('APP_NAME', 'Zippy Enterprises Private Limited');
defined('APP_TAGLINE') or define('APP_TAGLINE', 'Building Your Vision. Delivering Excellence.');
defined('APP_URL') or define('APP_URL', 'http://localhost:8000');
defined('APP_ENV') or define('APP_ENV', 'production'); // 'development' or 'production'

// Company Contact & Legal Info
define('COMPANY_NAME', 'Zippy Enterprises Private Limited');
define('COMPANY_CIN', 'U45200TG2020PTC145892');
define('COMPANY_GSTIN', '36AABCZ1234F1Z8');
define('COMPANY_PHONE', '+91 91212 87654');
define('COMPANY_PHONE_ALT', '+91 40 4567 8900');
define('COMPANY_EMAIL', 'info@zippyenterprises.com');
define('COMPANY_SALES_EMAIL', 'sales@zippyenterprises.com');
define('COMPANY_WHATSAPP', '919121287654');
define('COMPANY_ADDRESS', 'Level 4, Zippy Tech Tower, Road No. 36, Jubilee Hills, Hyderabad, Telangana 500033, India');

// Database Configuration (Hostinger & Local MySQL default)
define('DB_HOST', getenv('DB_HOST') ?: '127.0.0.1');
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
