<?php
/**
 * Corporate Header & Navigation Bar
 * Zippy Enterprises Private Limited
 * Public Corporate Business & Portfolio Website
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/security.php';

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <title><?= isset($pageTitle) ? e($pageTitle) . ' | ' . APP_NAME : APP_NAME . ' | Enterprise Construction Solutions Hyderabad' ?></title>
  <meta name="description" content="<?= isset($pageDescription) ? e($pageDescription) : 'Zippy Enterprises Private Limited - Premier commercial & residential construction, luxury villas, turnkey EPC, architectural engineering and building development in Hyderabad.' ?>">
  <meta name="keywords" content="construction company hyderabad, residential construction, luxury villa builders, commercial building contractors, turnkey civil construction, self construction loan assistance, zippy enterprises">
  <link rel="canonical" href="<?= APP_URL ?>/<?= basename($_SERVER['PHP_SELF']) ?>">
  
  <!-- Open Graph / Meta -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= isset($pageTitle) ? e($pageTitle) . ' | ' . APP_NAME : APP_NAME ?>">
  <meta property="og:description" content="Building Your Vision. Delivering Excellence. Premier construction solutions and building development in Hyderabad.">
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
  
  <!-- Custom Design System -->
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<!-- TOP BAR -->
<div class="top-bar d-none d-lg-block">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center">
        <span><i class="fas fa-map-marker-alt text-warning me-2"></i>HMT Nagar, Nacharam, Hyderabad 500076</span>
        <span class="divider"></span>
        <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE) ?>"><i class="fas fa-phone-alt text-warning me-2"></i><?= COMPANY_PHONE ?></a>
        <span class="divider"></span>
        <a href="mailto:<?= COMPANY_EMAIL ?>"><i class="fas fa-envelope text-warning me-2"></i><?= COMPANY_EMAIL ?></a>
      </div>
      <div class="d-flex align-items-center">
        <span class="badge bg-dark text-warning border border-warning px-2 py-1 me-3">
          <i class="fas fa-certificate me-1"></i> ISO 9001:2015 CERTIFIED
        </span>
        <span class="divider"></span>
        <a href="https://wa.me/<?= COMPANY_WHATSAPP ?>" target="_blank" class="text-warning fw-semibold me-3">
          <i class="fab fa-whatsapp me-1"></i> Quick WhatsApp
        </a>
        <a href="quote.php" class="text-white fw-bold">
          <i class="fas fa-file-invoice text-warning me-1"></i> Request a Quotation
        </a>
      </div>
    </div>
  </div>
</div>

<!-- MAIN NAVBAR -->
<nav class="navbar navbar-expand-xl navbar-custom">
  <div class="container">
    <a class="navbar-brand d-flex align-items-center" href="index.php">
      <div class="brand-logo-icon me-2">
        <i class="fas fa-building"></i>
      </div>
      <div class="d-flex flex-column">
        <span class="brand-text-title">ZIPPY <span style="color:#D4AF37;">ENTERPRISES</span></span>
        <span class="brand-text-sub">Construction Solutions</span>
      </div>
    </a>

    <button class="navbar-toggler text-white border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
      <i class="fas fa-bars fa-lg text-warning"></i>
    </button>

    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto align-items-xl-center">
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'index' ? 'active' : '' ?>" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'about' ? 'active' : '' ?>" href="about.php">About Us</a>
        </li>

        <!-- CONSTRUCTION SOLUTIONS DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle <?= in_array($currentPage, ['services', 'service-residential', 'service-independent-house', 'service-villa', 'service-commercial', 'service-apartment', 'service-turnkey', 'service-consultancy', 'loan-assistance']) ? 'active' : '' ?>" href="services.php" role="button" data-bs-toggle="dropdown">
            Construction Solutions
          </a>
          <ul class="dropdown-menu dropdown-menu-custom shadow-lg">
            <li><a class="dropdown-item dropdown-item-custom" href="services.php"><i class="fas fa-th-large text-warning"></i> <strong>All 15 Construction Solutions</strong></a></li>
            <li><hr class="dropdown-divider border-secondary"></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-residential.php"><i class="fas fa-home text-warning"></i> Residential Construction</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-independent-house.php"><i class="fas fa-house-user text-warning"></i> Independent House Construction</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-villa.php"><i class="fas fa-gem text-warning"></i> Luxury Villa Construction</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-commercial.php"><i class="fas fa-city text-warning"></i> Commercial Building Construction</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-apartment.php"><i class="fas fa-building text-warning"></i> Apartment Development &amp; JV</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-turnkey.php"><i class="fas fa-key text-warning"></i> Turnkey Construction Projects</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-consultancy.php"><i class="fas fa-drafting-compass text-warning"></i> Architectural &amp; Structural Design</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="loan-assistance.php"><i class="fas fa-landmark text-warning"></i> Self-Construction Loan Assistance</a></li>
          </ul>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'projects' ? 'active' : '' ?>" href="projects.php">Projects</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'gallery' ? 'active' : '' ?>" href="gallery.php">Gallery</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'network' ? 'active' : '' ?>" href="network.php">Professional Network</a>
        </li>

        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'contact' ? 'active' : '' ?>" href="contact.php">Contact</a>
        </li>
      </ul>

      <div class="d-flex align-items-center ms-xl-3 mt-3 mt-xl-0 gap-2">
        <a href="quote.php" class="btn btn-gold btn-sm px-3">
          <i class="fas fa-file-invoice me-1"></i> Request a Quote
        </a>
        <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE) ?>" class="btn btn-outline-gold btn-sm px-3 d-none d-xxl-inline-flex">
          <i class="fas fa-phone-alt me-1"></i> <?= COMPANY_PHONE ?>
        </a>
      </div>
    </div>
  </div>
</nav>
