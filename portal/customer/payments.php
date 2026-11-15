<?php
/**
 * Customer Payment Milestones & Invoices
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Payment Milestones & Invoices";

try {
    $db = Database::getConnection();
    // Get customer's project
    $pStmt = $db->prepare("SELECT id, title, total_budget FROM projects WHERE customer_id = ? LIMIT 1");
    $pStmt->execute([$userId]);
    $project = $pStmt->fetch();

    $payments = [];
    if ($project) {
        $payStmt = $db->prepare("SELECT * FROM payment_milestones WHERE project_id = ? ORDER BY id ASC");
        $payStmt->execute([$project['id']]);
        $payments = $payStmt->fetchAll();
    }
} catch (Exception $e) {
    $payments = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">Contract Payment Milestones</h4>
        <p class="text-muted small mb-0">Milestone disbursements are protected and released only upon certified stage verification.</p>
      </div>
      <div class="mt-3 mt-md-0">
        <span class="badge bg-dark text-warning border border-warning px-3 py-2 fs-6">
          Total Project Contract: ₹<?= !empty($project['total_budget']) ? number_format($project['total_budget'] / 10000000, 2) : '3.45' ?> Crores
        </span>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>#</th>
              <th>Milestone Stage</th>
              <th>Percentage Due</th>
              <th>Amount (INR)</th>
              <th>Due Date</th>
              <th>Status</th>
              <th>Txn / Receipt</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($payments)): ?>
              <?php foreach ($payments as $idx => $p): ?>
                <tr>
                  <td><?= $idx + 1 ?></td>
                  <td class="fw-bold text-navy"><?= e($p['milestone_title']) ?></td>
                  <td><?= $p['percentage_due'] ?>%</td>
                  <td class="fw-bold text-navy">₹<?= number_format($p['amount_due'], 2) ?></td>
                  <td><?= date('d M Y', strtotime($p['due_date'])) ?></td>
                  <td>
                    <span class="badge-status <?= $p['payment_status'] ?>"><?= strtoupper(e($p['payment_status'])) ?></span>
                  </td>
                  <td>
                    <?php if ($p['payment_status'] === 'paid'): ?>
                      <span class="small text-muted"><i class="fas fa-check text-success me-1"></i> Ref: <?= e($p['transaction_reference'] ?: 'ONLINE') ?></span>
                    <?php else: ?>
                      <button type="button" class="btn btn-sm btn-gold py-1 px-2" style="font-size:0.75rem;" onclick="alert('Bank Transfer Details:\nBank: HDFC Bank Jubilee Hills\nAccount: 50200089124401\nIFSC: HDFC0000542\nBeneficiary: Zippy Enterprises Private Limited');">
                        Pay Milestone
                      </button>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="7" class="text-center py-4 text-muted">No payment milestones scheduled for this account.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
