import React from 'react';

export default function Footer({ onOpenEnquiry, onNavigate }) {
  return (
    <>
      <footer className="footer-corporate">
        <div className="container">
          <div className="row g-4">
            {/* Col 1: Profile */}
            <div className="col-lg-4 col-md-6">
              <div className="d-flex align-items-center mb-3">
                <div className="brand-logo-icon me-2" style={{ width: '38px', height: '38px', fontSize: '1.1rem' }}>
                  <i className="fas fa-building"></i>
                </div>
                <div>
                  <h5 className="text-white mb-0 fw-bold">ZIPPY <span style={{ color: '#D4AF37' }}>ENTERPRISES</span></h5>
                  <small className="text-warning text-uppercase" style={{ fontSize: '0.65rem', letterSpacing: '2px' }}>Private Limited</small>
                </div>
              </div>
              <p className="text-white-50 small mb-3">
                Zippy Enterprises Private Limited is Hyderabad's premier construction solutions and building development corporation. Delivering independent homes, luxury villas, commercial developments, and turnkey EPC projects with uncompromised engineering excellence and complete transparency.
              </p>
              <div className="text-white-50 small mb-2">
                <strong>CIN:</strong> U45200TG2020PTC145892 | <strong>GSTIN:</strong> 36AABCZ1234F1Z8
              </div>
            </div>

            {/* Col 2: Solutions */}
            <div className="col-lg-3 col-md-6">
              <h5 className="footer-title">Construction Solutions</h5>
              <ul className="footer-links">
                <li><a href="#services" onClick={() => onNavigate('services')}><i className="fas fa-chevron-right text-warning small"></i> Residential Construction</a></li>
                <li><a href="#services" onClick={() => onNavigate('services')}><i className="fas fa-chevron-right text-warning small"></i> Independent House Construction</a></li>
                <li><a href="#services" onClick={() => onNavigate('services')}><i className="fas fa-chevron-right text-warning small"></i> Luxury Villa Construction</a></li>
                <li><a href="#services" onClick={() => onNavigate('services')}><i className="fas fa-chevron-right text-warning small"></i> Commercial Buildings</a></li>
                <li><a href="#services" onClick={() => onNavigate('services')}><i className="fas fa-chevron-right text-warning small"></i> Apartment Development</a></li>
                <li><a href="#services" onClick={() => onNavigate('services')}><i className="fas fa-chevron-right text-warning small"></i> Turnkey EPC Projects</a></li>
                <li><a href="#loan" onClick={() => onNavigate('loan')}><i className="fas fa-chevron-right text-warning small"></i> Self-Construction Loan Support</a></li>
              </ul>
            </div>

            {/* Col 3: Quick Navigation */}
            <div className="col-lg-2 col-md-6">
              <h5 className="footer-title">Explore Zippy</h5>
              <ul className="footer-links">
                <li><a href="#about" onClick={() => onNavigate('about')}><i className="fas fa-chevron-right text-warning small"></i> About Our Company</a></li>
                <li><a href="#projects" onClick={() => onNavigate('projects')}><i className="fas fa-chevron-right text-warning small"></i> Project Showcase</a></li>
                <li><a href="#gallery" onClick={() => onNavigate('gallery')}><i className="fas fa-chevron-right text-warning small"></i> Project Gallery</a></li>
                <li><a href="#network" onClick={() => onNavigate('network')}><i className="fas fa-chevron-right text-warning small"></i> Professional Network</a></li>
                <li><a href="#quote" onClick={() => onOpenEnquiry('Footer Quote Link')}><i className="fas fa-chevron-right text-warning small"></i> Request a Quote</a></li>
                <li><a href="#contact" onClick={() => onNavigate('contact')}><i className="fas fa-chevron-right text-warning small"></i> Contact Us</a></li>
              </ul>
            </div>

            {/* Col 4: Corporate Headquarters */}
            <div className="col-lg-3 col-md-6">
              <h5 className="footer-title">Hyderabad HQ</h5>
              <p className="text-white-50 small mb-2">
                <i className="fas fa-map-marked-alt text-warning me-2"></i>
                Sneha Apartment, HMT Nagar, Nacharam, Hyderabad, Telangana 500076
              </p>
              <p className="text-white-50 small mb-2">
                <i className="fas fa-phone-alt text-warning me-2"></i>
                <a href="tel:+919542439498" className="text-white text-decoration-none">+91 95424 39498</a>
              </p>
              <p className="text-white-50 small mb-3">
                <i className="fas fa-envelope text-warning me-2"></i>
                <a href="mailto:zippyconstructions@gmail.com" className="text-white text-decoration-none">zippyconstructions@gmail.com</a>
              </p>
              <div className="p-3 rounded" style={{ background: 'rgba(212,175,55,0.08)', border: '1px solid rgba(212,175,55,0.25)' }}>
                <small className="text-warning fw-bold d-block mb-1"><i className="fas fa-clock me-1"></i> Technical Advisory Hours</small>
                <span className="text-white-50 small">Mon - Sat: 9:00 AM - 7:00 PM<br />Sunday: By Prior Appointment</span>
              </div>
            </div>
          </div>

          <div className="footer-bottom">
            <div className="d-flex flex-wrap justify-content-between align-items-center">
              <small className="text-white-50">
                &copy; {new Date().getFullYear()} Zippy Enterprises Private Limited. All Rights Reserved. Engineered for Excellence in Hyderabad.
              </small>
              <div className="d-flex gap-3 small text-white-50">
                <a href="privacy-policy.php" className="text-white-50 text-decoration-none">Privacy Policy</a>
                <span>&bull;</span>
                <a href="terms.php" className="text-white-50 text-decoration-none">Terms &amp; Conditions</a>
              </div>
            </div>
          </div>
        </div>
      </footer>
    </>
  );
}
