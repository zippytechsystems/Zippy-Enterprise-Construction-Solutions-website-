<?php
/**
 * Request a Quotation Page (Full 10-Field System)
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Request a Construction Quotation";
$pageDescription = "Request a comprehensive, itemized construction quotation for your residential villa, independent home, commercial building, or apartment project in Hyderabad.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Request a Quotation" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">DETAILED PROJECT ESTIMATION</div>
    <h1 class="page-banner-title">Request a Construction Quotation</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Request a Quotation</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <!-- 10-FIELD ENQUIRY FORM -->
      <div class="col-lg-7">
        <div class="p-4 p-md-5 rounded-4 shadow-sm border bg-white">
          <div class="badge-gold mb-2">PROJECT SPECIFICATIONS</div>
          <h3 class="fw-bold text-navy mb-2">Tell Us About Your Construction Project</h3>
          <p class="text-muted small mb-4">Complete this form to receive an engineering Bill of Quantities (BOQ) and indicative cost breakdown prepared by our technical estimators.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="source" value="request_a_quotation_page">

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">1. Customer Full Name *</label>
                <input type="text" name="full_name" class="form-control" required placeholder="Enter your full name">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">2. Mobile Phone Number *</label>
                <input type="tel" name="phone" class="form-control" required placeholder="+91 98765 43210">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">3. Email Address *</label>
                <input type="email" name="email" class="form-control" required placeholder="name@domain.com">
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">4. Project Location in Hyderabad *</label>
                <input type="text" name="project_location" class="form-control" required placeholder="e.g. Jubilee Hills, Kokapet, Tellapur">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">5. Construction Type *</label>
                <select name="construction_type" class="form-select" required>
                  <option value="Residential Building Construction">Residential Building Construction</option>
                  <option value="Independent House Construction">Independent House Construction</option>
                  <option value="Luxury Villa Construction">Luxury Villa Construction</option>
                  <option value="Commercial Building Construction">Commercial Building Construction</option>
                  <option value="Apartment Development">Apartment Development</option>
                  <option value="Turnkey Construction Projects">Turnkey Construction Projects</option>
                  <option value="Architectural & Structural Design">Architectural &amp; Structural Design</option>
                  <option value="Self-Construction Loan Assistance">Self-Construction Loan Assistance</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label small fw-bold text-navy">6. Plot Size (Sq.Yards / Dimensions)</label>
                <input type="text" name="plot_size" class="form-control" placeholder="e.g. 350 Sq.Yards (40 x 78 ft)">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label small fw-bold text-navy">7. Built-Up Area (Sq.Ft)</label>
                <input type="text" name="built_up_area" class="form-control" placeholder="e.g. 4,200 Sq.Ft">
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold text-navy">8. Number of Floors</label>
                <select name="number_of_floors" class="form-select">
                  <option value="Ground Only (G)">Ground Only (G)</option>
                  <option value="Ground + 1 Floor (G+1)" selected>Ground + 1 Floor (G+1)</option>
                  <option value="Ground + 2 Floors (G+2)">Ground + 2 Floors (G+2)</option>
                  <option value="Ground + 3 Floors (G+3)">Ground + 3 Floors (G+3)</option>
                  <option value="G+4 / Multi-Storey">G+4 / Multi-Storey</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label small fw-bold text-navy">9. Approximate Budget</label>
                <select name="approx_budget" class="form-select">
                  <option value="₹75 Lakhs - ₹1.5 Crores">₹75 Lakhs - ₹1.5 Crores</option>
                  <option value="₹1.5 Crores - ₹3.0 Crores" selected>₹1.5 Crores - ₹3.0 Crores</option>
                  <option value="₹3.0 Crores - ₹6.0 Crores">₹3.0 Crores - ₹6.0 Crores</option>
                  <option value="₹6.0 Crores+">₹6.0 Crores+ (Commercial / Luxury)</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label small fw-bold text-navy">10. Project Requirements &amp; Special Preferences</label>
              <textarea name="project_requirements" rows="4" class="form-control" placeholder="Mention preferred architectural style (Contemporary/Classical), Vastu requirements, Italian marble preferences, home elevator, or target start date..."></textarea>
            </div>

            <button type="submit" class="btn btn-gold btn-lg w-100 py-3 fw-bold">
              <i class="fas fa-calculator me-2"></i> Submit &amp; Generate Quotation Reference
            </button>
          </form>
        </div>
      </div>

      <!-- RIGHT SIDEBAR: WHAT HAPPENS NEXT -->
      <div class="col-lg-5">
        <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5 mb-4" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">HOW IT WORKS</div>
          <h4 class="text-white fw-bold mb-3">Our 6-Step Consultation Process</h4>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:36px; height:36px; font-size:0.9rem;">1</div>
            <div>
              <h6 class="text-white fw-bold mb-1">Customer Consultation</h6>
              <p class="small text-white-50 mb-0">Initial telephone or office briefing with our Senior Technical Advisor.</p>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:36px; height:36px; font-size:0.9rem;">2</div>
            <div>
              <h6 class="text-white fw-bold mb-1">Project Requirements Finalized</h6>
              <p class="small text-white-50 mb-0">Room counts, floor heights, Vastu alignment, and aesthetic benchmarks.</p>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:36px; height:36px; font-size:0.9rem;">3</div>
            <div>
              <h6 class="text-white fw-bold mb-1">Site Visit &amp; Plot Inspection</h6>
              <p class="small text-white-50 mb-0">Topography survey, contour analysis, road access check, and soil assessment.</p>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:36px; height:36px; font-size:0.9rem;">4</div>
            <div>
              <h6 class="text-white fw-bold mb-1">Cost Estimation &amp; Proposal</h6>
              <p class="small text-white-50 mb-0">Comprehensive Bill of Quantities (BOQ) with transparent stage-wise milestones.</p>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:36px; height:36px; font-size:0.9rem;">5</div>
            <div>
              <h6 class="text-white fw-bold mb-1">Agreement &amp; Planning</h6>
              <p class="small text-white-50 mb-0">Executed legal contract, architectural sanction submission, and execution schedule.</p>
            </div>
          </div>

          <div class="d-flex">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:36px; height:36px; font-size:0.9rem;">6</div>
            <div>
              <h6 class="text-white fw-bold mb-1">Construction Execution Coordination</h6>
              <p class="small text-white-50 mb-0">On-ground civil execution with strict IS quality testing and timely handover.</p>
            </div>
          </div>
        </div>

        <!-- FAST WHATSAPP ASSISTANCE -->
        <div class="p-4 rounded-4 border bg-white shadow-sm text-center">
          <i class="fab fa-whatsapp text-success fa-3x mb-2"></i>
          <h5 class="fw-bold text-navy mb-1">Need Quick Answers?</h5>
          <p class="small text-muted mb-3">Connect directly with our Hyderabad Technical Advisory desk on WhatsApp.</p>
          <a href="https://wa.me/<?= COMPANY_WHATSAPP ?>" target="_blank" class="btn btn-outline-success w-100 py-2 fw-bold">
            <i class="fab fa-whatsapp me-2"></i> Chat on WhatsApp (+91 <?= COMPANY_WHATSAPP ?>)
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
