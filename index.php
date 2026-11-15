<?php
/**
 * Premium Corporate Homepage
 * Zippy Enterprises Private Limited
 * Public Corporate Business & Portfolio Website
 */
$pageTitle = "Enterprise Construction Solutions & Building Development";
$pageDescription = "From independent homes to commercial developments, Zippy Enterprises delivers professional construction solutions with a commitment to quality, transparency and excellence in Hyderabad.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

// Fetch verified featured projects for showcase
$featuredProjects = [];
try {
    $db = Database::getConnection();
    $featuredProjects = $db->query("SELECT * FROM projects ORDER BY id ASC LIMIT 3")->fetchAll();
} catch (Exception $e) {
    // Graceful fallback
}
?>

<!-- =========================================================================
     1. PREMIUM HERO BANNER
     ========================================================================= -->
<section class="hero-wrapper position-relative">
  <img src="assets/images/hero-bg.jpg" alt="Zippy Enterprises Architecture" class="hero-background-img">
  <div class="hero-overlay-gradient"></div>
  <div class="container hero-content py-5">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <div class="badge-gold mb-3">
          <i class="fas fa-certificate text-warning me-1"></i> PREMIER CONSTRUCTION SOLUTIONS IN HYDERABAD
        </div>
        <h1 class="hero-title mb-4">
          Building Your Vision. <br>
          <span class="gold-text">Delivering Excellence.</span>
        </h1>
        <p class="hero-subtitle mb-4">
          From independent homes to commercial developments, Zippy Enterprises delivers professional construction solutions with a commitment to quality, transparency and excellence.
        </p>
        <div class="d-flex flex-wrap gap-3">
          <a href="quote.php" class="btn btn-gold btn-lg">
            <i class="fas fa-hard-hat me-2"></i> Start Your Construction Project
          </a>
          <a href="services.php" class="btn btn-outline-gold btn-lg">
            <i class="fas fa-th-large me-2"></i> Explore Our Services
          </a>
          <a href="cost-estimator.php" class="btn btn-navy btn-lg border border-secondary text-white">
            <i class="fas fa-calculator me-2 text-warning"></i> Cost Calculator
          </a>
        </div>
      </div>
      <div class="col-lg-4 d-none d-lg-block">
        <div class="card border-0 shadow-premium p-4" style="background: rgba(14, 36, 66, 0.9); backdrop-filter: blur(16px); border-radius: 16px; border: 1px solid var(--border-gold);">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <span class="badge bg-warning text-dark fw-bold px-3 py-1">BENCHMARK STANDARDS</span>
            <span class="text-white-50 small"><i class="fas fa-shield-alt text-success me-1"></i> IS 456 Compliant</span>
          </div>
          <div class="mb-3 pb-3 border-bottom border-secondary">
            <div class="text-white-50 small text-uppercase fw-bold">Built-up Footprint</div>
            <div class="h3 text-white fw-bold mb-0">2.5M+ <span class="text-warning small fs-6">Sq.Ft Delivered</span></div>
          </div>
          <div class="mb-3 pb-3 border-bottom border-secondary">
            <div class="text-white-50 small text-uppercase fw-bold">Primary Steel &amp; RMC</div>
            <div class="h3 text-white fw-bold mb-0">Fe 550D <span class="text-white-50 small fs-6">Tata / JSW</span></div>
          </div>
          <div>
            <div class="text-white-50 small text-uppercase fw-bold">Corporate Governance</div>
            <div class="h3 text-warning fw-bold mb-0">100% <span class="text-white-50 small fs-6">Vastu &amp; Municipal Vetted</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     2. ABOUT ZIPPY ENTERPRISES
     ========================================================================= -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row align-items-center g-5">
      <div class="col-lg-6">
        <span class="section-subtitle">About Zippy Enterprises</span>
        <h2 class="section-title">Built On Structural Integrity, Transparency &amp; Craftsmanship</h2>
        <p class="section-desc">
          Zippy Enterprises Private Limited is an established corporate construction and building development company based in Jubilee Hills, Hyderabad. We specialize in bringing professional engineering discipline, rigorous quality testing, and transparent financial governance to private residential and commercial developments.
        </p>
        <p class="text-muted">
          Our integrated approach unites licensed architects, chartered structural engineers (STAAD-Pro &amp; ETABS certified), seasoned on-ground civil contractors, and premium material suppliers. Whether you are building an independent family villa or developing a commercial tech hub, Zippy ensures your project is executed safely, on schedule, and to exact specifications.
        </p>

        <div class="row g-3 mt-2">
          <div class="col-sm-6">
            <div class="p-3 rounded border h-100" style="background:#F8FAFC;">
              <h6 class="fw-bold text-navy mb-1"><i class="fas fa-certificate text-warning me-2"></i> Quality First</h6>
              <p class="small text-muted mb-0">Certified laboratory compressive testing for all concrete pours and mill test certificates for steel.</p>
            </div>
          </div>
          <div class="col-sm-6">
            <div class="p-3 rounded border h-100" style="background:#F8FAFC;">
              <h6 class="fw-bold text-navy mb-1"><i class="fas fa-file-contract text-warning me-2"></i> Fixed Contracts</h6>
              <p class="small text-muted mb-0">Transparent Bill of Quantities (BOQ) with zero hidden escalation clauses.</p>
            </div>
          </div>
        </div>

        <div class="mt-4">
          <a href="about.php" class="btn btn-navy px-4 py-2 me-2">
            Read Corporate Profile <i class="fas fa-arrow-right ms-2"></i>
          </a>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="position-relative">
          <img src="assets/images/services/consultancy.jpg" alt="Engineering Team" class="img-fluid rounded-4 shadow-lg border" style="border: 1px solid var(--border-gold);">
          <div class="p-4 rounded-3 shadow-lg position-absolute bottom-0 end-0 m-4 d-none d-md-block" style="background: rgba(10,25,47,0.95); border: 1px solid var(--border-gold); max-width: 290px;">
            <div class="text-warning h3 fw-bold mb-1">ISO 9001:2015</div>
            <div class="text-white-50 small">Standardized Quality Management Systems for Civil Execution and Architectural Coordination.</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     3. OUR CONSTRUCTION SOLUTIONS (15 CORE SERVICES)
     ========================================================================= -->
