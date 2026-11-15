<?php
/**
 * Projects Showcase
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Our Construction Projects & Developments";
$pageDescription = "Browse landmark ongoing and delivered construction projects by Zippy Enterprises in Hyderabad, including luxury villas in Jubilee Hills and commercial tech parks in Financial District.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

$categoryFilter = $_GET['cat'] ?? 'all';

try {
    $db = Database::getConnection();
    if ($categoryFilter !== 'all') {
        $stmt = $db->prepare("SELECT p.*, bp.company_name as builder_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id WHERE p.category = ? ORDER BY p.id ASC");
        $stmt->execute([$categoryFilter]);
        $projects = $stmt->fetchAll();
    } else {
        $projects = $db->query("SELECT p.*, bp.company_name as builder_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id ORDER BY p.id ASC")->fetchAll();
    }
} catch (Exception $e) {
    $projects = [];
}
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Zippy Construction Projects" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">PROJECT PORTFOLIO</div>
    <h1 class="page-banner-title">Our Landmark Construction Projects</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Projects</span>
    </div>
  </div>
</section>

<!-- PROJECT FILTER & GALLERY -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <!-- Category Filter Buttons -->
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
      <a href="projects.php?cat=all" class="btn <?= $categoryFilter === 'all' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-4">All Projects</a>
      <a href="projects.php?cat=residential" class="btn <?= $categoryFilter === 'residential' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-4">Residential Homes</a>
      <a href="projects.php?cat=villa" class="btn <?= $categoryFilter === 'villa' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-4">Luxury Villas</a>
      <a href="projects.php?cat=commercial" class="btn <?= $categoryFilter === 'commercial' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-4">Commercial Towers</a>
      <a href="projects.php?cat=apartment" class="btn <?= $categoryFilter === 'apartment' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-4">Apartments</a>
    </div>

    <!-- Projects Grid -->
    <div class="row g-4">
      <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $prj): ?>
          <div class="col-md-6 col-lg-4">
            <div class="card-project">
              <img src="<?= e($prj['featured_image'] ?: 'assets/images/projects/project-1.jpg') ?>" alt="<?= e($prj['title']) ?>" class="card-project-img">
              <div class="card-project-overlay">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <span class="card-project-category"><?= strtoupper(e($prj['category'])) ?> &bull; <?= e($prj['city']) ?></span>
                  <span class="badge bg-warning text-dark fw-bold text-uppercase" style="font-size:0.65rem;"><?= str_replace('_', ' ', e($prj['status'])) ?></span>
                </div>
                <h3 class="card-project-title"><?= e($prj['title']) ?></h3>
                <p class="text-white-50 small mb-2"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($prj['site_address']) ?></p>
                <div class="card-project-meta">
                  <span><i class="fas fa-ruler-combined text-warning me-1"></i> <?= number_format($prj['built_up_area_sqft']) ?> Sq.Ft.</span>
                  <span><i class="fas fa-layer-group text-warning me-1"></i> <?= $prj['floors_count'] ?> Floors</span>
                  <span><i class="fas fa-hard-hat text-warning me-1"></i> Stage <?= $prj['current_stage_id'] ?>/14</span>
                </div>
                
                <div class="d-flex justify-content-between small text-white-50 mb-1">
                  <span>Execution Progress</span>
                  <span class="text-warning fw-bold"><?= $prj['progress_percent'] ?>%</span>
                </div>
                <div class="progress-custom">
                  <div class="progress-bar-gold" style="width: <?= $prj['progress_percent'] ?>%;"></div>
                </div>

                <div class="d-flex justify-content-between align-items-center pt-2 border-top border-secondary">
                  <small class="text-white-50">Budget: ₹<?= number_format($prj['total_budget'] / 10000000, 2) ?> Cr</small>
                  <a href="login.php" class="btn btn-sm btn-outline-warning text-white border-warning py-1 px-2" style="font-size:0.75rem;">
                    <i class="fas fa-lock me-1"></i> View Live Milestones
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
          <p class="text-muted">No projects found in this category. Please select 'All Projects'.</p>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-5 text-center" style="background:#0A192F; color:#FFFFFF; border-top:1px solid var(--border-gold);">
  <div class="container py-4">
    <h2 class="text-white fw-bold mb-3">Want Your Construction Project Featured Here?</h2>
    <p class="text-white-50 mx-auto mb-4" style="max-width:600px;">
      Consult with Zippy Enterprises today for a comprehensive engineering evaluation, site inspection, and transparent quotation.
    </p>
    <a href="cost-estimator.php" class="btn btn-gold btn-lg">
      <i class="fas fa-calculator me-2"></i> Get Instant Estimate
    </a>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
