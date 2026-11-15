<?php
/**
 * Builder Company Profile & Credentials
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['builder', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Contractor Accreditation Profile";

$msg = '';
try {
    $db = Database::getConnection();
    $bStmt = $db->prepare("SELECT * FROM builder_profiles WHERE user_id = ? LIMIT 1");
    $bStmt->execute([$userId]);
    $prof = $bStmt->fetch();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
        $compName = Security::clean($_POST['company_name'] ?? '');
        $lic = Security::clean($_POST['license_number'] ?? '');
        $areas = Security::clean($_POST['service_areas'] ?? '');
        $spec = Security::clean($_POST['specialization'] ?? '');
        $summary = Security::clean($_POST['portfolio_summary'] ?? '');

        $up = $db->prepare("UPDATE builder_profiles SET company_name = ?, license_number = ?, service_areas = ?, specialization = ?, portfolio_summary = ? WHERE user_id = ?");
        $up->execute([$compName, $lic, $areas, $spec, $summary, $userId]);
        $msg = 'Company profile updated successfully!';
        
        $bStmt->execute([$userId]);
        $prof = $bStmt->fetch();
    }
} catch (Exception $e) {}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Contractor Profile &amp; Verification Badges</h4>
      <p class="text-muted small mb-0">Manage your civil contracting firm details, equipment capacity, and registered service areas.</p>
    </div>
  </div>
</div>

<?php if ($msg): ?><div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div><?php endif; ?>

<div class="row g-4">
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h5 class="fw-bold text-navy mb-3">Enterprise Profile Details</h5>
      <form action="profile.php" method="POST">
        <?= Security::csrfField() ?>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label small fw-bold text-navy">Company Legal Name</label>
            <input type="text" name="company_name" class="form-control" required value="<?= e($prof['company_name'] ?? '') ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-bold text-navy">Contractor License Number</label>
            <input type="text" name="license_number" class="form-control" required value="<?= e($prof['license_number'] ?? '') ?>">
          </div>
        </div>

        <div class="row g-3 mb-3">
          <div class="col-md-6">
            <label class="form-label small fw-bold text-navy">Civil Specialization</label>
            <input type="text" name="specialization" class="form-control" required value="<?= e($prof['specialization'] ?? '') ?>">
          </div>
          <div class="col-md-6">
            <label class="form-label small fw-bold text-navy">Service Areas in Hyderabad</label>
            <input type="text" name="service_areas" class="form-control" required value="<?= e($prof['service_areas'] ?? '') ?>">
          </div>
        </div>

        <div class="mb-4">
          <label class="form-label small fw-bold text-navy">Fleet, Machinery &amp; Track Record Summary</label>
          <textarea name="portfolio_summary" rows="4" class="form-control"><?= e($prof['portfolio_summary'] ?? '') ?></textarea>
        </div>

        <button type="submit" class="btn btn-gold py-2 px-4 fw-bold">
          <i class="fas fa-save me-2"></i> Save Profile Details
        </button>
      </form>
    </div>
  </div>

  <div class="col-lg-4">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h6 class="fw-bold text-navy mb-3">Accreditation Status</h6>
      <div class="p-3 rounded mb-3 text-center" style="background:#F8FAFC; border:1px solid #E2E8F0;">
        <span class="badge bg-success text-white px-3 py-2 fs-6 mb-2"><i class="fas fa-check-circle me-1"></i> VERIFIED PARTNER</span>
        <div class="fw-bold text-navy">Class-1 Civil Contractor</div>
        <small class="text-muted">Approved by Zippy Enterprises</small>
      </div>

      <div class="small text-muted mb-2 d-flex justify-content-between">
        <span>Quality Audit Rating:</span>
        <strong class="text-warning"><i class="fas fa-star"></i> <?= $prof['rating'] ?? 4.95 ?>/5.0</strong>
      </div>
      <div class="small text-muted mb-2 d-flex justify-content-between">
        <span>Verified Experience:</span>
        <strong class="text-navy"><?= $prof['experience_years'] ?? 16 ?>+ Years</strong>
      </div>
      <div class="small text-muted d-flex justify-content-between">
        <span>Safety Certification:</span>
        <strong class="text-success"><i class="fas fa-shield-alt"></i> Compliant</strong>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
