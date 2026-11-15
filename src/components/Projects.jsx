import React, { useState } from 'react';
import { projectsData } from '../data/projectsData';

export default function Projects({ onOpenEnquiry }) {
  const [filter, setFilter] = useState('all');

  const filterTabs = [
    { key: 'all', label: 'All Projects' },
    { key: 'residential', label: 'Residential' },
    { key: 'villa', label: 'Luxury Villas' },
    { key: 'commercial', label: 'Commercial Towers' },
    { key: 'apartment', label: 'Apartments' },
    { key: 'ongoing', label: 'Ongoing' },
    { key: 'completed', label: 'Completed' }
  ];

  const filteredProjects = projectsData.filter(p => {
    if (filter === 'all') return true;
    if (filter === 'residential') return p.category === 'independent' || p.category === 'villa';
    if (filter === 'ongoing') return p.status === 'ongoing';
    if (filter === 'completed') return p.status === 'completed';
    return p.category === filter;
  });

  return (
    <section id="projects" className="py-5" style={{ background: '#FFFFFF' }}>
      <div className="container py-4">
        <div className="section-header text-center mx-auto" style={{ maxWidth: '760px' }}>
          <span className="section-subtitle">Portfolio of Distinction</span>
          <h2 className="section-title">Our Landmark Construction Developments</h2>
          <p className="section-desc mx-auto">
            Browse delivered estates and active ongoing projects executed by Zippy across Jubilee Hills, Financial District, Kompally, and Kokapet.
          </p>
        </div>

        {/* Filter Buttons */}
        <div className="d-flex flex-wrap justify-content-center gap-2 mb-5">
          {filterTabs.map(tab => (
            <button
              key={tab.key}
              type="button"
              className={`btn btn-sm px-3 ${filter === tab.key ? 'btn-gold text-dark' : 'btn-outline-secondary'}`}
              onClick={() => setFilter(tab.key)}
            >
              {tab.label}
            </button>
          ))}
        </div>

        {/* Projects Grid */}
        <div className="row g-4">
          {filteredProjects.map(prj => (
            <div className="col-md-6 col-lg-4" key={prj.id}>
              <div className="card h-100 border-0 shadow-sm rounded-4 overflow-hidden d-flex flex-column" style={{ border: '1px solid #E2E8F0' }}>
                <div className="position-relative overflow-hidden" style={{ height: '240px' }}>
                  <img src={prj.img} alt={prj.title} className="w-100 h-100 object-fit-cover transition-smooth" />
                  <span className="position-absolute top-0 start-0 m-3 badge bg-dark text-warning border border-warning" style={{ fontSize: '0.75rem' }}>
                    {prj.categoryLabel}
                  </span>
                  <span className={`position-absolute top-0 end-0 m-3 badge ${prj.status === 'completed' ? 'bg-success' : 'bg-warning text-dark'} fw-bold text-uppercase`} style={{ fontSize: '0.75rem' }}>
                    {prj.statusLabel}
                  </span>
                </div>
                <div className="p-4 d-flex flex-column flex-grow-1">
                  <div className="text-muted small mb-1">
                    <i className="fas fa-map-marker-alt text-warning me-1"></i> {prj.location}, {prj.city}
                  </div>
                  <h3 className="h5 fw-bold text-navy mb-2">{prj.title}</h3>
                  <p className="text-muted small mb-3 flex-grow-1">{prj.desc}</p>

                  <div className="row g-2 p-2 rounded-3 mb-3 text-center" style={{ background: '#F8FAFC', border: '1px solid #EDF2F7' }}>
                    <div className="col-6 border-end">
                      <span className="d-block text-muted" style={{ fontSize: '0.7rem' }}>BUILT-UP AREA</span>
                      <span className="fw-bold text-navy small">{prj.builtUpArea.toLocaleString()} Sq.Ft.</span>
                    </div>
                    <div className="col-6">
                      <span className="d-block text-muted" style={{ fontSize: '0.7rem' }}>FLOORS</span>
                      <span className="fw-bold text-navy small">{prj.floors} Levels</span>
                    </div>
                  </div>

                  <div className="d-flex gap-2">
                    <button 
                      type="button" 
                      onClick={() => onOpenEnquiry(`Inquiry regarding ${prj.title} (${prj.code})`)}
                      className="btn btn-navy btn-sm flex-grow-1"
                    >
                      <i className="fas fa-envelope-open-text me-1"></i> Enquire Project
                    </button>
                    <a 
                      href={`https://wa.me/916302690251?text=${encodeURIComponent(`Hello Zippy Enterprises, I am inquiring about ${prj.title} (${prj.code}).`)}`}
                      target="_blank"
                      rel="noopener noreferrer"
                      className="btn btn-outline-success btn-sm px-3"
                      title="Chat on WhatsApp"
                    >
                      <i className="fab fa-whatsapp"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
