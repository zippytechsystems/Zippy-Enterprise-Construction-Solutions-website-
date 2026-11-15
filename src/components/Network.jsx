import React, { useState } from 'react';
import { networkData } from '../data/projectsData';

export default function Network({ onOpenEnquiry }) {
  const [activeCategory, setActiveCategory] = useState('all');

  const categories = [
    { key: 'all', label: 'All Partners' },
    { key: 'builder', label: 'Builders & Contractors' },
    { key: 'structural_engineer', label: 'Structural Consultants' },
    { key: 'architect', label: 'Architects' },
    { key: 'civil_engineer', label: 'Civil QA/QC' },
    { key: 'material_supplier', label: 'Material Suppliers' }
  ];

  const filteredPartners = activeCategory === 'all'
    ? networkData
    : networkData.filter(p => p.category === activeCategory);

  return (
    <section id="network" className="py-5" style={{ background: '#FFFFFF' }}>
      <div className="container py-4">
        <div className="section-header text-center mx-auto" style={{ maxWidth: '780px' }}>
          <span className="section-subtitle">Collaborative Strength</span>
          <h2 className="section-title">Our Professional Construction Network</h2>
          <p className="section-desc mx-auto">
            Zippy Enterprises partners with verified civil contractors, structural vetting consultants, ISO-certified material manufacturers, and premier architects.
          </p>
        </div>

        {/* Category Filter */}
        <div className="d-flex flex-wrap justify-content-center gap-2 mb-5">
          {categories.map(cat => (
            <button
              key={cat.key}
              type="button"
              className={`btn btn-sm px-3 ${activeCategory === cat.key ? 'btn-gold text-dark' : 'btn-outline-secondary'}`}
              onClick={() => setActiveCategory(cat.key)}
            >
              {cat.label}
            </button>
          ))}
        </div>

        {/* Partners Grid */}
        <div className="row g-4">
          {filteredPartners.map(p => (
            <div className="col-md-6 col-lg-4" key={p.id}>
              <div className="card border-0 shadow-sm rounded-4 p-4 h-100 bg-white border" style={{ border: '1px solid var(--border-light)' }}>
                <div className="d-flex justify-content-between align-items-start mb-3">
                  <div className="brand-logo-icon" style={{ width: '46px', height: '46px', fontSize: '1.2rem' }}>
                    <i className="fas fa-hard-hat"></i>
                  </div>
                  <span className="badge bg-success text-white px-2 py-1"><i className="fas fa-check-circle me-1"></i> Verified</span>
                </div>

                <h5 className="fw-bold text-navy mb-1">{p.name}</h5>
                <div className="text-warning small fw-bold mb-3">
                  {p.categoryLabel} &bull; {p.experience}+ Years Exp.
                </div>

                <p className="small text-muted mb-3 flex-grow-1">{p.specialization}</p>

                <div className="pt-3 border-top d-flex justify-content-between align-items-center">
                  <small className="text-muted"><i className="fas fa-map-marker-alt text-warning me-1"></i> {p.areas}</small>
                  <span className="text-warning fw-bold small"><i className="fas fa-star me-1"></i> {p.rating}/5.0</span>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
