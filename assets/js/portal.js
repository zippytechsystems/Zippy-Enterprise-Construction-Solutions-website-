/**
 * ZIPPY ENTERPRISES PRIVATE LIMITED
 * Portal & Dashboard Interaction Logic
 */

document.addEventListener('DOMContentLoaded', function () {
  // Mobile Sidebar Toggle
  const sidebarToggle = document.getElementById('sidebar-toggle-btn');
  const sidebar = document.querySelector('.portal-sidebar');
  if (sidebarToggle && sidebar) {
    sidebarToggle.addEventListener('click', function () {
      sidebar.classList.toggle('show');
    });
  }

  // Auto-dismiss alerts after 5 seconds
  const alerts = document.querySelectorAll('.portal-body .alert-dismissible');
  alerts.forEach(alert => {
    setTimeout(() => {
      const bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
      if (bsAlert) bsAlert.close();
    }, 5000);
  });
});
