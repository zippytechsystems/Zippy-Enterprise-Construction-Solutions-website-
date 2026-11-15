<?php
/**
 * Architectural & Structural Consultancy Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Architectural & Structural Engineering Consultancy";
$pageDescription = "Chartered structural engineering, STAAD-Pro analysis, 3D architectural elevation design, Vastu planning, and Project Management Consultancy (PMC) in Hyderabad.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/services/consultancy.jpg" alt="Architectural & Structural Consultancy" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">ENGINEERING &amp; DESIGN</div>
    <h1 class="page-banner-title">Architectural &amp; Structural Engineering Consultancy</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Services</a>
      <span>/</span>
      <span>Engineering Consultancy</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-navy mb-3">Certified Engineering Intelligence Before Concrete Meets Ground</h2>
        <p class="lead text-muted">
          A building is only as resilient as the mathematics that created its structural frame. Zippy Enterprises provides licensed architectural space planning and chartered structural engineering consultancy to clients, developers, and independent contractors across Telangana.
        </p>

        <div class="row g-4 my-4">
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-drafting-compass"></i></div>
              <h5 class="fw-bold text-navy">Architectural Design &amp; 3D BIM</h5>
              <p class="small text-muted mb-0">From micro-climatic daylight analysis to photorealistic 3D external elevation rendering, we create iconic structures aligned with modern lifestyle needs.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-calculator"></i></div>
              <h5 class="fw-bold text-navy">STAAD-Pro Structural Analysis</h5>
              <p class="small text-muted mb-0">Full finite-element structural modeling, load combination simulations (Dead, Live, Wind, Earthquake as per IS 1893), and rebar optimization.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-clipboard-check"></i></div>
              <h5 class="fw-bold text-navy">Project Management Consultancy (PMC)</h5>
              <p class="small text-muted mb-0">Independent quality audits, contractor bill vetting, slump cone testing, cube compressive strength tests, and defect verification.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-file-invoice"></i></div>
              <h5 class="fw-bold text-navy">Statutory Clearances &amp; Sanctions</h5>
              <p class="small text-muted mb-0">Preparation and liaison for GHMC / HMDA online building permissions, fire department approvals, and structural stability certificates.</p>
            </div>
          </div>
        </div>

        <h3 class="fw-bold text-navy mt-4 mb-3">Our Structural Engineering Deliverables</h3>
        <ul class="list-unstyled">
          <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Soil investigation interpretation and safe bearing capacity (SBC) validation</li>
          <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Raft foundation, isolated footing, or combined footing detailing</li>
          <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Column schedules, beam cross-sections, and slab rebar bending schedules (BBS)</li>
          <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Ductile detailing drawings conforming to IS 13920 for seismic resistance</li>
          <li class="mb-2"><i class="fas fa-check-circle text-warning me-2"></i> Registered Structural Engineer (RSE) stability certificate for bank &amp; municipal use</li>
        </ul>
      </div>

      <!-- SIDEBAR -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">DESIGN ADVISORY</div>
          <h4 class="text-white fw-bold mb-2">Book Design Consultation</h4>
          <p class="text-white-50 small mb-3">Consult with our Principal Architect or Chief Structural Engineer.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="service_requested" value="Architectural & Structural Design">
            <input type="hidden" name="source" value="consultancy_page">

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Full Name *</label>
              <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Your name">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Consultancy Required *</label>
              <select name="notes" class="form-select bg-dark text-white border-secondary">
                <option value="Complete Architectural & Structural Design">Complete Architectural &amp; Structural Design</option>
                <option value="Structural Stability & Vetting Only">Structural Stability &amp; Vetting Only</option>
                <option value="Project Management Consultancy (PMC)">Project Management Consultancy (PMC)</option>
                <option value="GHMC / HMDA Plan Sanction Vetting">GHMC / HMDA Plan Sanction Vetting</option>
              </select>
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2">Schedule Engineering Review</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
