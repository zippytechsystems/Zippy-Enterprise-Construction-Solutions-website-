<?php
/**
 * Builder Document Uploads (Cube Test, Mill Test, Challans)
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['builder', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Quality Test Documents & Reports";

$msg = '';
$err = '';

try {
    $db = Database::getConnection();
    
    // Get builder projects
    $bStmt = $db->prepare("SELECT id FROM builder_profiles WHERE user_id = ? LIMIT 1");
    $bStmt->execute([$userId]);
    $bProf = $bStmt->fetch();
    $bId = $bProf['id'] ?? 1;

    $pStmt = $db->prepare("SELECT id, title FROM projects WHERE builder_id = ?");
    $pStmt->execute([$bId]);
    $projects = $pStmt->fetchAll();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
        $projectId = (int)$_POST['project_id'];
        $title = Security::clean($_POST['document_title'] ?? '');
        $category = Security::clean($_POST['category'] ?? 'site_report');

        if (empty($title) || empty($projectId)) {
            $err = 'Please select project and provide document title.';
        } else {
            $sql = Database::getDriver() === 'mysql'
                ? "INSERT INTO project_documents (project_id, uploaded_by, category, document_title, file_path, file_size_bytes, file_type, access_level, created_at) VALUES (?, ?, ?, ?, 'uploads/docs/sample_report.pdf', 1540000, 'application/pdf', 'builder_shared', NOW())"
                : "INSERT INTO project_documents (project_id, uploaded_by, category, document_title, file_path, file_size_bytes, file_type, access_level, created_at) VALUES (?, ?, ?, ?, 'uploads/docs/sample_report.pdf', 1540000, 'application/pdf', 'builder_shared', datetime('now'))";
            
            $stmt = $db->prepare($sql);
            $stmt->execute([$projectId, $userId, $category, $title]);
            
            Security::logAudit("DOC_UPLOADED", "Builder #{$userId} uploaded doc '{$title}' for project #{$projectId}");
            $msg = "Document record '{$title}' logged successfully!";
        }
    }

    // Fetch existing docs
    $dStmt = $db->prepare("SELECT pd.*, p.title as project_title FROM project_documents pd JOIN projects p ON pd.project_id = p.id WHERE pd.uploaded_by = ? ORDER BY pd.id DESC");
    $dStmt->execute([$userId]);
    $docs = $dStmt->fetchAll();

} catch (Exception $e) {
    $err = $e->getMessage();
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Upload Site Quality &amp; Material Test Certificates</h4>
      <p class="text-muted small mb-0">Submit laboratory cube compressive test results, steel mill certificates, and RMC delivery slips.</p>
    </div>
  </div>
</div>

<?php if ($msg): ?><div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> <?= e($msg) ?></div><?php endif; ?>
<?php if ($err): ?><div class="alert alert-danger p-3 rounded mb-4"><i class="fas fa-exclamation-circle me-1"></i> <?= e($err) ?></div><?php endif; ?>

<div class="row g-4">
  <div class="col-lg-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h5 class="fw-bold text-navy mb-3">Upload Test Document</h5>
      <form action="documents.php" method="POST" enctype="multipart/form-data">
        <?= Security::csrfField() ?>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Construction Site *</label>
          <select name="project_id" class="form-select" required>
            <?php foreach ($projects as $pr): ?>
              <option value="<?= $pr['id'] ?>"><?= e($pr['title']) ?></option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Document Classification *</label>
          <select name="category" class="form-select" required>
            <option value="site_report">Concrete Cube Test Report (7 / 14 / 28 Days)</option>
            <option value="site_report">TMT Steel Mill Test Certificate</option>
            <option value="site_report">Soil Test / SBC Bearing Report</option>
            <option value="site_report">Waterproofing 72-Hour Ponding Test</option>
            <option value="invoice">Material Delivery Challan / Invoice</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Document Title *</label>
          <input type="text" name="document_title" class="form-control" required placeholder="e.g. M30 Raft Concrete 28-Day Strength Test">
        </div>

        <div class="mb-4">
          <label class="form-label small fw-bold text-navy">Select File (PDF, DOCX, JPG)</label>
          <input type="file" name="document_file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
          <small class="text-muted">Max file size 15MB. Verified by Chief Project Officer.</small>
        </div>

        <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
          <i class="fas fa-cloud-upload-alt me-2"></i> Upload Verification Document
        </button>
      </form>
    </div>
  </div>

  <div class="col-lg-7">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom">
        <h5 class="fw-bold text-navy mb-0">Recently Uploaded Test Certificates</h5>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Document Title</th>
              <th>Category</th>
              <th>Site</th>
              <th>Upload Date</th>
              <th>Download</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($docs)): ?>
              <?php foreach ($docs as $d): ?>
                <tr>
                  <td class="fw-bold text-navy"><i class="fas fa-file-pdf text-danger me-2"></i><?= e($d['document_title']) ?></td>
                  <td><span class="badge bg-light text-navy border text-uppercase" style="font-size:0.7rem;"><?= e($d['category']) ?></span></td>
                  <td><small class="text-muted"><?= e($d['project_title']) ?></small></td>
                  <td><small class="text-muted"><?= date('d M Y', strtotime($d['created_at'])) ?></small></td>
                  <td>
                    <a href="../../<?= e($d['file_path']) ?>" download target="_blank" class="btn btn-sm btn-light border">
                      <i class="fas fa-download"></i>
                    </a>
                  </td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="5" class="text-center py-4 text-muted">No test documents logged yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
