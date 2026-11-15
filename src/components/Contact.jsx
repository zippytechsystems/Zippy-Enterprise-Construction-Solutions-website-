import React from 'react';

export default function Contact({ onOpenEnquiry }) {
  return (
    <section id="contact" className="py-5" style={{ background: '#FFFFFF' }}>
      <div className="container py-4">
        <div className="row g-5">
          {/* Contact Details */}
          <div className="col-lg-5">
            <span className="section-subtitle">Get In Touch</span>
            <h2 className="section-title">Visit Our Corporate Headquarters</h2>
            <p className="section-desc">
              Meet our Principal Civil Engineers and Chartered Architects at our Nacharam office to review physical material samples (marble, timber, CP fittings) and inspect 3D architectural models.
            </p>

            <div className="mt-4">
              <div className="d-flex mb-4">
                <div className="brand-logo-icon me-3 flex-shrink-0" style={{ width: '44px', height: '44px', fontSize: '1.1rem' }}>
                  <i className="fas fa-map-marker-alt"></i>
                </div>
                <div>
                  <h6 className="fw-bold text-navy mb-1">Corporate Headquarters</h6>
                  <p className="text-muted small mb-0">Sneha Apartment, HMT Nagar, Nacharam, Hyderabad, Telangana 500076, India</p>
                </div>
              </div>

              <div className="d-flex mb-4">
                <div className="brand-logo-icon me-3 flex-shrink-0" style={{ width: '44px', height: '44px', fontSize: '1.1rem' }}>
                  <i className="fas fa-phone-alt"></i>
                </div>
                <div>
                  <h6 className="fw-bold text-navy mb-1">Direct Calling Line</h6>
                  <p className="text-muted small mb-0">
                    <a href="tel:+919542439498" className="text-navy fw-bold text-decoration-none">+91 95424 39498</a>
                  </p>
                </div>
              </div>

              <div className="d-flex mb-4">
                <div className="brand-logo-icon me-3 flex-shrink-0" style={{ width: '44px', height: '44px', fontSize: '1.1rem' }}>
                  <i className="fas fa-envelope"></i>
                </div>
                <div>
                  <h6 className="fw-bold text-navy mb-1">Official Email Address</h6>
                  <p className="text-muted small mb-0">
                    <a href="mailto:zippyconstructions@gmail.com" className="text-navy text-decoration-none">zippyconstructions@gmail.com</a>
                  </p>
                </div>
              </div>

              <div className="d-flex mb-4">
                <div className="brand-logo-icon me-3 flex-shrink-0" style={{ width: '44px', height: '44px', fontSize: '1.1rem' }}>
                  <i className="fab fa-whatsapp"></i>
                </div>
                <div>
                  <h6 className="fw-bold text-navy mb-1">Direct WhatsApp Desk</h6>
                  <p className="text-muted small mb-0">
                    <a href="https://wa.me/916302690251" target="_blank" rel="noopener noreferrer" className="text-success fw-bold text-decoration-none">
                      Click to Chat on WhatsApp (+91 63026 90251)
                    </a>
                  </p>
                </div>
              </div>
            </div>

            <div className="p-3 rounded border" style={{ background: '#F8FAFC' }}>
              <small className="text-navy fw-bold d-block mb-1"><i className="fas fa-clock text-warning me-2"></i> Working Hours</small>
              <div className="small text-muted">Monday - Saturday: 9:00 AM – 7:00 PM IST</div>
              <div className="small text-muted">Sunday: On-Site Plot Inspections by Prior Appointment</div>
            </div>
          </div>

          {/* Quick Consultation CTA Card */}
          <div className="col-lg-7">
            <div className="card border-0 shadow-lg p-4 p-md-5 rounded-4 text-center" style={{ background: '#0A192F', color: '#FFFFFF', border: '1px solid var(--border-gold)' }}>
              <div className="badge-gold mb-3 mx-auto" style={{ width: 'fit-content' }}>DIRECT PROJECT INQUIRY</div>
              <h3 className="text-white fw-bold mb-3">Ready to Build Your Dream Project?</h3>
              <p className="text-white-50 mx-auto mb-4" style={{ maxWidth: '520px' }}>
                Complete our comprehensive 10-Field Project Specification Form. Our Senior Project Consultant will review your plot requirements and deliver an indicative Bill of Quantities (BOQ) within 2 business hours.
              </p>
              
              <div className="d-flex justify-content-center gap-3 flex-wrap">
                <button 
                  type="button" 
                  onClick={() => onOpenEnquiry('Direct Contact Page Inquiry')} 
                  className="btn btn-gold btn-lg px-4"
                >
                  <i className="fas fa-file-invoice me-2"></i> Request Project Quotation
                </button>
                <a 
                  href="https://wa.me/916302690251?text=Hello%20Zippy%20Enterprises%2C%20I%20would%20like%20to%20consult%20with%20an%20engineer%20regarding%20my%20construction%20project."
                  target="_blank" 
                  rel="noopener noreferrer" 
                  className="btn btn-outline-light btn-lg px-4"
                >
                  <i className="fab fa-whatsapp text-success me-2"></i> Instant WhatsApp
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