<section class="py-5" style="background:#F8FAFC;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Our Specializations</span>
      <h2 class="section-title">Comprehensive Construction Solutions</h2>
      <p class="section-desc mx-auto">
        From concept planning and statutory municipal permissions to turnkey structural execution and luxury interior finishing.
      </p>
    </div>

    <div class="row g-4">
      <!-- 1. Residential -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/residential.jpg" alt="Residential Construction" class="card-service-img">
            <span class="card-service-badge">Residential</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Residential Building Construction</h3>
            <p class="card-service-text">Complete civil execution of bespoke private residences built to seismic safety and Vastu standards.</p>
            <div class="card-service-footer">
              <a href="service-residential.php" class="link-gold">Explore Solution <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- 2. Independent House -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/projects/project-3.jpg" alt="Independent House Construction" class="card-service-img">
            <span class="card-service-badge">Individual Plots</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Independent House Construction</h3>
            <p class="card-service-text">Individual plot construction tailored to your dimensions, parking needs, and future vertical floor extensions.</p>
            <div class="card-service-footer">
              <a href="service-independent-house.php" class="link-gold">Explore Solution <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- 3. Villa Construction -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/projects/project-1.jpg" alt="Luxury Villa Construction" class="card-service-img">
            <span class="card-service-badge">Luxury Estates</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Luxury Villa Construction</h3>
            <p class="card-service-text">Signature estates featuring double-height living rooms, Italian marble, home elevator shafts, and private pools.</p>
            <div class="card-service-footer">
              <a href="service-villa.php" class="link-gold">Explore Solution <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- 4. Commercial -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/commercial.jpg" alt="Commercial Building Construction" class="card-service-img">
            <span class="card-service-badge">Commercial</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Commercial Building Construction</h3>
            <p class="card-service-text">Grade-A corporate tech hubs, retail complexes, and business spaces engineered for high floor loadings.</p>
            <div class="card-service-footer">
              <a href="service-commercial.php" class="link-gold">Explore Solution <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- 5. Apartment Development -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/apartment.jpg" alt="Apartment Development" class="card-service-img">
            <span class="card-service-badge">Multi-Family</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Apartment Building Development</h3>
            <p class="card-service-text">Multi-floor residential developments and landowner Joint Venture (JV) collaborations with complete municipal clearance.</p>
            <div class="card-service-footer">
              <a href="service-apartment.php" class="link-gold">Explore Solution <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>

      <!-- 6. Turnkey EPC -->
      <div class="col-md-6 col-lg-4">
        <div class="card-service">
          <div class="card-service-img-wrapper">
            <img src="assets/images/services/turnkey.jpg" alt="Turnkey Construction" class="card-service-img">
            <span class="card-service-badge">Concept to Keys</span>
          </div>
          <div class="card-service-body">
            <h3 class="card-service-title">Turnkey Construction Projects</h3>
            <p class="card-service-text">Hassle-free, single-point accountability covering architectural drawings, municipal sanction, and turnkey delivery.</p>
            <div class="card-service-footer">
              <a href="service-turnkey.php" class="link-gold">Explore Solution <i class="fas fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="text-center mt-5">
      <a href="services.php" class="btn btn-navy px-4 py-2">
        <i class="fas fa-th-large text-warning me-2"></i> View All 15 Construction Solutions
      </a>
    </div>
  </div>
