<?php
/**
 * Villa Construction Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Luxury Villa Construction in Hyderabad";
$pageDescription = "Premier luxury villa construction in Jubilee Hills, Banjara Hills, Kokapet, and Gandipet. Ultra-luxury specifications, Italian marble, double-height living spaces, and bespoke architecture.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/projects/project-1.jpg" alt="Luxury Villa Construction" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">LUXURY RESIDENTIAL ESTATES</div>
    <h1 class="page-banner-title">Luxury Villa Construction</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Construction Solutions</a>
      <span>/</span>
      <span>Villa Construction</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-navy mb-3">Architectural Grandeur Built to Highest International Standards</h2>
        <p class="lead text-muted">
          A bespoke villa is not merely a house; it is a signature architectural landmark. Zippy Enterprises specializes in constructing sprawling private villas, contemporary estates, and hillside residences with uncompromised engineering precision.
        </p>
        <p class="text-secondary">
          From prime plots in Jubilee Hills, Banjara Hills, Kokapet, and Gandipet to gated enclave communities, our construction management teams coordinate with leading landscape architects, MEP consultants, and interior lighting designers to deliver residences that inspire.
        </p>

        <!-- LUXURY FEATURES -->
        <h4 class="fw-bold text-navy mt-5 mb-3">Signature Architectural Villa Features</h4>
        
        <div class="row g-4 mb-5">
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-archway"></i></div>
              <h5 class="fw-bold text-navy">Double-Height Living &amp; Atriums</h5>
              <p class="small text-muted mb-0">Structural steel and post-tensioned beam engineering that enables 22-foot soaring ceilings and floor-to-ceiling glass curtain walls.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-gem"></i></div>
              <h5 class="fw-bold text-navy">Imported Statuario &amp; Botticino Marble</h5>
              <p class="small text-muted mb-0">Precision diamond gang-saw cutting, seamless book-matched veins, and dry-lay inspection before final floor laying.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-arrows-alt-v"></i></div>
              <h5 class="fw-bold text-navy">Private Hydraulic Elevator Shafts</h5>
              <p class="small text-muted mb-0">Custom glass-enclosed or concealed pneumatic and hydraulic home elevators designed seamlessly into the core layout.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-swimming-pool"></i></div>
              <h5 class="fw-bold text-navy">Infinity Pool &amp; Water Features</h5>
              <p class="small text-muted mb-0">Cantilevered rooftop plunge pools or ground-level heated infinity pools with concealed balancing tanks and filtration plants.</p>
            </div>
          </div>
        </div>

        <!-- SPECIFICATIONS TABLE -->
        <div class="p-4 rounded-3 border" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">ULTRA-LUXURY SPECIFICATION</div>
          <h4 class="text-white fw-bold mb-3">The Zippy Royal Villa Standard</h4>
          <ul class="list-unstyled small text-white-50 mb-0">
            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> <strong>Concrete &amp; Steel:</strong> M30 grade RMC with Fe 550D primary steel conforming to high seismic ductile codes.</li>
            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> <strong>Acoustic &amp; Thermal Fenestration:</strong> Reynaers / Schüco double-glazed thermal break aluminium windows.</li>
            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> <strong>Fine Joinery:</strong> 8-foot high solid Burma teakwood door frames and artisan crafted shutter panels.</li>
            <li class="mb-2"><i class="fas fa-check text-warning me-2"></i> <strong>Sanitaryware:</strong> Concealed in-wall cisterns with Grohe, Hansgrohe, Kohler, or Toto wall-hung smart commodes.</li>
            <li><i class="fas fa-check text-warning me-2"></i> <strong>Home Automation:</strong> Complete KNX/Zigbee centralized wiring for HVAC, ambient lighting, and automated motorized curtains.</li>
          </ul>
        </div>
      </div>

      <!-- SIDEBAR ENQUIRY FORM -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">PRIVATE CONSULTATION</div>
          <h4 class="text-white fw-bold mb-2">Construct Your Villa</h4>
          <p class="text-white-50 small mb-3">Discuss your plot dimensions and architectural vision with our Principal Residential Engineer.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="construction_type" value="Luxury Villa Construction">
            <input type="hidden" name="source" value="villa_page">

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Full Name *</label>
              <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Your full name">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Mobile Number *</label>
              <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Plot Location *</label>
              <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Kokapet">
            </div>
            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Plot Size (Sq.Yds)</label>
                <input type="text" name="plot_size" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 500 Sq.Yds">
              </div>
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Built-up (Sq.Ft)</label>
                <input type="text" name="built_up_area" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 6,500 Sq.Ft">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Estimated Budget Range</label>
              <select name="approx_budget" class="form-select bg-dark text-white border-secondary">
                <option value="₹1.5 Crores - ₹3.0 Crores">₹1.5 Crores - ₹3.0 Crores</option>
                <option value="₹3.0 Crores - ₹6.0 Crores" selected>₹3.0 Crores - ₹6.0 Crores</option>
                <option value="₹6.0 Crores - ₹12.0 Crores">₹6.0 Crores - ₹12.0 Crores</option>
                <option value="₹12.0 Crores+">₹12.0 Crores+ (Ultra Estate)</option>
              </select>
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">Request Private Villa Briefing</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
