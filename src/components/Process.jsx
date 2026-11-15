import React from 'react';

export default function Process({ onOpenEnquiry }) {
  const steps = [
    { num: 1, title: 'Customer Consultation', desc: 'Initial technical consultation at our Nacharam office or via phone to discuss architectural vision and plot specifics.' },
    { num: 2, title: 'Requirements & Sanction', desc: 'Detailed site inspection, digital contour survey, 100% Vastu layout planning, and GHMC municipal approval liaison.' },
    { num: 3, title: 'Architectural & Engineering', desc: '3D BIM visualizations, STAAD-Pro structural frame analysis, column schedules, and itemized Bill of Quantities (BOQ).' },
    { num: 4, title: 'Turnkey Construction', desc: 'Civil foundation, Fe 550D rebar placement, M25/M30 slab pours with compressive cube testing, and masonry work.' },
    { num: 5, title: 'Finishing & Handover', desc: 'Internal joinery, concealed CPVC plumbing, electrical wiring, premium flooring, 3-layer waterproofing, and final inspection.' },
    { num: 6, title: 'Occupancy & Support', desc: 'Final key handover celebration, statutory occupancy certification, structural stability warranty, and long-term support.' }
  ];

  return (
    <section className="py-5" style={{ background: '#0A192F', color: '#FFFFFF' }}>
      <div className="container py-4">
        <div className="section-header text-center mx-auto" style={{ maxWidth: '720px' }}>
          <span className="section-subtitle">Systematic Precision</span>
          <h2 className="section-title text-white">Our 6-Step Construction Methodology</h2>
          <p className="text-white-50 mx-auto">
            From initial plot boundary survey to final key handover, every milestone is backed by written quality inspection sign-offs.
          </p>
        </div>

        <div className="row g-4 mt-2">
          {steps.map(step => (
            <div className="col-md-6 col-lg-4" key={step.num}>
              <div className="p-4 rounded-4 h-100 position-relative" style={{ background: 'rgba(255, 255, 255, 0.04)', border: '1px solid rgba(212, 175, 55, 0.25)' }}>
                <div className="brand-logo-icon mb-3" style={{ width: '44px', height: '44px', fontSize: '1.1rem' }}>{step.num}</div>
                <h5 className="fw-bold text-white mb-2">Step {step.num}: {step.title}</h5>
                <p className="small text-white-50 mb-0">{step.desc}</p>
              </div>
            </div>
          ))}
        </div>

        <div className="text-center mt-5">
          <button 
            type="button" 
            onClick={() => onOpenEnquiry('Consultation Request')} 
            className="btn btn-gold btn-lg"
          >
            <i className="fas fa-calendar-alt me-2"></i> Book Your Step 1 Consultation
          </button>
        </div>
      </div>
    </section>
  );
}
