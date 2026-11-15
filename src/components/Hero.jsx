import React from 'react';

export default function Hero({ onOpenEnquiry, onNavigate }) {
  return (
    <section id="hero" className="hero-section">
      <img src="assets/images/hero-bg.jpg" alt="Zippy Construction" className="hero-bg" />
      <div className="hero-overlay"></div>
      
      <div className="container hero-content">
        <div className="row align-items-center g-5">
          <div className="col-lg-8">
            <div className="badge-gold mb-3">
              <i className="fas fa-shield-alt me-1"></i> LICENSED CIVIL CONTRACTORS &bull; HYDERABAD
            </div>
            <h1 className="hero-title mb-3">
              Building Your Vision. <br />
              <span className="gold-text">Delivering Excellence.</span>
            </h1>
            <p className="hero-subtitle mb-4">
              From independent homes to commercial developments, Zippy Enterprises delivers professional construction solutions with a commitment to quality, transparency and excellence.
            </p>
            <div className="d-flex flex-wrap gap-3">
              <button 
                type="button" 
                onClick={() => onOpenEnquiry('Project Kickoff')} 
                className="btn btn-gold btn-lg"
              >
                <i className="fas fa-hard-hat me-2"></i> Start Your Construction Project
              </button>
              <button 
                type="button" 
                onClick={() => onNavigate('services')} 
                className="btn btn-outline-gold btn-lg"
              >
                <i className="fas fa-th-large me-2"></i> Explore Our Services
              </button>
            </div>
          </div>

          <div className="col-lg-4 d-none d-lg-block">
            <div className="card border-0 shadow-premium p-4" style={{ background: 'rgba(14, 36, 66, 0.9)', backdropFilter: 'blur(16px)', borderRadius: '16px', border: '1px solid var(--border-gold)' }}>
              <div className="d-flex align-items-center justify-content-between mb-3">
                <span className="badge bg-warning text-dark fw-bold px-3 py-1">BENCHMARK STANDARDS</span>
                <span className="text-white-50 small"><i className="fas fa-shield-alt text-success me-1"></i> IS 456 Compliant</span>
              </div>
              <div className="mb-3 pb-3 border-bottom border-secondary">
                <div className="text-white-50 small text-uppercase fw-bold">Built-up Footprint</div>
                <div className="h3 text-white fw-bold mb-0">1,250,000+ <span className="text-warning fs-6">Sq.Ft Delivered</span></div>
              </div>
              <div className="mb-3 pb-3 border-bottom border-secondary">
                <div className="text-white-50 small text-uppercase fw-bold">Structural Grade</div>
                <div className="h4 text-white fw-bold mb-0">Fe 550D <span className="text-warning fs-6">&amp; M30 Concrete</span></div>
              </div>
              <div>
                <div className="text-white-50 small text-uppercase fw-bold">Corporate Office</div>
                <div className="text-white small fw-bold mb-0">Sneha Apt, HMT Nagar, Nacharam, Hyd</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
