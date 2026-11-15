<?php
/**
 * Project Gallery Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Architectural & Site Construction Gallery";
$pageDescription = "High-resolution architectural photography, on-site construction milestone captures, and finished luxury interiors by Zippy Enterprises.";
require_once __DIR__ . '/includes/header.php';

$galleryItems = [
    ['img' => 'assets/images/projects/project-1.jpg', 'title' => 'Signature Villa Facade', 'cat' => 'Architecture', 'loc' => 'Jubilee Hills'],
    ['img' => 'assets/images/projects/project-2.jpg', 'title' => 'Commercial IT Tower Glazing', 'cat' => 'Commercial', 'loc' => 'Financial District'],
    ['img' => 'assets/images/projects/project-3.jpg', 'title' => 'Duplex Residence Elevation', 'cat' => 'Residential', 'loc' => 'Kompally'],
    ['img' => 'assets/images/services/residential.jpg', 'title' => 'Living Room Italian Marble', 'cat' => 'Interiors', 'loc' => 'Banjara Hills'],
    ['img' => 'assets/images/services/commercial.jpg', 'title' => 'Structural Framing & Columns', 'cat' => 'Civil Execution', 'loc' => 'Madhapur'],
    ['img' => 'assets/images/services/apartment.jpg', 'title' => 'Apartment Elevation & Basements', 'cat' => 'Multi-Unit', 'loc' => 'Kokapet']
];
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Construction Gallery" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">VISUAL SHOWCASE</div>
    <h1 class="page-banner-title">Architectural &amp; Construction Gallery</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Gallery</span>
    </div>
  </div>
</section>

<!-- GALLERY GRID -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:720px;">
      <span class="section-subtitle">Visual Excellence</span>
      <h2 class="section-title">From Blueprint to Reality</h2>
      <p class="section-desc mx-auto">Explore photographic documentation of our civil execution, structural milestones, and completed architectural marvels.</p>
    </div>

    <div class="row g-4">
      <?php foreach ($galleryItems as $item): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card border-0 shadow-sm rounded-3 overflow-hidden position-relative group-gallery" style="height:280px; background:#0A192F;">
            <img src="<?= $item['img'] ?>" alt="<?= e($item['title']) ?>" class="w-100 h-100 object-fit-cover transition-smooth">
            <div class="position-absolute bottom-0 start-0 end-0 p-3" style="background: linear-gradient(0deg, rgba(6,17,33,0.95) 0%, rgba(6,17,33,0) 100%);">
              <span class="badge bg-warning text-dark fw-bold text-uppercase" style="font-size:0.65rem;"><?= e($item['cat']) ?></span>
              <h5 class="text-white fw-bold mt-1 mb-0"><?= e($item['title']) ?></h5>
              <small class="text-white-50"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($item['loc']) ?></small>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
