<?php
/**
 * Corporate Footer
 * Zippy Enterprises Private Limited
 * Public Corporate Business & Portfolio Website
 */
?>

<!-- FLOATING WHATSAPP BUTTON -->
<a href="https://wa.me/<?= COMPANY_WHATSAPP ?>?text=<?= urlencode('Hello Zippy Enterprises! I am interested in building a construction project in Hyderabad and would like to speak with a Project Consultant.') ?>" 
   class="whatsapp-floating" 
   target="_blank" 
   rel="noopener noreferrer" 
   title="Chat with Zippy Construction Consultant on WhatsApp">
  <div class="whatsapp-pulse"></div>
  <i class="fab fa-whatsapp"></i>
</a>

<!-- FOOTER -->
<footer class="footer-corporate">
  <div class="container">
    <div class="row g-4">
      <!-- Col 1: Corporate Profile -->
      <div class="col-lg-4 col-md-6">
        <div class="d-flex align-items-center mb-3">
          <div class="brand-logo-icon me-2" style="width:38px; height:38px; font-size:1.1rem;">
            <i class="fas fa-building"></i>
          </div>
          <div>
            <h5 class="text-white mb-0 fw-bold">ZIPPY <span style="color:#D4AF37;">ENTERPRISES</span></h5>
            <small class="text-warning text-uppercase" style="font-size:0.65rem; letter-spacing:2px;">Private Limited</small>
          </div>
        </div>
        <p class="text-white-50 small mb-3">
          Zippy Enterprises Private Limited is Hyderabad's premier construction solutions and building development corporation. Delivering independent homes, luxury villas, commercial developments, and turnkey EPC projects with uncompromised engineering excellence and complete transparency.
        </p>
        <div class="text-white-50 small mb-2">
          <strong>CIN:</strong> <?= COMPANY_CIN ?> | <strong>GSTIN:</strong> <?= COMPANY_GSTIN ?>
        </div>
        <div class="d-flex gap-2 mt-3">
          <a href="#" class="btn btn-sm btn-outline-secondary text-warning border-secondary rounded-circle" style="width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;"><i class="fab fa-linkedin-in"></i></a>
          <a href="#" class="btn btn-sm btn-outline-secondary text-warning border-secondary rounded-circle" style="width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;"><i class="fab fa-instagram"></i></a>
          <a href="#" class="btn btn-sm btn-outline-secondary text-warning border-secondary rounded-circle" style="width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;"><i class="fab fa-facebook-f"></i></a>
          <a href="#" class="btn btn-sm btn-outline-secondary text-warning border-secondary rounded-circle" style="width:34px;height:34px;display:inline-flex;align-items:center;justify-content:center;"><i class="fab fa-youtube"></i></a>
        </div>
      </div>

      <!-- Col 2: Construction Solutions -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Construction Solutions</h5>
        <ul class="footer-links">
          <li><a href="service-residential.php"><i class="fas fa-chevron-right text-warning small"></i> Residential Construction</a></li>
          <li><a href="service-independent-house.php"><i class="fas fa-chevron-right text-warning small"></i> Independent House Construction</a></li>
          <li><a href="service-villa.php"><i class="fas fa-chevron-right text-warning small"></i> Luxury Villa Construction</a></li>
          <li><a href="service-commercial.php"><i class="fas fa-chevron-right text-warning small"></i> Commercial Buildings</a></li>
          <li><a href="service-apartment.php"><i class="fas fa-chevron-right text-warning small"></i> Apartment Development</a></li>
          <li><a href="service-turnkey.php"><i class="fas fa-chevron-right text-warning small"></i> Turnkey EPC Projects</a></li>
          <li><a href="service-consultancy.php"><i class="fas fa-chevron-right text-warning small"></i> Architectural &amp; Structural Design</a></li>
          <li><a href="loan-assistance.php"><i class="fas fa-chevron-right text-warning small"></i> Self-Construction Loan Support</a></li>
        </ul>
      </div>

      <!-- Col 3: Company & Portfolio -->
      <div class="col-lg-2 col-md-6">
        <h5 class="footer-title">Explore Zippy</h5>
        <ul class="footer-links">
          <li><a href="about.php"><i class="fas fa-chevron-right text-warning small"></i> About Our Company</a></li>
          <li><a href="projects.php"><i class="fas fa-chevron-right text-warning small"></i> Project Showcase</a></li>
          <li><a href="gallery.php"><i class="fas fa-chevron-right text-warning small"></i> Project Gallery</a></li>
          <li><a href="network.php"><i class="fas fa-chevron-right text-warning small"></i> Professional Network</a></li>
          <li><a href="quote.php"><i class="fas fa-chevron-right text-warning small"></i> Request a Quote</a></li>
          <li><a href="careers.php"><i class="fas fa-chevron-right text-warning small"></i> Careers at Zippy</a></li>
          <li><a href="contact.php"><i class="fas fa-chevron-right text-warning small"></i> Contact Us</a></li>
        </ul>
      </div>

      <!-- Col 4: Corporate Headquarters -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Hyderabad HQ</h5>
        <p class="text-white-50 small mb-2">
          <i class="fas fa-map-marked-alt text-warning me-2"></i>
          Sneha Apartment, HMT Nagar, Nacharam, Hyderabad, Telangana 500076
        </p>
        <p class="text-white-50 small mb-2">
          <i class="fas fa-phone-alt text-warning me-2"></i>
          <a href="tel:<?= str_replace(' ', '', COMPANY_PHONE) ?>" class="text-white"><?= COMPANY_PHONE ?></a>
        </p>
        <p class="text-white-50 small mb-3">
          <i class="fas fa-envelope text-warning me-2"></i>
          <a href="mailto:<?= COMPANY_EMAIL ?>" class="text-white"><?= COMPANY_EMAIL ?></a>
        </p>
        <div class="p-3 rounded" style="background:rgba(212,175,55,0.08); border:1px solid rgba(212,175,55,0.25);">
          <small class="text-warning fw-bold d-block mb-1"><i class="fas fa-clock me-1"></i> Technical Advisory Hours</small>
          <span class="text-white-50 small">Mon - Sat: 9:00 AM - 7:00 PM<br>Sunday: By Prior Appointment</span>
        </div>
      </div>
    </div>

    <!-- Bottom Bar -->
    <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center text-center text-md-start">
      <div class="mb-2 mb-md-0">
        &copy; <?= date('Y') ?> <strong><?= COMPANY_NAME ?></strong>. All Rights Reserved.
      </div>
      <div class="d-flex gap-3">
        <a href="privacy-policy.php" class="text-white-50">Privacy Policy</a>
        <a href="terms.php" class="text-white-50">Terms &amp; Conditions</a>
        <a href="contact.php" class="text-white-50">Sitemap</a>
      </div>
    </div>
  </div>
