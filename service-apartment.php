<?php
/**
 * Apartment Development Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Apartment Construction & Multi-Storey Developments";
$pageDescription = "Turnkey apartment construction, gated community development, and builder-floor housing schemes across Hyderabad with strict GHMC/HMDA compliance.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/services/apartment.jpg" alt="Apartment Construction" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">MULTI-UNIT DEVELOPMENT</div>
    <h1 class="page-banner-title">Apartment Construction &amp; Gated Communities</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Services</a>
      <span>/</span>
      <span>Apartment Construction</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-navy mb-3">Multi-Family Housing Built for Communities and Longevity</h2>
        <p class="lead text-muted">
          Whether you are a landowner seeking a Joint Venture (JV) apartment development or a developer requiring a turnkey civil contractor, Zippy Enterprises delivers high-density residential structures with optimized carpet ratios, spacious basement configurations, and robust structural frames.
        </p>

        <h3 class="fw-bold text-navy mt-4 mb-3">Our Apartment Construction Capabilities</h3>
        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <div class="p-3 rounded border" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy"><i class="fas fa-car text-warning me-2"></i> Basement &amp; Stilt Parking</h5>
              <p class="small text-muted mb-0">Raft foundation with diaphragm retaining walls, sump tanks, and automated ventilation fans.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded border" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy"><i class="fas fa-arrows-alt-v text-warning me-2"></i> Elevator Core Shafts</h5>
              <p class="small text-muted mb-0">High-speed dual passenger and stretcher elevators engineered for quick passenger transit.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded border" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy"><i class="fas fa-swimming-pool text-warning me-2"></i> Amenity Clubhouse</h5>
              <p class="small text-muted mb-0">Clubhouse execution including fitness gymnasium, banquet hall, terrace swimming pool, and children's play areas.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded border" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy"><i class="fas fa-fire-extinguisher text-warning me-2"></i> Statutory Fire Compliance</h5>
              <p class="small text-muted mb-0">Complete wet-riser, hose-reel, automatic sprinkler, and smoke detector installation satisfying Fire NOC guidelines.</p>
            </div>
          </div>
        </div>

        <div class="p-4 rounded-3 border" style="background:rgba(212,175,55,0.06); border-color:var(--border-gold) !important;">
          <h4 class="fw-bold text-navy mb-2"><i class="fas fa-handshake text-warning me-2"></i> Landowner Joint Venture (JV) Program</h4>
          <p class="text-muted small mb-0">
            Own land in Hyderabad? Partner with Zippy Enterprises under our transparent development model. We fund the entire construction, manage GHMC approvals, and deliver a completed residential apartment complex with equitable revenue or built-up area sharing.
          </p>
        </div>
      </div>

      <!-- SIDEBAR -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">APARTMENT ENQUIRY</div>
          <h4 class="text-white fw-bold mb-2">Start an Apartment Project</h4>
          <p class="text-white-50 small mb-3">Speak with our Multi-Unit Housing Director regarding your plot layout and feasibility.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="service_requested" value="Apartment Construction">
            <input type="hidden" name="source" value="apartment_page">

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Full Name *</label>
              <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Your name">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Plot Location *</label>
              <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Kompally, Miyapur, Kokapet">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Number of Planned Units / Floors</label>
              <input type="text" name="notes" class="form-control bg-dark text-white border-secondary" placeholder="e.g. G+5 Floors, 20 Units">
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2">Request Feasibility Review</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
