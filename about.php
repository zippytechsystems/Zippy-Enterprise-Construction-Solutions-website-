<?php
/**
 * About Us Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "About Us | Corporate Profile & Engineering Legacy";
$pageDescription = "Learn about Zippy Enterprises Private Limited, our leadership team, engineering governance, safety protocols, and commitment to architectural excellence in Hyderabad.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- PAGE BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="About Zippy Enterprises" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">CORPORATE PROFILE</div>
    <h1 class="page-banner-title">Engineering Excellence. Architectural Vision.</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>About Us</span>
    </div>
  </div>
</section>

<!-- CORPORATE OVERVIEW -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="section-subtitle">Who We Are</span>
        <h2 class="section-title">Zippy Enterprises Private Limited</h2>
        <p class="section-desc">
          Headquartered in Jubilee Hills, Hyderabad, Zippy Enterprises Private Limited was incorporated with a decisive charter: to elevate construction solutions and building development to the rigorous standards of enterprise technology.
        </p>
        <p class="text-muted">
          We combine cutting-edge structural engineering software (STAAD-Pro, ETABS, Revit BIM) with seasoned on-ground site execution teams. Whether executing ultra-luxury private villas or multi-storey commercial complexes, our proprietary 14-stage governance model guarantees complete financial transparency, zero material compromise, and strict adherence to handover schedules.
        </p>
        <div class="row g-3 mt-3">
          <div class="col-sm-6">
            <div class="p-3 rounded border" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy mb-1"><i class="fas fa-bullseye text-warning me-2"></i> Our Mission</h5>
              <p class="small text-muted mb-0">To eliminate uncertainty and delay from construction through digitized milestone tracking, certified engineering, and transparent pricing.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 rounded border" style="background:#F8FAFC;">
              <h5 class="fw-bold text-navy mb-1"><i class="fas fa-eye text-warning me-2"></i> Our Vision</h5>
              <p class="small text-muted mb-0">To be Telangana and South India's most trusted construction brand for high-value residential and commercial developments.</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6">
        <div class="position-relative">
          <img src="assets/images/services/consultancy.jpg" alt="Construction Management" class="img-fluid rounded-4 shadow-lg border" style="border: 1px solid var(--border-gold);">
          <div class="p-4 rounded-3 shadow-lg position-absolute bottom-0 end-0 m-4 d-none d-md-block" style="background: rgba(10,25,47,0.95); border: 1px solid var(--border-gold); max-width: 280px;">
            <div class="text-warning h3 fw-bold mb-1">ISO 9001:2015</div>
            <div class="text-white-50 small">Certified Quality Management System for Civil Construction and Engineering Consultancy.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ENGINEERING & QUALITY BENCHMARKS -->
<section class="py-5" style="background:#0A192F; color:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Zero Tolerance For Compromise</span>
      <h2 class="section-title text-white">Our Engineering &amp; Quality Benchmarks</h2>
      <p class="text-white-50 mx-auto">Every structural element is vetted against Indian Standard (IS) Codes and documented digitally.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-cube"></i></div>
          <h5 class="text-white fw-bold">M25 / M30 Ready-Mix Concrete</h5>
          <p class="text-white-50 small mb-0">Tested with standardized compressive cube tests at 7, 14, and 28 days with lab certificates uploaded to your portal.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-layer-group"></i></div>
          <h5 class="text-white fw-bold">Fe 550D High-Ductility TMT</h5>
          <p class="text-white-50 small mb-0">Only primary steel manufacturers (Tata Tiscon, JSW Steel, Vizag Steel) ensuring seismic and earthquake resistance.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-shield-virus"></i></div>
          <h5 class="text-white fw-bold">3-Tier Waterproofing</h5>
          <p class="text-white-50 small mb-0">Elastomeric membrane coatings and ponding tests for 72 hours on all sunken slabs, basements, and terrace roofs.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-compass"></i></div>
          <h5 class="text-white fw-bold">100% Vastu Compliance</h5>
          <p class="text-white-50 small mb-0">Architectural layouts vetted by traditional Vastu consultants while preserving modern spatial aesthetics and ventilation.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- LEADERSHIP TEAM -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:720px;">
      <span class="section-subtitle">Executive Governance</span>
      <h2 class="section-title">Leadership &amp; Technical Advisory</h2>
      <p class="section-desc mx-auto">Experienced civil engineers, chartered architects, and construction management professionals.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden text-center p-3" style="background:#F8FAFC;">
          <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold" style="width:100px; height:100px; background:var(--navy-primary); font-size:1.8rem; border:2px solid var(--gold-primary);">
            ER
          </div>
          <h5 class="fw-bold text-navy mb-1">Er. R. K. Varma</h5>
          <div class="text-warning small fw-bold mb-2">Managing Director &amp; CEO</div>
          <p class="text-muted small mb-0">M.Tech Structural (IIT Kharagpur) with 24+ years directing massive civil EPC projects across South India.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden text-center p-3" style="background:#F8FAFC;">
          <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold" style="width:100px; height:100px; background:var(--navy-primary); font-size:1.8rem; border:2px solid var(--gold-primary);">
            SM
          </div>
          <h5 class="fw-bold text-navy mb-1">Ar. Sneha Madhavan</h5>
          <div class="text-warning small fw-bold mb-2">Principal Architect</div>
          <p class="text-muted small mb-0">B.Arch (SPA Delhi), LEED AP. Renowned for biophilic sustainable design and luxury villa architecture.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden text-center p-3" style="background:#F8FAFC;">
          <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold" style="width:100px; height:100px; background:var(--navy-primary); font-size:1.8rem; border:2px solid var(--gold-primary);">
            VR
          </div>
          <h5 class="fw-bold text-navy mb-1">Er. Vikram Rao</h5>
          <div class="text-warning small fw-bold mb-2">Chief Project Officer (PMC)</div>
          <p class="text-muted small mb-0">PMP certified construction expert who has successfully overseen over 80 residential &amp; commercial handovers.</p>
        </div>
      </div>
      <div class="col-md-6 col-lg-3">
        <div class="card border-0 shadow-sm rounded-3 overflow-hidden text-center p-3" style="background:#F8FAFC;">
          <div class="rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center text-white fw-bold" style="width:100px; height:100px; background:var(--navy-primary); font-size:1.8rem; border:2px solid var(--gold-primary);">
            AN
          </div>
          <h5 class="fw-bold text-navy mb-1">A. N. Nambiar</h5>
          <div class="text-warning small fw-bold mb-2">VP - Banking &amp; Financial Liaison</div>
          <p class="text-muted small mb-0">Former Chief Manager at SBI with 20+ years expertise facilitating self-construction home loan sanctions.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- CALL TO ACTION -->
<section class="py-5 text-center" style="background:var(--navy-deep); color:#FFFFFF; border-top:1px solid var(--border-gold);">
  <div class="container py-4">
    <h2 class="text-white fw-bold mb-3">Ready to Build Your Architectural Landmark?</h2>
    <p class="text-white-50 mx-auto mb-4" style="max-width:600px;">
      Schedule a private consultation at our Jubilee Hills corporate office or request a site inspection with our Senior Project Consultant.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <button type="button" class="btn btn-gold" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal">
        <i class="fas fa-calendar-alt me-2"></i> Schedule Consultation
      </button>
      <a href="cost-estimator.php" class="btn btn-outline-gold">
        <i class="fas fa-calculator me-2"></i> Calculate Cost
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
