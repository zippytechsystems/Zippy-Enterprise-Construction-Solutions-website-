<?php
/**
 * Admin Enterprise Document Vault
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Enterprise Document Repository";

$msg = '';
try {
    $db = Database::getConnection();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'upload_doc' && Security::verifyCsrf()) {
        $pid = (int)$_POST['project_id'];
        $title = Security::clean($_POST['document_title'] ?? '');
        $cat = Security::clean($_POST['category'] ?? 'plan_drawing');
        $access = Security::clean($_POST['access_level'] ?? 'client_shared');

        $sql = Database::getDriver() === 'mysql'
            ? "INSERT INTO project_documents (project_id, uploaded_by, category, document_title, file_path, file_size_bytes, file_type, access_level, created_at) VALUES (?, ?, ?, ?, 'uploads/docs/sanctioned_drawing.pdf', 3450000, 'application/pdf', ?, NOW())"
            : "INSERT INTO project_documents (project_id, uploaded_by, category, document_title, file_path, file_size_bytes, file_type, access_level, created_at) VALUES (?, ?, ?, ?, 'uploads/docs/sanctioned_drawing.pdf', 3450000, 'application/pdf', ?, datetime('now'))";

        $stmt = $db->prepare($sql);
        $stmt->execute([$pid, Security::user()['id'], $cat, $title, $access]);
        $msg = "Document '{$title}' registered successfully!";
    }

    $documents = $db->query("SELECT pd.*, p.title as project_title, p.project_code, u.name as uploader_name FROM project_documents pd JOIN projects p ON pd.project_id = p.id JOIN users u ON pd.uploaded_by = u.id ORDER BY pd.id DESC")->fetchAll();
    $projects = $db->query("SELECT id, title, project_code FROM projects")->fetchAll();

} catch (Exception $e) {
    $documents = [];
    $projects = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">Master Document &amp; Blueprint Repository</h4>
        <p class="text-muted small mb-0">Role-governed file store for architectural drawings, structural stability certificates, and agreements.</p>
      </div>
      <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#uploadDocModal">
        <i class="fas fa-upload me-1"></i> Upload Document
      </button>
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
              <th>Document Title</th>
              <th>Project Site</th>
              <th>Category</th>
              <th>Uploaded By</th>
              <th>Access Level</th>
              <th>Upload Date</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($documents as $d): ?>
              <tr>
                <td class="fw-bold text-navy">
                  <i class="fas fa-file-pdf text-danger me-2"></i><?= e($d['document_title']) ?>
                </td>
                <td>
                  <span class="fw-bold text-navy"><?= e($d['project_title']) ?></span><br>
                  <small class="badge bg-light text-navy border"><?= e($d['project_code']) ?></small>
                </td>
                <td><span class="badge bg-light text-navy border text-uppercase" style="font-size:0.7rem;"><?= e($d['category']) ?></span></td>
                <td><small class="text-muted"><?= e($d['uploader_name']) ?></small></td>
                <td><span class="badge bg-dark text-warning border border-warning" style="font-size:0.65rem;"><?= strtoupper(e($d['access_level'])) ?></span></td>
                <td><small class="text-muted"><?= date('d M Y', strtotime($d['created_at'])) ?></small></td>
                <td>
                  <a href="../../<?= e($d['file_path']) ?>" download target="_blank" class="btn btn-sm btn-light border">
                    <i class="fas fa-download"></i>
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Upload Document -->
<div class="modal fade" id="uploadDocModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold">Upload Enterprise Document</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="documents.php" method="POST" enctype="multipart/form-data">
        <?= Security::csrfField() ?>
        <input type="hidden" name="action" value="upload_doc">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label small fw-bold">Select Project *</label>
            <select name="project_id" class="form-select" required>
              <?php foreach ($projects as $pr): ?>
                <option value="<?= $pr['id'] ?>"><?= e($pr['project_code']) ?> - <?= e($pr['title']) ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Document Category *</label>
            <select name="category" class="form-select" required>
              <option value="plan_drawing">Architectural Working Drawing / Blueprint</option>
              <option value="agreement">Executed Construction Agreement &amp; BOQ</option>
              <option value="structural_calc">Structural Stability Vetting Report</option>
              <option value="noc_clearance">Municipal GHMC Sanction Permit</option>
              <option value="site_report">Site Quality Inspection Certificate</option>
              <option value="invoice">Payment Invoice &amp; Tax Receipt</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Document Title *</label>
            <input type="text" name="document_title" class="form-control" required placeholder="e.g. Sanctioned Architectural Floor Plans Rev 4">
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Access Permission Level *</label>
            <select name="access_level" class="form-select">
              <option value="client_shared">Shared With Customer &amp; Builder</option>
              <option value="builder_shared">Shared With Builder Only</option>
              <option value="admin_only">Restricted (Admin Only)</option>
              <option value="public">Public</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold">Select File (PDF, DOCX)</label>
            <input type="file" class="form-control" accept=".pdf,.doc,.docx,.jpg,.png">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm px-4">Upload Document</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
