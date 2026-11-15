import React, { useState } from 'react';

export default function Navbar({ onOpenEnquiry, activeSection, onNavigate }) {
  const [isOpen, setIsOpen] = useState(false);

  const navLinks = [
    { label: 'Home', target: 'hero' },
    { label: 'About Us', target: 'about' },
    { label: 'Services', target: 'services' },
    { label: 'Projects', target: 'projects' },
    { label: 'Gallery', target: 'gallery' },
    { label: 'Network', target: 'network' },
    { label: 'Loan Assistance', target: 'loan' },
    { label: 'Contact', target: 'contact' }
  ];

  const handleNavClick = (target) => {
    setIsOpen(false);
    onNavigate(target);
  };

  return (
    <>
      {/* TOP BAR */}
      <div className="top-bar d-none d-lg-block">
        <div className="container">
          <div className="d-flex justify-content-between align-items-center">
            <div className="d-flex align-items-center">
              <span><i className="fas fa-map-marker-alt text-warning me-2"></i>HMT Nagar, Nacharam, Hyderabad 500076</span>
              <span className="divider"></span>
              <a href="tel:+919542439498"><i className="fas fa-phone-alt text-warning me-2"></i>+91 95424 39498</a>
              <span className="divider"></span>
              <a href="mailto:zippyconstructions@gmail.com"><i className="fas fa-envelope text-warning me-2"></i>zippyconstructions@gmail.com</a>
            </div>
            <div className="d-flex align-items-center">
              <span className="badge bg-dark text-warning border border-warning px-2 py-1 me-3">
                <i className="fas fa-certificate me-1"></i> ISO 9001:2015 CERTIFIED
              </span>
              <span className="divider"></span>
              <a href="https://wa.me/916302690251" target="_blank" rel="noopener noreferrer" className="text-warning fw-semibold me-3">
                <i className="fab fa-whatsapp me-1"></i> Quick WhatsApp
              </a>
              <button 
                type="button" 
                onClick={() => onOpenEnquiry('General Quotation')} 
                className="btn btn-link text-white fw-bold p-0 text-decoration-none"
              >
                <i className="fas fa-file-invoice text-warning me-1"></i> Request a Quotation
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* MAIN NAVBAR */}
      <nav className="navbar navbar-expand-xl navbar-custom sticky-top">
        <div className="container">
          <a className="navbar-brand d-flex align-items-center" href="#hero" onClick={(e) => { e.preventDefault(); handleNavClick('hero'); }}>
            <div className="brand-logo-icon me-2">
              <i className="fas fa-building"></i>
            </div>
            <div className="d-flex flex-column">
              <span className="brand-text-title">ZIPPY <span style={{ color: '#D4AF37' }}>ENTERPRISES</span></span>
              <span className="brand-text-sub">Construction Solutions</span>
            </div>
          </a>

          <button 
            className="navbar-toggler text-white border-0" 
            type="button" 
            onClick={() => setIsOpen(!isOpen)}
            aria-label="Toggle navigation"
          >
            <i className={`fas ${isOpen ? 'fa-times' : 'fa-bars'} fa-lg text-warning`}></i>
          </button>

          <div className={`collapse navbar-collapse ${isOpen ? 'show' : ''}`} id="mainNav">
            <ul className="navbar-nav ms-auto align-items-xl-center">
              {navLinks.map((link) => (
                <li className="nav-item" key={link.target}>
                  <a 
                    className={`nav-link nav-link-custom ${activeSection === link.target ? 'active' : ''}`} 
                    href={`#${link.target}`}
                    onClick={(e) => { e.preventDefault(); handleNavClick(link.target); }}
                  >
                    {link.label}
                  </a>
                </li>
              ))}
            </ul>

            <div className="d-flex align-items-center ms-xl-3 mt-3 mt-xl-0 gap-2">
              <button 
                type="button" 
                onClick={() => onOpenEnquiry('Quotation Request')} 
                className="btn btn-gold btn-sm px-3"
              >
                <i className="fas fa-file-invoice me-1"></i> Request a Quote
              </button>
              <a href="tel:+919542439498" className="btn btn-outline-gold btn-sm px-3 d-none d-xxl-inline-flex">
                <i className="fas fa-phone-alt me-1"></i> +91 95424 39498
              </a>
            </div>
          </div>
        </div>
      </nav>
    </>
  );
}
