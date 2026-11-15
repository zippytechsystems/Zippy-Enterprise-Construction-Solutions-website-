/**
 * ZIPPY ENTERPRISES PRIVATE LIMITED
 * Main Public Frontend Scripts
 */

document.addEventListener('DOMContentLoaded', function () {
  // 1. Sticky Navbar scroll effect
  const navbar = document.querySelector('.navbar-custom');
  if (navbar) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 40) {
        navbar.classList.add('scrolled');
      } else {
        navbar.classList.remove('scrolled');
      }
    });
  }

  // 2. Animated Numerical Counters (IntersectionObserver)
  const counters = document.querySelectorAll('.counter-val');
  if (counters.length > 0) {
    const counterObserver = new IntersectionObserver((entries, observer) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          const counter = entry.target;
          const target = +counter.getAttribute('data-target');
          const prefix = counter.getAttribute('data-prefix') || '';
          const suffix = counter.getAttribute('data-suffix') || '';
          const duration = 1800;
          const stepTime = 20;
          const totalSteps = duration / stepTime;
          const increment = target / totalSteps;
          let current = 0;

          const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
              counter.innerText = prefix + target.toLocaleString('en-IN') + suffix;
              clearInterval(timer);
            } else {
              counter.innerText = prefix + Math.floor(current).toLocaleString('en-IN') + suffix;
            }
          }, stepTime);

          observer.unobserve(counter);
        }
      });
    }, { threshold: 0.3 });

    counters.forEach(counter => counterObserver.observe(counter));
  }

  // 3. AJAX Form submission helper for Leads & Enquiries
  const ajaxForms = document.querySelectorAll('.ajax-enquiry-form');
  ajaxForms.forEach(form => {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const submitBtn = form.querySelector('button[type="submit"]');
      const originalText = submitBtn ? submitBtn.innerHTML : 'Submit';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i> Submitting...';
      }

      const formData = new FormData(form);

      fetch(form.action || 'api/submit-enquiry.php', {
        method: 'POST',
        body: formData
      })
      .then(res => res.json())
      .then(data => {
        if (data.success) {
          showToast('success', data.message || 'Enquiry submitted successfully! Our Senior Project Consultant will contact you within 2 hours.');
          form.reset();
          const modal = bootstrap.Modal.getInstance(form.closest('.modal'));
          if (modal) modal.hide();
        } else {
          showToast('error', data.message || 'There was an error submitting your request. Please try again or call us directly.');
        }
      })
      .catch(err => {
        console.error(err);
        showToast('error', 'Connection error. Please call +91 91212 87654.');
      })
      .finally(() => {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalText;
        }
      });
    });
  });

  // 4. Simple Toast Notification System
  window.showToast = function (type, message) {
    const toastContainer = document.getElementById('toast-container') || createToastContainer();
    const toast = document.createElement('div');
    toast.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show shadow-lg border-0`;
    toast.style.minWidth = '320px';
    toast.style.borderRadius = '12px';
    toast.style.marginBottom = '12px';
    toast.style.backgroundColor = type === 'success' ? '#064E3B' : '#7F1D1D';
    toast.style.color = '#FFFFFF';
    toast.style.borderLeft = type === 'success' ? '5px solid #10B981' : '5px solid #EF4444';
    
    toast.innerHTML = `
      <div class="d-flex align-items-center">
        <i class="fas ${type === 'success' ? 'fa-check-circle text-success' : 'fa-exclamation-triangle text-danger'} fa-lg me-3"></i>
        <div><strong>${type === 'success' ? 'Success' : 'Notice'}</strong><br><small>${message}</small></div>
      </div>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    `;

    toastContainer.appendChild(toast);
    setTimeout(() => {
      toast.classList.remove('show');
      setTimeout(() => toast.remove(), 300);
    }, 6000);
  };

  function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toast-container';
    container.style.position = 'fixed';
    container.style.top = '24px';
    container.style.right = '24px';
    container.style.zIndex = '99999';
    document.body.appendChild(container);
    return container;
  }
});