</section>

<!-- =========================================================================
     4. WHY CHOOSE US?
     ========================================================================= -->
<section class="py-5" style="background:#0A192F; color:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">The Zippy Advantage</span>
      <h2 class="section-title text-white">Why Discerning Clients Trust Zippy Enterprises</h2>
      <p class="text-white-50 mx-auto">We eliminate the stress and fragmentation of traditional construction with engineered corporate governance.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-file-invoice-dollar"></i></div>
          <h5 class="text-white fw-bold">Zero Hidden Cost Escalation</h5>
          <p class="text-white-50 small mb-0">Transparent, binding contracts backed by itemized Bill of Quantities (BOQ). The quoted price remains the delivered price.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-flask"></i></div>
          <h5 class="text-white fw-bold">Certified Lab Testing</h5>
          <p class="text-white-50 small mb-0">Every concrete batch undergoes slump cone and 7/14/28-day cube compressive strength verification by chartered engineers.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-user-shield"></i></div>
          <h5 class="text-white fw-bold">Single-Point Accountability</h5>
          <p class="text-white-50 small mb-0">No juggling multiple contractors, plumbers, or municipal agents. Zippy acts as your single accountable partner from start to handover.</p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3">
        <div class="p-4 rounded-3 h-100" style="background: rgba(255,255,255,0.04); border: 1px solid rgba(212,175,55,0.25);">
          <div class="brand-logo-icon mb-3"><i class="fas fa-calendar-check"></i></div>
          <h5 class="text-white fw-bold">Timely Project Handover</h5>
          <p class="text-white-50 small mb-0">Strict milestone schedules enforced with dedicated site supervisors and contractual handover commitments.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     5. FEATURED PROJECTS
     ========================================================================= -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-4">
      <div>
        <span class="section-subtitle">Realized Portfolio</span>
        <h2 class="section-title">Featured Landmark Developments</h2>
        <p class="section-desc">Explore luxury residential villas, independent houses, and commercial projects across Hyderabad.</p>
      </div>
      <a href="projects.php" class="btn btn-outline-gold mb-3 mb-md-0">View All Projects <i class="fas fa-arrow-right ms-2"></i></a>
    </div>

    <div class="row g-4">
      <?php if (!empty($featuredProjects)): ?>
        <?php foreach ($featuredProjects as $prj): ?>
          <div class="col-lg-4 col-md-6">
            <div class="card-project">
              <img src="<?= e($prj['featured_image']) ?>" alt="<?= e($prj['title']) ?>" class="card-project-img">
              <div class="card-project-overlay">
                <span class="card-project-category"><?= strtoupper(e($prj['category'])) ?> &bull; <?= e($prj['city']) ?></span>
                <h3 class="card-project-title"><?= e($prj['title']) ?></h3>
                <p class="text-white-50 small mb-2"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($prj['site_location']) ?></p>
                <div class="card-project-meta">
                  <span><i class="fas fa-ruler-combined text-warning me-1"></i> <?= number_format($prj['built_up_area_sqft']) ?> Sq.Ft</span>
                  <span><i class="fas fa-layer-group text-warning me-1"></i> <?= $prj['floors_count'] ?> Floors</span>
                </div>
                <p class="text-white-50 small mb-0" style="font-size:0.75rem;"><?= e($prj['short_description']) ?></p>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>
  </div>
</section>

