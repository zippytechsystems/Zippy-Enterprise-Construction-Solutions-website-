import React from 'react';

export default function LoanAssistance({ onOpenEnquiry }) {
  return (
    <section id="loan" className="py-5" style={{ background: '#F8FAFC' }}>
      <div className="container py-4">
        <div className="row g-5 align-items-center">
          <div className="col-lg-7">
            <span className="section-subtitle">Financial Facilitation</span>
            <h2 className="section-title">Self-Construction Home Loan Assistance</h2>
            <p className="lead text-muted">
              Constructing on your private plot? Banks require rigorous technical scrutiny, stage-wise estimates, valuation certificates, and municipal sanction drawings before disbursing construction loan tranches.
            </p>
            <p className="text-secondary">
              Zippy Enterprises coordinates directly with lending bank engineering panels (SBI, HDFC Bank, ICICI Bank, Axis Bank) to ensure 100% compliant documentation and prompt milestone fund disbursements.
            </p>

            <div className="row g-3 mt-4">
              <div className="col-sm-6">
                <div className="p-3 rounded bg-white border">
                  <h6 className="fw-bold text-navy mb-1"><i className="fas fa-file-invoice-dollar text-warning me-2"></i> Chartered Engineer BOQ</h6>
                  <p className="small text-muted mb-0">Format-compliant itemized estimates that satisfy bank technical inspection panels.</p>
                </div>
              </div>
              <div className="col-sm-6">
                <div className="p-3 rounded bg-white border">
                  <h6 className="fw-bold text-navy mb-1"><i className="fas fa-tasks text-warning me-2"></i> Stage-Wise Certificates</h6>
                  <p className="small text-muted mb-0">Disbursement certificates issued promptly as construction hits structural stages.</p>
                </div>
              </div>
            </div>

            <div className="mt-4 pt-2">
              <button 
                type="button" 
                onClick={() => onOpenEnquiry('Self-Construction Loan Assistance')} 
                className="btn btn-navy"
              >
                <i className="fas fa-landmark me-2"></i> Apply For Loan Estimation Support
              </button>
            </div>
          </div>

          <div className="col-lg-5">
            <div className="card border-0 shadow-lg p-4 p-md-5 rounded-4" style={{ background: '#0A192F', color: '#FFFFFF', border: '1px solid var(--border-gold)' }}>
              <div className="badge-gold mb-2">LOAN DOCUMENT CHECKLIST</div>
              <h4 className="text-white fw-bold mb-3">Required Bank Documents</h4>
              <ul className="list-unstyled small text-white-50 mb-4">
                <li className="mb-2"><i className="fas fa-check text-warning me-2"></i> Registered Sale Deed of the Plot</li>
                <li className="mb-2"><i className="fas fa-check text-warning me-2"></i> Latest 30-Year Encumbrance Certificate (EC)</li>
                <li className="mb-2"><i className="fas fa-check text-warning me-2"></i> GHMC / HMDA Approved Sanction Drawing</li>
                <li className="mb-2"><i className="fas fa-check text-warning me-2"></i> Detailed Construction Estimate by Chartered Eng.</li>
                <li className="mb-2"><i className="fas fa-check text-warning me-2"></i> Tri-Party Construction Agreement (Zippy)</li>
                <li className="mb-2"><i className="fas fa-check text-warning me-2"></i> Soil Test Report &amp; Structural Stability Letter</li>
              </ul>
              <div className="p-3 rounded" style={{ background: 'rgba(212,175,55,0.08)', border: '1px solid rgba(212,175,55,0.25)' }}>
                <small className="text-warning fw-bold d-block mb-1">Bank Panel Tie-Ups</small>
                <span className="text-white-50 small">SBI &bull; HDFC Bank &bull; ICICI Bank &bull; Axis Bank &bull; Bank of Baroda</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
