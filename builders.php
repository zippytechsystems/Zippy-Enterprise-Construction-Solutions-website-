<?php
/**
 * Builder Network & Partner Portal
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Builder & Contractor Network | Partner With Us";
$pageDescription = "Partner with Zippy Enterprises as an accredited civil contractor or builder in Hyderabad. Receive verified project allocations, milestone payment protection, and digital project management.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

try {
    $db = Database::getConnection();
    $builders = $db->query("SELECT bp.*, u.name as contact_person, u.email, u.phone FROM builder_profiles bp JOIN users u ON bp.user_id = u.id WHERE bp.verification_status = 'verified'")->fetchAll();
} catch (Exception $e) {
    $builders = [];
}
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Zippy Builder Network" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">CONTRACTOR PARTNERSHIP</div>
    <h1 class="page-banner-title">Accredited Builder &amp; Contractor Network</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Our Builders</span>
    </div>
  </div>
</section>

<!-- OVERVIEW & BENEFITS -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="section-subtitle">Scale Your Civil Contracting Business</span>
        <h2 class="section-title">Why Hyderabad's Best Builders Partner With Zippy</h2>
        <p class="section-desc">
          Zippy Enterprises brings together qualified plot owners, commercial clients, and verified construction contractors. We handle client sales, architectural design, structural vetting, and banking coordination—freeing contractors to focus 100% on quality site execution.
        </p>

        <div class="mt-4">
          <div class="d-flex mb-3">
            <i class="fas fa-money-check-alt text-warning fa-2x me-3 mt-1"></i>
            <div>
              <h5 class="fw-bold text-navy mb-1">Guaranteed Milestone Payments</h5>
              <p class="text-muted small mb-0">No delayed payments. Funds are escrowed and released directly upon stage completion and digital site photo verification.</p>
            </div>
          </div>
          <div class="d-flex mb-3">
            <i class="fas fa-laptop-code text-warning fa-2x me-3 mt-1"></i>
            <div>
              <h5 class="fw-bold text-navy mb-1">Standardized Engineering BOQ</h5>
              <p class="text-muted small mb-0">Every project comes with pre-vetted architectural working drawings, concrete mix designs, and itemized quantity schedules.</p>
            </div>
          </div>
          <div class="d-flex mb-3">
            <i class="fas fa-truck-moving text-warning fa-2x me-3 mt-1"></i>
            <div>
              <h5 class="fw-bold text-navy mb-1">Direct Factory Material Supply</h5>
              <p class="text-muted small mb-0">Access wholesale manufacturer rates for Tata steel, UltraTech cement, and plumbing supplies through our supply network.</p>
            </div>
          </div>
        </div>

        <div class="mt-4 d-flex gap-3">
          <a href="builder-register.php" class="btn btn-gold">
            <i class="fas fa-hard-hat me-2"></i> Apply for Accreditation
          </a>
          <a href="builder-login.php" class="btn btn-outline-secondary">
            <i class="fas fa-sign-in-alt me-2"></i> Contractor Login
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="p-4 rounded-4 shadow-lg border" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-3">ACCREDITATION STANDARDS</div>
          <h4 class="text-white fw-bold mb-3">Minimum Verification Criteria</h4>
          <p class="text-white-50 small mb-4">To ensure uncompromised quality for our clients, every contractor undergoes our 4-point technical audit:</p>

          <ul class="list-unstyled small text-white-50">
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
              <span><strong>Registration &amp; License:</strong> Valid GHMC / State PWD contractor license or corporate incorporation certificate.</span>
            </li>
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
              <span><strong>Track Record:</strong> Minimum 5+ years verified civil construction experience in Telangana.</span>
            </li>
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
              <span><strong>Technical Staff:</strong> Dedicated full-time site supervisor with a Diploma / Degree in Civil Engineering.</span>
            </li>
            <li class="mb-3 d-flex align-items-center">
              <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
              <span><strong>Quality &amp; Safety:</strong> Adherence to PPE safety norms and IS 456 concrete curing protocols.</span>
            </li>
          </ul>

          <div class="p-3 rounded mt-4" style="background:rgba(212,175,55,0.1); border:1px solid rgba(212,175,55,0.3);">
            <small class="text-warning fw-bold d-block mb-1"><i class="fas fa-shield-alt me-1"></i> Admin Approval Required</small>
            <span class="text-white-50 small">All contractor accounts are verified by our Chief Project Officer before receiving site tenders.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- SHOWCASE ACCREDITED BUILDERS -->
<section class="py-5" style="background:#F8FAFC;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:720px;">
      <span class="section-subtitle">Verified Excellence</span>
      <h2 class="section-title">Accredited Network Partners</h2>
      <p class="section-desc mx-auto">Inspect active corporate builders in the Zippy Enterprises ecosystem.</p>
    </div>

    <div class="row g-4 justify-content-center">
      <?php if (!empty($builders)): ?>
        <?php foreach ($builders as $b): ?>
          <div class="col-md-6 col-lg-5">
            <div class="p-4 rounded-3 bg-white border shadow-sm h-100">
              <div class="d-flex justify-content-between align-items-start mb-3">
                <div>
                  <h4 class="fw-bold text-navy mb-1"><?= e($b['company_name']) ?></h4>
                  <small class="text-muted"><i class="fas fa-id-card text-warning me-1"></i> License: <?= e($b['license_number']) ?></small>
                </div>
                <span class="badge bg-success text-white"><i class="fas fa-check-circle me-1"></i> Verified</span>
              </div>
              <p class="text-secondary small mb-3"><?= e($b['portfolio_summary']) ?></p>
              
              <div class="mb-3">
                <small class="text-muted d-block fw-bold mb-1">Specialization:</small>
                <span class="badge bg-dark text-warning border border-warning"><?= e($b['specialization']) ?></span>
              </div>
              <div class="mb-3">
                <small class="text-muted d-block fw-bold mb-1">Service Areas in Hyderabad:</small>
                <small class="text-muted"><?= e($b['service_areas']) ?></small>
              </div>

              <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                <span class="text-warning fw-bold"><i class="fas fa-star me-1"></i> <?= $b['rating'] ?> / 5.0 Rating</span>
                <span class="text-muted small"><strong><?= $b['experience_years'] ?>+ Years</strong> Exp.</span>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
