<?php
/**
 * Self-Construction Loan Assistance Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Self-Construction Loan Assistance & Bank Estimation Coordination";
$pageDescription = "Expert self-construction loan assistance in Hyderabad. Chartered engineer detailed estimates, valuation certificates, and bank application guidance for SBI, HDFC, ICICI & Axis Bank.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/services/loan.jpg" alt="Self-Construction Loan Assistance" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">FINANCIAL FACILITATION</div>
    <h1 class="page-banner-title">Self-Construction Loan Assistance</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <a href="services.php">Services</a>
      <span>/</span>
      <span>Loan Assistance</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <!-- Notice Disclaimer Alert -->
    <div class="alert alert-secondary border-0 mb-5 d-flex align-items-center p-3 rounded-3" style="background: rgba(10,25,47,0.06);">
      <i class="fas fa-info-circle text-warning fa-lg me-3"></i>
      <div class="small text-muted">
        <strong>Important Regulatory Notice:</strong> Zippy Enterprises Private Limited acts as a technical construction estimation, architectural documentation, and engineering liaison facilitator. Final loan sanctions, interest rates, and loan-to-cost (LTC) ratios are determined solely by lending banks and financial institutions subject to their independent credit underwriting norms.
      </div>
    </div>

    <div class="row g-5">
      <div class="col-lg-7">
        <h2 class="fw-bold text-navy mb-3">Navigate Construction Home Loans with Confidence</h2>
        <p class="lead text-muted">
          Unlike standard ready-to-move apartment home loans where builder approvals are pre-cleared, a <strong>Self-Construction Home Loan</strong> requires stringent technical verification by bank chartered engineers.
        </p>
        <p class="text-secondary">
          Banks require detailed, stage-wise architectural estimates, municipal sanction drawings, title search deeds, and chartered engineer valuation certificates before disbursing construction funds in tranches. Zippy Enterprises bridges this exact gap for plot owners.
        </p>

        <!-- 4-STEP FACILITATION PROCESS -->
        <h4 class="fw-bold text-navy mt-5 mb-3">How We Coordinate Your Construction Loan</h4>
        
        <div class="d-flex mb-3">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:40px; height:40px; font-size:1rem;">1</div>
          <div>
            <h6 class="fw-bold text-navy mb-1">Bank-Compliant Detailed Estimate (BOQ)</h6>
            <p class="small text-muted mb-0">We generate an itemized Bill of Quantities certified by a Registered Chartered Engineer, structured specifically to match the format requirements of your preferred lending institution.</p>
          </div>
        </div>

        <div class="d-flex mb-3">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:40px; height:40px; font-size:1rem;">2</div>
          <div>
            <h6 class="fw-bold text-navy mb-1">Municipal Sanction Permit &amp; Floor Plans</h6>
            <p class="small text-muted mb-0">We ensure that your GHMC / HMDA approved architectural blueprint corresponds 1:1 with the construction cost estimate, eliminating technical rejection queries from bank panels.</p>
          </div>
        </div>

        <div class="d-flex mb-3">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:40px; height:40px; font-size:1rem;">3</div>
          <div>
            <h6 class="fw-bold text-navy mb-1">Bank Valuation Panel Coordination</h6>
            <p class="small text-muted mb-0">When the bank's empaneled valuer visits your plot, our site engineers assist with boundary demarcation, soil report presentation, and structural explanations.</p>
          </div>
        </div>

        <div class="d-flex mb-3">
          <div class="brand-logo-icon me-3 flex-shrink-0" style="width:40px; height:40px; font-size:1rem;">4</div>
          <div>
            <h6 class="fw-bold text-navy mb-1">Stage-Wise Disbursement Certificates</h6>
            <p class="small text-muted mb-0">As construction reaches plinth, first slab, brickwork, and plastering, we issue formal stage-completion certificates so the bank releases subsequent loan tranches smoothly.</p>
          </div>
        </div>

        <!-- DOCUMENT CHECKLIST -->
        <div class="p-4 rounded-3 border mt-4" style="background:#F8FAFC;">
          <h5 class="fw-bold text-navy mb-3"><i class="fas fa-file-alt text-warning me-2"></i> Self-Construction Loan Document Checklist</h5>
          <div class="row g-2 small text-muted">
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Registered Sale Deed of the Plot</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Latest Encumbrance Certificate (EC - 30 Yrs)</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> GHMC / HMDA Sanction Permit &amp; Drawing</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Certified Construction Estimate by Chartered Eng.</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Soil Test Report &amp; Structural Plan</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Tri-Party Construction Agreement (Zippy)</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Property Tax Receipts &amp; Land Mutation</div>
            <div class="col-sm-6"><i class="fas fa-check text-success me-2"></i> Applicant KYC &amp; Income Verification</div>
          </div>
        </div>
      </div>

      <!-- LOAN APPLICATION FORM -->
      <div class="col-lg-5">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">LOAN ASSISTANCE FILE</div>
          <h4 class="text-white fw-bold mb-2">Apply For Loan Coordination</h4>
          <p class="text-white-50 small mb-3">Submit your construction requirements for technical estimate preparation.</p>

          <form id="loanAppForm" action="api/loan-application.php" method="POST">
            <?= Security::csrfField() ?>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Applicant Full Name *</label>
              <input type="text" name="applicant_name" class="form-control bg-dark text-white border-secondary" required placeholder="As per PAN / Aadhaar">
            </div>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Phone Number *</label>
                <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
              </div>
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Email Address *</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="name@domain.com">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Plot Ownership Status *</label>
              <select name="plot_ownership" class="form-select bg-dark text-white border-secondary" required>
                <option value="self_owned">Registered in my name (Self-owned)</option>
                <option value="joint">Joint family / Co-owned plot</option>
                <option value="in_process_of_purchase">In process of plot purchase</option>
              </select>
            </div>

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Plot Location *</label>
              <input type="text" name="plot_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Kokapet, Tellapur, Kompally">
            </div>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Est. Construction Budget (₹)</label>
                <input type="number" name="estimated_construction_budget" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 5000000">
              </div>
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Desired Loan (₹)</label>
                <input type="number" name="desired_loan_amount" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 3500000">
              </div>
            </div>

            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Employment Type</label>
                <select name="employment_type" class="form-select bg-dark text-white border-secondary">
                  <option value="salaried">Salaried (Corporate / Govt)</option>
                  <option value="self_employed_business">Self-Employed (Business)</option>
                  <option value="self_employed_professional">Professional (Doctor / CA / Arch)</option>
                  <option value="nri">NRI (Non-Resident Indian)</option>
                </select>
              </div>
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Monthly Income (₹)</label>
                <input type="number" name="monthly_income" class="form-control bg-dark text-white border-secondary" placeholder="e.g. 150000">
              </div>
            </div>

            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Preferred Banks</label>
              <input type="text" name="preferred_banks" class="form-control bg-dark text-white border-secondary" value="SBI, HDFC Bank, ICICI Bank">
            </div>

            <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">
              <i class="fas fa-file-signature me-2"></i> Request Loan File Review
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
document.getElementById('loanAppForm').addEventListener('submit', function (e) {
  e.preventDefault();
  var form = this;
  var btn = form.querySelector('button[type="submit"]');
  var orig = btn.innerHTML;
  btn.disabled = true;
  btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Submitting...';

  fetch('api/loan-application.php', {
    method: 'POST',
    body: new FormData(form)
  })
  .then(res => res.json())
  .then(data => {
    if (data.success) {
      showToast('success', data.message);
      form.reset();
    } else {
      showToast('error', data.message);
    }
  })
  .catch(err => {
    showToast('error', 'Network error. Please call our loan support helpline.');
  })
  .finally(() => {
    btn.disabled = false;
    btn.innerHTML = orig;
  });
});
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
