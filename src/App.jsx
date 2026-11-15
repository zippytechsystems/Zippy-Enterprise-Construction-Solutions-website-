import React, { useState } from 'react';
import Navbar from './components/Navbar';
import Hero from './components/Hero';
import About from './components/About';
import Services from './components/Services';
import Projects from './components/Projects';
import Process from './components/Process';
import Gallery from './components/Gallery';
import Network from './components/Network';
import LoanAssistance from './components/LoanAssistance';
import Contact from './components/Contact';
import Footer from './components/Footer';
import WhatsAppWidget from './components/WhatsAppWidget';
import EnquiryModal from './components/EnquiryModal';

export default function App() {
  const [modalOpen, setModalOpen] = useState(false);
  const [initialService, setInitialService] = useState('Residential Building Construction');
  const [activeSection, setActiveSection] = useState('hero');

  const handleOpenEnquiry = (serviceName = 'General Construction Enquiry') => {
    setInitialService(serviceName);
    setModalOpen(true);
  };

  const handleNavigate = (sectionId) => {
    setActiveSection(sectionId);
    const element = document.getElementById(sectionId);
    if (element) {
      element.scrollIntoView({ behavior: 'smooth' });
    }
  };

  return (
    <div className="zippy-react-app">
      <Navbar 
        onOpenEnquiry={handleOpenEnquiry} 
        activeSection={activeSection}
        onNavigate={handleNavigate}
      />

      <main>
        <Hero 
          onOpenEnquiry={handleOpenEnquiry} 
          onNavigate={handleNavigate} 
        />
        <About 
          onOpenEnquiry={handleOpenEnquiry} 
        />
        <Services 
          onOpenEnquiry={handleOpenEnquiry} 
        />
        <Projects 
          onOpenEnquiry={handleOpenEnquiry} 
        />
        <Process 
          onOpenEnquiry={handleOpenEnquiry} 
        />
        <Gallery />
        <Network 
          onOpenEnquiry={handleOpenEnquiry} 
        />
        <LoanAssistance 
          onOpenEnquiry={handleOpenEnquiry} 
        />
        <Contact 
          onOpenEnquiry={handleOpenEnquiry} 
        />
      </main>

      <Footer 
        onOpenEnquiry={handleOpenEnquiry} 
        onNavigate={handleNavigate} 
      />

      <WhatsAppWidget />

      <EnquiryModal 
        isOpen={modalOpen} 
        onClose={() => setModalOpen(false)} 
        initialService={initialService} 
      />
    </div>
  );
}
