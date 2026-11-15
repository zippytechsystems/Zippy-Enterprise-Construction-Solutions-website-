<?php
/**
 * Turnkey Construction Solutions Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Turnkey Construction Solutions (Concept to Keys)";
$pageDescription = "Complete turnkey construction services in Hyderabad. Single-point accountability, fixed price contracts, 14-stage digital tracking, and guaranteed handover dates.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/services/turnkey.jpg" alt="Turnkey Construction" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">END-TO-END EPC</div>
    <h1 class="page-banner-title">Turnkey Construction Solutions (Concept to Keys)</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Services</a>
      <span>/</span>
      <span>Turnkey Construction</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-navy mb-3">Zero Hassle. Single-Point Accountability. Guaranteed Handover.</h2>
        <p class="lead text-muted">
          Traditional construction forces property owners to juggle architects, structural consultants, civil contractors, plumbing teams, electrical vendors, and municipal approval agents. Zippy Enterprises eliminates this fragmentation with our unified Turnkey EPC model.
        </p>

        <!-- THE 5 PILLARS OF OUR TURNKEY PROMISE -->
        <h3 class="fw-bold text-navy mt-5 mb-4">The Five Pillars of the Zippy Turnkey Contract</h3>
        
        <div class="mb-4 d-flex align-items-start">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:48px; height:48px; font-size:1.2rem;">1</div>
          <div>
            <h5 class="fw-bold text-navy mb-1">Fixed-Price Transparency (Zero Escalation)</h5>
            <p class="text-muted small mb-0">Our comprehensive Bill of Quantities (BOQ) locks in material costs and contractor labor. No hidden surprise bills or mid-project cost escalations.</p>
          </div>
        </div>

        <div class="mb-4 d-flex align-items-start">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:48px; height:48px; font-size:1.2rem;">2</div>
          <div>
            <h5 class="fw-bold text-navy mb-1">100% Statutory Clearance Coordination</h5>
            <p class="text-muted small mb-0">We prepare and coordinate all architectural submissions for GHMC / HMDA building sanction permits, borewell permissions, and electrical transformer installations.</p>
          </div>
        </div>

        <div class="mb-4 d-flex align-items-start">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:48px; height:48px; font-size:1.2rem;">3</div>
          <div>
            <h5 class="fw-bold text-navy mb-1">Transparent 14-Stage Milestone Governance</h5>
            <p class="text-muted small mb-0">Receive weekly documented progress reports, certified slump and cube test certificates, high-resolution site photographs, and transparent stage-wise milestone sign-offs before any payment release.</p>
          </div>
        </div>

        <div class="mb-4 d-flex align-items-start">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:48px; height:48px; font-size:1.2rem;">4</div>
          <div>
            <h5 class="fw-bold text-navy mb-1">Direct Factory Brand Procurement</h5>
            <p class="text-muted small mb-0">We source directly from manufacturers: Tata Tiscon / JSW Fe550D steel, UltraTech cement, Ashirvad pipes, Finolex / Polycab wiring, and Saint-Gobain glass.</p>
          </div>
        </div>

        <div class="mb-4 d-flex align-items-start">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:48px; height:48px; font-size:1.2rem;">5</div>
          <div>
            <h5 class="fw-bold text-navy mb-1">Contractual Delay Penalty</h5>
            <p class="text-muted small mb-0">We stand behind our commitments. Our contracts include a daily liquidated damage penalty for unjustified contractor delays.</p>
          </div>
        </div>

        <div class="mt-4 p-4 rounded-3 border" style="background:#F8FAFC;">
          <h5 class="fw-bold text-navy mb-2"><i class="fas fa-file-invoice text-warning me-2"></i> Want a Turnkey Project Quotation?</h5>
          <p class="text-muted small mb-3">Submit your plot location, dimensions, and building requirements to receive an itemized Bill of Quantities (BOQ).</p>
          <a href="quote.php" class="btn btn-navy">Request a Quotation <i class="fas fa-arrow-right ms-2"></i></a>
        </div>
      </div>

      <!-- SIDEBAR -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">TURNKEY CONTRACT</div>
          <h4 class="text-white fw-bold mb-2">Turnkey Consultation</h4>
          <p class="text-white-50 small mb-3">Discuss your project scope and schedule a free plot survey.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="service_requested" value="Turnkey Construction">
            <input type="hidden" name="source" value="turnkey_page">

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
              <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Gachibowli">
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2">Schedule Free Site Survey</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
