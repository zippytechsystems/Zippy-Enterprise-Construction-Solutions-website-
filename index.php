<?php
/**
 * ZIPPY ENTERPRISES PRIVATE LIMITED
 * React JS Frontend + Pure PHP/MySQL Backend Architecture
 * Hostinger Production & Local Environment Compatible (Zero Node.js Required on Server)
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';

$pageTitle = "Enterprise Construction Solutions & Building Development | Zippy Enterprises";
$pageDescription = "From independent homes to commercial developments, Zippy Enterprises delivers professional construction solutions with a commitment to quality, transparency and excellence in Hyderabad.";
$canonicalUrl = APP_URL . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <title><?= htmlspecialchars($pageTitle) ?></title>
  <meta name="description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta name="keywords" content="construction solutions hyderabad, luxury villa builders, commercial building contractors, independent house construction, turnkey epc hyderabad, zippy enterprises">
  <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl) ?>">
  
  <!-- Open Graph -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= htmlspecialchars($pageTitle) ?>">
  <meta property="og:description" content="<?= htmlspecialchars($pageDescription) ?>">
  <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl) ?>">
  <meta property="og:image" content="<?= APP_URL ?>/assets/images/logo.svg">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">

  <!-- Google Fonts: Plus Jakarta Sans & Playfair Display -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Font Awesome 6.5.1 -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Custom Luxury Corporate Design System -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

  <!-- CSRF Token for React Forms -->
  <?= Security::csrfField() ?>

  <!-- REACT APPLICATION MOUNT ROOT -->
  <div id="root">
    <!-- Initial Loading State -->
    <div class="d-flex flex-column align-items-center justify-content-center vh-100" style="background:#0A192F; color:#FFFFFF;">
      <div class="spinner-border text-warning mb-3" style="width:3rem; height:3rem;" role="status">
        <span class="visually-hidden">Loading Zippy Enterprises Platform...</span>
      </div>
      <div class="h5 fw-bold text-white mb-1">ZIPPY <span style="color:#D4AF37;">ENTERPRISES</span></div>
      <p class="small text-white-50">Building Your Vision. Delivering Excellence.</p>
    </div>
  </div>

  <!-- Fallback for Non-JS Clients / SEO Crawlers -->
  <noscript>
    <div class="container py-5 text-center">
      <h2>Zippy Enterprises Private Limited</h2>
      <p>Building Your Vision. Delivering Excellence.</p>
      <p>Corporate Office: Sneha Apartment, HMT Nagar, Nacharam, Hyderabad, Telangana 500076</p>
      <p>Phone: +91 95424 39498 | Email: zippyconstructions@gmail.com | WhatsApp: +91 63026 90251</p>
      <a href="contact.php" class="btn btn-primary">Contact Us</a>
    </div>
  </noscript>

  <!-- Bootstrap 5 Bundle JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Compiled React JS Application Bundle (Zero Node.js Required in Production) -->
  <script src="assets/js/react-app.bundle.js"></script>
</body>
</html>
