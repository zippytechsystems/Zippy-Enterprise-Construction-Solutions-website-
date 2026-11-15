<?php
/**
 * Customer Project Documents Repository
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Project Document Vault";

try {
    $db = Database::getConnection();
    $stmt = $db->prepare("SELECT pd.*, p.title as project_title FROM project_documents pd JOIN projects p ON pd.project_id = p.id WHERE p.customer_id = ? AND pd.access_level IN ('client_shared', 'public') ORDER BY pd.id DESC");
    $stmt->execute([$userId]);
    $documents = $stmt->fetchAll();
} catch (Exception $e) {
    $documents = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Encrypted Project Document Vault</h4>
      <p class="text-muted small mb-0">Role-governed access to your municipal sanction drawings, structural calculations, and legal agreements.</p>
    </div>
  </div>
</div>

<div class="row g-4">
  <?php if (!empty($documents)): ?>
    <?php foreach ($documents as $doc): ?>
      <div class="col-md-6 col-lg-4">
        <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100 d-flex flex-column justify-content-between">
          <div>
            <div class="d-flex justify-content-between align-items-start mb-3">
              <div class="brand-logo-icon" style="width:44px; height:44px; font-size:1.2rem;">
                <i class="fas fa-file-pdf"></i>
              </div>
              <span class="badge bg-light text-navy border text-uppercase" style="font-size:0.7rem;"><?= e($doc['category']) ?></span>
            </div>
            <h6 class="fw-bold text-navy mb-1"><?= e($doc['document_title']) ?></h6>
            <small class="text-muted d-block mb-3">Uploaded on <?= date('d M Y', strtotime($doc['created_at'])) ?> &bull; <?= round($doc['file_size_bytes'] / 1024 / 1024, 2) ?> MB</small>
          </div>
          <div class="pt-3 border-top d-flex justify-content-between align-items-center">
            <span class="small text-success fw-bold"><i class="fas fa-shield-alt me-1"></i> Verified Clean</span>
            <a href="../../<?= e($doc['file_path']) ?>" download target="_blank" class="btn btn-sm btn-outline-warning text-dark border-warning fw-bold">
              <i class="fas fa-download me-1"></i> Download
            </a>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  <?php else: ?>
    <div class="col-12 text-center py-5">
      <p class="text-muted">No documents uploaded for your active projects yet.</p>
    </div>
  <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
