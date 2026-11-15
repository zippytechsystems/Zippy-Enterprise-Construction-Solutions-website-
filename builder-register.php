<?php
/**
 * Builder & Contractor Registration Page
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::verifyCsrf()) {
        $error = 'Security session expired. Please reload.';
    } else {
        $contactName  = Security::clean($_POST['contact_name'] ?? '');
        $companyName  = Security::clean($_POST['company_name'] ?? '');
        $email        = Security::clean($_POST['email'] ?? '');
        $phone        = Security::clean($_POST['phone'] ?? '');
        $license      = Security::clean($_POST['license_number'] ?? '');
        $experience   = (int)($_POST['experience_years'] ?? 5);
        $serviceAreas = Security::clean($_POST['service_areas'] ?? '');
        $specialization = Security::clean($_POST['specialization'] ?? '');
        $portfolio    = Security::clean($_POST['portfolio_summary'] ?? '');
        $password     = $_POST['password'] ?? '';
        $confirm      = $_POST['confirm_password'] ?? '';

        if (empty($contactName) || empty($companyName) || empty($email) || empty($phone) || empty($license) || empty($password)) {
            $error = 'Please fill in all mandatory fields.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } else {
            try {
                $db = Database::getConnection();
                
                // Check if user exists
                $chk = $db->prepare("SELECT id FROM users WHERE email = ? OR phone = ?");
                $chk->execute([$email, $phone]);
                if ($chk->fetch()) {
                    $error = 'An account with this email address or phone already exists.';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Insert into users with 'builder' role and 'pending_approval' status
                    $sqlUser = Database::getDriver() === 'mysql'
                        ? "INSERT INTO users (name, email, phone, password_hash, role, status, created_at) VALUES (?, ?, ?, ?, 'builder', 'pending_approval', NOW())"
                        : "INSERT INTO users (name, email, phone, password_hash, role, status, created_at) VALUES (?, ?, ?, ?, 'builder', 'pending_approval', datetime('now'))";
                    
                    $stmtUser = $db->prepare($sqlUser);
                    $stmtUser->execute([$contactName, $email, $phone, $hash]);
                    $userId = $db->lastInsertId();

                    // Insert into builder_profiles
                    $sqlBuilder = Database::getDriver() === 'mysql'
                        ? "INSERT INTO builder_profiles (user_id, company_name, license_number, experience_years, service_areas, specialization, portfolio_summary, verification_status, rating, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', 5.00, NOW())"
                        : "INSERT INTO builder_profiles (user_id, company_name, license_number, experience_years, service_areas, specialization, portfolio_summary, verification_status, rating, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, 'pending', 5.00, datetime('now'))";
                    
                    $stmtBuilder = $db->prepare($sqlBuilder);
                    $stmtBuilder->execute([
                        $userId, $companyName, $license, $experience, $serviceAreas, $specialization, $portfolio
                    ]);

                    // Notify Admin of new contractor application
                    $adminUser = $db->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1")->fetch();
                    if ($adminUser) {
                        Security::createNotification(
                            (int)$adminUser['id'],
                            "New Contractor Accreditation Application",
                            "{$companyName} ({$contactName}) submitted a verification application. License: {$license}",
                            "builders.php"
                        );
                    }

                    Security::logAudit('BUILDER_REGISTERED', "Contractor application submitted by {$companyName} ({$email})");
                    $success = 'Your contractor accreditation application has been submitted successfully! Our Vendor Audit Team will review your GHMC/PWD license and conduct a telephone interview within 48 business hours.';
                }
            } catch (Exception $e) {
                $error = 'Application submission failed: ' . $e->getMessage();
            }
        }
    }
}

$pageTitle = "Builder Accreditation Application";
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5" style="background:#061121; min-height:85vh; display:flex; align-items:center;">
  <div class="container py-4">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="card border-0 shadow-premium rounded-4 overflow-hidden" style="background:#0A192F; border:1px solid var(--border-gold);">
          <div class="p-4 text-center" style="background:#0E2442; color:#FFFFFF; border-bottom:1px solid var(--border-gold);">
            <div class="badge-gold mb-2">PARTNER NETWORK ONBOARDING</div>
            <h3 class="fw-bold mb-1">Contractor Accreditation Application</h3>
            <p class="small text-white-50 mb-0">Join Hyderabad's premier construction execution ecosystem</p>
          </div>

          <div class="card-body p-4 p-md-5">
            <?php if (!empty($success)): ?>
              <div class="alert alert-success p-4 rounded-3 text-center mb-4">
                <i class="fas fa-check-circle fa-2x text-success mb-2"></i>
                <h5 class="fw-bold">Application Received for Verification</h5>
                <p class="small mb-3"><?= e($success) ?></p>
                <a href="index.php" class="btn btn-navy btn-sm">Return to Homepage</a>
              </div>
            <?php else: ?>

              <?php if (!empty($error)): ?>
                <div class="alert alert-danger small p-3 rounded mb-4">
                  <i class="fas fa-exclamation-circle me-1"></i> <?= e($error) ?>
                </div>
              <?php endif; ?>

              <form action="builder-register.php" method="POST">
                <?= Security::csrfField() ?>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Company / Firm Name *</label>
                    <input type="text" name="company_name" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Sri Balaji Constructions Pvt Ltd">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Authorized Contact Person *</label>
                    <input type="text" name="contact_name" class="form-control bg-dark text-white border-secondary" required placeholder="Managing Director / Chief Engineer">
                  </div>
                </div>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Official Email Address *</label>
                    <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="contact@builder.com">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Mobile Phone *</label>
                    <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
                  </div>
                </div>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Contractor License / Registration No. *</label>
                    <input type="text" name="license_number" class="form-control bg-dark text-white border-secondary" required placeholder="GHMC / PWD / MCA Registration">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Years in Civil Construction *</label>
                    <input type="number" name="experience_years" class="form-control bg-dark text-white border-secondary" required min="1" max="50" value="6">
                  </div>
                </div>

                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Primary Specialization *</label>
                    <select name="specialization" class="form-select bg-dark text-white border-secondary" required>
                      <option value="Luxury Residential Independent Villas">Luxury Residential Independent Villas</option>
                      <option value="Commercial Buildings & IT Complexes">Commercial Buildings &amp; IT Complexes</option>
                      <option value="Multi-Storey Apartment Complexes">Multi-Storey Apartment Complexes</option>
                      <option value="Turnkey Civil & Structural Framing">Turnkey Civil &amp; Structural Framing</option>
                      <option value="Industrial Sheds & Warehousing">Industrial Sheds &amp; Warehousing</option>
                    </select>
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Service Areas in Hyderabad *</label>
                    <input type="text" name="service_areas" class="form-control bg-dark text-white border-secondary" required placeholder="e.g. Jubilee Hills, Gachibowli, Kompally">
                  </div>
                </div>

                <div class="mb-3">
                  <label class="form-label small fw-bold text-warning">Brief Company Profile &amp; Past Completed Projects</label>
                  <textarea name="portfolio_summary" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Mention delivered square footage, notable landmarks, equipment fleet, and labor strength..."></textarea>
                </div>

                <div class="row g-3 mb-4">
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Create Account Password *</label>
                    <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required placeholder="Min 6 characters">
                  </div>
                  <div class="col-md-6">
                    <label class="form-label small fw-bold text-warning">Confirm Password *</label>
                    <input type="password" name="confirm_password" class="form-control bg-dark text-white border-secondary" required placeholder="Repeat password">
                  </div>
                </div>

                <div class="p-3 rounded bg-dark border border-secondary small text-white-50 mb-4">
                  <i class="fas fa-info-circle text-warning me-1"></i>
                  <strong>Verification Notice:</strong> Submitting this form creates a provisional builder account. Upon submission, Zippy Enterprises will verify your license details before assigning site projects.
                </div>

                <button type="submit" class="btn btn-gold w-100 py-3 fw-bold">
                  <i class="fas fa-file-contract me-2"></i> Submit Contractor Application
                </button>
              </form>

              <div class="text-center pt-3 mt-3 border-top border-secondary">
                <span class="small text-white-50">Already an accredited contractor?</span>
                <a href="builder-login.php" class="small fw-bold text-warning ms-1">Sign In Here</a>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
