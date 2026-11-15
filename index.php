<?php
/**
 * Corporate Homepage
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Enterprise Construction Solutions & Building Development";
$pageDescription = "Zippy Enterprises Private Limited is Hyderabad's premier construction solutions company, delivering luxury residential villas, commercial complexes, and turnkey EPC projects.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

// Fetch featured projects for showcase
$featuredProjects = [];
try {
    $db = Database::getConnection();
    $featuredProjects = $db->query("SELECT p.*, bp.company_name as builder_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id ORDER BY p.id ASC LIMIT 3")->fetchAll();
} catch (Exception $e) {
    // Graceful fallback
}
?>

<!-- FULL SCREEN ARCHITECTURAL HERO SECTION -->
<section class="hero-wrapper">
  <img src="assets/images/hero-bg.jpg" alt="Zippy Enterprises Architecture" class="hero-background-img">
  <div class="hero-overlay-gradient"></div>
  <div class="container hero-content">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="badge-gold mb-3">
          <i class="fas fa-certificate text-warning"></i> HYDERABAD'S PREMIER CONSTRUCTION PLATFORM
        </div>
        <h1 class="hero-title">
          Building Your Vision. <br>
          <span class="gold-text">Delivering Excellence.</span>
        </h1>
        <p class="hero-subtitle">
          From bespoke luxury villas in Jubilee Hills to state-of-the-art commercial tech towers in the Financial District, Zippy Enterprises Private Limited delivers turnkey architectural design, structural engineering, and precision construction execution.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="cost-estimator.php" class="btn btn-gold">
            <i class="fas fa-calculator me-2"></i> Calculate Construction Cost
          </a>
          <a href="projects.php" class="btn btn-outline-gold">
            <i class="fas fa-eye me-2"></i> Explore Projects
          </a>
          <button type="button" class="btn btn-navy text-white border border-secondary" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal">
            <i class="fas fa-calendar-check me-2 text-warning"></i> Book Site Inspection
          </button>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 shadow-premium p-4" style="background: rgba(14, 36, 66, 0.88); backdrop-filter: blur(16px); border-radius: 16px; border: 1px solid var(--border-gold);">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="badge bg-warning text-dark fw-bold px-3 py-1">LIVE METRICS</span>
            <span class="text-white-50 small"><i class="fas fa-circle text-success me-1"></i> Monitored Daily</span>
          </div>
          <div class="mb-3 pb-3 border-bottom border-secondary">
            <div class="text-white-50 small text-uppercase fw-bold">Active Construction Sites</div>
            <div class="h2 text-white fw-bold mb-0">42 <span class="text-warning small fs-6">+12% YoY</span></div>
          </div>
          <div class="mb-3 pb-3 border-bottom border-secondary">
            <div class="text-white-50 small text-uppercase fw-bold">Built-up Area Under Delivery</div>
            <div class="h2 text-white fw-bold mb-0">1.8M <span class="text-white-50 small fs-6">Sq.Ft.</span></div>
          </div>
          <div>
            <div class="text-white-50 small text-uppercase fw-bold">Engineering Quality Rating</div>
            <div class="h2 text-warning fw-bold mb-0"><i class="fas fa-star me-1"></i> 4.95 <span class="text-white-50 small fs-6">/ 5.0</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ANIMATED STATISTICS BANNER -->
<section class="stats-banner">
  <div class="container">
    <div class="row g-4">
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-number counter-val" data-target="150" data-suffix="+">0</div>
          <div class="stat-label">Projects Delivered</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-number counter-val" data-target="25" data-suffix=" Lakh+">0</div>
          <div class="stat-label">Sq.Ft. Constructed</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-number counter-val" data-target="85" data-suffix="+">0</div>
          <div class="stat-label">Vetted Contractors</div>
        </div>
      </div>
      <div class="col-6 col-lg-3">
        <div class="stat-item">
          <div class="stat-number counter-val" data-target="100" data-suffix="%">0</div>
          <div class="stat-label">On-Time Milestones</div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- INTERACTIVE SERVICES OVERVIEW (14 CORE SERVICES) -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Our Specializations</span>
      <h2 class="section-title">Comprehensive Construction &amp; Development Solutions</h2>
      <p class="section-desc mx-auto">
        Zippy Enterprises integrates end-to-end civil execution, structural intelligence, architectural design, and banking coordination under one corporate roof.
      </p>
    </div>

    <div class="row g-4">
      <!-- 1. Residential -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/residential.jpg" alt="Residential Construction" class="card-service-img">
            <span class="card-service-badge">Luxury Homes</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Residential Construction</h3>
            <p class="card-service-text">
              Turnkey civil construction of independent luxury villas, modern duplexes, and multi-generational family residences with bespoke layouts.
            </p>
            <div class="card-service-footer">
              <a href="service-residential.php" class="link-gold">Explore Service <i class="fas fa-arrow-right"></i></a>
              <span class="text-muted small">₹1,750 - ₹3,650/sqft</span>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Commercial -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/commercial.jpg" alt="Commercial Construction" class="card-service-img">
            <span class="card-service-badge">Grade-A Commercial</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Commercial Construction</h3>
            <p class="card-service-text">
              Corporate tech parks, retail shopping complexes, medical clinics, and institutional structures built to strict NBC &amp; GHMC norms.
            </p>
            <div class="card-service-footer">
              <a href="service-commercial.php" class="link-gold">Explore Service <i class="fas fa-arrow-right"></i></a>
              <span class="text-muted small">High-Velocity EPC</span>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Apartment Development -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/apartment.jpg" alt="Apartment Development" class="card-service-img">
            <span class="card-service-badge">Multi-Family</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Apartment Construction</h3>
            <p class="card-service-text">
              Multi-storey gated residential towers and boutique standalone apartment developments with modern parking basements and clubhouses.
            </p>
            <div class="card-service-footer">
              <a href="service-apartment.php" class="link-gold">Explore Service <i class="fas fa-arrow-right"></i></a>
              <span class="text-muted small">Joint-Venture &amp; EPC</span>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. Turnkey EPC -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/turnkey.jpg" alt="Turnkey Construction" class="card-service-img">
            <span class="card-service-badge">Hassle-Free</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Turnkey Construction</h3>
            <p class="card-service-text">
              Complete single-point responsibility from initial soil testing and GHMC plan approvals through foundation, finishing, and key handover.
            </p>
            <div class="card-service-footer">
              <a href="service-turnkey.php" class="link-gold">Explore Service <i class="fas fa-arrow-right"></i></a>
              <span class="text-muted small">Single-Point Accountability</span>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. Architectural & Structural -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/consultancy.jpg" alt="Architectural & Structural" class="card-service-img">
            <span class="card-service-badge">Design &amp; PMC</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Architectural &amp; Structural Design</h3>
            <p class="card-service-text">
              Vastu-compliant architectural space planning, 3D elevation renderings, STAAD-Pro structural vetting, and Project Management Consultancy.
            </p>
            <div class="card-service-footer">
              <a href="service-consultancy.php" class="link-gold">Explore Service <i class="fas fa-arrow-right"></i></a>
              <span class="text-muted small">STAAD Certified</span>
            </div>
          </div>
        </div>
      </div>

      <!-- 6. Loan Assistance -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/loan.jpg" alt="Self-Construction Loan Assistance" class="card-service-img">
            <span class="card-service-badge">Banking Support</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Self-Construction Loan Assistance</h3>
            <p class="card-service-text">
              Bank-compliant detailed estimates, chartered engineer valuation certificates, and end-to-end documentation coordination for SBI, HDFC &amp; ICICI.
            </p>
            <div class="card-service-footer">
              <a href="loan-assistance.php" class="link-gold">Explore Service <i class="fas fa-arrow-right"></i></a>
              <span class="text-muted small">Bank Certified BOQ</span>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="services.php" class="btn btn-navy px-4 py-2">
        <i class="fas fa-th-large me-2 text-warning"></i> View All 14 Construction Services
      </a>
    </div>
  </div>
</section>

<!-- 14-STAGE VISUAL CONSTRUCTION EXECUTION JOURNEY -->
<section class="py-5" style="background:#0A192F; color:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:780px;">
      <span class="section-subtitle">Transparent Project Governance</span>
      <h2 class="section-title text-white">Our Proprietary 14-Stage Construction Lifecycle</h2>
      <p class="text-white-50 mx-auto">
        Every project entrusted to Zippy Enterprises is tracked across 14 verifiable stages with photographic proof, quality audits, and milestone-linked payment protection.
      </p>
    </div>

    <div class="row g-3">
      <?php
      $stages14 = [
          1 => ['Enquiry & Consultation', 'fa-comments'],
          2 => ['Site Inspection & Soil Lab Test', 'fa-map-marked-alt'],
          3 => ['Requirements & Floor Plans', 'fa-drafting-compass'],
          4 => ['Detailed BOQ & Estimation', 'fa-calculator'],
          5 => ['Quotation & Specifications', 'fa-file-invoice-dollar'],
          6 => ['Contract Agreement & Permits', 'fa-file-signature'],
          7 => ['Excavation & Raft Foundation', 'fa-trowel-bricks'],
          8 => ['RCC Columns & Slab Castings', 'fa-cubes'],
          9 => ['Brickwork & Block Masonry', 'fa-cube'],
          10 => ['MEP Concealed Piping & Wiring', 'fa-bolt'],
          11 => ['Plastering & Waterproofing', 'fa-tint-slash'],
          12 => ['Flooring, Joinery & Finishing', 'fa-brush'],
          13 => ['Quality Audit & Snagging', 'fa-clipboard-check'],
          14 => ['Handover Ceremony & Keys', 'fa-key']
      ];
      foreach ($stages14 as $num => $st):
      ?>
        <div class="col-6 col-md-4 col-lg-3 col-xl-2">
          <div class="p-3 h-100 rounded text-center" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
            <div class="badge bg-warning text-dark rounded-circle fw-bold mb-2" style="width:28px; height:28px; line-height:20px;"><?= $num ?></div>
            <div class="text-warning mb-2"><i class="fas <?= $st[1] ?> fa-lg"></i></div>
            <div class="text-white small fw-bold" style="font-size:0.8rem; line-height:1.2;"><?= $st[0] ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="text-center mt-5">
      <a href="login.php" class="btn btn-gold">
        <i class="fas fa-satellite-dish me-2"></i> Track Your Project in Real-Time
      </a>
    </div>
  </div>
</section>

<!-- FEATURED CONSTRUCTION PROJECTS SHOWCASE -->
<section class="py-5" style="background:#F8FAFC;">
  <div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
      <div>
        <span class="section-subtitle">Realized Architecture</span>
        <h2 class="section-title">Featured Landmark Projects</h2>
        <p class="section-desc">Inspect active execution sites across Jubilee Hills, Financial District, and Kompally.</p>
      </div>
      <a href="projects.php" class="btn btn-outline-gold mb-3 mb-md-0">View All Projects <i class="fas fa-arrow-right ms-2"></i></a>
    </div>

    <div class="row g-4">
      <?php if (!empty($featuredProjects)): ?>
        <?php foreach ($featuredProjects as $prj): ?>
          <div class="col-lg-4 col-md-6">
            <div class="card-project">
              <img src="<?= e($prj['featured_image'] ?: 'assets/images/projects/project-1.jpg') ?>" alt="<?= e($prj['title']) ?>" class="card-project-img">
              <div class="card-project-overlay">
                <span class="card-project-category"><?= strtoupper(e($prj['category'])) ?> &bull; <?= e($prj['city']) ?></span>
                <h3 class="card-project-title"><?= e($prj['title']) ?></h3>
                <div class="card-project-meta">
                  <span><i class="fas fa-ruler-combined text-warning me-1"></i> <?= number_format($prj['built_up_area_sqft']) ?> Sq.Ft.</span>
                  <span><i class="fas fa-layer-group text-warning me-1"></i> <?= $prj['floors_count'] ?> Floors</span>
                </div>
                <div class="d-flex justify-content-between small text-white-50 mb-1">
                  <span>Current Progress</span>
                  <span class="text-warning fw-bold"><?= $prj['progress_percent'] ?>%</span>
                </div>
                <div class="progress-custom">
                  <div class="progress-bar-gold" style="width: <?= $prj['progress_percent'] ?>%;"></div>
                </div>
                <a href="login.php" class="link-gold small"><i class="fas fa-lock me-1"></i> View Milestone Audit Logs</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- COST ESTIMATION TEASER SECTION -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="section-subtitle">Transparent Financial Planning</span>
        <h2 class="section-title">Calculate Your Construction Cost In Under 60 Seconds</h2>
        <p class="section-desc">
          Get an instant, itemized estimate based on your exact built-up area, number of floors, and material specifications. Download a formal quotation PDF directly.
        </p>
        <ul class="list-unstyled my-4">
          <li class="mb-3 d-flex align-items-center">
            <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
            <span><strong>Civil &amp; Structural Breakdown:</strong> Raft foundation, RCC frame, TMT steel, concrete.</span>
          </li>
          <li class="mb-3 d-flex align-items-center">
            <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
            <span><strong>Finishing Specifications:</strong> Italian marble, vitrified tiles, teakwood joinery.</span>
          </li>
          <li class="mb-3 d-flex align-items-center">
            <i class="fas fa-check-circle text-warning fa-lg me-3"></i>
            <span><strong>MEP Engineering:</strong> Concealed plumbing, wiring, switches &amp; drainage systems.</span>
          </li>
        </ul>
        <a href="cost-estimator.php" class="btn btn-gold btn-lg">
          <i class="fas fa-calculator me-2"></i> Launch Construction Cost Estimator
        </a>
      </div>
      <div class="col-lg-6">
        <div class="calculator-card">
          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold mb-0 text-navy">Quick Estimate Preview</h5>
            <span class="badge bg-warning text-dark fw-bold">Live Calculator</span>
          </div>
          <div class="mb-3">
            <label class="form-label small fw-bold text-muted">Built-Up Area: <span id="quick-area-val" class="text-navy fw-bold">2,500</span> sq.ft</label>
            <input type="range" class="form-range" id="quick-area-range" min="1000" max="15000" step="100" value="2500" oninput="document.getElementById('quick-area-val').innerText = parseInt(this.value).toLocaleString('en-IN'); updateQuickTotal(this.value);">
          </div>
          <div class="calc-result-box mb-3">
            <div class="small text-white-50 text-uppercase fw-bold">Indicative Construction Budget</div>
            <div class="calc-total-number" id="quick-total-display">₹53.75 Lakhs</div>
            <div class="small text-warning">Based on Premium Specification (₹2,150/sq.ft)</div>
          </div>
          <a href="cost-estimator.php" class="btn btn-navy w-100">
            Open Full 4-Step Estimator &amp; Download PDF <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- BUILDER NETWORK CALLOUT -->
<section class="py-5" style="background: linear-gradient(135deg, #061121 0%, #0A192F 100%); color:#FFFFFF; border-top: 1px solid var(--border-gold);">
  <div class="container py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="badge-gold mb-2">BUILDER &amp; CONTRACTOR NETWORK</div>
        <h2 class="text-white fw-bold mb-3">Are You an Accredited Civil Contractor or Builder in Hyderabad?</h2>
        <p class="text-white-50 mb-0">
          Partner with Zippy Enterprises to receive verified high-value construction contracts, streamlined digital milestone approvals, and guaranteed escrow-backed billing disbursements.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="builder-register.php" class="btn btn-gold me-2 mb-2 mb-sm-0">
          <i class="fas fa-hard-hat me-2"></i> Apply for Builder Accreditation
        </a>
        <a href="builder-login.php" class="btn btn-outline-gold">
          <i class="fas fa-sign-in-alt me-2"></i> Contractor Portal
        </a>
      </div>
    </div>
  </div>
</section>

<!-- TESTIMONIALS & TRUST -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:740px;">
      <span class="section-subtitle">Client Experiences</span>
      <h2 class="section-title">What Our Project Owners Say</h2>
      <p class="section-desc mx-auto">Read authentic feedback from villa owners, tech executives, and commercial property developers.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 rounded h-100 shadow-sm border" style="background:#F8FAFC;">
          <div class="text-warning mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="text-muted small mb-3">
            "Constructing our 7,500 sq.ft villa in Jubilee Hills was completely stress-free with Zippy Enterprises. The 14-stage portal allowed us to inspect daily cube test reports, site photos, and milestone billings while living in the UK."
          </p>
          <div class="d-flex align-items-center">
            <div class="brand-logo-icon me-3" style="width:38px; height:38px; font-size:1rem;">RV</div>
            <div>
              <h6 class="mb-0 fw-bold text-navy">Rajesh Kumar Verma</h6>
              <small class="text-muted">Villa Owner, Jubilee Hills</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded h-100 shadow-sm border" style="background:#F8FAFC;">
          <div class="text-warning mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="text-muted small mb-3">
            "We awarded Zippy Enterprises the turnkey EPC contract for our G+5 commercial IT facility in the Financial District. Their structural engineering coordination and GHMC liaison was executed with textbook precision."
          </p>
          <div class="d-flex align-items-center">
            <div class="brand-logo-icon me-3" style="width:38px; height:38px; font-size:1rem;">PR</div>
            <div>
              <h6 class="mb-0 fw-bold text-navy">Dr. Priya Reddy</h6>
              <small class="text-muted">Managing Partner, Apex Health Hub</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded h-100 shadow-sm border" style="background:#F8FAFC;">
          <div class="text-warning mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="text-muted small mb-3">
            "Their self-construction loan assistance division prepared an airtight estimate and valuation certificate for SBI. The home loan was sanctioned in 14 days without a single query on specifications!"
          </p>
          <div class="d-flex align-items-center">
            <div class="brand-logo-icon me-3" style="width:38px; height:38px; font-size:1rem;">VS</div>
            <div>
              <h6 class="mb-0 fw-bold text-navy">Venkat S. Ramanathan</h6>
              <small class="text-muted">Tech Lead, Kokapet Residence</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
function updateQuickTotal(area) {
  var total = area * 2150;
  var display = '₹' + (total / 100000).toFixed(2) + ' Lakhs';
  if (total >= 10000000) {
    display = '₹' + (total / 10000000).toFixed(2) + ' Crores';
  }
  document.getElementById('quick-total-display').innerText = display;
}
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
