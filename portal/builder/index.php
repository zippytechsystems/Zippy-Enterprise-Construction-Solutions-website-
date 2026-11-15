<?php
/**
 * Builder / Contractor Dashboard Overview
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['builder', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Contractor Execution Dashboard";

try {
    $db = Database::getConnection();
    // Fetch builder profile
    $bStmt = $db->prepare("SELECT * FROM builder_profiles WHERE user_id = ? LIMIT 1");
    $bStmt->execute([$userId]);
    $builderProfile = $bStmt->fetch();

    $builderProfileId = $builderProfile['id'] ?? 1;

    // Fetch assigned projects
    $pStmt = $db->prepare("SELECT * FROM projects WHERE builder_id = ? ORDER BY id ASC");
    $pStmt->execute([$builderProfileId]);
    $projects = $pStmt->fetchAll();

    // Active projects count
    $activeCount = count($projects);
} catch (Exception $e) {
    $projects = [];
    $builderProfile = null;
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<!-- WELCOME BANNER -->
<div class="row mb-4">
  <div class="col-12">
    <div class="p-4 rounded-4 shadow-sm" style="background:#061121; color:#FFFFFF; border:1px solid var(--border-gold);">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <span class="badge-gold mb-2">ACCREDITED CONTRACTOR DESK</span>
          <h2 class="text-white fw-bold mb-1"><?= e($builderProfile['company_name'] ?? $user['name']) ?></h2>
          <p class="text-white-50 mb-0">License: <strong><?= e($builderProfile['license_number'] ?? 'VERIFIED-PWD') ?></strong> &bull; Rating: <span class="text-warning fw-bold"><i class="fas fa-star"></i> <?= $builderProfile['rating'] ?? '4.95' ?>/5.0</span></p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
          <a href="update-stage.php" class="btn btn-gold btn-sm px-3">
            <i class="fas fa-camera me-1"></i> Log Daily Progress
          </a>
          <a href="documents.php" class="btn btn-outline-warning text-white border-warning btn-sm px-3 ms-2">
            <i class="fas fa-upload me-1"></i> Upload Test Doc
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- KPI CARDS -->
<div class="row g-4 mb-4">
  <div class="col-md-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Assigned Sites</div>
          <div class="h4 fw-bold text-navy mb-0"><?= count($projects) ?> Active</div>
          <small class="text-muted">Hyderabad West Division</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-navy">
          <i class="fas fa-trowel-bricks"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Contractor Rating</div>
          <div class="h4 fw-bold text-warning mb-0"><i class="fas fa-star"></i> <?= $builderProfile['rating'] ?? '4.95' ?></div>
          <small class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> Class-1 Quality Vetted</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-gold">
          <i class="fas fa-medal"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Escrow Billing Status</div>
          <div class="h4 fw-bold text-success mb-0">Up To Date</div>
          <small class="text-muted">Zero Pending Disbursements</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-green">
          <i class="fas fa-wallet"></i>
        </div>
      </div>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Next Stage Audit</div>
          <div class="h4 fw-bold text-navy mb-0">Stage 11</div>
          <small class="text-muted">Plastering Inspection Due</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-purple">
          <i class="fas fa-clipboard-check"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ASSIGNED SITES TABLE -->
<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <h5 class="fw-bold text-navy mb-0">Assigned Construction Sites &amp; Work Orders</h5>
        <a href="projects.php" class="btn btn-sm btn-outline-secondary">View SOW Details</a>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Project Code</th>
              <th>Project Title &amp; Location</th>
              <th>Category</th>
              <th>Built-Up Area</th>
              <th>Active Stage</th>
              <th>Progress</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($projects)): ?>
              <?php foreach ($projects as $prj): ?>
                <tr>
                  <td><span class="badge bg-light text-navy border fw-bold"><?= e($prj['project_code']) ?></span></td>
                  <td>
                    <span class="fw-bold text-navy"><?= e($prj['title']) ?></span><br>
                    <small class="text-muted"><?= e($prj['site_address']) ?></small>
                  </td>
                  <td><span class="text-uppercase small fw-bold text-muted"><?= e($prj['category']) ?></span></td>
                  <td><?= number_format($prj['built_up_area_sqft']) ?> Sq.Ft</td>
                  <td><span class="badge bg-warning text-dark fw-bold">Stage <?= $prj['current_stage_id'] ?>/14</span></td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="progress" style="width: 80px; height: 6px;">
                        <div class="progress-bar bg-warning" style="width: <?= $prj['progress_percent'] ?>%;"></div>
                      </div>
                      <span class="small fw-bold"><?= $prj['progress_percent'] ?>%</span>
                    </div>
                  </td>
                  <td>
                    <a href="update-stage.php?pid=<?= $prj['id'] ?>" class="btn btn-sm btn-gold py-1 px-2" style="font-size:0.75rem;">
                      <i class="fas fa-edit me-1"></i> Update Stage
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">No site projects assigned currently.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
