<?php
/**
 * Unified Portal Top Header
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/database.php';

$user = Security::user();
$userId = (int)($user['id'] ?? 0);
$role = Security::role();

// Fetch unread notifications count
$unreadCount = 0;
$recentNotifs = [];
try {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM notifications WHERE user_id = ? ORDER BY id DESC LIMIT 5");
    $stmt->execute([$userId]);
    $recentNotifs = $stmt->fetchAll();
    
    $cntStmt = $db->prepare("SELECT COUNT(*) FROM notifications WHERE user_id = ? AND is_read = 0");
    $cntStmt->execute([$userId]);
    $unreadCount = (int)$cntStmt->fetchColumn();
} catch (Exception $e) {
    // Graceful fallback
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= isset($portalTitle) ? e($portalTitle) . ' | Zippy Portal' : 'Enterprise Portal | Zippy Enterprises' ?></title>
  
  <link rel="icon" type="image/svg+xml" href="../../assets/images/favicon.svg">
  
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  
  <!-- Custom Portal CSS -->
  <link rel="stylesheet" href="../../assets/css/style.css">
  <link rel="stylesheet" href="../../assets/css/portal.css">
</head>
<body>

<div class="portal-wrapper">
  <?php require_once __DIR__ . '/portal-sidebar.php'; ?>

  <div class="portal-main">
    <!-- Top Bar -->
    <header class="portal-topbar">
      <div class="d-flex align-items-center">
        <button type="button" id="sidebar-toggle-btn" class="btn btn-sm btn-light d-lg-none me-3 border">
          <i class="fas fa-bars"></i>
        </button>
        <h5 class="fw-bold text-navy mb-0 d-none d-sm-block">
          <?= isset($portalTitle) ? e($portalTitle) : 'Enterprise Dashboard' ?>
        </h5>
      </div>

      <div class="d-flex align-items-center gap-3">
        <!-- Live Website Link -->
        <a href="../../index.php" class="btn btn-outline-secondary btn-sm d-none d-md-inline-flex align-items-center" target="_blank">
          <i class="fas fa-external-link-alt me-1"></i> Public Website
        </a>

        <!-- Notifications Dropdown -->
        <div class="dropdown">
          <button class="btn btn-light position-relative rounded-circle border" type="button" data-bs-toggle="dropdown" style="width:42px; height:42px;">
            <i class="fas fa-bell text-navy"></i>
            <?php if ($unreadCount > 0): ?>
              <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.65rem;">
                <?= $unreadCount ?>
              </span>
            <?php endif; ?>
          </button>
          <ul class="dropdown-menu dropdown-menu-end shadow-lg p-2" style="min-width:300px; border-radius:12px;">
            <li class="p-2 border-bottom fw-bold text-navy d-flex justify-content-between align-items-center">
              <span>Notifications</span>
              <span class="badge bg-warning text-dark"><?= $unreadCount ?> New</span>
            </li>
            <?php if (!empty($recentNotifs)): ?>
              <?php foreach ($recentNotifs as $n): ?>
                <li class="p-2 border-bottom">
                  <div class="small fw-bold text-navy"><?= e($n['title']) ?></div>
                  <div class="small text-muted" style="font-size:0.75rem;"><?= e($n['message']) ?></div>
                </li>
              <?php endforeach; ?>
            <?php else: ?>
              <li class="p-3 text-center small text-muted">No recent notifications.</li>
            <?php endif; ?>
          </ul>
        </div>

        <!-- User Profile Dropdown -->
        <div class="dropdown">
          <div class="portal-user-badge dropdown-toggle" role="button" data-bs-toggle="dropdown">
            <div class="portal-user-avatar">
              <?= strtoupper(substr($user['name'] ?? 'U', 0, 1)) ?>
            </div>
            <div class="d-none d-md-block text-start">
              <div class="fw-bold text-navy small leading-tight mb-0"><?= e($user['name'] ?? 'User') ?></div>
              <small class="badge bg-dark text-warning border border-warning" style="font-size:0.65rem;"><?= strtoupper(e($role)) ?></small>
            </div>
          </div>
          <ul class="dropdown-menu dropdown-menu-end shadow-lg" style="border-radius:10px;">
            <li class="px-3 py-2 border-bottom">
              <div class="fw-bold text-navy small"><?= e($user['name'] ?? 'User') ?></div>
              <small class="text-muted"><?= e($user['email'] ?? '') ?></small>
            </li>
            <li><a class="dropdown-item small" href="../../logout.php"><i class="fas fa-sign-out-alt text-danger me-2"></i> Sign Out</a></li>
          </ul>
        </div>
      </div>
    </header>

    <!-- Portal Body Container Starts -->
    <div class="portal-body">
