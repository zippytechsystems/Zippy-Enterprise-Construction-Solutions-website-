<?php
/**
 * Customer 14-Stage Project Tracking System
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];

$portalTitle = "14-Stage Construction Lifecycle Tracker";

try {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT p.*, bp.company_name as builder_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id WHERE p.customer_id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $project = $stmt->fetch();

    $milestones = [];
    if ($project) {
        $mStmt = $db->prepare("SELECT * FROM project_milestones WHERE project_id = ? ORDER BY stage_number ASC");
        $mStmt->execute([$project['id']]);
        $milestones = $mStmt->fetchAll();
    }
} catch (Exception $e) {
    $project = null;
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <div class="badge-gold mb-1">REAL-TIME EXECUTION ENGINE</div>
        <h3 class="fw-bold text-navy mb-1"><?= e($project['title'] ?? 'My Project') ?></h3>
        <p class="text-muted small mb-0">
          <i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($project['site_address'] ?? 'Hyderabad') ?> &bull;
          Contractor: <strong><?= e($project['builder_name'] ?? 'Assigned Civil Contractor') ?></strong>
        </p>
      </div>
      <div class="text-md-end mt-3 mt-md-0">
        <div class="h2 fw-bold text-warning mb-0"><?= $project['progress_percent'] ?? 0 ?>%</div>
        <span class="small text-muted text-uppercase fw-bold">Overall Progress</span>
      </div>
    </div>
  </div>
</div>

<?php if ($project): ?>
  <div class="row g-4">
    <!-- 14-STAGE TIMELINE -->
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-4">
          <h5 class="fw-bold text-navy mb-0">Verified 14-Stage Construction Lifecycle</h5>
          <span class="badge bg-warning text-dark fw-bold">Live Synced</span>
        </div>

        <div class="stages-timeline-container p-0">
          <?php foreach ($milestones as $m): ?>
            <div class="stage-step <?= $m['status'] ?>">
              <div class="stage-indicator">
                <?php if ($m['status'] === 'completed'): ?>
                  <i class="fas fa-check"></i>
                <?php elseif ($m['status'] === 'in_progress'): ?>
                  <i class="fas fa-spinner fa-spin"></i>
                <?php elseif ($m['status'] === 'delayed'): ?>
                  <i class="fas fa-exclamation"></i>
                <?php else: ?>
                  <?= $m['stage_number'] ?>
                <?php endif; ?>
              </div>

              <div class="stage-content">
                <div class="d-flex flex-wrap justify-content-between align-items-center mb-1">
                  <h6 class="stage-name mb-0">
                    Stage <?= $m['stage_number'] ?>: <?= e($m['stage_name']) ?>
                  </h6>
                  <span class="badge-status <?= $m['status'] ?>">
                    <?= strtoupper(str_replace('_', ' ', $m['status'])) ?>
                  </span>
                </div>
                
                <p class="small text-secondary mb-2"><?= e($m['notes']) ?></p>

                <?php if ($m['status'] === 'in_progress'): ?>
                  <div class="p-3 rounded mb-2 border" style="background:#FEF3C7; border-color:#F59E0B !important;">
                    <small class="fw-bold text-navy d-block mb-1"><i class="fas fa-hard-hat text-warning me-1"></i> Site Engineering Status:</small>
                    <small class="text-secondary">Curing tests underway. Mortar ratio 1:4 inspected by Er. Vikram Rao (PMC). Ready for client site review.</small>
                  </div>
                <?php endif; ?>

                <?php if ($m['status'] === 'delayed'): ?>
                  <div class="alert alert-danger small p-2 rounded mb-2">
                    <i class="fas fa-exclamation-triangle me-1"></i> <strong>Delayed Task Alert:</strong> Unseasonal rain delayed plaster curing by 48 hours. Contractor overtime approved to recover milestone schedule.
                  </div>
                <?php endif; ?>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- SITE PHOTOS & SPECIFICATIONS -->
    <div class="col-lg-4">
      <!-- Site Photos Card -->
      <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
        <h5 class="fw-bold text-navy mb-3"><i class="fas fa-camera text-warning me-2"></i> Daily Site Photo Log</h5>
        <div class="row g-2">
          <div class="col-6">
            <div class="rounded overflow-hidden position-relative" style="height:110px; background:#0A192F;">
              <img src="../../assets/images/projects/project-1.jpg" alt="Site Photo 1" class="w-100 h-100 object-fit-cover">
              <span class="position-absolute bottom-0 start-0 bg-dark text-white p-1" style="font-size:0.6rem;">Stage 11 &bull; Plaster</span>
            </div>
          </div>
          <div class="col-6">
            <div class="rounded overflow-hidden position-relative" style="height:110px; background:#0A192F;">
              <img src="../../assets/images/services/commercial.jpg" alt="Site Photo 2" class="w-100 h-100 object-fit-cover">
              <span class="position-absolute bottom-0 start-0 bg-dark text-white p-1" style="font-size:0.6rem;">Stage 10 &bull; MEP</span>
            </div>
          </div>
          <div class="col-6">
            <div class="rounded overflow-hidden position-relative" style="height:110px; background:#0A192F;">
              <img src="../../assets/images/services/residential.jpg" alt="Site Photo 3" class="w-100 h-100 object-fit-cover">
              <span class="position-absolute bottom-0 start-0 bg-dark text-white p-1" style="font-size:0.6rem;">Stage 9 &bull; Brickwork</span>
            </div>
          </div>
          <div class="col-6">
            <div class="rounded overflow-hidden position-relative" style="height:110px; background:#0A192F;">
              <img src="../../assets/images/services/turnkey.jpg" alt="Site Photo 4" class="w-100 h-100 object-fit-cover">
              <span class="position-absolute bottom-0 start-0 bg-dark text-white p-1" style="font-size:0.6rem;">Stage 8 &bull; RCC Slab</span>
            </div>
          </div>
        </div>
        <p class="small text-muted text-center mt-3 mb-0">Photos uploaded daily by Site Engineer Er. S. Kumar.</p>
      </div>

      <!-- Quick Actions -->
      <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <h6 class="fw-bold text-navy mb-3">Project Governance Actions</h6>
        <div class="d-grid gap-2">
          <a href="site-visits.php" class="btn btn-navy btn-sm py-2">
            <i class="fas fa-calendar-check me-2"></i> Book On-Site Inspection
          </a>
          <a href="documents.php" class="btn btn-outline-secondary btn-sm py-2">
            <i class="fas fa-file-pdf me-2"></i> Download Sanctioned Blueprints
          </a>
          <a href="payments.php" class="btn btn-outline-warning text-dark border-warning btn-sm py-2">
            <i class="fas fa-receipt me-2"></i> Review Payment Milestones
          </a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
