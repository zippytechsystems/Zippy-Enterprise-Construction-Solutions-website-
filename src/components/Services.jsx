import React, { useState } from 'react';
import { servicesData } from '../data/servicesData';

export default function Services({ onOpenEnquiry }) {
  const [activeCategory, setActiveCategory] = useState('all');

  const categories = [
    { key: 'all', label: 'All 15 Services' },
    { key: 'residential', label: 'Residential & Villas' },
    { key: 'commercial', label: 'Commercial Hubs' },
    { key: 'apartment', label: 'Apartments & JV' },
    { key: 'turnkey', label: 'Turnkey EPC' },
    { key: 'engineering', label: 'Engineering & Design' }
  ];

  const filteredServices = activeCategory === 'all' 
    ? servicesData 
    : servicesData.filter(s => s.category === activeCategory);

  return (
    <section id="services" className="py-5" style={{ background: '#F8FAFC' }}>
      <div className="container py-4">
        <div className="section-header text-center mx-auto" style={{ maxWidth: '780px' }}>
          <span className="section-subtitle">Complete Construction Ecosystem</span>
          <h2 className="section-title">Our 15 Specialized Construction Solutions</h2>
          <p className="section-desc mx-auto">
            From luxury independent villas in Jubilee Hills to multi-unit apartments in Kokapet and corporate IT hubs, Zippy delivers end-to-end civil execution.
          </p>
        </div>

        {/* Category Tabs */}
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

        {/* Services Grid */}
        <div className="row g-4">
          {filteredServices.map((service, idx) => (
            <div className="col-md-6 col-lg-4" key={service.id}>
              <div className="card-service h-100 d-flex flex-column">
                <div className="card-service-img-wrapper" style={{ height: '220px', overflow: 'hidden' }}>
                  <img src={service.img} alt={service.title} className="card-service-img w-100 h-100 object-fit-cover" />
                  <span className="card-service-badge">{service.badge}</span>
                </div>
                <div className="card-service-body d-flex flex-column flex-grow-1 p-4">
                  <div className="text-warning small fw-bold mb-1">Service #{String(idx + 1).padStart(2, '0')}</div>
                  <h3 className="card-service-title h5 fw-bold text-navy mb-2">{service.title}</h3>
                  <p className="card-service-text small text-muted mb-3 flex-grow-1">{service.desc}</p>

                  <ul className="list-unstyled small text-muted mb-3">
                    {service.features.map((feat, fIdx) => (
                      <li key={fIdx} className="mb-1">
                        <i className="fas fa-check text-warning me-2"></i>{feat}
                      </li>
                    ))}
                  </ul>

                  <div className="card-service-footer pt-3 border-top d-flex justify-content-between align-items-center">
                    <button 
                      type="button" 
                      onClick={() => onOpenEnquiry(service.title)} 
                      className="btn btn-sm btn-gold px-3"
                    >
                      <i className="fas fa-paper-plane me-1"></i> Enquire Now
                    </button>
                    <a 
                      href={`https://wa.me/916302690251?text=${encodeURIComponent(`Hello Zippy Enterprises, I am interested in ${service.title}.`)}`}
                      target="_blank" 
                      rel="noopener noreferrer"
                      className="text-success small fw-bold text-decoration-none"
                    >
                      <i className="fab fa-whatsapp me-1"></i> WhatsApp
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
