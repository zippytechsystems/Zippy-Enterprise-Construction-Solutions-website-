<?php
/**
 * Customer Quotations & BOQ History
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "My Quotations & Estimates";

try {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT * FROM quotations WHERE customer_id = ? OR customer_id IS NULL ORDER BY id DESC LIMIT 10");
    $stmt->execute([$userId]);
    $quotations = $stmt->fetchAll();
} catch (Exception $e) {
    $quotations = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">Quotations &amp; Bill of Quantities</h4>
        <p class="text-muted small mb-0">View all itemized cost estimates generated for your construction projects.</p>
      </div>
      <a href="../../cost-estimator.php" class="btn btn-gold btn-sm">
        <i class="fas fa-plus me-1"></i> Generate New Estimate
      </a>
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
              <th>Quotation Ref</th>
              <th>Package Tier</th>
              <th>Built-Up Area</th>
              <th>Civil Structure</th>
              <th>Finishing &amp; MEP</th>
              <th>Total Estimate</th>
              <th>Status</th>
              <th class="text-end">Actions</th>
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
                    <span class="badge bg-dark text-warning border border-warning text-uppercase"><?= e($q['package_tier']) ?></span>
                  </td>
                  <td><?= number_format($q['built_up_area_sqft']) ?> Sq.Ft (<?= $q['floors'] ?> Floors)</td>
                  <td>₹<?= number_format($q['structure_cost'] / 100000, 2) ?> Lakhs</td>
                  <td>₹<?= number_format(($q['finishing_cost'] + $q['mep_cost']) / 100000, 2) ?> Lakhs</td>
                  <td class="fw-bold text-navy">₹<?= number_format($q['total_estimated_cost'] / 100000, 2) ?> Lakhs</td>
                  <td>
                    <span class="badge-status <?= $q['status'] ?>"><?= strtoupper(e($q['status'])) ?></span>
                  </td>
                  <td class="text-end">
                    <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print();" title="Print/Download PDF">
                      <i class="fas fa-file-pdf text-danger me-1"></i> Download
                    </button>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="8" class="text-center py-4 text-muted">No saved quotations found. Use the Cost Estimator to create one.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
