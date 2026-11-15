<?php
/**
 * Builder Stage Progress Update & Daily Logs
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['builder', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Log Daily Site Progress & Milestones";

$msg = '';
$err = '';

try {
    $db = Database::getConnection();
    
    // Get builder profile
    $bStmt = $db->prepare("SELECT id FROM builder_profiles WHERE user_id = ? LIMIT 1");
    $bStmt->execute([$userId]);
    $bProf = $bStmt->fetch();
    $bId = $bProf['id'] ?? 1;

    // Get assigned projects
    $pStmt = $db->prepare("SELECT * FROM projects WHERE builder_id = ?");
    $pStmt->execute([$bId]);
    $projects = $pStmt->fetchAll();

    $selectedPid = (int)($_GET['pid'] ?? ($projects[0]['id'] ?? 1));

    // Handle stage update submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
        $projectId = (int)$_POST['project_id'];
        $stageNumber = (int)$_POST['stage_number'];
        $status = Security::clean($_POST['status'] ?? 'in_progress');
        $notes = Security::clean($_POST['notes'] ?? '');
        $photos = Security::clean($_POST['site_photos'] ?? '');

        // Update project_milestones
        $upMilestone = $db->prepare("UPDATE project_milestones SET status = ?, notes = ?, updated_by = ?, updated_at = CURRENT_TIMESTAMP WHERE project_id = ? AND stage_number = ?");
        $upMilestone->execute([$status, $notes, $userId, $projectId, $stageNumber]);

        // Calculate new progress percent
        $completedCount = (int)$db->query("SELECT COUNT(*) FROM project_milestones WHERE project_id = {$projectId} AND status = 'completed'")->fetchColumn();
        $inProgCount = (int)$db->query("SELECT COUNT(*) FROM project_milestones WHERE project_id = {$projectId} AND status = 'in_progress'")->fetchColumn();
        $newProgress = round((($completedCount * 1.0) + ($inProgCount * 0.5)) / 14 * 100, 2);

        // Update projects table
        $upPrj = $db->prepare("UPDATE projects SET current_stage_id = ?, progress_percent = ? WHERE id = ?");
        $upPrj->execute([$stageNumber, $newProgress, $projectId]);

        // Get customer ID to notify
        $custStmt = $db->prepare("SELECT customer_id, title FROM projects WHERE id = ?");
        $custStmt->execute([$projectId]);
        $prjRow = $custStmt->fetch();
        if ($prjRow && $prjRow['customer_id']) {
            Security::createNotification(
                (int)$prjRow['customer_id'],
                "Stage {$stageNumber} Update: {$prjRow['title']}",
                "Contractor updated Stage {$stageNumber} to " . strtoupper($status) . ". Notes: {$notes}",
                "my-project.php"
            );
        }

        Security::logAudit("STAGE_UPDATED", "Builder #{$userId} updated Project #{$projectId} Stage #{$stageNumber} to {$status}");
        $msg = "Stage {$stageNumber} progress successfully saved! Progress updated to {$newProgress}%.";
    }

    // Fetch milestones for selected project
    $mStmt = $db->prepare("SELECT * FROM project_milestones WHERE project_id = ? ORDER BY stage_number ASC");
    $mStmt->execute([$selectedPid]);
    $milestones = $mStmt->fetchAll();

} catch (Exception $e) {
    $err = "Database error: " . $e->getMessage();
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Update Site Stage Progress</h4>
      <p class="text-muted small mb-0">Record daily civil construction milestones, concrete curing logs, and site progress notes.</p>
    </div>
  </div>
</div>

<?php if ($msg): ?>
  <div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div>
<?php endif; ?>
<?php if ($err): ?>
  <div class="alert alert-danger p-3 rounded mb-4"><i class="fas fa-exclamation-circle me-1"></i> <?= e($err) ?></div>
<?php endif; ?>

<div class="row g-4">
  <!-- UPDATE FORM -->
  <div class="col-lg-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h5 class="fw-bold text-navy mb-3">Submit Stage Status Update</h5>
      <form action="update-stage.php?pid=<?= $selectedPid ?>" method="POST">
        <?= Security::csrfField() ?>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Select Construction Site *</label>
          <select name="project_id" class="form-select" onchange="window.location.href='update-stage.php?pid=' + this.value;">
            <?php foreach ($projects as $pr): ?>
              <option value="<?= $pr['id'] ?>" <?= $pr['id'] == $selectedPid ? 'selected' : '' ?>>
                <?= e($pr['project_code']) ?> &bull; <?= e($pr['title']) ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Construction Stage (1 - 14) *</label>
          <select name="stage_number" class="form-select" required>
            <?php foreach ($milestones as $m): ?>
              <option value="<?= $m['stage_number'] ?>">
                Stage <?= $m['stage_number'] ?>: <?= e($m['stage_name']) ?> (Current: <?= strtoupper($m['status']) ?>)
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Updated Stage Status *</label>
          <select name="status" class="form-select" required>
            <option value="in_progress">In Progress (Execution Underway)</option>
            <option value="completed">Completed (Ready for PMC Quality Inspection)</option>
            <option value="delayed">Delayed (Material / Weather Holdup)</option>
            <option value="pending">Pending</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Daily Site Notes &amp; Material Log *</label>
          <textarea name="notes" rows="4" class="form-control" required placeholder="Describe work completed today, e.g. column rebar binding completed, concrete slump measured at 110mm, cube samples taken..."></textarea>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
          <i class="fas fa-check-circle me-2"></i> Update Construction Milestone
        </button>
      </form>
    </div>
  </div>

  <!-- CURRENT STAGES TABLE FOR SELECTED PROJECT -->
  <div class="col-lg-7">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom">
        <h5 class="fw-bold text-navy mb-0">Milestones for Selected Project</h5>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Stage Name</th>
              <th>Status</th>
              <th>Engineer Log</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($milestones as $m): ?>
              <tr>
                <td><strong><?= $m['stage_number'] ?></strong></td>
                <td class="fw-bold text-navy"><?= e($m['stage_name']) ?></td>
                <td><span class="badge-status <?= $m['status'] ?>"><?= strtoupper(e($m['status'])) ?></span></td>
                <td><small class="text-muted"><?= e($m['notes'] ?: 'Pending initiation') ?></small></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
