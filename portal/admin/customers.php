<?php
/**
 * Admin Customer Management & Site Visits
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Customer Management & Directory";

$msg = '';
try {
    $db = Database::getConnection();

    // Confirm or reschedule site visit
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_visit' && Security::verifyCsrf()) {
        $visitId = (int)$_POST['visit_id'];
        $status = Security::clean($_POST['status'] ?? 'confirmed');
        $notes = Security::clean($_POST['admin_notes'] ?? '');

        $up = $db->prepare("UPDATE site_visits SET status = ?, admin_notes = ? WHERE id = ?");
        $up->execute([$status, $notes, $visitId]);
        $msg = "Site visit #{$visitId} updated to " . strtoupper($status) . "!";
    }

    // Customers with project counts
    $customers = $db->query("SELECT u.*, COUNT(p.id) as project_count FROM users u LEFT JOIN projects p ON u.id = p.customer_id WHERE u.role = 'customer' GROUP BY u.id ORDER BY u.id DESC")->fetchAll();

    // Site visits
    $visits = $db->query("SELECT sv.*, u.name as customer_name, u.phone as customer_phone, p.title as project_title FROM site_visits sv JOIN users u ON sv.user_id = u.id LEFT JOIN projects p ON sv.project_id = p.id ORDER BY sv.id DESC")->fetchAll();

} catch (Exception $e) {
    $customers = [];
    $visits = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Customer Accounts &amp; Site Visit Coordination</h4>
      <p class="text-muted small mb-0">Manage registered property clients, inspect linked projects, and confirm site inspection requests.</p>
    </div>
  </div>
</div>

<?php if ($msg): ?><div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div><?php endif; ?>

<!-- TABS -->
<ul class="nav nav-pills mb-4" id="custTab" role="tablist">
  <li class="nav-item">
    <button class="nav-link active px-4 fw-bold" id="customers-tab" data-bs-toggle="pill" data-bs-target="#customers-pane">
      <i class="fas fa-users me-2"></i> Registered Customers (<?= count($customers) ?>)
    </button>
  </li>
  <li class="nav-item">
    <button class="nav-link px-4 fw-bold" id="visits-tab" data-bs-toggle="pill" data-bs-target="#visits-pane">
      <i class="fas fa-calendar-alt me-2"></i> Site Visit Requests (<?= count($visits) ?>)
    </button>
  </li>
</ul>

<div class="tab-content" id="custTabContent">
  <!-- PANE 1: CUSTOMERS DIRECTORY -->
  <div class="tab-pane fade show active" id="customers-pane">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>ID</th>
              <th>Customer Name</th>
              <th>Contact Info</th>
              <th>Registered Since</th>
              <th>Linked Projects</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($customers as $c): ?>
              <tr>
                <td>#<?= $c['id'] ?></td>
                <td class="fw-bold text-navy"><?= e($c['name']) ?></td>
                <td>
                  <small class="d-block text-navy"><i class="fas fa-phone-alt text-warning me-1"></i> <?= e($c['phone']) ?></small>
                  <small class="d-block text-muted"><i class="fas fa-envelope text-warning me-1"></i> <?= e($c['email']) ?></small>
                </td>
                <td><?= date('d M Y', strtotime($c['created_at'])) ?></td>
                <td><span class="badge bg-light text-navy border fw-bold"><?= $c['project_count'] ?> Active Sites</span></td>
                <td><span class="badge-status active">ACTIVE</span></td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- PANE 2: SITE VISITS -->
  <div class="tab-pane fade" id="visits-pane">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Visit Date &amp; Slot</th>
              <th>Customer</th>
              <th>Site Project</th>
              <th>Purpose</th>
              <th>Status</th>
              <th>Action / Notes</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($visits as $v): ?>
              <tr>
                <td>
                  <span class="fw-bold text-navy"><?= date('d M Y', strtotime($v['requested_date'])) ?></span><br>
                  <small class="text-muted"><?= e($v['time_slot']) ?></small>
                </td>
                <td>
                  <span class="fw-bold text-navy"><?= e($v['customer_name']) ?></span><br>
                  <small class="text-muted"><?= e($v['customer_phone']) ?></small>
                </td>
                <td><small class="text-muted"><?= e($v['project_title'] ?: 'Plot Survey') ?></small></td>
                <td><small class="text-secondary"><?= e($v['visit_purpose']) ?></small></td>
                <td><span class="badge-status <?= $v['status'] ?>"><?= strtoupper(e($v['status'])) ?></span></td>
                <td>
                  <form action="customers.php" method="POST" class="d-flex gap-1">
                    <?= Security::csrfField() ?>
                    <input type="hidden" name="action" value="update_visit">
                    <input type="hidden" name="visit_id" value="<?= $v['id'] ?>">
                    <select name="status" class="form-select form-select-sm" style="font-size:0.75rem; width:120px;">
                      <option value="confirmed" <?= $v['status'] === 'confirmed' ? 'selected' : '' ?>>Confirmed</option>
                      <option value="completed" <?= $v['status'] === 'completed' ? 'selected' : '' ?>>Completed</option>
                      <option value="cancelled" <?= $v['status'] === 'cancelled' ? 'selected' : '' ?>>Cancelled</option>
                    </select>
                    <button type="submit" class="btn btn-sm btn-gold py-1 px-2" style="font-size:0.75rem;"><i class="fas fa-save"></i></button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
