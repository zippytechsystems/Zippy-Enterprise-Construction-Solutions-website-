<?php
/**
 * Commercial Building Construction Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Commercial Building Construction & Tech Parks";
$pageDescription = "Grade-A commercial building construction in Hyderabad. High-velocity EPC for IT tech parks, corporate offices, retail spaces, and mixed-use structures.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/services/commercial.jpg" alt="Commercial Construction" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">COMMERCIAL EPC</div>
    <h1 class="page-banner-title">Commercial Building Construction &amp; IT Hubs</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Services</a>
      <span>/</span>
      <span>Commercial Construction</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <div class="col-lg-8">
        <h2 class="fw-bold text-navy mb-3">Enterprise-Grade Commercial Engineering &amp; Execution</h2>
        <p class="lead text-muted">
          Commercial assets demand structural efficiency, rapid execution speed, and compliance with stringent municipal, fire, and structural safety codes. Zippy Enterprises provides full EPC capabilities for high-velocity commercial developments across Hyderabad.
        </p>
        
        <div class="row g-4 my-4">
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-laptop-code"></i></div>
              <h5 class="fw-bold text-navy">Corporate Tech Parks &amp; IT Hubs</h5>
              <p class="small text-muted mb-0">High-capacity structural design allowing wide column spans, large floor plates, and dedicated server room slab loading.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-shopping-bag"></i></div>
              <h5 class="fw-bold text-navy">Retail &amp; Showroom Complexes</h5>
              <p class="small text-muted mb-0">Double-height entrance atriums, frameless structural glazing, escalators, and customer flow optimization.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-hospital-alt"></i></div>
              <h5 class="fw-bold text-navy">Healthcare &amp; Institutional</h5>
              <p class="small text-muted mb-0">Medical gas line integration, anti-bacterial seamless flooring, radiation-shielded diagnostic spaces, and heavy elevator shafts.</p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="p-4 rounded border h-100" style="background:#F8FAFC;">
              <div class="brand-logo-icon mb-3"><i class="fas fa-hotel"></i></div>
              <h5 class="fw-bold text-navy">Hospitality &amp; Banquet Complexes</h5>
              <p class="small text-muted mb-0">Acoustic insulation, large pillarless banquet halls with post-tensioned (PT) slabs, and commercial kitchen MEP layouts.</p>
            </div>
          </div>
        </div>

        <h3 class="fw-bold text-navy mt-4 mb-3">Commercial Execution Highlights</h3>
        <ul class="list-unstyled">
          <li class="mb-3 d-flex align-items-start">
            <i class="fas fa-check-circle text-warning fa-lg me-3 mt-1"></i>
            <div>
              <strong>Post-Tensioned (PT) Slabs:</strong> Facilitates large clear spans without intermediate columns, maximizing carpet area and commercial leasing yields.
            </div>
          </li>
          <li class="mb-3 d-flex align-items-start">
            <i class="fas fa-check-circle text-warning fa-lg me-3 mt-1"></i>
            <div>
              <strong>High-Performance Structural Facades:</strong> Double-glazed unitized curtain walls offering thermal insulation and sound deadening.
            </div>
          </li>
          <li class="mb-3 d-flex align-items-start">
            <i class="fas fa-check-circle text-warning fa-lg me-3 mt-1"></i>
            <div>
              <strong>Integrated MEP Engineering:</strong> Centralized HVAC chilling plants, multi-level fire suppression sprinklers, and backup diesel generator synchronizers.
            </div>
          </li>
        </ul>
      </div>

      <!-- SIDEBAR -->
      <div class="col-lg-4">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">COMMERCIAL INQUIRY</div>
          <h4 class="text-white fw-bold mb-2">Commercial Project Tender</h4>
          <p class="text-white-50 small mb-3">Request a comprehensive Bill of Quantities (BOQ) or propose a joint commercial development.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="service_requested" value="Commercial Building Construction">
            <input type="hidden" name="source" value="commercial_page">

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Company / Developer Name *</label>
              <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Company or contact name">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Site Location in Hyderabad *</label>
              <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Financial District, Hitec City">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Estimated Built-up Area (Sq.Ft)</label>
              <input type="text" name="notes" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 25,000 sq.ft">
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2">Submit Commercial Tender Request</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
