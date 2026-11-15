<?php
/**
 * Contact Us Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Contact Us | Corporate Headquarters Hyderabad";
$pageDescription = "Contact Zippy Enterprises Private Limited in Jubilee Hills, Hyderabad. Book an architectural consultation, schedule a site inspection, or call our construction desk directly.";
require_once __DIR__ . '/includes/header.php';
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Contact Zippy Enterprises" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">COMMUNICATION DESK</div>
    <h1 class="page-banner-title">Contact Our Corporate Office</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Contact Us</span>
    </div>
  </div>
</section>

<!-- MAIN CONTENT -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <div class="row g-5">
      <!-- Contact Info & Location -->
      <div class="col-lg-5">
        <span class="section-subtitle">Get In Touch</span>
        <h2 class="section-title">We Are Here To Assist Your Construction Journey</h2>
        <p class="section-desc">
          Visit our Jubilee Hills headquarters to review physical material samples (marble, timber, CP fittings), inspect architectural 3D models, or meet with our Principal Engineers.
        </p>

        <div class="mt-4">
          <div class="d-flex mb-4">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:44px; height:44px; font-size:1.1rem;"><i class="fas fa-map-marker-alt"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">Corporate Headquarters</h6>
              <p class="text-muted small mb-0"><?= COMPANY_ADDRESS ?></p>
            </div>
          </div>

          <div class="d-flex mb-4">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:44px; height:44px; font-size:1.1rem;"><i class="fas fa-phone-alt"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">Direct Telephone Lines</h6>
              <p class="text-muted small mb-0">
                Primary: <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE) ?>" class="text-navy fw-bold"><?= COMPANY_PHONE ?></a><br>
                Board: <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE_ALT) ?>" class="text-navy"><?= COMPANY_PHONE_ALT ?></a>
              </p>
            </div>
          </div>

          <div class="d-flex mb-4">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:44px; height:44px; font-size:1.1rem;"><i class="fas fa-envelope"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">Official Email Inquiries</h6>
              <p class="text-muted small mb-0">
                General: <a href="mailto:<?= COMPANY_EMAIL ?>" class="text-navy"><?= COMPANY_EMAIL ?></a><br>
                Tenders &amp; Sales: <a href="mailto:<?= COMPANY_SALES_EMAIL ?>" class="text-navy"><?= COMPANY_SALES_EMAIL ?></a>
              </p>
            </div>
          </div>

          <div class="d-flex mb-4">
            <div class="brand-logo-icon me-3 flex-shrink-0" style="width:44px; height:44px; font-size:1.1rem;"><i class="fab fa-whatsapp"></i></div>
            <div>
              <h6 class="fw-bold text-navy mb-1">Instant WhatsApp Support</h6>
              <p class="text-muted small mb-0">
                <a href="https://wa.me/<?= COMPANY_WHATSAPP ?>" target="_blank" class="text-success fw-bold">
                  Click to Chat Directly (+91 <?= COMPANY_WHATSAPP ?>)
                </a>
              </p>
            </div>
          </div>
        </div>

        <div class="p-3 rounded border" style="background:#F8FAFC;">
          <small class="text-navy fw-bold d-block mb-1"><i class="fas fa-clock text-warning me-2"></i> Working Hours</small>
          <div class="small text-muted">Monday - Saturday: 9:00 AM – 7:00 PM IST</div>
          <div class="small text-muted">Sunday: On-Site Inspections by Pre-Appointment Only</div>
        </div>
      </div>

      <!-- Contact Form -->
      <div class="col-lg-7">
        <div class="card border-0 shadow-lg p-4 p-md-5" style="background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">ONLINE ENQUIRY DESK</div>
          <h3 class="text-white fw-bold mb-2">Send Us a Direct Message</h3>
          <p class="text-white-50 small mb-4">Complete this form and our Senior Project Consultant will review your request and get back within 2 business hours.</p>

          <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
            <?= Security::csrfField() ?>
            <input type="hidden" name="source" value="contact_page">

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Your Full Name *</label>
                <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Enter full name">
              </div>
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Phone Number *</label>
                <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Email Address *</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="name@domain.com">
              </div>
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Service Required *</label>
                <select name="service_requested" class="form-select bg-dark text-white border-secondary" required>
                  <option value="Residential Building Construction">Residential Building Construction</option>
                  <option value="Commercial Building Construction">Commercial Building Construction</option>
                  <option value="Apartment Construction">Apartment Construction</option>
                  <option value="Turnkey Construction">Turnkey EPC Construction</option>
                  <option value="Architectural & Structural Design">Architectural &amp; Structural Design</option>
                  <option value="Self-Construction Loan Assistance">Self-Construction Loan Assistance</option>
                  <option value="General Inquiry">General Corporate Inquiry</option>
                </select>
              </div>
            </div>

            <div class="row g-3 mb-3">
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Plot / Project Location in Hyderabad *</label>
                <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Kokapet">
              </div>
              <div class="col-md-6">
                <label class="form-label text-warning small fw-bold">Estimated Budget Range</label>
                <select name="estimated_budget" class="form-select bg-dark text-white border-secondary">
                  <option value="₹75 Lakhs - ₹1.5 Crores">₹75 Lakhs - ₹1.5 Crores</option>
                  <option value="₹1.5 Crores - ₹3.0 Crores" selected>₹1.5 Crores - ₹3.0 Crores</option>
                  <option value="₹3.0 Crores - ₹7.0 Crores">₹3.0 Crores - ₹7.0 Crores</option>
                  <option value="₹7.0 Crores+">₹7.0 Crores+ (Commercial / Luxury)</option>
                </select>
              </div>
            </div>

            <div class="mb-4">
              <label class="form-label text-warning small fw-bold">Project Details / Requirements</label>
              <textarea name="notes" rows="4" class="form-control bg-dark text-white border-secondary" placeholder="Tell us about plot dimensions, orientation, preferred architectural style, or timeline..."></textarea>
            </div>

            <button type="submit" class="btn btn-gold btn-lg w-100 fw-bold">
              <i class="fas fa-paper-plane me-2"></i> Submit Inquiry
            </button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
