<?php
/**
 * Admin Enterprise Project Management
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Project Management Suite";

$msg = '';
$err = '';

try {
    $db = Database::getConnection();

    // Create New Project Form Handling
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'create_project' && Security::verifyCsrf()) {
        $code      = 'ZIP-PRJ-HYD-' . rand(100, 999);
        $title     = Security::clean($_POST['title'] ?? '');
        $custId    = (int)$_POST['customer_id'];
        $bldId     = !empty($_POST['builder_id']) ? (int)$_POST['builder_id'] : null;
        $category  = Security::clean($_POST['category'] ?? 'residential');
        $address   = Security::clean($_POST['site_address'] ?? 'Hyderabad');
        $area      = (float)$_POST['built_up_area_sqft'];
        $floors    = (int)$_POST['floors_count'];
        $budget    = (float)$_POST['total_budget'];
        $startDate = Security::clean($_POST['start_date'] ?? date('Y-m-d'));
        $targetDate = Security::clean($_POST['target_handover_date'] ?? date('Y-m-d', strtotime('+1 year')));

        $sql = Database::getDriver() === 'mysql'
            ? "INSERT INTO projects (project_code, title, customer_id, builder_id, category, site_address, city, built_up_area_sqft, floors_count, current_stage_id, progress_percent, total_budget, start_date, target_handover_date, status, featured_image, created_at) VALUES (?, ?, ?, ?, ?, ?, 'Hyderabad', ?, ?, 1, 0.00, ?, ?, ?, 'in_progress', 'assets/images/projects/project-1.jpg', NOW())"
            : "INSERT INTO projects (project_code, title, customer_id, builder_id, category, site_address, city, built_up_area_sqft, floors_count, current_stage_id, progress_percent, total_budget, start_date, target_handover_date, status, featured_image, created_at) VALUES (?, ?, ?, ?, ?, ?, 'Hyderabad', ?, ?, 1, 0.00, ?, ?, ?, 'in_progress', 'assets/images/projects/project-1.jpg', datetime('now'))";

        $stmt = $db->prepare($sql);
        $stmt->execute([$code, $title, $custId, $bldId, $category, $address, $area, $floors, $budget, $startDate, $targetDate]);
        $newPid = $db->lastInsertId();

        // Initialize all 14 milestones for this new project
        $stages = [
            1 => 'Enquiry Received', 2 => 'Site Inspection', 3 => 'Requirements Finalized', 4 => 'Estimation Prepared',
            5 => 'Quotation Submitted', 6 => 'Agreement Completed', 7 => 'Foundation Work', 8 => 'Structural Work',
            9 => 'Brickwork', 10 => 'Electrical & Plumbing', 11 => 'Plastering', 12 => 'Flooring & Finishing',
            13 => 'Final Inspection', 14 => 'Project Handover'
        ];
        $insertM = $db->prepare("INSERT INTO project_milestones (project_id, stage_number, stage_name, status, notes) VALUES (?, ?, ?, 'pending', 'Scheduled')");
        foreach ($stages as $num => $sname) {
            $insertM->execute([$newPid, $num, $sname]);
        }

        Security::logAudit("PROJECT_CREATED", "Admin created Project {$code}: {$title} with budget ₹{$budget}");
        $msg = "Project [{$code}] created successfully and 14 milestones initialized!";
    }

    // Fetch projects
    $projects = $db->query("SELECT p.*, bp.company_name as builder_name, u.name as customer_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id JOIN users u ON p.customer_id = u.id ORDER BY p.id DESC")->fetchAll();

    // Fetch customers & builders for form
    $customers = $db->query("SELECT id, name, email FROM users WHERE role = 'customer'")->fetchAll();
    $builders  = $db->query("SELECT id, company_name FROM builder_profiles WHERE verification_status = 'verified'")->fetchAll();

} catch (Exception $e) {
    $err = $e->getMessage();
    $projects = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">Civil Construction Project Management</h4>
        <p class="text-muted small mb-0">Create new project works, assign vetted builders, manage 14-stage governance, and monitor budgets.</p>
      </div>
      <button class="btn btn-gold btn-sm" data-bs-toggle="modal" data-bs-target="#newProjectModal">
        <i class="fas fa-plus me-1"></i> Create New Project
      </button>
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
              <th>Project Code</th>
              <th>Project Title &amp; Address</th>
              <th>Customer</th>
              <th>Assigned Builder</th>
              <th>Category</th>
              <th>Active Stage</th>
              <th>Progress</th>
              <th>Budget (INR)</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if (!empty($projects)): ?>
              <?php foreach ($projects as $p): ?>
                <tr>
                  <td><span class="badge bg-light text-navy border fw-bold"><?= e($p['project_code']) ?></span></td>
                  <td>
                    <span class="fw-bold text-navy"><?= e($p['title']) ?></span><br>
                    <small class="text-muted"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($p['site_address']) ?></small>
                  </td>
                  <td><small class="fw-bold text-navy"><?= e($p['customer_name']) ?></small></td>
                  <td><small class="text-muted"><?= e($p['builder_name'] ?: 'In-House Civil Team') ?></small></td>
                  <td><span class="text-uppercase small fw-bold text-muted"><?= e($p['category']) ?></span></td>
                  <td><span class="badge bg-warning text-dark fw-bold">Stage <?= $p['current_stage_id'] ?>/14</span></td>
                  <td>
                    <div class="d-flex align-items-center gap-2">
                      <div class="progress" style="width: 70px; height: 6px;">
                        <div class="progress-bar bg-warning" style="width: <?= $p['progress_percent'] ?>%;"></div>
                      </div>
                      <span class="small fw-bold"><?= $p['progress_percent'] ?>%</span>
                    </div>
                  </td>
                  <td class="fw-bold text-navy">₹<?= number_format($p['total_budget'] / 10000000, 2) ?> Cr</td>
                  <td><span class="badge-status <?= $p['status'] ?>"><?= strtoupper(e($p['status'])) ?></span></td>
                </tr>
              <?php endforeach; ?>
            <?php else: ?>
              <tr>
                <td colspan="9" class="text-center py-4 text-muted">No projects created yet.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Modal: Create New Project -->
<div class="modal fade" id="newProjectModal" tabindex="-1">
  <div class="modal-dialog modal-lg">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header bg-dark text-white">
        <h5 class="modal-title fw-bold">Initialize Construction Project</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <form action="projects.php" method="POST">
        <?= Security::csrfField() ?>
        <input type="hidden" name="action" value="create_project">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label small fw-bold">Project Title / Name *</label>
            <input type="text" name="title" class="form-control" required placeholder="e.g. Zippy Royal Villa #14">
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label small fw-bold">Select Customer *</label>
              <select name="customer_id" class="form-select" required>
                <?php foreach ($customers as $c): ?>
                  <option value="<?= $c['id'] ?>"><?= e($c['name']) ?> (<?= e($c['email']) ?>)</option>
                <?php endforeach; ?>
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-bold">Assign Accredited Builder</label>
              <select name="builder_id" class="form-select">
                <option value="">In-House Civil Execution Team</option>
                <?php foreach ($builders as $b): ?>
                  <option value="<?= $b['id'] ?>"><?= e($b['company_name']) ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label small fw-bold">Category *</label>
              <select name="category" class="form-select">
                <option value="residential">Residential Independent House</option>
                <option value="villa">Luxury Villa</option>
                <option value="commercial">Commercial Building</option>
                <option value="apartment">Multi-Storey Apartment</option>
                <option value="turnkey">Turnkey EPC</option>
              </select>
            </div>
            <div class="col-md-4">
              <label class="form-label small fw-bold">Built-Up Area (Sq.Ft) *</label>
              <input type="number" name="built_up_area_sqft" class="form-control" required value="4000">
            </div>
            <div class="col-md-4">
              <label class="form-label small fw-bold">Number of Floors *</label>
              <input type="number" name="floors_count" class="form-control" required value="3">
            </div>
          </div>

          <div class="mb-3">
            <label class="form-label small fw-bold">Site Location / Address in Hyderabad *</label>
            <input type="text" name="site_address" class="form-control" required placeholder="e.g. Plot 88, Kokapet, Hyderabad">
          </div>

          <div class="row g-3 mb-3">
            <div class="col-md-4">
              <label class="form-label small fw-bold">Total Budget (INR) *</label>
              <input type="number" name="total_budget" class="form-control" required value="25000000">
            </div>
            <div class="col-md-4">
              <label class="form-label small fw-bold">Start Date</label>
              <input type="date" name="start_date" class="form-control" value="<?= date('Y-m-d') ?>">
            </div>
            <div class="col-md-4">
              <label class="form-label small fw-bold">Target Handover Date</label>
              <input type="date" name="target_handover_date" class="form-control" value="<?= date('Y-m-d', strtotime('+14 months')) ?>">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm px-4">Create Project &amp; Init 14 Stages</button>
        </div>
      </form>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
