<?php
/**
 * Master Services Page (All 15 Construction Services + Loan Assistance)
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Construction Services | 15 Specialized Solutions";
$pageDescription = "Explore all 15 comprehensive construction and building development services offered by Zippy Enterprises in Hyderabad: residential, commercial, turnkey EPC, and PMC.";
require_once __DIR__ . '/includes/header.php';

$allServices = [
    [
        'id' => 'residential',
        'title' => 'Residential Building Construction',
        'badge' => 'Luxury Living',
        'desc' => 'End-to-end civil execution for custom private residences, luxury duplexes, and multi-family homes built with Grade-A structural materials.',
        'features' => ['Vastu-compliant layouts', 'M25/M30 concrete with cube testing', '10-year structural stability guarantee'],
        'link' => 'service-residential.php',
        'img' => 'assets/images/services/residential.jpg'
    ],
    [
        'id' => 'independent-house',
        'title' => 'Independent House Construction',
        'badge' => 'Private Homes',
        'desc' => 'Specialized construction on private plots and layouts, delivering customized elevation designs, dedicated parking basements, and terrace gardens.',
        'features' => ['Customized room dimensions', 'Engineered raft foundations', 'Rainwater harvesting pit included'],
        'link' => 'service-independent-house.php',
        'img' => 'assets/images/services/residential.jpg'
    ],
    [
        'id' => 'villa',
        'title' => 'Villa Construction',
        'badge' => 'Ultra Luxury',
        'desc' => 'Sprawling private villas and architectural estates in Jubilee Hills, Banjara Hills, and Kokapet with double-height atriums and infinity pools.',
        'features' => ['Imported Statuario marble flooring', 'Schüco acoustic glass fenestration', 'Private hydraulic elevator shafts'],
        'link' => 'service-villa.php',
        'img' => 'assets/images/projects/project-1.jpg'
    ],
    [
        'id' => 'apartment',
        'title' => 'Apartment Construction',
        'badge' => 'Multi-Unit Housing',
        'desc' => 'Turnkey execution of multi-storey residential complexes, G+5 standalone apartment schemes, and gated communities with modern amenities.',
        'features' => ['Basement car parking engineering', 'Automatic high-speed elevator shafts', 'Fire-safety compliance (NOC ready)'],
        'link' => 'service-apartment.php',
        'img' => 'assets/images/services/apartment.jpg'
    ],
    [
        'id' => 'commercial',
        'title' => 'Commercial Building Construction',
        'badge' => 'Corporate & Retail',
        'desc' => 'Grade-A corporate IT offices, retail strip malls, medical clinics, and warehousing spaces designed for high floor load capacity and energy efficiency.',
        'features' => ['Structural glass curtain wall facades', 'High floor-to-ceiling heights (12ft+)', 'Heavy MEP and HVAC ducting integration'],
        'link' => 'service-commercial.php',
        'img' => 'assets/images/services/commercial.jpg'
    ],
    [
        'id' => 'turnkey',
        'title' => 'Turnkey Construction Projects',
        'badge' => 'Concept to Keys',
        'desc' => 'Complete stress-free execution where Zippy manages architectural drawings, GHMC permits, material procurement, civil labor, and interior finishing.',
        'features' => ['Single-point contract accountability', 'Fixed price & milestone schedule', 'Transparent stage-wise inspection sign-offs'],
        'link' => 'service-turnkey.php',
        'img' => 'assets/images/services/turnkey.jpg'
    ],
    [
        'id' => 'development',
        'title' => 'Building Development',
        'badge' => 'Joint Ventures',
        'desc' => 'Strategic property development collaborations, land-owner joint venture (JV) agreements, and mixed-use commercial-residential complexes.',
        'features' => ['Fair & transparent ratio sharing', 'Full statutory clearance handling', 'High-velocity project execution'],
        'link' => 'service-apartment.php',
        'img' => 'assets/images/services/apartment.jpg'
    ],
    [
        'id' => 'consultancy',
        'title' => 'Construction Consultancy',
        'badge' => 'Technical Advisory',
        'desc' => 'Comprehensive technical consultancy covering feasibility studies, cost engineering, contractor vetting, and construction safety compliance.',
        'features' => ['Chartered Engineer technical audits', 'Detailed Bill of Quantities (BOQ)', 'Risk assessment & mitigation planning'],
        'link' => 'service-consultancy.php',
        'img' => 'assets/images/services/consultancy.jpg'
    ],
    [
        'id' => 'pmc',
        'title' => 'Construction Project Coordination',
        'badge' => 'Quality & Auditing',
        'desc' => 'Independent technical supervision, material testing, contractor vetting, site safety enforcement, and budget variance monitoring for client peace of mind.',
        'features' => ['Daily digital site inspection logs', 'Bill checking & BOQ verification', 'Snag list preparation & resolution'],
        'link' => 'service-consultancy.php',
        'img' => 'assets/images/services/consultancy.jpg'
    ],
    [
        'id' => 'architectural',
        'title' => 'Architectural Design Coordination',
        'badge' => 'Aesthetic Design',
        'desc' => 'Bespoke contemporary, minimalist, and classical architectural concepts created in 3D BIM, walkthrough simulations, and municipal sanction drawings.',
        'features' => ['Photorealistic 3D external elevations', 'Daylight & ventilation analysis', 'Complete construction working drawings'],
        'link' => 'service-consultancy.php',
        'img' => 'assets/images/services/consultancy.jpg'
    ],
    [
        'id' => 'structural',
        'title' => 'Structural Engineering Coordination',
        'badge' => 'Safety & Strength',
        'desc' => 'Rigorous structural analysis using STAAD-Pro and ETABS, optimizing steel tonnage and concrete mix designs while exceeding seismic and wind load safety codes.',
        'features' => ['Soil test interpretation & raft design', 'Ductile detailing as per IS 13920', 'Structural stability certificate'],
        'link' => 'service-consultancy.php',
        'img' => 'assets/images/services/consultancy.jpg'
    ],
    [
        'id' => 'interiors',
        'title' => 'Interior Design & Execution',
        'badge' => 'Refined Aesthetics',
        'desc' => 'Turnkey interior design services for luxury living rooms, modular kitchens, custom wardrobes, false ceilings, and ambient smart lighting.',
        'features' => ['Factory-finish modular cabinetry', 'False ceilings with cove LED lighting', 'Premium Italian marble & wood flooring'],
        'link' => 'service-residential.php',
        'img' => 'assets/images/services/residential.jpg'
    ],
    [
        'id' => 'renovation',
        'title' => 'Renovation & Remodeling',
        'badge' => 'Space Modernization',
        'desc' => 'Structural retrofitting, vertical floor additions, facade overhauls, and complete spatial redesign for aging buildings across Hyderabad.',
        'features' => ['Structural load-bearing assessment', 'Plumbing & electrical rewiring', 'Modern architectural modernization'],
        'link' => 'service-residential.php',
        'img' => 'assets/images/services/residential.jpg'
    ],
    [
        'id' => 'material-coord',
        'title' => 'Construction Material Coordination',
        'badge' => 'Direct Procurement',
        'desc' => 'Direct factory procurement of primary steel (Tata/JSW), cement (UltraTech/Bharathi), high-grade sand, red clay bricks, and AAC blocks at wholesale rates.',
        'features' => ['Direct mill test certificates', 'Zero sub-standard supplier risk', 'Just-in-time site delivery management'],
        'link' => 'service-turnkey.php',
        'img' => 'assets/images/services/turnkey.jpg'
    ],
    [
        'id' => 'property-consultancy',
        'title' => 'Property Development Consultancy',
        'badge' => 'Feasibility & ROI',
        'desc' => 'Master planning, land feasibility studies, FSI / FAR calculations under HMDA/GHMC master plans, and financial cashflow modeling for developers.',
        'features' => ['FSI/FAR optimization analysis', 'RERA registration coordination', 'Market absorption rate advisory'],
        'link' => 'service-consultancy.php',
        'img' => 'assets/images/services/consultancy.jpg'
    ],
    [
        'id' => 'loan-assistance',
        'title' => 'Self-Construction Loan Assistance',
        'badge' => 'Bank Sanction Ready',
        'desc' => 'Facilitating construction home loans from SBI, HDFC, ICICI, and Axis Bank with certified architectural estimates, valuation, and milestone disbursement support.',
        'features' => ['Certified Chartered Engineer BOQ', '100% bank format compliance', 'Stage-wise disbursement inspections'],
        'link' => 'loan-assistance.php',
        'img' => 'assets/images/services/loan.jpg'
    ]
];
?>

<!-- PAGE BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Construction Services" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">SERVICE DIRECTORY</div>
    <h1 class="page-banner-title">Our 15 Construction &amp; Development Solutions</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Services</span>
    </div>
  </div>
</section>

<!-- SERVICES GRID -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Complete Construction Ecosystem</span>
      <h2 class="section-title">Engineered For Longevity &amp; Precision</h2>
      <p class="section-desc mx-auto">
        Every service is backed by strict Indian Standard (IS) compliance, seasoned site engineers, and continuous digital milestone governance.
      </p>
    </div>

    <div class="row g-4">
      <?php foreach ($allServices as $idx => $s): ?>
        <div class="col-md-6 col-lg-4">
          <div class="card-service">
            <div class="card-service-img-wrapper">
              <img src="<?= $s['img'] ?>" alt="<?= e($s['title']) ?>" class="card-service-img">
              <span class="card-service-badge"><?= e($s['badge']) ?></span>
            </div>
            <div class="card-service-body">
              <div class="text-warning small fw-bold mb-1">Service #<?= str_pad($idx + 1, 2, '0', STR_PAD_LEFT) ?></div>
              <h3 class="card-service-title"><?= e($s['title']) ?></h3>
              <p class="card-service-text"><?= e($s['desc']) ?></p>
              
              <ul class="list-unstyled small text-muted mb-3">
                <?php foreach ($s['features'] as $feat): ?>
                  <li class="mb-1"><i class="fas fa-check text-warning me-2"></i><?= e($feat) ?></li>
                <?php endforeach; ?>
              </ul>

              <div class="card-service-footer">
                <a href="<?= $s['link'] ?>" class="link-gold">View Full Details <i class="fas fa-arrow-right"></i></a>
                <button type="button" class="btn btn-sm btn-outline-warning text-dark border-warning" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal" onclick="document.querySelector('[name=service_requested]').value='<?= e($s['title']) ?>'">
                  Enquire Now
                </button>
              </div>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- CONTACT CTA -->
<section class="py-5 text-center" style="background:var(--navy-primary); color:#FFFFFF; border-top:1px solid var(--border-gold);">
  <div class="container py-4">
    <h2 class="text-white fw-bold mb-3">Require a Custom Construction Package or Joint Venture?</h2>
    <p class="text-white-50 mx-auto mb-4" style="max-width:620px;">
      Our Senior Engineering Consultants are available for on-site plot inspections anywhere across Hyderabad and surrounding regions.
    </p>
    <div class="d-flex justify-content-center gap-3">
      <button type="button" class="btn btn-gold btn-lg" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal">
        <i class="fas fa-calendar-check me-2"></i> Book Technical Consultation
      </button>
      <a href="quote.php" class="btn btn-outline-light btn-lg">
        <i class="fas fa-file-invoice me-2"></i> Request a Quote
      </a>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
