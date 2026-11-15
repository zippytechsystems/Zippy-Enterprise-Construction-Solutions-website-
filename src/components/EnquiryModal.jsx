import React, { useState } from 'react';

export default function EnquiryModal({ isOpen, onClose, initialService }) {
  const [formData, setFormData] = useState({
    full_name: '',
    phone: '',
    email: '',
    project_location: '',
    construction_type: initialService || 'Residential Building Construction',
    plot_size: '',
    built_up_area: '',
    number_of_floors: 'Ground + 1 Floor (G+1)',
    approx_budget: '₹1.5 Crores - ₹3.0 Crores',
    project_requirements: ''
  });

  const [loading, setLoading] = useState(false);
  const [result, setResult] = useState(null);

  if (!isOpen) return null;

  const handleChange = (e) => {
    setFormData({ ...formData, [e.target.name]: e.target.value });
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setResult(null);

    const bodyData = new URLSearchParams();
    Object.keys(formData).forEach(key => {
      bodyData.append(key, formData[key]);
    });
    bodyData.append('source', 'react_10_field_modal');

    // Get CSRF token from page meta or input if available
    const csrfInput = document.querySelector('input[name="csrf_token"]');
    if (csrfInput) {
      bodyData.append('csrf_token', csrfInput.value);
    }

    try {
      const res = await fetch('api/submit-enquiry.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
        body: bodyData.toString()
      });
      const data = await res.json();
      setResult(data);
    } catch (err) {
      setResult({
        success: false,
        message: 'Network error occurred. Please call +91 95424 39498 or message on WhatsApp.'
      });
    } finally {
      setLoading(false);
    }
  };

  return (
    <div className="modal show d-block" tabIndex="-1" style={{ backgroundColor: 'rgba(0,0,0,0.8)' }}>
      <div className="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div className="modal-content border-0 shadow-lg" style={{ background: '#0A192F', color: '#FFFFFF', border: '1px solid var(--border-gold)', borderRadius: '16px' }}>
          <div className="modal-header border-secondary">
            <div>
              <div className="badge-gold mb-1">10-FIELD SPECIFICATION FORM</div>
              <h5 className="modal-title fw-bold text-white">Request a Detailed Construction Quotation</h5>
            </div>
            <button type="button" className="btn-close btn-close-white" onClick={onClose} aria-label="Close"></button>
          </div>

          <div className="modal-body p-4">
            {result ? (
              <div className="text-center py-4">
                {result.success ? (
                  <>
                    <div className="text-success display-4 mb-3"><i className="fas fa-check-circle"></i></div>
                    <h4 className="text-white fw-bold mb-2">Enquiry Successfully Logged!</h4>
                    <p className="text-warning fw-bold fs-5 mb-2">Reference ID: {result.enquiry_number}</p>
                    <p className="text-white-50 mb-4">{result.message}</p>
                    {result.whatsapp_url && (
                      <a 
                        href={result.whatsapp_url} 
                        target="_blank" 
                        rel="noopener noreferrer" 
                        className="btn btn-success btn-lg px-4"
                      >
                        <i className="fab fa-whatsapp me-2"></i> Connect on WhatsApp Instantly
                      </a>
                    )}
                  </>
                ) : (
                  <>
                    <div className="text-danger display-4 mb-3"><i className="fas fa-exclamation-triangle"></i></div>
                    <h5 className="text-white fw-bold mb-2">Submission Error</h5>
                    <p className="text-white-50 mb-4">{result.message}</p>
                    <button type="button" className="btn btn-gold" onClick={() => setResult(null)}>
                      Try Again
                    </button>
                  </>
                )}
              </div>
            ) : (
              <form onSubmit={handleSubmit}>
                <div className="row g-3 mb-3">
                  <div className="col-md-6">
                    <label className="form-label text-warning small fw-bold">1. Full Name *</label>
                    <input 
                      type="text" 
                      name="full_name" 
                      className="form-control bg-dark text-white border-secondary" 
                      required 
                      value={formData.full_name} 
                      onChange={handleChange}
                      placeholder="e.g. Rajesh Kumar" 
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label text-warning small fw-bold">2. Phone Number *</label>
                    <input 
                      type="tel" 
                      name="phone" 
                      className="form-control bg-dark text-white border-secondary" 
                      required 
                      value={formData.phone} 
                      onChange={handleChange}
                      placeholder="+91 98765 43210" 
                    />
                  </div>
                </div>

                <div className="row g-3 mb-3">
                  <div className="col-md-6">
                    <label className="form-label text-warning small fw-bold">3. Email Address *</label>
                    <input 
                      type="email" 
                      name="email" 
                      className="form-control bg-dark text-white border-secondary" 
                      required 
                      value={formData.email} 
                      onChange={handleChange}
                      placeholder="name@domain.com" 
                    />
                  </div>
                  <div className="col-md-6">
                    <label className="form-label text-warning small fw-bold">4. Project Location *</label>
                    <input 
                      type="text" 
                      name="project_location" 
                      className="form-control bg-dark text-white border-secondary" 
                      required 
                      value={formData.project_location} 
                      onChange={handleChange}
                      placeholder="e.g. Nacharam, Jubilee Hills, Tellapur" 
                    />
                  </div>
                </div>

                <div className="row g-3 mb-3">
                  <div className="col-md-6">
                    <label className="form-label text-warning small fw-bold">5. Construction Type *</label>
                    <select 
                      name="construction_type" 
                      className="form-select bg-dark text-white border-secondary" 
                      value={formData.construction_type} 
                      onChange={handleChange}
                    >
                      <option value="Residential Building Construction">Residential Building Construction</option>
                      <option value="Independent House Construction">Independent House Construction</option>
                      <option value="Luxury Villa Construction">Luxury Villa Construction</option>
                      <option value="Commercial Building Construction">Commercial Building Construction</option>
                      <option value="Apartment Development">Apartment Development</option>
                      <option value="Turnkey Construction Projects">Turnkey Construction Projects</option>
                      <option value="Architectural & Structural Design">Architectural &amp; Structural Design</option>
                      <option value="Self-Construction Loan Assistance">Self-Construction Loan Assistance</option>
                    </select>
                  </div>
                  <div className="col-md-6">
                    <label className="form-label text-warning small fw-bold">6. Plot Size (Sq.Yards)</label>
                    <input 
                      type="text" 
                      name="plot_size" 
                      className="form-control bg-dark text-white border-secondary" 
                      value={formData.plot_size} 
                      onChange={handleChange}
                      placeholder="e.g. 300 Sq.Yards (30 x 90 ft)" 
                    />
                  </div>
                </div>

                <div className="row g-3 mb-3">
                  <div className="col-md-4">
                    <label className="form-label text-warning small fw-bold">7. Built-Up Area (Sq.Ft)</label>
                    <input 
                      type="text" 
                      name="built_up_area" 
                      className="form-control bg-dark text-white border-secondary" 
                      value={formData.built_up_area} 
                      onChange={handleChange}
                      placeholder="e.g. 3,500 Sq.Ft" 
                    />
                  </div>
                  <div className="col-md-4">
                    <label className="form-label text-warning small fw-bold">8. Number of Floors</label>
                    <select 
                      name="number_of_floors" 
                      className="form-select bg-dark text-white border-secondary" 
                      value={formData.number_of_floors} 
                      onChange={handleChange}
                    >
                      <option value="Ground Only (G)">Ground Only (G)</option>
                      <option value="Ground + 1 Floor (G+1)">Ground + 1 Floor (G+1)</option>
                      <option value="Ground + 2 Floors (G+2)">Ground + 2 Floors (G+2)</option>
                      <option value="Ground + 3 Floors (G+3)">Ground + 3 Floors (G+3)</option>
                      <option value="G+4 / Multi-Storey">G+4 / Multi-Storey</option>
                    </select>
                  </div>
                  <div className="col-md-4">
                    <label className="form-label text-warning small fw-bold">9. Budget Range</label>
                    <select 
                      name="approx_budget" 
                      className="form-select bg-dark text-white border-secondary" 
                      value={formData.approx_budget} 
                      onChange={handleChange}
                    >
                      <option value="₹75 Lakhs - ₹1.5 Crores">₹75 Lakhs - ₹1.5 Crores</option>
                      <option value="₹1.5 Crores - ₹3.0 Crores">₹1.5 Crores - ₹3.0 Crores</option>
                      <option value="₹3.0 Crores - ₹7.0 Crores">₹3.0 Crores - ₹7.0 Crores</option>
                      <option value="₹7.0 Crores+">₹7.0 Crores+ (Commercial / Luxury)</option>
                    </select>
                  </div>
                </div>

                <div className="mb-4">
                  <label className="form-label text-warning small fw-bold">10. Project Requirements / Notes</label>
                  <textarea 
                    name="project_requirements" 
                    rows="3" 
                    className="form-control bg-dark text-white border-secondary" 
                    value={formData.project_requirements} 
                    onChange={handleChange}
                    placeholder="Describe plot orientation, Vastu preferences, timeline, or material requests..."
                  ></textarea>
                </div>

                <div className="d-flex justify-content-end gap-2">
                  <button type="button" className="btn btn-secondary" onClick={onClose}>Cancel</button>
                  <button type="submit" className="btn btn-gold px-4" disabled={loading}>
                    {loading ? (
                      <>
                        <span className="spinner-border spinner-border-sm me-2"></span> Submitting...
                      </>
                    ) : (
                      <>
                        <i className="fas fa-paper-plane me-2"></i> Submit Construction Enquiry
                      </>
                    )}
                  </button>
                </div>
              </form>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
