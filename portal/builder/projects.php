<?php
/**
 * Builder Assigned Projects & Work Orders
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['builder', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Assigned Construction Sites & Contracts";

try {
    $db = Database::getConnection();
    $bStmt = $db->prepare("SELECT id FROM builder_profiles WHERE user_id = ? LIMIT 1");
    $bStmt->execute([$userId]);
    $bProf = $bStmt->fetch();
    $bId = $bProf['id'] ?? 1;

    $stmt = $db->prepare("SELECT p.*, u.name as customer_name, u.phone as customer_phone FROM projects p JOIN users u ON p.customer_id = u.id WHERE p.builder_id = ? ORDER BY p.id ASC");
    $stmt->execute([$bId]);
    $projects = $stmt->fetchAll();
} catch (Exception $e) {
    $projects = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Contractor Work Orders &amp; Site Allocations</h4>
      <p class="text-muted small mb-0">Review project engineering blueprints, built-up areas, and execution targets.</p>
    </div>
  </div>
</div>

<div class="row g-4">
  <?php if (!empty($projects)): ?>
    <?php foreach ($projects as $prj): ?>
      <div class="col-lg-6">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
          <div class="d-flex justify-content-between align-items-start mb-2">
            <span class="badge bg-light text-navy border fw-bold"><?= e($prj['project_code']) ?></span>
            <span class="badge bg-warning text-dark fw-bold">Stage <?= $prj['current_stage_id'] ?>/14</span>
          </div>
          <h5 class="fw-bold text-navy mb-1"><?= e($prj['title']) ?></h5>
          <p class="small text-muted mb-3"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($prj['site_address']) ?></p>
          
          <div class="p-3 rounded-3 mb-3" style="background:#F8FAFC;">
            <div class="row g-2 small">
              <div class="col-6"><strong>Client:</strong> <?= e($prj['customer_name']) ?></div>
              <div class="col-6"><strong>Built-Up Area:</strong> <?= number_format($prj['built_up_area_sqft']) ?> Sq.Ft</div>
              <div class="col-6"><strong>Floors:</strong> <?= $prj['floors_count'] ?> Levels</div>
              <div class="col-6"><strong>Target Handover:</strong> <?= date('d M Y', strtotime($prj['target_handover_date'])) ?></div>
            </div>
          </div>

          <div class="mb-3">
            <div class="d-flex justify-content-between small text-muted mb-1">
              <span>Stage Completion Progress</span>
              <span class="fw-bold text-navy"><?= $prj['progress_percent'] ?>%</span>
            </div>
            <div class="progress" style="height: 8px;">
              <div class="progress-bar bg-warning" style="width: <?= $prj['progress_percent'] ?>%;"></div>
            </div>
          </div>

          <div class="d-flex justify-content-between align-items-center pt-3 border-top mt-auto">
            <span class="fw-bold text-navy small">Budget: ₹<?= number_format($prj['total_budget'] / 10000000, 2) ?> Cr</span>
            <a href="update-stage.php?pid=<?= $prj['id'] ?>" class="btn btn-sm btn-gold">
              <i class="fas fa-camera me-1"></i> Log Daily Progress
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12 text-center py-5">
      <p class="text-muted">No site allocations found.</p>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