</footer>

<!-- 10-FIELD PROJECT ENQUIRY MODAL (Section 13) -->
<div class="modal fade" id="quickEnquiryModal" tabindex="-1" aria-labelledby="quickEnquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow-lg" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
      <div class="modal-header border-secondary">
        <div>
          <span class="badge-gold mb-1">PROJECT CONSULTATION</span>
          <h5 class="modal-title fw-bold text-white mb-0" id="quickEnquiryModalLabel">
            <i class="fas fa-hard-hat text-warning me-2"></i> Start Your Construction Project
          </h5>
        </div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
        <?= Security::csrfField() ?>
        <input type="hidden" name="source" value="website_modal">
        <div class="modal-body p-4">
          <div class="row g-3 mb-3">
            <div class="col-md-6">
              <label class="form-label text-warning small fw-bold">Customer Full Name *</label>
              <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Enter full name">
            </div>
            <div class="col-md-6">
              <label class="form-label text-warning small fw-bold">Mobile Number *</label>
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
              <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Kokapet, Gachibowli">
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
              <label class="form-label text-warning small fw-bold">Plot Size (Sq.Yards / Sq.Ft)</label>
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

          <div class="mb-2">
            <label class="form-label text-warning small fw-bold">Project Requirements &amp; Notes</label>
            <textarea name="project_requirements" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Provide details on plot orientation, Vastu preferences, timeline, or material requests..."></textarea>
          </div>
        </div>
        <div class="modal-footer border-secondary">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm px-4">Submit Construction Enquiry</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>
<?php if (isset($extraScripts)): ?>
  <?= $extraScripts ?>
<?php endif; ?>
</body>
</html>
