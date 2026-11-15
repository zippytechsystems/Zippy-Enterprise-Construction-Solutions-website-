import React, { useState } from 'react';

export default function Gallery() {
  const [selectedImg, setSelectedImg] = useState(null);

  const galleryItems = [
    { img: 'assets/images/projects/project-1.jpg', title: 'Signature Villa Facade', cat: 'Architecture', loc: 'Jubilee Hills' },
    { img: 'assets/images/projects/project-2.jpg', title: 'Commercial IT Tower Glazing', cat: 'Commercial', loc: 'Financial District' },
    { img: 'assets/images/projects/project-3.jpg', title: 'Duplex Residence Elevation', cat: 'Residential', loc: 'Kompally' },
    { img: 'assets/images/services/residential.jpg', title: 'Living Room Italian Marble', cat: 'Interiors', loc: 'Banjara Hills' },
    { img: 'assets/images/services/commercial.jpg', title: 'Structural Framing & Columns', cat: 'Civil Execution', loc: 'Madhapur' },
    { img: 'assets/images/services/apartment.jpg', title: 'Apartment Elevation & Basements', cat: 'Multi-Unit', loc: 'Kokapet' }
  ];

  return (
    <section id="gallery" className="py-5" style={{ background: '#F8FAFC' }}>
      <div className="container py-4">
        <div className="section-header text-center mx-auto" style={{ maxWidth: '720px' }}>
          <span className="section-subtitle">Visual Excellence</span>
          <h2 className="section-title">Architectural &amp; Site Construction Gallery</h2>
          <p className="section-desc mx-auto">
            Explore photographic documentation of our civil execution, structural milestones, and finished luxury interiors.
          </p>
        </div>

        <div className="row g-4">
          {galleryItems.map((item, idx) => (
            <div className="col-md-6 col-lg-4" key={idx}>
              <div 
                className="card border-0 shadow-sm rounded-4 overflow-hidden position-relative group-gallery cursor-pointer" 
                style={{ height: '280px', background: '#0A192F', cursor: 'pointer' }}
                onClick={() => setSelectedImg(item)}
              >
                <img src={item.img} alt={item.title} className="w-100 h-100 object-fit-cover transition-smooth" />
                <div className="position-absolute bottom-0 start-0 end-0 p-3" style={{ background: 'linear-gradient(0deg, rgba(6,17,33,0.95) 0%, rgba(6,17,33,0) 100%)' }}>
                  <span className="badge bg-warning text-dark fw-bold text-uppercase" style={{ fontSize: '0.65rem' }}>{item.cat}</span>
                  <h5 className="text-white fw-bold mt-1 mb-0">{item.title}</h5>
                  <small className="text-white-50"><i className="fas fa-map-marker-alt text-warning me-1"></i> {item.loc}</small>
                </div>
              </div>
            </div>
          ))}
        </div>

        {/* Modal Lightbox */}
        {selectedImg && (
          <div 
            className="modal show d-block" 
            tabIndex="-1" 
            style={{ backgroundColor: 'rgba(0,0,0,0.85)' }}
            onClick={() => setSelectedImg(null)}
          >
            <div className="modal-dialog modal-lg modal-dialog-centered" onClick={e => e.stopPropagation()}>
              <div className="modal-content bg-dark text-white border-gold">
                <div className="modal-header border-secondary">
                  <h5 className="modal-title">{selectedImg.title} ({selectedImg.loc})</h5>
                  <button type="button" className="btn-close btn-close-white" onClick={() => setSelectedImg(null)}></button>
                </div>
                <div className="modal-body p-0">
                  <img src={selectedImg.img} alt={selectedImg.title} className="w-100 object-fit-cover rounded-bottom" style={{ maxHeight: '70vh' }} />
                </div>
              </div>
            </div>
          </div>
        )}
      </div>
    </section>
  );
}
