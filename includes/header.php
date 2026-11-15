<?php
/**
 * Corporate Header & Navigation Bar
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/security.php';

$currentPage = basename($_SERVER['PHP_SELF'], '.php');
$isLoggedIn = Security::check();
$userRole = Security::role();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <title><?= isset($pageTitle) ? e($pageTitle) . ' | ' . APP_NAME : APP_NAME . ' | Enterprise Construction Solutions' ?></title>
  <meta name="description" content="<?= isset($pageDescription) ? e($pageDescription) : 'Zippy Enterprises Private Limited - Premier commercial & residential construction, turnkey EPC, architectural engineering and construction management in Hyderabad.' ?>">
  <meta name="keywords" content="construction company hyderabad, residential construction, commercial building developers, turnkey civil contractors, self construction loan assistance, zippy enterprises">
  <link rel="canonical" href="<?= APP_URL ?>/<?= basename($_SERVER['PHP_SELF']) ?>">
  
  <!-- Open Graph / Meta -->
  <meta property="og:type" content="website">
  <meta property="og:title" content="<?= isset($pageTitle) ? e($pageTitle) . ' | ' . APP_NAME : APP_NAME ?>">
  <meta property="og:description" content="Building Your Vision. Delivering Excellence. Premier construction and building management platform.">
  <meta property="og:image" content="<?= APP_URL ?>/assets/images/logo.svg">

  <!-- Favicon -->
  <link rel="icon" type="image/svg+xml" href="assets/images/favicon.svg">

  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  
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
        <span><i class="fas fa-map-marker-alt text-warning me-2"></i>Jubilee Hills, Hyderabad</span>
        <span class="divider"></span>
        <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE) ?>"><i class="fas fa-phone-alt text-warning me-2"></i><?= COMPANY_PHONE ?></a>
        <span class="divider"></span>
        <a href="mailto:<?= COMPANY_EMAIL ?>"><i class="fas fa-envelope text-warning me-2"></i><?= COMPANY_EMAIL ?></a>
      </div>
      <div class="d-flex align-items-center">
        <span class="badge bg-dark text-warning border border-warning me-3 px-2 py-1"><i class="fas fa-shield-alt me-1"></i> ISO 9001:2015 CERTIFIED</span>
        <span class="divider"></span>
        <?php if ($isLoggedIn): ?>
          <a href="portal/<?= $userRole === 'admin' ? 'admin' : ($userRole === 'builder' ? 'builder' : 'customer') ?>/index.php" class="fw-bold text-warning me-3">
            <i class="fas fa-user-circle me-1"></i> My Dashboard (<?= ucfirst($userRole) ?>)
          </a>
          <a href="logout.php" class="text-white-50"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
        <?php else: ?>
          <div class="dropdown d-inline-block">
            <a class="dropdown-toggle text-white fw-semibold" href="#" role="button" data-bs-toggle="dropdown">
              <i class="fas fa-lock text-warning me-1"></i> Portal Access
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-custom">
              <li><a class="dropdown-item dropdown-item-custom" href="login.php"><i class="fas fa-user text-warning"></i> Customer Login</a></li>
              <li><a class="dropdown-item dropdown-item-custom" href="builder-login.php"><i class="fas fa-hard-hat text-warning"></i> Builder / Contractor Login</a></li>
              <li><hr class="dropdown-divider border-secondary"></li>
              <li><a class="dropdown-item dropdown-item-custom" href="login.php?role=admin"><i class="fas fa-user-shield text-warning"></i> Enterprise Admin Login</a></li>
            </ul>
          </div>
        <?php endif; ?>
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

        <!-- SERVICES DROPDOWN -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle <?= in_array($currentPage, ['services', 'service-residential', 'service-commercial', 'service-apartment', 'service-turnkey', 'service-consultancy']) ? 'active' : '' ?>" href="services.php" role="button" data-bs-toggle="dropdown">
            Services
          </a>
          <ul class="dropdown-menu dropdown-menu-custom shadow-lg">
            <li><a class="dropdown-item dropdown-item-custom" href="services.php"><i class="fas fa-th-large text-warning"></i> All 14 Construction Services</a></li>
            <li><hr class="dropdown-divider border-secondary"></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-residential.php"><i class="fas fa-home text-warning"></i> Residential Construction &amp; Villas</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-commercial.php"><i class="fas fa-city text-warning"></i> Commercial Buildings &amp; IT Hubs</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-apartment.php"><i class="fas fa-building text-warning"></i> Apartment Development</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="service-turnkey.php"><i class="fas fa-key text-warning"></i> Turnkey EPC Solutions</a></li>
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
          <a class="nav-link nav-link-custom <?= $currentPage === 'builders' ? 'active' : '' ?>" href="builders.php">Builder Network</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'cost-estimator' ? 'active' : '' ?>" href="cost-estimator.php">
            <span class="badge bg-warning text-dark me-1">Instant</span> Cost Estimator
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'careers' ? 'active' : '' ?>" href="careers.php">Careers</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-custom <?= $currentPage === 'contact' ? 'active' : '' ?>" href="contact.php">Contact</a>
        </li>
      </ul>

      <div class="d-flex align-items-center ms-xl-3 mt-3 mt-xl-0 gap-2">
        <a href="cost-estimator.php" class="btn btn-gold btn-sm px-3">
          <i class="fas fa-calculator me-1"></i> Get Quote
        </a>
        <?php if ($isLoggedIn): ?>
          <a href="portal/<?= $userRole === 'admin' ? 'admin' : ($userRole === 'builder' ? 'builder' : 'customer') ?>/index.php" class="btn btn-outline-gold btn-sm px-3">
            <i class="fas fa-columns me-1"></i> Portal
          </a>
        <?php else: ?>
          <a href="login.php" class="btn btn-outline-gold btn-sm px-3">
            <i class="fas fa-sign-in-alt me-1"></i> Login
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</nav>
