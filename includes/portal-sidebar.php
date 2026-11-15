<?php
/**
 * Role-Aware Portal Sidebar Navigation
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../config/security.php';

$role = Security::role();
$currentScript = basename($_SERVER['PHP_SELF']);
?>
<aside class="portal-sidebar">
  <div class="portal-sidebar-brand">
    <div class="brand-logo-icon" style="width:38px; height:38px; font-size:1.1rem;">
      <i class="fas fa-building"></i>
    </div>
    <div class="d-flex flex-column">
      <span class="text-white fw-bold" style="letter-spacing:1px; font-size:0.95rem;">ZIPPY <span style="color:#D4AF37;">PORTAL</span></span>
      <span class="text-warning text-uppercase" style="font-size:0.6rem; letter-spacing:1.5px;"><?= strtoupper(e($role)) ?> SUITE</span>
    </div>
  </div>

  <ul class="portal-sidebar-menu">
    <?php if ($role === 'admin'): ?>
      <!-- ADMIN NAVIGATION -->
      <li class="portal-menu-header">Executive Suite</li>
      <li class="portal-nav-item">
        <a href="index.php" class="portal-nav-link <?= $currentScript === 'index.php' ? 'active' : '' ?>">
          <i class="fas fa-chart-line"></i> Dashboard Overview
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="leads.php" class="portal-nav-link <?= $currentScript === 'leads.php' ? 'active' : '' ?>">
          <i class="fas fa-funnel-dollar"></i> Lead &amp; CRM Desk
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="projects.php" class="portal-nav-link <?= $currentScript === 'projects.php' ? 'active' : '' ?>">
          <i class="fas fa-city"></i> Project Management
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="builders.php" class="portal-nav-link <?= $currentScript === 'builders.php' ? 'active' : '' ?>">
          <i class="fas fa-hard-hat"></i> Builder Accreditation
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="customers.php" class="portal-nav-link <?= $currentScript === 'customers.php' ? 'active' : '' ?>">
          <i class="fas fa-users"></i> Customer Profiles
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="quotations.php" class="portal-nav-link <?= $currentScript === 'quotations.php' ? 'active' : '' ?>">
          <i class="fas fa-file-invoice-dollar"></i> Quotation Management
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="finance.php" class="portal-nav-link <?= $currentScript === 'finance.php' ? 'active' : '' ?>">
          <i class="fas fa-wallet"></i> Financial &amp; Payments
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="documents.php" class="portal-nav-link <?= $currentScript === 'documents.php' ? 'active' : '' ?>">
          <i class="fas fa-folder-open"></i> Document Repository
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="reports.php" class="portal-nav-link <?= $currentScript === 'reports.php' ? 'active' : '' ?>">
          <i class="fas fa-file-excel"></i> Reports &amp; Exports
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="audit-logs.php" class="portal-nav-link <?= $currentScript === 'audit-logs.php' ? 'active' : '' ?>">
          <i class="fas fa-shield-alt"></i> Security Audit Trail
        </a>
      </li>

    <?php elseif ($role === 'builder'): ?>
      <!-- BUILDER NAVIGATION -->
      <li class="portal-menu-header">Contractor Hub</li>
      <li class="portal-nav-item">
        <a href="index.php" class="portal-nav-link <?= $currentScript === 'index.php' ? 'active' : '' ?>">
          <i class="fas fa-tachometer-alt"></i> Contractor Dashboard
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="projects.php" class="portal-nav-link <?= $currentScript === 'projects.php' ? 'active' : '' ?>">
          <i class="fas fa-trowel-bricks"></i> Assigned Sites
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="update-stage.php" class="portal-nav-link <?= $currentScript === 'update-stage.php' ? 'active' : '' ?>">
          <i class="fas fa-camera"></i> Daily Progress &amp; Photos
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="documents.php" class="portal-nav-link <?= $currentScript === 'documents.php' ? 'active' : '' ?>">
          <i class="fas fa-file-contract"></i> Material &amp; Test Reports
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="profile.php" class="portal-nav-link <?= $currentScript === 'profile.php' ? 'active' : '' ?>">
          <i class="fas fa-id-badge"></i> Company Profile
        </a>
      </li>

    <?php else: ?>
      <!-- CUSTOMER NAVIGATION -->
      <li class="portal-menu-header">Client Self-Service</li>
      <li class="portal-nav-item">
        <a href="index.php" class="portal-nav-link <?= $currentScript === 'index.php' ? 'active' : '' ?>">
          <i class="fas fa-home"></i> Project Overview
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="my-project.php" class="portal-nav-link <?= $currentScript === 'my-project.php' ? 'active' : '' ?>">
          <i class="fas fa-tasks"></i> 14-Stage Progress Tracker
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="quotations.php" class="portal-nav-link <?= $currentScript === 'quotations.php' ? 'active' : '' ?>">
          <i class="fas fa-file-invoice"></i> My Quotations &amp; BOQ
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="payments.php" class="portal-nav-link <?= $currentScript === 'payments.php' ? 'active' : '' ?>">
          <i class="fas fa-credit-card"></i> Payment Milestones
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="documents.php" class="portal-nav-link <?= $currentScript === 'documents.php' ? 'active' : '' ?>">
          <i class="fas fa-file-pdf"></i> Plans &amp; Legal Docs
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="site-visits.php" class="portal-nav-link <?= $currentScript === 'site-visits.php' ? 'active' : '' ?>">
          <i class="fas fa-calendar-check"></i> Book Site Visit
        </a>
      </li>
      <li class="portal-nav-item">
        <a href="support.php" class="portal-nav-link <?= $currentScript === 'support.php' ? 'active' : '' ?>">
          <i class="fas fa-headset"></i> Support &amp; Enquiries
        </a>
      </li>
    <?php endif; ?>
  </ul>

  <div class="portal-sidebar-footer">
    <a href="../../logout.php" class="btn btn-outline-danger btn-sm w-100 text-white-50 border-danger d-flex align-items-center justify-content-center">
      <i class="fas fa-sign-out-alt me-2"></i> Log Out
    </a>
  </div>
</aside>