<!-- =========================================================================
     6. OUR PROFESSIONAL NETWORK CALLOUT
     ========================================================================= -->
<section class="py-5" style="background: linear-gradient(135deg, #061121 0%, #0A192F 100%); color:#FFFFFF; border-top: 1px solid var(--border-gold); border-bottom: 1px solid var(--border-gold);">
  <div class="container py-4">
    <div class="row align-items-center g-4">
      <div class="col-lg-8">
        <div class="badge-gold mb-2">INDUSTRY COLLABORATION</div>
        <h2 class="text-white fw-bold mb-3">Our Verified Professional Network</h2>
        <p class="text-white-50 mb-0">
          We bring together certified civil contractors, chartered structural engineers, registered architects, and tier-1 material manufacturers to execute projects of any scale across Hyderabad.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end">
        <a href="network.php" class="btn btn-gold">
          <i class="fas fa-users me-2"></i> Explore Professional Network
        </a>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     7. OUR WORKING PROCESS (6 STEPS - Section 12)
     ========================================================================= -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Structured Execution</span>
      <h2 class="section-title">Our Six-Step Working Process</h2>
      <p class="section-desc mx-auto">A proven, transparent methodology ensuring your construction journey is seamless from concept to keys.</p>
    </div>

    <div class="row g-4">
      <!-- Step 1 -->
      <div class="col-md-6 col-lg-4">
        <div class="p-4 rounded-4 border h-100 position-relative shadow-sm" style="background:#F8FAFC;">
          <div class="brand-logo-icon mb-3" style="width:44px; height:44px; font-size:1.1rem;">1</div>
          <h5 class="fw-bold text-navy mb-2">Step 1: Customer Consultation</h5>
          <p class="small text-muted mb-0">Initial consultation at our Jubilee Hills office or via telephone to discuss your vision, space requirements, and budget expectations.</p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="col-md-6 col-lg-4">
        <div class="p-4 rounded-4 border h-100 position-relative shadow-sm" style="background:#F8FAFC;">
          <div class="brand-logo-icon mb-3" style="width:44px; height:44px; font-size:1.1rem;">2</div>
          <h5 class="fw-bold text-navy mb-2">Step 2: Project Requirements</h5>
          <p class="small text-muted mb-0">Detailing exact floor counts, Vastu specifications, room dimensions, ventilation, and interior finishing aspirations.</p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="col-md-6 col-lg-4">
        <div class="p-4 rounded-4 border h-100 position-relative shadow-sm" style="background:#F8FAFC;">
          <div class="brand-logo-icon mb-3" style="width:44px; height:44px; font-size:1.1rem;">3</div>
          <h5 class="fw-bold text-navy mb-2">Step 3: Site Visit &amp; Inspection</h5>
          <p class="small text-muted mb-0">On-site technical survey of your plot in Hyderabad: contour check, soil condition evaluation, road access, and boundary survey.</p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="col-md-6 col-lg-4">
        <div class="p-4 rounded-4 border h-100 position-relative shadow-sm" style="background:#F8FAFC;">
          <div class="brand-logo-icon mb-3" style="width:44px; height:44px; font-size:1.1rem;">4</div>
          <h5 class="fw-bold text-navy mb-2">Step 4: Cost Estimation &amp; Proposal</h5>
          <p class="small text-muted mb-0">Comprehensive engineering Bill of Quantities (BOQ) with transparent stage-wise milestones and package specifications.</p>
        </div>
      </div>

      <!-- Step 5 -->
      <div class="col-md-6 col-lg-4">
        <div class="p-4 rounded-4 border h-100 position-relative shadow-sm" style="background:#F8FAFC;">
          <div class="brand-logo-icon mb-3" style="width:44px; height:44px; font-size:1.1rem;">5</div>
          <h5 class="fw-bold text-navy mb-2">Step 5: Agreement &amp; Planning</h5>
          <p class="small text-muted mb-0">Formal agreement execution, municipal GHMC/HMDA sanction liaison, structural analysis, and procurement schedule finalization.</p>
        </div>
      </div>

      <!-- Step 6 -->
      <div class="col-md-6 col-lg-4">
        <div class="p-4 rounded-4 border h-100 position-relative shadow-sm" style="background:#F8FAFC;">
          <div class="brand-logo-icon mb-3" style="width:44px; height:44px; font-size:1.1rem;">6</div>
          <h5 class="fw-bold text-navy mb-2">Step 6: Construction Execution</h5>
          <p class="small text-muted mb-0">Strict on-ground civil execution under certified project management supervision, culminating in final snag audit and key handover.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     8. CONSTRUCTION QUALITY & STANDARDS
     ========================================================================= -->
