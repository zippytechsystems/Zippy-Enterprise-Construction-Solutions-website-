<?php
/**
 * Corporate Footer
 * Zippy Enterprises Private Limited
 */
?>

<!-- FLOATING WHATSAPP BUTTON -->
<a href="https://wa.me/<?= COMPANY_WHATSAPP ?>?text=<?= urlencode('Hello Zippy Enterprises! I am interested in building a project in Hyderabad and would like to speak with a Project Consultant.') ?>" 
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
          Zippy Enterprises Private Limited is Hyderabad's premier construction solutions and building development corporation. We deliver world-class residential villas, high-rise apartments, commercial complexes, and turnkey EPC solutions with uncompromised engineering precision.
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

      <!-- Col 2: Construction Services -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Our Services</h5>
        <ul class="footer-links">
          <li><a href="service-residential.php"><i class="fas fa-chevron-right text-warning small"></i> Residential Construction</a></li>
          <li><a href="service-commercial.php"><i class="fas fa-chevron-right text-warning small"></i> Commercial Buildings</a></li>
          <li><a href="service-apartment.php"><i class="fas fa-chevron-right text-warning small"></i> Apartment Development</a></li>
          <li><a href="service-turnkey.php"><i class="fas fa-chevron-right text-warning small"></i> Turnkey EPC Solutions</a></li>
          <li><a href="service-consultancy.php"><i class="fas fa-chevron-right text-warning small"></i> Architectural &amp; Structural Design</a></li>
          <li><a href="services.php"><i class="fas fa-chevron-right text-warning small"></i> Interior Design &amp; Execution</a></li>
          <li><a href="services.php"><i class="fas fa-chevron-right text-warning small"></i> Renovation &amp; Remodeling</a></li>
          <li><a href="loan-assistance.php"><i class="fas fa-chevron-right text-warning small"></i> Self-Construction Loan Support</a></li>
        </ul>
      </div>

      <!-- Col 3: Enterprise Portals & Tracking -->
      <div class="col-lg-2 col-md-6">
        <h5 class="footer-title">Portals &amp; Tools</h5>
        <ul class="footer-links">
          <li><a href="cost-estimator.php"><i class="fas fa-calculator text-warning small"></i> Construction Estimator</a></li>
          <li><a href="login.php"><i class="fas fa-user-lock text-warning small"></i> Customer Portal</a></li>
          <li><a href="builder-login.php"><i class="fas fa-hard-hat text-warning small"></i> Builder Portal</a></li>
          <li><a href="builders.php"><i class="fas fa-handshake text-warning small"></i> Partner With Us</a></li>
          <li><a href="projects.php"><i class="fas fa-building text-warning small"></i> Project Showcase</a></li>
          <li><a href="gallery.php"><i class="fas fa-images text-warning small"></i> Project Gallery</a></li>
          <li><a href="careers.php"><i class="fas fa-briefcase text-warning small"></i> Careers at Zippy</a></li>
          <li><a href="login.php?role=admin"><i class="fas fa-shield-alt text-warning small"></i> Admin Suite</a></li>
        </ul>
      </div>

      <!-- Col 4: Corporate Headquarters -->
      <div class="col-lg-3 col-md-6">
        <h5 class="footer-title">Hyderabad HQ</h5>
        <p class="text-white-50 small mb-2">
          <i class="fas fa-map-marked-alt text-warning me-2"></i>
          Level 4, Zippy Tech Tower, Road No. 36, Jubilee Hills, Hyderabad, Telangana 500033
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
          <small class="text-warning fw-bold d-block mb-1"><i class="fas fa-clock me-1"></i> Site Inspection Hours</small>
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

<!-- Quick Enquiry Modal -->
<div class="modal fade" id="quickEnquiryModal" tabindex="-1" aria-labelledby="quickEnquiryModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow-lg" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
      <div class="modal-header border-secondary">
        <h5 class="modal-title fw-bold text-white" id="quickEnquiryModalLabel">
          <i class="fas fa-hard-hat text-warning me-2"></i> Request Construction Consultation
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form class="ajax-enquiry-form" action="api/submit-enquiry.php" method="POST">
        <?= Security::csrfField() ?>
        <input type="hidden" name="source" value="website_modal">
        <div class="modal-body p-4">
          <div class="mb-3">
            <label class="form-label text-warning small fw-bold">Full Name *</label>
            <input type="text" name="full_name" class="form-control bg-dark text-white border-secondary" required placeholder="Enter your full name">
          </div>
          <div class="row g-2 mb-3">
            <div class="col-md-6">
              <label class="form-label text-warning small fw-bold">Phone Number *</label>
              <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
            </div>
            <div class="col-md-6">
              <label class="form-label text-warning small fw-bold">Email Address *</label>
              <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="name@domain.com">
            </div>
          </div>
          <div class="mb-3">
            <label class="form-label text-warning small fw-bold">Service Required *</label>
            <select name="service_requested" class="form-select bg-dark text-white border-secondary" required>
              <option value="Residential Building Construction">Residential Building Construction</option>
              <option value="Commercial Building Construction">Commercial Building Construction</option>
              <option value="Apartment Construction">Apartment Construction</option>
              <option value="Turnkey Construction">Turnkey EPC Construction</option>
              <option value="Architectural & Structural Design">Architectural & Structural Design</option>
              <option value="Interior Design & Execution">Interior Design & Execution</option>
              <option value="Self-Construction Loan Assistance">Self-Construction Loan Assistance</option>
            </select>
          </div>
          <div class="mb-3">
            <label class="form-label text-warning small fw-bold">Plot / Project Location in Hyderabad *</label>
            <input type="text" name="project_location" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Kokapet, Gachibowli">
          </div>
          <div class="mb-3">
            <label class="form-label text-warning small fw-bold">Estimated Budget</label>
            <select name="estimated_budget" class="form-select bg-dark text-white border-secondary">
              <option value="₹75 Lakhs - ₹1.5 Crores">₹75 Lakhs - ₹1.5 Crores</option>
              <option value="₹1.5 Crores - ₹3.0 Crores" selected>₹1.5 Crores - ₹3.0 Crores</option>
              <option value="₹3.0 Crores - ₹7.0 Crores">₹3.0 Crores - ₹7.0 Crores</option>
              <option value="₹7.0 Crores+">₹7.0 Crores+ (Commercial / Luxury)</option>
            </select>
          </div>
        </div>
        <div class="modal-footer border-secondary">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-gold btn-sm px-4">Submit Consultation Request</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Bootstrap 5 Bundle JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

<!-- Main JS -->
<script src="assets/js/main.js"></script>
<?php if (isset($extraScripts)): ?>
  <?= $extraScripts ?>
<?php endif; ?>
</body>
</html>
