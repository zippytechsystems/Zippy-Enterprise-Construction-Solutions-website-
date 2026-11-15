<?php
/**
 * Customer Dashboard Overview
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];

$portalTitle = "Customer Project Dashboard";

// Fetch customer project
$project = null;
$milestones = [];
$upcomingPayment = null;
$documents = [];

try {
    $db = Database::getConnection();
    
    // Project for this customer
    $stmt = $db->prepare("SELECT p.*, bp.company_name as builder_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id WHERE p.customer_id = ? LIMIT 1");
    $stmt->execute([$userId]);
    $project = $stmt->fetch();

    if ($project) {
        // Milestones
        $mStmt = $db->prepare("SELECT * FROM project_milestones WHERE project_id = ? ORDER BY stage_number ASC");
        $mStmt->execute([$project['id']]);
        $milestones = $mStmt->fetchAll();

        // Next pending payment
        $pStmt = $db->prepare("SELECT * FROM payment_milestones WHERE project_id = ? AND payment_status = 'pending' ORDER BY id ASC LIMIT 1");
        $pStmt->execute([$project['id']]);
        $upcomingPayment = $pStmt->fetch();

        // Recent documents
        $dStmt = $db->prepare("SELECT * FROM project_documents WHERE project_id = ? ORDER BY id DESC LIMIT 4");
        $dStmt->execute([$project['id']]);
        $documents = $dStmt->fetchAll();
    }
} catch (Exception $e) {
    error_log("Customer portal error: " . $e->getMessage());
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<!-- WELCOME BANNER -->
<div class="row mb-4">
  <div class="col-12">
    <div class="p-4 rounded-4 shadow-sm" style="background: linear-gradient(135deg, #0A192F 0%, #16365C 100%); color:#FFFFFF; border:1px solid var(--border-gold);">
      <div class="row align-items-center">
        <div class="col-lg-8">
          <span class="badge-gold mb-2">CLIENT SELF-SERVICE PORTAL</span>
          <h2 class="text-white fw-bold mb-1">Welcome back, <?= e($user['name']) ?></h2>
          <p class="text-white-50 mb-0">Track real-time engineering milestones, inspect verified daily site photos, and review your payment schedules.</p>
        </div>
        <div class="col-lg-4 text-lg-end mt-3 mt-lg-0">
          <a href="site-visits.php" class="btn btn-gold btn-sm px-3">
            <i class="fas fa-calendar-plus me-1"></i> Request Site Visit
          </a>
          <a href="support.php" class="btn btn-outline-light btn-sm px-3 ms-2">
            <i class="fas fa-headset me-1"></i> Support
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if ($project): ?>
  <!-- ACTIVE PROJECT KPI STATS -->
  <div class="row g-4 mb-4">
    <div class="col-md-6 col-xl-3">
      <div class="portal-stat-card">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small text-muted fw-bold text-uppercase mb-1">Project Code</div>
            <div class="h5 fw-bold text-navy mb-0"><?= e($project['project_code']) ?></div>
            <small class="text-muted"><?= strtoupper(e($project['category'])) ?> &bull; <?= e($project['city']) ?></small>
          </div>
          <div class="stat-icon-wrapper stat-icon-navy">
            <i class="fas fa-building"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="portal-stat-card">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small text-muted fw-bold text-uppercase mb-1">Current Progress</div>
            <div class="h5 fw-bold text-navy mb-0"><?= $project['progress_percent'] ?>%</div>
            <small class="text-success fw-bold"><i class="fas fa-clock me-1"></i> On Schedule</small>
          </div>
          <div class="stat-icon-wrapper stat-icon-green">
            <i class="fas fa-tasks"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="portal-stat-card">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small text-muted fw-bold text-uppercase mb-1">Current Active Stage</div>
            <div class="h5 fw-bold text-warning mb-0">Stage <?= $project['current_stage_id'] ?> of 14</div>
            <small class="text-muted">Plastering &amp; Waterproofing</small>
          </div>
          <div class="stat-icon-wrapper stat-icon-gold">
            <i class="fas fa-hard-hat"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-6 col-xl-3">
      <div class="portal-stat-card">
        <div class="d-flex justify-content-between align-items-start">
          <div>
            <div class="small text-muted fw-bold text-uppercase mb-1">Target Handover</div>
            <div class="h5 fw-bold text-navy mb-0"><?= date('M Y', strtotime($project['target_handover_date'])) ?></div>
            <small class="text-muted">Guaranteed Contract Date</small>
          </div>
          <div class="stat-icon-wrapper stat-icon-purple">
            <i class="fas fa-calendar-check"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- PROJECT PROGRESS & TIMELINE SNAPSHOT -->
  <div class="row g-4 mb-4">
    <div class="col-lg-8">
      <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <div>
            <h5 class="fw-bold text-navy mb-0"><?= e($project['title']) ?></h5>
            <small class="text-muted"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($project['site_address']) ?></small>
          </div>
          <a href="my-project.php" class="btn btn-sm btn-outline-warning text-dark border-warning fw-bold">
            Full 14-Stage View <i class="fas fa-arrow-right ms-1"></i>
          </a>
        </div>

        <div class="p-3 rounded-3 mb-4" style="background:#F8FAFC;">
          <div class="d-flex justify-content-between small text-muted mb-1">
            <span>Overall Construction Progress</span>
            <span class="fw-bold text-navy"><?= $project['progress_percent'] ?>% Completed</span>
          </div>
          <div class="progress" style="height: 10px; border-radius:10px;">
            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: <?= $project['progress_percent'] ?>%;"></div>
          </div>
        </div>

        <!-- 14-Stage Highlights (Recent 4 stages) -->
        <h6 class="fw-bold text-navy mb-3">Construction Stages Timeline</h6>
        <div class="stages-timeline-container p-0">
          <?php foreach (array_slice($milestones, 9, 4) as $m): ?>
            <div class="stage-step <?= $m['status'] ?>">
              <div class="stage-indicator">
                <?php if ($m['status'] === 'completed'): ?>
                  <i class="fas fa-check"></i>
                <?php else: ?>
                  <?= $m['stage_number'] ?>
                <?php endif; ?>
              </div>
              <div class="stage-content">
                <div class="d-flex justify-content-between align-items-center">
                  <h6 class="stage-name mb-0"><?= e($m['stage_name']) ?></h6>
                  <span class="badge-status <?= $m['status'] ?>"><?= strtoupper(str_replace('_', ' ', $m['status'])) ?></span>
                </div>
                <p class="small text-muted mb-0 mt-1"><?= e($m['notes']) ?></p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>
      </div>
    </div>

    <!-- SIDE PANEL: UPCOMING PAYMENT & RECENT DOCS -->
    <div class="col-lg-4">
      <!-- UPCOMING PAYMENT MILESTONE -->
      <?php if ($upcomingPayment): ?>
        <div class="card border-0 shadow-sm rounded-4 p-4 mb-4" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge-gold">NEXT PAYMENT</span>
            <small class="text-white-50"><i class="fas fa-clock text-warning me-1"></i> Due <?= date('d M Y', strtotime($upcomingPayment['due_date'])) ?></small>
          </div>
          <h5 class="fw-bold text-white mb-1"><?= e($upcomingPayment['milestone_title']) ?></h5>
          <div class="h3 fw-bold text-warning mb-2">₹<?= number_format($upcomingPayment['amount_due'], 2) ?></div>
          <p class="small text-white-50 mb-3">Disbursement payable upon technical signoff of plastering and waterproofing cube tests.</p>
          <a href="payments.php" class="btn btn-gold btn-sm w-100">
            <i class="fas fa-file-invoice me-1"></i> View Milestone Invoice &amp; Bank Details
          </a>
        </div>
      <?php endif; ?>

      <!-- QUICK DOCUMENTS -->
      <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
        <div class="d-flex justify-content-between align-items-center mb-3">
          <h6 class="fw-bold text-navy mb-0">Project Documents</h6>
          <a href="documents.php" class="small text-warning fw-bold">View All</a>
        </div>
        <ul class="list-unstyled mb-0">
          <?php foreach ($documents as $doc): ?>
            <li class="py-2 border-bottom d-flex justify-content-between align-items-center">
              <div class="d-flex align-items-center">
                <i class="fas fa-file-pdf text-danger fa-lg me-2"></i>
                <div>
                  <div class="small fw-bold text-navy text-truncate" style="max-width:180px;"><?= e($doc['document_title']) ?></div>
                  <small class="text-muted"><?= strtoupper(e($doc['category'])) ?></small>
                </div>
              </div>
              <a href="../../<?= e($doc['file_path']) ?>" class="btn btn-sm btn-light border" download target="_blank" title="Download Document">
                <i class="fas fa-download text-muted"></i>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>

<?php else: ?>
  <!-- NO PROJECT ASSIGNED YET -->
  <div class="card border-0 shadow-sm rounded-4 p-5 text-center bg-white">
    <div class="brand-logo-icon mx-auto mb-3" style="width:64px; height:64px; font-size:1.8rem;">
      <i class="fas fa-hard-hat"></i>
    </div>
    <h3 class="fw-bold text-navy mb-2">Welcome to Your Construction Portal</h3>
    <p class="text-muted mx-auto mb-4" style="max-width:540px;">
      You do not have an active construction project linked yet. Start by generating a quotation with our estimation engine or schedule an on-site plot survey with our engineering team.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <a href="../../cost-estimator.php" class="btn btn-gold">
        <i class="fas fa-calculator me-1"></i> Generate Construction Estimate
      </a>
      <a href="site-visits.php" class="btn btn-navy">
        <i class="fas fa-calendar-check me-1"></i> Book Plot Inspection
      </a>
    </div>
  </div>
<?php endif; ?>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
