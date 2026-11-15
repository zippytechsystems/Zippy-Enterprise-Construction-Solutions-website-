<?php
/**
 * Customer Site Visit Booking & History
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Site Visit Appointments";

$msg = '';
$err = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
    $date = Security::clean($_POST['requested_date'] ?? '');
    $slot = Security::clean($_POST['time_slot'] ?? '');
    $purpose = Security::clean($_POST['visit_purpose'] ?? '');
    $projectId = !empty($_POST['project_id']) ? (int)$_POST['project_id'] : null;

    if (empty($date) || empty($slot) || empty($purpose)) {
        $err = 'Please select a date, time slot, and reason for your visit.';
    } else {
        try {
            $db = Database::getConnection();
            $sql = Database::getDriver() === 'mysql'
                ? "INSERT INTO site_visits (project_id, user_id, requested_date, time_slot, visit_purpose, status, created_at) VALUES (?, ?, ?, ?, ?, 'requested', NOW())"
                : "INSERT INTO site_visits (project_id, user_id, requested_date, time_slot, visit_purpose, status, created_at) VALUES (?, ?, ?, ?, ?, 'requested', datetime('now'))";
            $stmt = $db->prepare($sql);
            $stmt->execute([$projectId, $userId, $date, $slot, $purpose]);
            $msg = 'Site visit request registered! Our site engineer will confirm your slot.';
        } catch (Exception $e) {
            $err = 'Error saving visit request: ' . $e->getMessage();
        }
    }
}

try {
    $db = Database::getConnection();
    // Get projects for dropdown
    $pStmt = $db->prepare("SELECT id, title FROM projects WHERE customer_id = ?");
    $pStmt->execute([$userId]);
    $projects = $pStmt->fetchAll();

    // Get past visits
    $vStmt = $db->prepare("SELECT * FROM site_visits WHERE user_id = ? ORDER BY id DESC");
    $vStmt->execute([$userId]);
    $visits = $vStmt->fetchAll();
} catch (Exception $e) {
    $visits = [];
    $projects = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Site Inspection Appointments</h4>
      <p class="text-muted small mb-0">Schedule on-site walkthroughs with your dedicated Project Management Engineer.</p>
    </div>
  </div>
</div>

<?php if ($msg): ?>
  <div class="alert alert-success small p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div>
<?php endif; ?>
<?php if ($err): ?>
  <div class="alert alert-danger small p-3 rounded mb-4"><i class="fas fa-exclamation-circle me-1"></i> <?= e($err) ?></div>
<?php endif; ?>

<div class="row g-4">
  <!-- BOOKING FORM -->
  <div class="col-lg-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h5 class="fw-bold text-navy mb-3">Request New Site Visit</h5>
      <form action="site-visits.php" method="POST">
        <?= Security::csrfField() ?>

        <?php if (!empty($projects)): ?>
          <div class="mb-3">
            <label class="form-label small fw-bold text-navy">Project Site</label>
            <select name="project_id" class="form-select">
              <?php foreach ($projects as $pr): ?>
                <option value="<?= $pr['id'] ?>"><?= e($pr['title']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
        <?php endif; ?>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Preferred Date *</label>
          <input type="date" name="requested_date" class="form-control" required min="<?= date('Y-m-d') ?>">
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Preferred Time Slot *</label>
          <select name="time_slot" class="form-select" required>
            <option value="10:00 AM - 11:30 AM">10:00 AM - 11:30 AM (Morning Slot)</option>
            <option value="02:30 PM - 04:00 PM">02:30 PM - 04:00 PM (Afternoon Slot)</option>
            <option value="04:30 PM - 06:00 PM">04:30 PM - 06:00 PM (Evening Golden Hour)</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label small fw-bold text-navy">Purpose of Inspection *</label>
          <textarea name="visit_purpose" rows="3" class="form-control" required placeholder="e.g. Inspect electrical conduit locations, review living room marble samples..."></textarea>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
          <i class="fas fa-calendar-check me-2"></i> Submit Visit Request
        </button>
      </form>
    </div>
  </div>

  <!-- PAST VISITS TABLE -->
  <div class="col-lg-7">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom">
        <h5 class="fw-bold text-navy mb-0">Visit History &amp; Status</h5>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Date &amp; Slot</th>
              <th>Inspection Purpose</th>
              <th>Status</th>
              <th>Engineer Remarks</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($visits)): ?>
              <?php foreach ($visits as $v): ?>
                <tr>
                  <td>
                    <span class="fw-bold text-navy"><?= date('d M Y', strtotime($v['requested_date'])) ?></span><br>
                    <small class="text-muted"><?= e($v['time_slot']) ?></small>
                  </td>
                  <td><small class="text-secondary"><?= e($v['visit_purpose']) ?></small></td>
                  <td><span class="badge-status <?= $v['status'] ?>"><?= strtoupper(e($v['status'])) ?></span></td>
                  <td><small class="text-muted"><?= e($v['admin_notes'] ?: 'Pending confirmation') ?></small></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="4" class="text-center py-4 text-muted">No site visits scheduled yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
