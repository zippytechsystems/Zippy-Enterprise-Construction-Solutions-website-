<?php
/**
 * Projects Showcase
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Our Construction Projects & Developments";
$pageDescription = "Browse landmark ongoing and delivered construction projects by Zippy Enterprises in Hyderabad, including luxury villas in Jubilee Hills and commercial tech parks in Financial District.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

$filter = $_GET['cat'] ?? 'all';

try {
    $db = Database::getConnection();
    
    switch ($filter) {
        case 'residential':
            $stmt = $db->prepare("SELECT * FROM projects WHERE category IN ('Independent Houses', 'Luxury Villas', 'Residential Construction') ORDER BY id ASC");
            $stmt->execute();
            break;
        case 'independent':
            $stmt = $db->prepare("SELECT * FROM projects WHERE category = 'Independent Houses' ORDER BY id ASC");
            $stmt->execute();
            break;
        case 'villa':
            $stmt = $db->prepare("SELECT * FROM projects WHERE category = 'Luxury Villas' ORDER BY id ASC");
            $stmt->execute();
            break;
        case 'commercial':
            $stmt = $db->prepare("SELECT * FROM projects WHERE category = 'Commercial Projects' ORDER BY id ASC");
            $stmt->execute();
            break;
        case 'apartment':
            $stmt = $db->prepare("SELECT * FROM projects WHERE category = 'Apartment Buildings' ORDER BY id ASC");
            $stmt->execute();
            break;
        case 'ongoing':
            $stmt = $db->prepare("SELECT * FROM projects WHERE status = 'ongoing' ORDER BY id ASC");
            $stmt->execute();
            break;
        case 'completed':
            $stmt = $db->prepare("SELECT * FROM projects WHERE status = 'completed' ORDER BY id ASC");
            $stmt->execute();
            break;
        default:
            $stmt = $db->query("SELECT * FROM projects ORDER BY id ASC");
            break;
    }
    $projects = $stmt->fetchAll();
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
      <a href="projects.php?cat=all" class="btn <?= $filter === 'all' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">All Projects</a>
      <a href="projects.php?cat=residential" class="btn <?= $filter === 'residential' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Residential</a>
      <a href="projects.php?cat=independent" class="btn <?= $filter === 'independent' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Independent Houses</a>
      <a href="projects.php?cat=villa" class="btn <?= $filter === 'villa' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Luxury Villas</a>
      <a href="projects.php?cat=commercial" class="btn <?= $filter === 'commercial' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Commercial Towers</a>
      <a href="projects.php?cat=apartment" class="btn <?= $filter === 'apartment' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Apartment Developments</a>
      <a href="projects.php?cat=ongoing" class="btn <?= $filter === 'ongoing' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Ongoing</a>
      <a href="projects.php?cat=completed" class="btn <?= $filter === 'completed' ? 'btn-gold' : 'btn-outline-secondary' ?> btn-sm px-3">Completed</a>
    </div>

    <!-- Projects Grid -->
    <div class="row g-4">
      <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $prj): ?>
          <div class="col-md-6 col-lg-4">
            <div class="card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column" style="background:#FFFFFF; border:1px solid #E2E8F0 !important;">
              <div class="position-relative overflow-hidden" style="height:250px;">
                <img src="<?= e($prj['featured_image'] ?: 'assets/images/projects/project-1.jpg') ?>" alt="<?= e($prj['title']) ?>" class="w-100 h-100 object-fit-cover transition-smooth">
                <span class="position-absolute top-0 start-0 m-3 badge bg-dark text-warning border border-warning" style="font-size:0.75rem;">
                  <?= strtoupper(e($prj['category'])) ?>
                </span>
                <span class="position-absolute top-0 end-0 m-3 badge <?= $prj['status'] === 'completed' ? 'bg-success' : 'bg-warning text-dark' ?> fw-bold text-uppercase" style="font-size:0.75rem;">
                  <?= e($prj['status']) ?>
                </span>
              </div>
              <div class="p-4 d-flex flex-column flex-grow-1">
                <div class="text-muted small mb-1">
                  <i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($prj['site_location']) ?>, <?= e($prj['city']) ?>
                </div>
                <h3 class="h5 fw-bold text-navy mb-2"><?= e($prj['title']) ?></h3>
                <p class="text-muted small mb-3 flex-grow-1"><?= e($prj['short_description']) ?></p>

                <div class="row g-2 p-2 rounded-3 mb-3 text-center" style="background:#F8FAFC; border:1px solid #EDF2F7;">
                  <div class="col-6 border-end">
                    <span class="d-block text-muted" style="font-size:0.7rem;">BUILT-UP AREA</span>
                    <span class="fw-bold text-navy small"><?= number_format($prj['built_up_area_sqft']) ?> Sq.Ft.</span>
                  </div>
                  <div class="col-6">
                    <span class="d-block text-muted" style="font-size:0.7rem;">CONFIGURATION</span>
                    <span class="fw-bold text-navy small"><?= $prj['floors_count'] ?> Floors (G+<?= max(0, $prj['floors_count'] - 1) ?>)</span>
                  </div>
                </div>

                <div class="d-flex gap-2">
                  <button type="button" class="btn btn-navy btn-sm flex-grow-1" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal" onclick="document.querySelector('[name=project_requirements]').value='Inquiry regarding <?= e(addslashes($prj['title'])) ?> (<?= e($prj['project_code']) ?>)'; document.querySelector('[name=service_requested]').value='<?= e(addslashes($prj['category'])) ?>';">
                    <i class="fas fa-envelope-open-text me-1"></i> Enquire Project
                  </button>
                  <a href="quote.php" class="btn btn-outline-warning text-dark border-warning btn-sm" title="Request custom quote">
                    Quote <i class="fas fa-arrow-right ms-1"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="col-12 text-center py-5">
          <div class="p-5 rounded-4 bg-light">
            <i class="fas fa-building text-muted fa-3x mb-3"></i>
            <h4 class="text-navy fw-bold">No Projects Found</h4>
            <p class="text-muted">No projects found in this category filter. Please click 'All Projects' to see our full portfolio.</p>
            <a href="projects.php?cat=all" class="btn btn-gold btn-sm mt-2">View All Projects</a>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-5 text-center" style="background:#0A192F; color:#FFFFFF; border-top:1px solid var(--border-gold);">
  <div class="container py-4">
    <div class="badge-gold mb-2">CUSTOM CONSTRUCTION</div>
    <h2 class="text-white fw-bold mb-3">Want Your Construction Project Engineered by Zippy?</h2>
    <p class="text-white-50 mx-auto mb-4" style="max-width:620px;">
      Schedule a complimentary site inspection and technical consultation with our Principal Civil Engineers in Hyderabad.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <button type="button" class="btn btn-gold btn-lg" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal">
        <i class="fas fa-calendar-check me-2"></i> Book Site Inspection
      </button>
      <a href="quote.php" class="btn btn-outline-light btn-lg">
        <i class="fas fa-file-invoice me-2"></i> Request Detailed Quote
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