<section class="py-5" style="background:#0A192F; color:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Uncompromising Benchmarks</span>
      <h2 class="section-title text-white">Construction Quality &amp; Engineering Standards</h2>
      <p class="text-white-50 mx-auto">Every structure we erect conforms rigorously to Bureau of Indian Standards (BIS) and National Building Codes (NBC).</p>
    </div>

    <div class="row g-4">
      <div class="col-md-3 text-center">
        <div class="p-4 rounded-3 h-100" style="background:rgba(255,255,255,0.03); border:1px solid rgba(212,175,55,0.2);">
          <div class="h3 text-warning fw-bold mb-2">IS 456:2000</div>
          <h6 class="text-white fw-bold mb-2">Plain &amp; Reinforced Concrete</h6>
          <p class="text-white-50 small mb-0">Strict mix design, slump control, and proper curing cycles observed on all slabs and structural footings.</p>
        </div>
      </div>

      <div class="col-md-3 text-center">
        <div class="p-4 rounded-3 h-100" style="background:rgba(255,255,255,0.03); border:1px solid rgba(212,175,55,0.2);">
          <div class="h3 text-warning fw-bold mb-2">IS 1786:2008</div>
          <h6 class="text-white fw-bold mb-2">Primary Steel Rebars</h6>
          <p class="text-white-50 small mb-0">Exclusive use of high-strength deformed Fe 550D primary steel bars (Tata Tiscon / JSW Steel).</p>
        </div>
      </div>

      <div class="col-md-3 text-center">
        <div class="p-4 rounded-3 h-100" style="background:rgba(255,255,255,0.03); border:1px solid rgba(212,175,55,0.2);">
          <div class="h3 text-warning fw-bold mb-2">IS 1893:2016</div>
          <h6 class="text-white fw-bold mb-2">Seismic Resistant Design</h6>
          <p class="text-white-50 small mb-0">Earthquake-resistant structural ductile detailing conforming to IS 13920 for maximum occupant safety.</p>
        </div>
      </div>

      <div class="col-md-3 text-center">
        <div class="p-4 rounded-3 h-100" style="background:rgba(255,255,255,0.03); border:1px solid rgba(212,175,55,0.2);">
          <div class="h3 text-warning fw-bold mb-2">5-Year Warranty</div>
          <h6 class="text-white fw-bold mb-2">Waterproofing Guarantee</h6>
          <p class="text-white-50 small mb-0">72-hour ponding tests and multi-layer elastomeric polymer coatings for leak-free living.</p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     9. CUSTOMER TESTIMONIALS
     ========================================================================= -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:720px;">
      <span class="section-subtitle">Client Experiences</span>
      <h2 class="section-title">What Our Project Owners Say</h2>
      <p class="section-desc mx-auto">Feedback from villa owners, independent home builders, and commercial developers.</p>
    </div>

    <div class="row g-4">
      <div class="col-md-4">
        <div class="p-4 rounded-4 h-100 border shadow-sm" style="background:#F8FAFC;">
          <div class="text-warning mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="text-muted small mb-3">
            "Constructing our 7,500 sq.ft villa in Jubilee Hills was completely smooth with Zippy Enterprises. Their adherence to concrete testing, structural vetting, and transparent milestone billings was textbook professional."
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
        <div class="p-4 rounded-4 h-100 border shadow-sm" style="background:#F8FAFC;">
          <div class="text-warning mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="text-muted small mb-3">
            "We partnered with Zippy Enterprises for our G+5 commercial IT development in the Financial District. Their structural engineering coordination and high-velocity execution saved us nearly 3 months on leasing readiness."
          </p>
          <div class="d-flex align-items-center">
            <div class="brand-logo-icon me-3" style="width:38px; height:38px; font-size:1rem;">PR</div>
            <div>
              <h6 class="mb-0 fw-bold text-navy">Dr. Priya Reddy</h6>
              <small class="text-muted">Director, Apex Health &amp; IT Hub</small>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="p-4 rounded-4 h-100 border shadow-sm" style="background:#F8FAFC;">
          <div class="text-warning mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
          </div>
          <p class="text-muted small mb-3">
            "Their self-construction loan assistance team prepared an immaculate chartered engineer estimate that matched SBI's format exactly. The loan sanction was processed smoothly with zero back-and-forth queries."
          </p>
          <div class="d-flex align-items-center">
            <div class="brand-logo-icon me-3" style="width:38px; height:38px; font-size:1rem;">VS</div>
            <div>
              <h6 class="mb-0 fw-bold text-navy">Venkat S. Ramanathan</h6>
              <small class="text-muted">Plot Owner, Kokapet</small>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     10. FREQUENTLY ASKED QUESTIONS (FAQ)
     ========================================================================= -->
