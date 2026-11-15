<?php
/**
 * Admin Builder & Contractor Management
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Contractor Accreditation & Management";

$msg = '';
$err = '';

try {
    $db = Database::getConnection();

    // Handle verification actions
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
        $builderId = (int)$_POST['builder_id'];
        $action = Security::clean($_POST['verification_action'] ?? '');
        $rating = (float)($_POST['rating'] ?? 4.90);

        if ($action === 'verify') {
            $up = $db->prepare("UPDATE builder_profiles SET verification_status = 'verified', rating = ? WHERE id = ?");
            $up->execute([$rating, $builderId]);

            // Update user status to active
            $db->query("UPDATE users SET status = 'active' WHERE id = (SELECT user_id FROM builder_profiles WHERE id = {$builderId})");

            Security::logAudit("BUILDER_VERIFIED", "Admin approved Contractor #{$builderId}");
            $msg = "Contractor #{$builderId} verified and activated successfully!";
        } elseif ($action === 'reject') {
            $up = $db->prepare("UPDATE builder_profiles SET verification_status = 'rejected' WHERE id = ?");
            $up->execute([$builderId]);

            Security::logAudit("BUILDER_REJECTED", "Admin rejected Contractor #{$builderId}");
            $msg = "Contractor #{$builderId} status updated to REJECTED.";
        }
    }

    $builders = $db->query("SELECT bp.*, u.name as contact_name, u.email, u.phone, u.status as user_status FROM builder_profiles bp JOIN users u ON bp.user_id = u.id ORDER BY bp.id DESC")->fetchAll();

} catch (Exception $e) {
    $err = $e->getMessage();
    $builders = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Accredited Contractor &amp; Builder Network Management</h4>
      <p class="text-muted small mb-0">Verify municipal licenses, audit civil qualifications, approve partner onboarding, and manage contractor ratings.</p>
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
              <th>Company Name</th>
              <th>Contact Person</th>
              <th>License No.</th>
              <th>Experience</th>
              <th>Specialization</th>
              <th>Areas in Hyderabad</th>
              <th>Rating</th>
              <th>Status</th>
              <th>Accreditation Action</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($builders)): ?>
              <?php foreach ($builders as $b): ?>
                <tr>
                  <td class="fw-bold text-navy"><?= e($b['company_name']) ?></td>
                  <td>
                    <small class="d-block text-navy fw-bold"><?= e($b['contact_name']) ?></small>
                    <small class="text-muted"><?= e($b['phone']) ?></small>
                  </td>
                  <td><span class="badge bg-light text-navy border"><?= e($b['license_number']) ?></span></td>
                  <td><?= $b['experience_years'] ?>+ Years</td>
                  <td><span class="badge bg-dark text-warning border border-warning" style="font-size:0.7rem;"><?= e($b['specialization']) ?></span></td>
                  <td><small class="text-muted"><?= e($b['service_areas']) ?></small></td>
                  <td><span class="text-warning fw-bold"><i class="fas fa-star me-1"></i> <?= $b['rating'] ?></span></td>
                  <td>
                    <span class="badge-status <?= $b['verification_status'] ?>"><?= strtoupper(e($b['verification_status'])) ?></span>
                  </td>
                  <td>
                    <?php if ($b['verification_status'] === 'pending'): ?>
                      <form action="builders.php" method="POST" class="d-flex gap-1">
                        <?= Security::csrfField() ?>
                        <input type="hidden" name="builder_id" value="<?= $b['id'] ?>">
                        <button type="submit" name="verification_action" value="verify" class="btn btn-sm btn-success py-1 px-2" style="font-size:0.75rem;">
                          <i class="fas fa-check me-1"></i> Approve
                        </button>
                        <button type="submit" name="verification_action" value="reject" class="btn btn-sm btn-danger py-1 px-2" style="font-size:0.75rem;">
                          <i class="fas fa-times me-1"></i> Reject
                        </button>
                      </form>
                    <?php else: ?>
                      <span class="small text-muted"><i class="fas fa-check-double text-success me-1"></i> Audited</span>
                    <?php endif; ?>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center py-4 text-muted">No contractor accounts registered.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
