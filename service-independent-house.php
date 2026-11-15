<?php
/**
 * Independent House Construction Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Independent House Construction in Hyderabad";
$pageDescription = "Bespoke independent house construction on private plots across Hyderabad. Transparent pricing, engineered foundations, 100% Vastu compliance, and premium structural execution.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/services/residential.jpg" alt="Independent House Construction" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">INDIVIDUAL HOMES</div>
    <h1 class="page-banner-title">Independent House Construction</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Construction Solutions</a>
      <span>/</span>
      <span>Independent House Construction</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-navy mb-3">Custom Independent Homes Tailored to Your Family's Lifestyle</h2>
        <p class="lead text-muted">
          Building on your private plot requires meticulous spatial planning, soil bearing capacity analysis, and personalized architectural styling. Zippy Enterprises translates your vision into an enduring, earthquake-resistant individual home designed for generations.
        </p>
        <p class="text-secondary">
          Whether you own a 200, 300, or 500 square yard plot in Kompally, Tellapur, Manikonda, or Uppal, we oversee every phase: architectural concept drawings, GHMC municipal building sanction, foundation raft casting, AAC block masonry, concealed electrical/plumbing conduits, and fine interior joinery.
        </p>

        <!-- CORE FEATURES -->
        <h4 class="fw-bold text-navy mt-5 mb-3">What Distinguishes Our Independent House Construction</h4>
        
        <div class="row g-3 mb-4">
          <div class="col-md-6">
            <div class="p-3 rounded border h-100" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy"><i class="fas fa-compass text-warning me-2"></i> 100% Traditional Vastu Compliance</h5>
              <p class="small text-muted mb-0">Every room dimension, kitchen placement (Agni corner), master bedroom orientation, and water storage sump is mapped to classical Vastu principles.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded border h-100" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy"><i class="fas fa-layer-group text-warning me-2"></i> Engineered Raft &amp; Footings</h5>
              <p class="small text-muted mb-0">Structural designs calculated using STAAD-Pro to accommodate future vertical floor additions (e.g., designing G+1 foundations with G+3 load reserve).</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-2" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-shield-alt"></i></div>
              <h5 class="fw-bold text-navy">Primary Steel &amp; Certified Concrete</h5>
              <p class="small text-muted mb-0">Tata Tiscon or JSW Fe550D TMT steel coupled with automated batching plant M25/M30 concrete with compressive cube testing certificates.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-3 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-2" style="width:36px; height:36px; font-size:1rem;"><i class="fas fa-tint-slash"></i></div>
              <h5 class="fw-bold text-navy">Comprehensive Waterproofing</h5>
              <p class="small text-muted mb-0">3-layer elastomeric waterproofing on terrace slabs, sunken bathrooms, and external retaining walls with a 5-year leak-free warranty.</p>
            </div>
          </div>
        </div>

        <!-- SPECIFICATIONS MATRIX -->
        <h4 class="fw-bold text-navy mt-4 mb-3">Package Options for Independent Houses</h4>
        <div class="row g-3 mb-4">
          <div class="col-md-4">
            <div class="p-4 rounded border h-100 text-center" style="background:#F8FAFC;">
              <span class="badge bg-secondary mb-2">CLASSIC</span>
              <div class="h4 fw-bold text-navy mb-1">₹1,750 <small class="fs-6 text-muted">/sqft</small></div>
              <p class="small text-muted">Sturdy quality build for budget-conscious families &amp; rental floors.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-4 rounded border h-100 text-center position-relative shadow-sm" style="background:#FFFFFF; border:2px solid var(--gold-primary) !important;">
              <span class="badge bg-warning text-dark fw-bold mb-2">PREMIUM</span>
              <div class="h4 fw-bold text-navy mb-1">₹2,150 <small class="fs-6 text-muted">/sqft</small></div>
              <p class="small text-muted">Our flagship choice with 4x2 GVT tiles, teakwood doors, Kohler/Jaquar.</p>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-4 rounded border h-100 text-center" style="background:#F8FAFC;">
              <span class="badge bg-dark text-warning border border-warning mb-2">LUXURY</span>
              <div class="h4 fw-bold text-navy mb-1">₹2,850 <small class="fs-6 text-muted">/sqft</small></div>
              <p class="small text-muted">Italian marble living spaces, designer ceilings, and smart conduits.</p>
            </div>
          </div>
        </div>
      </div>

      <!-- SIDEBAR ENQUIRY FORM -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">PROJECT ENQUIRY</div>
          <h4 class="text-white fw-bold mb-2">Build Your House</h4>
          <p class="text-white-50 small mb-3">Consult with our Senior Civil Project Consultant regarding your plot dimensions and floor plans.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="construction_type" value="Independent House Construction">
            <input type="hidden" name="source" value="independent_house_page">

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Full Name *</label>
              <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Your name">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Mobile Phone *</label>
              <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Plot Location *</label>
              <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Kompally, Tellapur">
            </div>
            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Plot Size</label>
                <input type="text" name="plot_size" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 250 sqyd">
              </div>
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Floors</label>
                <select name="number_of_floors" class="form-select bg-dark text-white border-secondary">
                  <option value="G">G Only</option>
                  <option value="G+1" selected>G+1</option>
                  <option value="G+2">G+2</option>
                  <option value="G+3">G+3</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">Request Project Consultation</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
