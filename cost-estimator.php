<?php
/**
 * Interactive Construction Cost Estimator & Live PDF Generator
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Interactive Construction Cost Estimator & Instant Quotation";
$pageDescription = "Calculate your exact construction costs in Hyderabad. Real-time cost estimates for residential villas, apartments, and commercial buildings with floor-wise breakdown and downloadable PDF quotation.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Cost Estimator" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">PROPRIETARY CALCULATION ENGINE</div>
    <h1 class="page-banner-title">Interactive Construction Cost Estimator</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Cost Estimator</span>
    </div>
  </div>
</section>

<!-- CALCULATOR SECTION -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="section-header text-center mx-auto" style="max-width:760px;">
      <span class="section-subtitle">Real-Time Quantity Estimation</span>
      <h2 class="section-title">Transparent Pricing Tailored To Your Plot</h2>
      <p class="section-desc mx-auto">
        Select your project parameters below to compute an itemized engineering estimate. All pricing reflects Q4 2026 Hyderabad primary steel and cement market indices.
      </p>
    </div>

    <div class="row g-5">
      <!-- INPUT CONTROLS -->
      <div class="col-lg-7">
        <div class="card border p-4 shadow-sm rounded-4" style="background:#F8FAFC;">
          <!-- STEP 1: DIMENSIONS -->
          <h5 class="fw-bold text-navy mb-3"><i class="fas fa-ruler-combined text-warning me-2"></i> 1. Dimensions &amp; Building Scope</h5>
          
          <div class="row g-3 mb-4">
            <div class="col-md-6">
              <label class="form-label small fw-bold text-navy">Built-Up Area (Sq.Ft) *</label>
              <input type="number" id="calc-builtup-area" class="form-control form-control-lg bg-white" value="3000" min="500" max="50000" step="50">
              <small class="text-muted">Avg. 300 sq.yd plot with G+2 = ~3,600 sq.ft</small>
            </div>
            <div class="col-md-6">
              <label class="form-label small fw-bold text-navy">Number of Floors *</label>
              <select id="calc-floors" class="form-select form-select-lg bg-white">
                <option value="1">Ground Floor Only (G)</option>
                <option value="2" selected>Ground + 1 Floor (G+1 Duplex)</option>
                <option value="3">Ground + 2 Floors (G+2 Triplex)</option>
                <option value="4">Ground + 3 Floors (G+3)</option>
                <option value="5">Ground + 4 Floors (G+4)</option>
              </select>
            </div>
          </div>

          <div class="mb-4">
            <label class="form-label small fw-bold text-navy">Building Category *</label>
            <select id="calc-category" class="form-select form-select-lg bg-white">
              <option value="residential" data-multiplier="1.0" selected>Residential Independent Villa / Duplex</option>
              <option value="commercial" data-multiplier="1.15">Commercial Tech Hub / Retail Complex (+15% Load specs)</option>
              <option value="apartment" data-multiplier="0.95">Multi-Storey Apartment Complex (-5% Scale economy)</option>
            </select>
          </div>

          <!-- STEP 2: QUALITY SPECIFICATION PACKAGES -->
          <h5 class="fw-bold text-navy mb-3 mt-4"><i class="fas fa-gem text-warning me-2"></i> 2. Select Construction Quality Tier</h5>
          
          <div class="row g-3 mb-4">
            <div class="col-sm-6">
              <div class="calc-package-card" data-rate="1750" data-name="Classic Package">
                <span class="badge bg-secondary mb-1">CLASSIC</span>
                <div class="h5 fw-bold text-navy mb-0">₹1,750 <small class="fs-6 text-muted">/sqft</small></div>
                <small class="text-muted d-block mt-1">Fe500 Steel, M20 Concrete, Clay Bricks, Standard Vitrified Tiles</small>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="calc-package-card selected" data-rate="2150" data-name="Premium Package">
                <span class="badge bg-warning text-dark fw-bold mb-1">PREMIUM (RECOMMENDED)</span>
                <div class="h5 fw-bold text-navy mb-0">₹2,150 <small class="fs-6 text-muted">/sqft</small></div>
                <small class="text-muted d-block mt-1">Tata Fe550D, M25 RMC, 4x2 GVT Tiles, Teakwood Doors, Kohler/Jaquar</small>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="calc-package-card" data-rate="2850" data-name="Luxury Package">
                <span class="badge bg-dark text-warning border border-warning mb-1">LUXURY</span>
                <div class="h5 fw-bold text-navy mb-0">₹2,850 <small class="fs-6 text-muted">/sqft</small></div>
                <small class="text-muted d-block mt-1">Italian Marble living area, M30 concrete, Full Teakwood, Grohe/Toto</small>
              </div>
            </div>

            <div class="col-sm-6">
              <div class="calc-package-card" data-rate="3650" data-name="Ultra Luxury Package">
                <span class="badge-gold mb-1">ULTRA LUXURY</span>
                <div class="h5 fw-bold text-navy mb-0">₹3,650 <small class="fs-6 text-muted">/sqft</small></div>
                <small class="text-muted d-block mt-1">Imported Statuario marble, Automation, Double glazing, Designer ceiling</small>
              </div>
            </div>
          </div>

          <!-- STEP 3: OPTIONAL UPGRADES & ADD-ONS -->
          <h5 class="fw-bold text-navy mb-3 mt-4"><i class="fas fa-plus-circle text-warning me-2"></i> 3. Optional High-End Upgrades</h5>
          <div class="row g-2">
            <div class="col-md-6">
              <div class="form-check p-3 rounded bg-white border">
                <input class="form-check-input calc-addon-check" type="checkbox" id="addon-marble" data-type="sqft" data-val="250">
                <label class="form-check-label small fw-bold text-navy" for="addon-marble">
                  Italian Marble Flooring <span class="text-warning d-block small">+₹250/sq.ft</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check p-3 rounded bg-white border">
                <input class="form-check-input calc-addon-check" type="checkbox" id="addon-automation" data-type="sqft" data-val="150">
                <label class="form-check-label small fw-bold text-navy" for="addon-automation">
                  Home Automation &amp; Smart Security <span class="text-warning d-block small">+₹150/sq.ft</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check p-3 rounded bg-white border">
                <input class="form-check-input calc-addon-check" type="checkbox" id="addon-solar" data-type="flat" data-val="350000">
                <label class="form-check-label small fw-bold text-navy" for="addon-solar">
                  5kW On-Grid Rooftop Solar Plant <span class="text-warning d-block small">+₹3.50 Lakhs Flat</span>
                </label>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-check p-3 rounded bg-white border">
                <input class="form-check-input calc-addon-check" type="checkbox" id="addon-elevator" data-type="flat" data-val="650000">
                <label class="form-check-label small fw-bold text-navy" for="addon-elevator">
                  Hydraulic Home Passenger Elevator <span class="text-warning d-block small">+₹6.50 Lakhs Flat</span>
                </label>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- RESULTS & QUOTATION CARD -->
      <div class="col-lg-5">
        <div class="calc-result-box sticky-top" style="top: 100px;">
          <div class="d-flex justify-content-between align-items-center mb-2">
            <span class="badge-gold">ESTIMATE PROPOSAL</span>
            <small class="text-white-50"><i class="fas fa-shield-alt text-warning me-1"></i> Indicative BOQ</small>
          </div>
          <div class="small text-white-50 text-uppercase fw-bold">Total Estimated Construction Cost</div>
          <div class="calc-total-number" id="calc-total-cost">₹64.50 Lakhs</div>
          <div class="text-warning small mb-4" id="calc-effective-rate">₹2,150 / sq.ft effective rate</div>

          <!-- Component Cost Breakdown -->
          <h6 class="text-white fw-bold mb-3 border-bottom border-secondary pb-2">Component-Wise Cost Distribution</h6>
          <div class="mb-2 d-flex justify-content-between small">
            <span class="text-white-50"><i class="fas fa-cube text-warning me-2"></i> Civil &amp; Structural Framework (46%):</span>
            <span class="text-white fw-bold" id="calc-structure-cost">₹29.67 Lakhs</span>
          </div>
          <div class="mb-2 d-flex justify-content-between small">
            <span class="text-white-50"><i class="fas fa-brush text-warning me-2"></i> Flooring, Joinery &amp; Finishing (24%):</span>
            <span class="text-white fw-bold" id="calc-finishing-cost">₹15.48 Lakhs</span>
          </div>
          <div class="mb-2 d-flex justify-content-between small">
            <span class="text-white-50"><i class="fas fa-bolt text-warning me-2"></i> MEP (Plumbing, Electrical, HVAC) (15%):</span>
            <span class="text-white fw-bold" id="calc-mep-cost">₹9.68 Lakhs</span>
          </div>
          <div class="mb-3 d-flex justify-content-between small">
            <span class="text-white-50"><i class="fas fa-hard-hat text-warning me-2"></i> Labour &amp; Engineering PMC (15%):</span>
            <span class="text-white fw-bold" id="calc-labour-cost">₹9.68 Lakhs</span>
          </div>

          <!-- Floor-Wise Table -->
          <h6 class="text-white fw-bold mb-2 mt-4 border-bottom border-secondary pb-2">Floor-Wise Estimated Allocation</h6>
          <table class="table table-sm table-dark table-borderless small mb-4">
            <thead>
              <tr class="text-white-50 border-bottom border-secondary">
                <th>Level</th>
                <th>Area</th>
                <th>Rate</th>
                <th class="text-end">Subtotal</th>
              </tr>
            </thead>
            <tbody id="calc-floor-breakdown-body">
              <!-- Dynamically Populated by estimator.js -->
            </tbody>
          </table>

          <div class="d-grid gap-2">
            <button type="button" class="btn btn-gold py-2" id="btn-download-estimate-pdf">
              <i class="fas fa-file-pdf me-2"></i> Print / Download Proposal PDF
            </button>
            <button type="button" class="btn btn-outline-warning text-white border-warning py-2" data-bs-toggle="modal" data-bs-target="#quickEnquiryModal">
              <i class="fas fa-user-check me-2"></i> Lock-In This Quotation With Engineer
            </button>
          </div>

          <p class="small text-white-50 text-center mt-3 mb-0" style="font-size:0.75rem;">
            *All estimates are indicative based on standard soil bearing capacity (200 kN/m2) and subject to final site contour survey and soil laboratory test verification.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Include Estimator Engine JS -->
<?php 
$extraScripts = '<script src="assets/js/estimator.js"></script>';
require_once __DIR__ . '/includes/footer.php'; 
?>
