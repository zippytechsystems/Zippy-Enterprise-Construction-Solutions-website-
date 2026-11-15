<?php
/**
 * Admin Security & System Audit Trail
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Security & Audit Governance Trail";

try {
    $db = Database::getConnection();
    $logs = $db->query("SELECT al.*, u.name as user_name, u.role as user_role FROM audit_logs al LEFT JOIN users u ON al.user_id = u.id ORDER BY al.id DESC LIMIT 100")->fetchAll();
} catch (Exception $e) {
    $logs = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Immutable Security &amp; Activity Audit Trail</h4>
      <p class="text-muted small mb-0">Complete historical logging of user authentications, milestone modifications, financial records, and contractor approvals.</p>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-3 border-bottom d-flex justify-content-between align-items-center bg-light">
        <span class="small fw-bold text-navy"><i class="fas fa-shield-alt text-warning me-1"></i> Showing Most Recent 100 System Events</span>
        <span class="badge bg-success text-white">SSL Encrypted</span>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Timestamp</th>
              <th>Action Trigger</th>
              <th>User / Role</th>
              <th>IP Address</th>
              <th>Event Details</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($logs)): ?>
              <?php foreach ($logs as $log): ?>
                <tr>
                  <td><small class="text-muted"><?= date('d M Y H:i:s', strtotime($log['created_at'])) ?></small></td>
                  <td>
                    <span class="badge bg-dark text-warning border border-warning" style="font-size:0.7rem; letter-spacing:0.04em;">
                      <?= e($log['action']) ?>
                    </span>
                  </td>
                  <td>
                    <?php if ($log['user_name']): ?>
                      <span class="fw-bold text-navy small"><?= e($log['user_name']) ?></span><br>
                      <small class="badge bg-light text-navy border" style="font-size:0.6rem;"><?= strtoupper(e($log['user_role'])) ?></small>
                    <?php else: ?>
                      <small class="text-muted">Public / Visitor</small>
                    <?php endif; ?>
                  </td>
                  <td><code class="text-muted small"><?= e($log['ip_address']) ?></code></td>
                  <td><small class="text-secondary"><?= e($log['details']) ?></small></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center py-4 text-muted">No audit logs recorded yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
