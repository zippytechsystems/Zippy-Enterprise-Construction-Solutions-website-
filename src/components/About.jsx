import React from 'react';

export default function About({ onOpenEnquiry }) {
  return (
    <section id="about" className="py-5" style={{ background: '#FFFFFF' }}>
      <div className="container py-4">
        <div className="row align-items-center g-5">
          <div className="col-lg-6">
            <span className="section-subtitle">About Zippy Enterprises</span>
            <h2 className="section-title">Built On Structural Integrity, Transparency &amp; Craftsmanship</h2>
            <p className="section-desc">
              Zippy Enterprises Private Limited is an established corporate construction and building development company based in Nacharam, Hyderabad. We specialize in bringing professional engineering discipline, rigorous quality testing, and transparent financial governance to private residential and commercial developments.
            </p>
            <p className="text-muted">
              Our integrated approach unites licensed architects, chartered structural engineers (STAAD-Pro &amp; ETABS certified), seasoned on-ground civil contractors, and premium material suppliers. Whether you are building an independent family villa or developing a commercial tech hub, Zippy ensures your project is executed safely, on schedule, and to exact specifications.
            </p>

            <div className="row g-3 mt-2">
              <div className="col-sm-6">
                <div className="p-3 rounded border h-100" style={{ background: '#F8FAFC' }}>
                  <h6 className="fw-bold text-navy mb-1"><i className="fas fa-check-circle text-warning me-2"></i> 100% IS Code Compliant</h6>
                  <p className="small text-muted mb-0">Adherence to IS 456, IS 1893 seismic ductility, and standard compressive cube tests.</p>
                </div>
              </div>
              <div className="col-sm-6">
                <div className="p-3 rounded border h-100" style={{ background: '#F8FAFC' }}>
                  <h6 className="fw-bold text-navy mb-1"><i className="fas fa-shield-alt text-warning me-2"></i> Single-Point Accountability</h6>
                  <p className="small text-muted mb-0">From soil investigation to GHMC sanctions and final key handover, one reliable team.</p>
                </div>
              </div>
            </div>

            <div className="mt-4 pt-2">
              <button 
                type="button" 
                onClick={() => onOpenEnquiry('Consultation Booking')} 
                className="btn btn-navy"
              >
                <i className="fas fa-calendar-check me-2"></i> Schedule On-Site Plot Inspection
              </button>
            </div>
          </div>

          <div className="col-lg-6">
            <div className="position-relative">
              <img 
                src="assets/images/services/commercial.jpg" 
                alt="Corporate Civil Execution" 
                className="w-100 rounded-4 shadow-lg object-fit-cover" 
                style={{ height: '440px' }} 
              />
              <div className="position-absolute bottom-0 start-0 m-4 p-4 rounded-3 shadow" style={{ background: 'rgba(10,25,47,0.95)', border: '1px solid var(--border-gold)', maxWidth: '320px' }}>
                <div className="text-warning small fw-bold text-uppercase">CORPORATE GUARANTEE</div>
                <h5 className="text-white fw-bold mb-1">10-Year Warranty</h5>
                <p className="text-white-50 small mb-0">Comprehensive structural stability guarantee and 5-year leak-free waterproofing warranty.</p>
              </div>
            </div>
          </div>
        </div>

        {/* ENGINEERING BENCHMARKS */}
        <div className="mt-5 p-4 rounded-4" style={{ background: '#0A192F', color: '#FFFFFF' }}>
          <div className="row g-4 text-center">
            <div className="col-md-3">
              <div className="brand-logo-icon mx-auto mb-2"><i className="fas fa-cube"></i></div>
              <h6 className="text-white fw-bold mb-1">M25 / M30 Concrete</h6>
              <p className="text-white-50 small mb-0">RMC automated batching with 7, 14, 28-day certified lab cube tests.</p>
            </div>
            <div className="col-md-3">
              <div className="brand-logo-icon mx-auto mb-2"><i className="fas fa-layer-group"></i></div>
              <h6 className="text-white fw-bold mb-1">Tata / JSW Fe550D</h6>
              <p className="text-white-50 small mb-0">Primary steel mill test certificates for earthquake ductility.</p>
            </div>
            <div className="col-md-3">
              <div className="brand-logo-icon mx-auto mb-2"><i className="fas fa-compass"></i></div>
              <h6 className="text-white fw-bold mb-1">100% Vastu Harmony</h6>
              <p className="text-white-50 small mb-0">Architectural layouts vetted by traditional Vastu science.</p>
            </div>
            <div className="col-md-3">
              <div className="brand-logo-icon mx-auto mb-2"><i className="fas fa-tint-slash"></i></div>
              <h6 className="text-white fw-bold mb-1">3-Tier Waterproofing</h6>
              <p className="text-white-50 small mb-0">Elastomeric membranes and 72-hour continuous ponding tests.</p>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
