<?php
/**
 * Admin Quotation & Estimation Management
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Quotation & Estimation Suite";

$msg = '';
try {
    $db = Database::getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'update_status' && Security::verifyCsrf()) {
        $qid = (int)$_POST['quote_id'];
        $st  = Security::clean($_POST['status'] ?? 'sent');
        $up = $db->prepare("UPDATE quotations SET status = ? WHERE id = ?");
        $up->execute([$st, $qid]);
        $msg = "Quotation status updated to " . strtoupper($st) . "!";
    }

    $quotations = $db->query("SELECT q.*, u.name as customer_name, l.full_name as lead_name FROM quotations q LEFT JOIN users u ON q.customer_id = u.id LEFT JOIN leads l ON q.lead_id = l.id ORDER BY q.id DESC")->fetchAll();

} catch (Exception $e) {
    $quotations = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">Commercial Quotation Management</h4>
        <p class="text-muted small mb-0">Review BOQs, civil/finishing breakdowns, tax inclusions, and quotation approval stages.</p>
      </div>
      <a href="../../cost-estimator.php" target="_blank" class="btn btn-gold btn-sm">
        <i class="fas fa-calculator me-1"></i> Launch Cost Estimator
      </a>
    </div>
  </div>
</div>

<?php if ($msg): ?><div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div><?php endif; ?>

<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Quotation Ref</th>
              <th>Customer / Lead</th>
              <th>Built-Up Area</th>
              <th>Package Tier</th>
              <th>Structure (46%)</th>
              <th>Finishing &amp; MEP</th>
              <th>Total Estimate</th>
              <th>Status</th>
              <th>Update</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($quotations)): ?>
              <?php foreach ($quotations as $q): ?>
                <tr>
                  <td>
                    <span class="fw-bold text-navy"><?= e($q['quote_number']) ?></span><br>
                    <small class="text-muted"><?= date('d M Y', strtotime($q['created_at'])) ?></small>
                  </td>
                  <td>
                    <span class="fw-bold text-navy"><?= e($q['customer_name'] ?: ($q['lead_name'] ?: 'Prospect Client')) ?></span>
                  </td>
                  <td><?= number_format($q['built_up_area_sqft']) ?> Sq.Ft</td>
                  <td><span class="badge bg-dark text-warning border border-warning text-uppercase" style="font-size:0.7rem;"><?= e($q['package_tier']) ?></span></td>
                  <td>₹<?= number_format($q['structure_cost'] / 100000, 2) ?> L</td>
                  <td>₹<?= number_format(($q['finishing_cost'] + $q['mep_cost']) / 100000, 2) ?> L</td>
                  <td class="fw-bold text-navy">₹<?= number_format($q['total_estimated_cost'] / 100000, 2) ?> L</td>
                  <td><span class="badge-status <?= $q['status'] ?>"><?= strtoupper(e($q['status'])) ?></span></td>
                  <td>
                    <form action="quotations.php" method="POST" class="d-flex gap-1">
                      <?= Security::csrfField() ?>
                      <input type="hidden" name="action" value="update_status">
                      <input type="hidden" name="quote_id" value="<?= $q['id'] ?>">
                      <select name="status" class="form-select form-select-sm" style="font-size:0.75rem; width:110px;">
                        <option value="sent" <?= $q['status'] === 'sent' ? 'selected' : '' ?>>Sent</option>
                        <option value="approved" <?= $q['status'] === 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="revised" <?= $q['status'] === 'revised' ? 'selected' : '' ?>>Revised</option>
                        <option value="rejected" <?= $q['status'] === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                      </select>
                      <button type="submit" class="btn btn-sm btn-gold py-1 px-2" style="font-size:0.75rem;"><i class="fas fa-save"></i></button>
                    </form>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center py-4 text-muted">No quotations recorded.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