<section class="py-5" style="background:#F8FAFC;">
  <div class="container py-4" style="max-width:900px;">
    <div class="section-header text-center mx-auto mb-4">
      <span class="section-subtitle">Clarifications</span>
      <h2 class="section-title">Frequently Asked Questions</h2>
      <p class="section-desc mx-auto">Common questions regarding our construction process, pricing, permits, and timelines.</p>
    </div>

    <div class="accordion shadow-sm" id="faqAccordion">
      <!-- FAQ 1 -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="faqH1">
          <button class="accordion-button fw-bold text-navy collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC1">
            What is included in Zippy Enterprises' Turnkey Construction packages?
          </button>
        </h2>
        <div id="faqC1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-secondary small">
            Our turnkey EPC packages cover complete architectural floor plans, 3D elevations, structural analysis, GHMC municipal building sanction coordination, soil bearing testing, excavation, raft foundation, RCC framing, AAC/red clay masonry, concealed electrical and plumbing lines, internal/external plastering, waterproofing, premium vitrified or Italian marble flooring, and fine joinery.
          </div>
        </div>
      </div>

      <!-- FAQ 2 -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="faqH2">
          <button class="accordion-button fw-bold text-navy collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC2">
            How are construction costs calculated and are there escalation risks?
          </button>
        </h2>
        <div id="faqC2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-secondary small">
            Costs are calculated based on your exact built-up area and chosen specification package (Classic, Premium, Luxury, or Ultra-Luxury). Our agreements are fixed-price contracts based on a mutually approved Bill of Quantities (BOQ), protecting you from surprise market price spikes during execution.
          </div>
        </div>
      </div>

      <!-- FAQ 3 -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="faqH3">
          <button class="accordion-button fw-bold text-navy collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC3">
            Do you handle GHMC / HMDA municipal building permissions?
          </button>
        </h2>
        <div id="faqC3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-secondary small">
            Yes. Our architectural coordination team prepares all statutory drawings conforming to TS-bPASS, GHMC, and HMDA master plan building bylaws, coordinating directly with registered architects to obtain your construction approval.
          </div>
        </div>
      </div>

      <!-- FAQ 4 -->
      <div class="accordion-item border-0 mb-3 rounded-3 overflow-hidden shadow-sm">
        <h2 class="accordion-header" id="faqH4">
          <button class="accordion-button fw-bold text-navy collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqC4">
            How does your Self-Construction Loan Assistance work?
          </button>
        </h2>
        <div id="faqC4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
          <div class="accordion-body text-secondary small">
            We prepare the certified Chartered Engineer construction estimate and stage-wise Bill of Quantities required by leading banks (SBI, HDFC, ICICI, Axis). We also coordinate during bank panel inspections to provide stage disbursement certificates without delay.
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     11. CONTACT & PROJECT ENQUIRY (FULL 10 FIELDS - Section 13)
     ========================================================================= -->
