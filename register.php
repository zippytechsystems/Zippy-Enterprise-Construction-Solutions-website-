<?php
/**
 * Customer Registration Page
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/config/database.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::verifyCsrf()) {
        $error = 'Security token invalid. Please refresh and try again.';
    } else {
        $name     = Security::clean($_POST['name'] ?? '');
        $email    = Security::clean($_POST['email'] ?? '');
        $phone    = Security::clean($_POST['phone'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirm  = $_POST['confirm_password'] ?? '';

        if (empty($name) || empty($email) || empty($phone) || empty($password)) {
            $error = 'All fields are mandatory.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters long.';
        } else {
            try {
                $db = Database::getConnection();
                
                // Check if email or phone exists
                $chk = $db->prepare("SELECT id FROM users WHERE email = ? OR phone = ?");
                $chk->execute([$email, $phone]);
                if ($chk->fetch()) {
                    $error = 'An account with this email address or phone number already exists.';
                } else {
                    $hash = password_hash($password, PASSWORD_DEFAULT);
                    $sql = Database::getDriver() === 'mysql'
                        ? "INSERT INTO users (name, email, phone, password_hash, role, status, created_at) VALUES (?, ?, ?, ?, 'customer', 'active', NOW())"
                        : "INSERT INTO users (name, email, phone, password_hash, role, status, created_at) VALUES (?, ?, ?, ?, 'customer', 'active', datetime('now'))";
                    
                    $stmt = $db->prepare($sql);
                    $stmt->execute([$name, $email, $phone, $hash]);
                    $userId = $db->lastInsertId();

                    // Create welcome notification
                    Security::createNotification(
                        (int)$userId,
                        "Welcome to Zippy Enterprises!",
                        "Your customer portal account is ready. You can now track enquiries, view estimates, and request site inspections.",
                        "portal/customer/index.php"
                    );

                    Security::logAudit('CUSTOMER_REGISTERED', "New customer registration: {$name} ({$email})");

                    Security::setFlash('success', 'Your account has been created successfully! Please sign in below.');
                    header('Location: login.php');
                    exit;
                }
            } catch (Exception $e) {
                $error = 'Registration failed: ' . $e->getMessage();
            }
        }
    }
}

$pageTitle = "Customer Registration";
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5" style="background:#F1F5F9; min-height:85vh; display:flex; align-items:center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-6">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
          <div class="p-4 text-center" style="background:#0A192F; color:#FFFFFF; border-bottom:1px solid var(--border-gold);">
            <div class="brand-logo-icon mx-auto mb-2" style="width:48px; height:48px; font-size:1.3rem;">
              <i class="fas fa-user-plus"></i>
            </div>
            <h4 class="fw-bold mb-1">Create Customer Account</h4>
            <p class="small text-white-50 mb-0">Track your residential or commercial project 24/7</p>
          </div>

          <div class="card-body p-4 p-md-5 bg-white">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger small p-3 rounded mb-4">
                <i class="fas fa-exclamation-circle me-1"></i> <?= e($error) ?>
              </div>
            <?php endif; ?>

            <form action="register.php" method="POST">
              <?= Security::csrfField() ?>

              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Full Name *</label>
                <input type="text" name="name" class="form-control" required placeholder="Enter your full name" value="<?= e($_POST['name'] ?? '') ?>">
              </div>

              <div class="row g-2 mb-3">
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Email Address *</label>
                  <input type="email" name="email" class="form-control" required placeholder="name@domain.com" value="<?= e($_POST['email'] ?? '') ?>">
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Mobile Number *</label>
                  <input type="tel" name="phone" class="form-control" required placeholder="+91 98765 43210" value="<?= e($_POST['phone'] ?? '') ?>">
                </div>
              </div>

              <div class="row g-2 mb-4">
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Create Password *</label>
                  <input type="password" name="password" class="form-control" required placeholder="Min 6 characters">
                </div>
                <div class="col-md-6">
                  <label class="form-label small fw-bold text-navy">Confirm Password *</label>
                  <input type="password" name="confirm_password" class="form-control" required placeholder="Repeat password">
                </div>
              </div>

              <div class="form-check small text-muted mb-4">
                <input class="form-check-input" type="checkbox" required id="agreeTerms">
                <label class="form-check-label" for="agreeTerms">
                  I agree to the <a href="terms.php" target="_blank">Terms of Service</a> and <a href="privacy-policy.php" target="_blank">Privacy Policy</a> of Zippy Enterprises Private Limited.
                </label>
              </div>

              <button type="submit" class="btn btn-gold w-100 py-2 fw-bold mb-3">
                <i class="fas fa-check-circle me-2"></i> Register Account
              </button>
            </form>

            <div class="text-center pt-3 border-top">
              <span class="small text-muted">Already have a customer portal account?</span>
              <a href="login.php" class="small fw-bold text-navy ms-1">Sign In Here</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
