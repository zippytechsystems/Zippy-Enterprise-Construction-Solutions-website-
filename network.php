<?php
/**
 * Our Professional Network Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Our Professional Construction Network in Hyderabad";
$pageDescription = "Explore the verified professional network of Zippy Enterprises Private Limited: certified builders, civil engineers, chartered architects, structural consultants, material suppliers, and interior designers.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

try {
    $db = Database::getConnection();
    $partners = $db->query("SELECT * FROM network_partners WHERE verified_status = 1 ORDER BY id ASC")->fetchAll();
} catch (Exception $e) {
    $partners = [];
}

$categories = [
    'all' => 'All Professionals',
    'builder' => 'Builders & Contractors',
    'civil_engineer' => 'Civil Engineers & PMC',
    'architect' => 'Chartered Architects',
    'structural_engineer' => 'Structural Engineers',
    'material_supplier' => 'Material Suppliers',
    'interior_designer' => 'Interior Designers'
];
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Our Professional Network" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">ECOSYSTEM OF EXCELLENCE</div>
    <h1 class="page-banner-title">Our Professional Construction Network</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Professional Network</span>
    </div>
  </div>
</section>

<!-- NETWORK OVERVIEW -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:780px;">
      <span class="section-subtitle">Collaborative Strength</span>
      <h2 class="section-title">An Integrated Network of Industry Leaders</h2>
      <p class="section-desc mx-auto">
        Zippy Enterprises partners with verified civil contractors, structural vetting consultants, ISO-certified material manufacturers, and premier architects to ensure uncompromising quality across every square foot constructed.
      </p>
    </div>

    <!-- Category Badges / Filter -->
    <div class="d-flex flex-wrap justify-content-center gap-2 mb-5">
      <?php foreach ($categories as $key => $label): ?>
        <button class="btn btn-sm btn-outline-secondary px-3 network-filter-btn <?= $key === 'all' ? 'active btn-gold text-dark' : '' ?>" data-filter="<?= $key ?>">
          <?= $label ?>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- PARTNERS GRID -->
    <div class="row g-4" id="network-cards-container">
      <?php if (!empty($partners)): ?>
        <?php foreach ($partners as $p): ?>
          <div class="col-md-6 col-lg-4 network-card-item" data-category="<?= e($p['category']) ?>">
            <div class="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border" style="border: 1px solid var(--border-light);">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div class="brand-logo-icon" style="width:46px; height:46px; font-size:1.2rem;">
                  <?php if ($p['category'] === 'builder' || $p['category'] === 'contractor'): ?>
                    <i class="fas fa-hard-hat"></i>
                  <?php elseif ($p['category'] === 'civil_engineer'): ?>
                    <i class="fas fa-drafting-compass"></i>
                  <?php elseif ($p['category'] === 'architect'): ?>
                    <i class="fas fa-compass"></i>
                  <?php elseif ($p['category'] === 'structural_engineer'): ?>
                    <i class="fas fa-cube"></i>
                  <?php elseif ($p['category'] === 'material_supplier'): ?>
                    <i class="fas fa-truck-moving"></i>
                  <?php else: ?>
                    <i class="fas fa-brush"></i>
                  <?php endif; ?>
                </div>
                <span class="badge bg-success text-white px-2 py-1"><i class="fas fa-check-circle me-1"></i> Verified</span>
              </div>

              <h5 class="fw-bold text-navy mb-1"><?= e($p['partner_name']) ?></h5>
              <div class="text-warning small fw-bold mb-3">
                <?= strtoupper(str_replace('_', ' ', e($p['category']))) ?> &bull; <?= $p['experience_years'] ?>+ Years Exp.
              </div>

              <p class="small text-muted mb-3 flex-grow-1"><?= e($p['specialization']) ?></p>

              <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                <small class="text-muted"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($p['service_areas']) ?></small>
                <span class="text-warning fw-bold small"><i class="fas fa-star me-1"></i> <?= $p['rating'] ?>/5.0</span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <!-- PARTNER CRITERIA CALLOUT -->
    <div class="mt-5 p-4 rounded-4 shadow-sm text-center" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
      <div class="badge-gold mb-2">QUALITY AUDIT SYSTEM</div>
      <h3 class="text-white fw-bold mb-2">Strict Network Vetting Standards</h3>
      <p class="text-white-50 mx-auto mb-4" style="max-width:700px;">
        Every professional partner in the Zippy ecosystem undergoes statutory license checks, site safety audits, and on-ground workmanship inspection by our Chief Project Officer before assignment to any client project.
      </p>
      <div class="d-flex justify-content-center gap-3">
        <a href="quote.php" class="btn btn-gold">
          <i class="fas fa-paper-plane me-2"></i> Start a Project with Our Network
        </a>
        <a href="contact.php" class="btn btn-outline-gold">
          <i class="fas fa-handshake me-2"></i> Partner With Zippy Enterprises
        </a>
      </div>
    </div>
  </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function () {
  const filterBtns = document.querySelectorAll('.network-filter-btn');
  const cards = document.querySelectorAll('.network-card-item');

  filterBtns.forEach(btn => {
    btn.addEventListener('click', function () {
      filterBtns.forEach(b => {
        b.classList.remove('active', 'btn-gold', 'text-dark');
        b.classList.add('btn-outline-secondary');
      });
      this.classList.add('active', 'btn-gold', 'text-dark');
      this.classList.remove('btn-outline-secondary');

      const filter = this.getAttribute('data-filter');
      cards.forEach(card => {
        if (filter === 'all' || card.getAttribute('data-category') === filter) {
          card.style.display = 'block';
        } else {
          card.style.display = 'none';
        }
      });
    });
  });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
