<?php
/**
 * Customer Support & Enquiry History
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole(['customer', 'admin']);
$user = Security::user();
$userId = (int)$user['id'];
$portalTitle = "Customer Support & Concierge";

$sent = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
    $subject = Security::clean($_POST['subject'] ?? '');
    $message = Security::clean($_POST['message'] ?? '');

    try {
        $db = Database::getConnection();
        // Insert notification for Admin
        $adminUser = $db->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1")->fetch();
        if ($adminUser) {
            Security::createNotification(
                (int)$adminUser['id'],
                "Support Ticket: {$subject}",
                "From {$user['name']}: {$message}",
                "customers.php"
            );
        }
        Security::logAudit('SUPPORT_TICKET_CREATED', "Support query submitted by user #{$userId}: {$subject}");
        $sent = true;
    } catch (Exception $e) {}
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="bg-white p-4 rounded-4 shadow-sm border">
      <h4 class="fw-bold text-navy mb-1">Customer Care &amp; Project Concierge</h4>
      <p class="text-muted small mb-0">Direct escalation desk for site queries, material specifications, or billing inquiries.</p>
    </div>
  </div>
</div>

<?php if ($sent): ?>
  <div class="alert alert-success p-3 rounded mb-4"><i class="fas fa-check-circle me-1"></i> Your message has been routed to your Senior Project Coordinator. Resolution target: within 4 hours.</div>
<?php endif; ?>

<div class="row g-4">
  <div class="col-lg-7">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <h5 class="fw-bold text-navy mb-3">Submit a Support Request</h5>
      <form action="support.php" method="POST">
        <?= Security::csrfField() ?>
        
        <div class="mb-3">
          <label class="form-label small fw-bold text-navy">Category / Subject *</label>
          <select name="subject" class="form-select" required>
            <option value="Material Specification Clarification">Material Specification Clarification</option>
            <option value="Milestone Inspection Request">Milestone Inspection Request</option>
            <option value="Billing / Invoice Query">Billing / Invoice Query</option>
            <option value="Architectural Drawing Revision">Architectural Drawing Revision</option>
            <option value="General Query">General Support Query</option>
          </select>
        </div>

        <div class="mb-4">
          <label class="form-label small fw-bold text-navy">Detailed Message *</label>
          <textarea name="message" rows="5" class="form-control" required placeholder="Describe your query or request in detail..."></textarea>
        </div>

        <button type="submit" class="btn btn-gold py-2 px-4 fw-bold">
          <i class="fas fa-paper-plane me-2"></i> Submit Request
        </button>
      </form>
    </div>
  </div>

  <div class="col-lg-5">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white mb-4">
      <h5 class="fw-bold text-navy mb-3">Your Dedicated Project Team</h5>
      
      <div class="d-flex align-items-center mb-3">
        <div class="brand-logo-icon me-3" style="width:44px; height:44px; font-size:1.1rem;"><i class="fas fa-user-tie"></i></div>
        <div>
          <h6 class="fw-bold text-navy mb-0">Er. Vikram Rao</h6>
          <small class="text-muted">Chief Project Officer (PMC)</small><br>
          <small class="text-navy fw-semibold"><i class="fas fa-phone-alt me-1"></i> +91 91212 87654 (Ext 104)</small>
        </div>
      </div>

      <div class="d-flex align-items-center mb-3">
        <div class="brand-logo-icon me-3" style="width:44px; height:44px; font-size:1.1rem;"><i class="fas fa-hard-hat"></i></div>
        <div>
          <h6 class="fw-bold text-navy mb-0">Er. S. Kumar</h6>
          <small class="text-muted">Senior Site Supervisor (Jubilee Hills)</small><br>
          <small class="text-navy fw-semibold"><i class="fas fa-phone-alt me-1"></i> +91 91212 87654 (Ext 112)</small>
        </div>
      </div>

      <div class="p-3 rounded mt-3" style="background:#F8FAFC; border:1px solid #E2E8F0;">
        <small class="fw-bold text-navy d-block mb-1"><i class="fab fa-whatsapp text-success me-1"></i> Instant WhatsApp Channel</small>
        <span class="small text-muted">For urgent on-site updates, ping our official support team at <a href="https://wa.me/<?= COMPANY_WHATSAPP ?>" target="_blank" class="text-success fw-bold">+91 <?= COMPANY_WHATSAPP ?></a></span>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
