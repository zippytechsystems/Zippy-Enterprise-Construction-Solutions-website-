<?php
/**
 * Admin Lead & CRM Management Desk
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Lead Management & CRM Desk";

$msg = '';
$err = '';

try {
    $db = Database::getConnection();

    // Handle lead status update
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
        $leadId = (int)$_POST['lead_id'];
        $newStatus = Security::clean($_POST['status'] ?? 'contacted');
        $notes = Security::clean($_POST['notes'] ?? '');

        $up = $db->prepare("UPDATE leads SET status = ?, notes = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        $up->execute([$newStatus, $notes, $leadId]);

        Security::logAudit("LEAD_UPDATED", "Admin updated Lead #{$leadId} to {$newStatus}");
        $msg = "Lead #{$leadId} status updated to " . strtoupper($newStatus) . "!";
    }

    $leads = $db->query("SELECT * FROM leads ORDER BY id DESC")->fetchAll();

} catch (Exception $e) {
    $err = $e->getMessage();
    $leads = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">CRM Lead Desk &amp; Enquiry Pipeline</h4>
        <p class="text-muted small mb-0">Capture website inquiries, calculator submissions, follow-up scheduling, and conversion tracking.</p>
      </div>
      <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#newLeadModal">
        <i class="fas fa-plus me-1"></i> Add Direct Lead
      </button>
    </div>
  </div>
</div>

<?php if ($msg): ?><div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="alert alert-danger p-3 rounded mb-4"><i class="fas fa-exclamation-circle me-1"></i> <?= e($err) ?></div><?php endif; ?>

<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Enquiry No.</th>
              <th>Customer Name</th>
              <th>Contact Details</th>
              <th>Service Required</th>
              <th>Location &amp; Budget</th>
              <th>Source</th>
              <th>Status</th>
              <th>Update Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($leads)): ?>
              <?php foreach ($leads as $l): ?>
                <tr>
                  <td>
                    <span class="badge bg-light text-navy border fw-bold"><?= e($l['enquiry_number']) ?></span><br>
                    <small class="text-muted"><?= date('d M Y', strtotime($l['created_at'])) ?></small>
                  </td>
                  <td class="fw-bold text-navy"><?= e($l['full_name']) ?></td>
                  <td>
                    <small class="d-block text-navy"><i class="fas fa-phone-alt text-warning me-1"></i> <?= e($l['phone']) ?></small>
                    <small class="d-block text-muted"><i class="fas fa-envelope text-warning me-1"></i> <?= e($l['email']) ?></small>
                  </td>
                  <td><span class="badge bg-dark text-warning border border-warning"><?= e($l['service_requested']) ?></span></td>
                  <td>
                    <small class="d-block fw-semibold text-navy"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($l['project_location']) ?></small>
                    <small class="text-muted"><?= e($l['estimated_budget'] ?: 'Not Specified') ?></small>
                  </td>
                  <td><span class="badge bg-light text-muted border text-uppercase" style="font-size:0.65rem;"><?= e($l['source']) ?></span></td>
                  <td>
                    <span class="badge-status <?= $l['status'] ?>"><?= strtoupper(e($l['status'])) ?></span>
                  </td>
                  <td>
                    <form action="leads.php" method="POST" class="d-flex gap-1 align-items-center">
                      <?= Security::csrfField() ?>
                      <input type="hidden" name="lead_id" value="<?= $l['id'] ?>">
                      <select name="status" class="form-select form-select-sm" style="font-size:0.75rem; width:130px;">
                        <option value="new" <?= $l['status'] === 'new' ? 'selected' : '' ?>>New</option>
                        <option value="contacted" <?= $l['status'] === 'contacted' ? 'selected' : '' ?>>Contacted</option>
                        <option value="site_visit_scheduled" <?= $l['status'] === 'site_visit_scheduled' ? 'selected' : '' ?>>Site Visit</option>
                        <option value="estimation_sent" <?= $l['status'] === 'estimation_sent' ? 'selected' : '' ?>>Est. Sent</option>
                        <option value="converted" <?= $l['status'] === 'converted' ? 'selected' : '' ?>>Converted</option>
                        <option value="dropped" <?= $l['status'] === 'dropped' ? 'selected' : '' ?>>Dropped</option>
                      </select>
                      <button type="submit" class="btn btn-sm btn-gold py-1 px-2" style="font-size:0.75rem;" title="Update Lead">
                        <i class="fas fa-save"></i>
                      </button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center py-4 text-muted">No leads logged yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Add Direct Lead -->
<div class="modal fade" id="newLeadModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold">Manual CRM Lead Entry</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="../../api/submit-enquiry.php" method="POST">
        <?= Security::csrfField() ?>
        <input type="hidden" name="source" value="call">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label small fw-bold">Prospect Full Name *</label>
            <input type="text" name="full_name" class="form-control" required placeholder="Name">
          </div>
          <div class="row g-2 mb-3">
            <div class="col-6">
              <label class="form-label small fw-bold">Phone *</label>
              <input type="tel" name="phone" class="form-control" required placeholder="+91...">
            </div>
            <div class="col-6">
              <label class="form-label small fw-bold">Email</label>
              <input type="email" name="email" class="form-control" placeholder="name@email.com">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Service Required</label>
            <select name="service_requested" class="form-select">
              <option value="Residential Building Construction">Residential Building Construction</option>
              <option value="Commercial Building Construction">Commercial Building Construction</option>
              <option value="Apartment Construction">Apartment Construction</option>
              <option value="Turnkey Construction">Turnkey EPC Construction</option>
              <option value="Self-Construction Loan Assistance">Self-Construction Loan Assistance</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Plot Location *</label>
            <input type="text" name="project_location" class="form-control" required placeholder="e.g. Kokapet">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Estimated Budget</label>
            <input type="text" name="estimated_budget" class="form-control" placeholder="e.g. ₹2.5 Cr">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm">Save Lead</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
