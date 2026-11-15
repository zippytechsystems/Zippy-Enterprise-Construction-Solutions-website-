import React from 'react';

export default function WhatsAppWidget() {
  const whatsappUrl = "https://wa.me/916302690251?text=" + encodeURIComponent("Hello Zippy Enterprises! I am interested in building a construction project in Hyderabad and would like to speak with a Project Consultant.");

  return (
    <a 
      href={whatsappUrl} 
      className="whatsapp-floating" 
      target="_blank" 
      rel="noopener noreferrer" 
      title="Chat with Zippy Construction Consultant on WhatsApp (+91 63026 90251)"
    >
      <div className="whatsapp-pulse"></div>
      <i className="fab fa-whatsapp"></i>
    </a>
  );
}
