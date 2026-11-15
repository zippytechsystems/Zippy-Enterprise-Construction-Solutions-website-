<?php
/**
 * Admin Financial & Milestone Disbursements
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Financial Governance & Cashflow Desk";

$msg = '';
try {
    $db = Database::getConnection();

    // Mark milestone payment as paid
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'mark_paid' && Security::verifyCsrf()) {
        $payId = (int)$_POST['payment_id'];
        $ref = Security::clean($_POST['txn_ref'] ?? 'BANK-NEFT');

        $up = $db->prepare("UPDATE payment_milestones SET payment_status = 'paid', paid_date = CURRENT_TIMESTAMP, transaction_reference = ? WHERE id = ?");
        $up->execute([$ref, $payId]);
        $msg = "Payment milestone #{$payId} marked as PAID with Ref: {$ref}!";
        Security::logAudit("PAYMENT_RECORDED", "Admin marked Milestone #{$payId} as PAID");
    }

    $payments = $db->query("SELECT pm.*, p.title as project_title, p.project_code, u.name as customer_name FROM payment_milestones pm JOIN projects p ON pm.project_id = p.id JOIN users u ON p.customer_id = u.id ORDER BY pm.id ASC")->fetchAll();

    $totalDue = (float)$db->query("SELECT SUM(amount_due) FROM payment_milestones")->fetchColumn();
    $totalPaid = (float)$db->query("SELECT SUM(amount_due) FROM payment_milestones WHERE payment_status = 'paid'")->fetchColumn();
    $totalPending = (float)$db->query("SELECT SUM(amount_due) FROM payment_milestones WHERE payment_status = 'pending'")->fetchColumn();

} catch (Exception $e) {
    $payments = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Financial &amp; Milestone Billing Governance</h4>
      <p class="text-muted small mb-0">Monitor cashflow inflows, stage disbursement authorizations, and contractor payment releases.</p>
    </div>
  </div>
</div>

<?php if ($msg): ?><div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div><?php endif; ?>

<!-- FINANCE SUMMARY STATS -->
<div class="row g-3 mb-4">
  <div class="col-md-4">
    <div class="portal-stat-card">
      <div class="small text-muted fw-bold text-uppercase mb-1">Contract Billed Total</div>
      <div class="h3 fw-bold text-navy mb-0">₹<?= number_format($totalDue / 10000000, 2) ?> Cr</div>
      <small class="text-muted">Total Scheduled Milestones</small>
    </div>
  </div>
  <div class="col-md-4">
    <div class="portal-stat-card">
      <div class="small text-muted fw-bold text-uppercase mb-1">Total Realized Revenue</div>
      <div class="h3 fw-bold text-success mb-0">₹<?= number_format($totalPaid / 10000000, 2) ?> Cr</div>
      <small class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> Received in Escrow</small>
    </div>
  </div>
  <div class="col-md-4">
    <div class="portal-stat-card">
      <div class="small text-muted fw-bold text-uppercase mb-1">Pending Receivables</div>
      <div class="h3 fw-bold text-warning mb-0">₹<?= number_format($totalPending / 10000000, 2) ?> Cr</div>
      <small class="text-muted">Awaiting Stage Completion Sign-Off</small>
    </div>
  </div>
</div>

<!-- PAYMENTS TABLE -->
<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom">
        <h5 class="fw-bold text-navy mb-0">Scheduled &amp; Paid Milestones</h5>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Project Site</th>
              <th>Customer</th>
              <th>Milestone Stage</th>
              <th>Percentage</th>
              <th>Amount Due</th>
              <th>Target Date</th>
              <th>Status</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($payments as $p): ?>
              <tr>
                <td>
                  <span class="fw-bold text-navy"><?= e($p['project_title']) ?></span><br>
                  <small class="badge bg-light text-navy border"><?= e($p['project_code']) ?></small>
                </td>
                <td><small class="fw-bold text-navy"><?= e($p['customer_name']) ?></small></td>
                <td><small class="fw-bold text-navy"><?= e($p['milestone_title']) ?></small></td>
                <td><?= $p['percentage_due'] ?>%</td>
                <td class="fw-bold text-navy">₹<?= number_format($p['amount_due'] / 100000, 2) ?> Lakhs</td>
                <td><small class="text-muted"><?= date('d M Y', strtotime($p['due_date'])) ?></small></td>
                <td><span class="badge-status <?= $p['payment_status'] ?>"><?= strtoupper(e($p['payment_status'])) ?></span></td>
                <td>
                  <?php if ($p['payment_status'] === 'pending'): ?>
                    <form action="finance.php" method="POST" class="d-flex gap-1" onsubmit="return confirm('Confirm milestone payment received?');">
                      <?= Security::csrfField() ?>
                      <input type="hidden" name="action" value="mark_paid">
                      <input type="hidden" name="payment_id" value="<?= $p['id'] ?>">
                      <input type="text" name="txn_ref" class="form-control form-control-sm" style="width:110px; font-size:0.75rem;" placeholder="Txn Ref" required>
                      <button type="submit" class="btn btn-sm btn-success py-1 px-2" style="font-size:0.75rem;"><i class="fas fa-check"></i></button>
                    </form>
                  <?php else: ?>
                    <small class="text-success fw-bold"><i class="fas fa-check-double me-1"></i> <?= e($p['transaction_reference'] ?: 'CLEARED') ?></small>
                  <?php endif; ?>
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