<section class="py-5" style="background:#FFFFFF;" id="project-enquiry">
  <div class="container py-4">
    <div class="row g-5 align-items-center">
      <div class="col-lg-5">
        <span class="section-subtitle">Start Your Project</span>
        <h2 class="section-title">Schedule a Technical Consultation</h2>
        <p class="section-desc">
          Meet with our Senior Project Consultant at our Jubilee Hills corporate office or request a complimentary on-site plot inspection anywhere across Hyderabad.
        </p>

        <div class="mt-4">
          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:42px; height:42px; font-size:1.1rem;"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">Corporate Headquarters</h6>
              <p class="text-muted small mb-0"><?= COMPANY_ADDRESS ?></p>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:42px; height:42px; font-size:1.1rem;"><i class="fas fa-phone-alt"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">Direct Phone Lines</h6>
              <p class="text-muted small mb-0">
                <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE) ?>" class="text-navy fw-bold"><?= COMPANY_PHONE ?></a>
              </p>
            </div>
          </div>

          <div class="d-flex mb-3">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:42px; height:42px; font-size:1.1rem;"><i class="fab fa-whatsapp"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">WhatsApp Advisory</h6>
              <p class="text-muted small mb-0">
                <a href="https://wa.me/<?= COMPANY_WHATSAPP ?>" target="_blank" class="text-success fw-bold">Chat with Project Consultant (+91 <?= COMPANY_WHATSAPP ?>)</a>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- 10-FIELD PROJECT ENQUIRY FORM -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-lg p-4 p-md-5" style="background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">PROJECT ENQUIRY</div>
          <h3 class="text-white fw-bold mb-2">Request Project Estimate</h3>
          <p class="text-white-50 small mb-4">Complete this form and an automatic reference number will be generated for your inquiry.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="source" value="homepage_enquiry">

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Customer Full Name *</label>
                <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Your full name">
              </div>
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Mobile Phone Number *</label>
                <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Email Address *</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="name@domain.com">
              </div>
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Project Location in Hyderabad *</label>
                <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Kokapet, Kompally">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Construction Type *</label>
                <select name="construction_type" class="form-select bg-dark text-white border-secondary" required>
                  <option value="Residential Building Construction">Residential Building Construction</option>
                  <option value="Independent House Construction">Independent House Construction</option>
                  <option value="Luxury Villa Construction">Luxury Villa Construction</option>
                  <option value="Commercial Building Construction">Commercial Building Construction</option>
                  <option value="Apartment Development">Apartment Development</option>
                  <option value="Turnkey Construction Projects">Turnkey Construction Projects</option>
                  <option value="Architectural & Structural Coordination">Architectural &amp; Structural Coordination</option>
                  <option value="Self-Construction Loan Assistance">Self-Construction Loan Assistance</option>
                </select>
              </div>
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Plot Size (Sq.Yds / Sq.Ft)</label>
                <input type="text" name="plot_size" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 300 Sq.Yards">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-4">
                <label class="form-label text-warning small fw-bold">Built-Up Area (Sq.Ft)</label>
                <input type="text" name="built_up_area" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 3,500 Sq.Ft">
              </div>
              <div class="col-md-4">
                <label class="form-label text-warning small fw-bold">Number of Floors</label>
                <select name="number_of_floors" class="form-select bg-dark text-white border-secondary">
                  <option value="Ground Only (G)">Ground Only (G)</option>
                  <option value="Ground + 1 Floor (G+1)" selected>Ground + 1 Floor (G+1)</option>
                  <option value="Ground + 2 Floors (G+2)">Ground + 2 Floors (G+2)</option>
                  <option value="Ground + 3 Floors (G+3)">Ground + 3 Floors (G+3)</option>
                  <option value="G+4 / Multi-Storey">G+4 / Multi-Storey</option>
                </select>
              </div>
              <div class="col-md-4">
                <label class="form-label text-warning small fw-bold">Approximate Budget</label>
                <select name="approx_budget" class="form-select bg-dark text-white border-secondary">
                  <option value="₹75 Lakhs - ₹1.5 Crores">₹75 Lakhs - ₹1.5 Crores</option>
                  <option value="₹1.5 Crores - ₹3.0 Crores" selected>₹1.5 Crores - ₹3.0 Crores</option>
                  <option value="₹3.0 Crores - ₹7.0 Crores">₹3.0 Crores - ₹7.0 Crores</option>
                  <option value="₹7.0 Crores+">₹7.0 Crores+ (Commercial / Luxury)</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label text-warning small fw-bold">Project Requirements &amp; Notes</label>
              <textarea name="project_requirements" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Tell us about plot orientation, Vastu preferences, timeline, or material requests..."></textarea>
            </div>

            <button type="submit" class="btn btn-gold btn-lg w-100 fw-bold">
              <i class="fas fa-paper-plane me-2"></i> Submit Construction Enquiry
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- =========================================================================
     12. PREMIUM CORPORATE FOOTER (included automatically)
     ========================================================================= -->
<?php require_once __DIR__ . '/includes/footer.php'; ?>
