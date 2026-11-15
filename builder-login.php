<?php
/**
 * Builder & Contractor Portal Login
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/config/database.php';

$error = '';

if (Security::check()) {
    $role = Security::role();
    if ($role === 'builder') header('Location: portal/builder/index.php');
    elseif ($role === 'admin') header('Location: portal/admin/index.php');
    else header('Location: portal/customer/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::verifyCsrf()) {
        $error = 'Security session expired. Please reload.';
    } else {
        $email = Security::clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = 'Please enter your registered contractor email and password.';
        } else {
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("SELECT u.*, bp.verification_status, bp.company_name FROM users u LEFT JOIN builder_profiles bp ON u.id = bp.user_id WHERE u.email = ? AND u.role = 'builder' LIMIT 1");
                $stmt->execute([$email]);
                $builder = $stmt->fetch();

                if ($builder && password_verify($password, $builder['password_hash'])) {
                    if ($builder['verification_status'] === 'pending') {
                        $error = 'Your contractor profile is pending Executive Admin verification. You will be notified via SMS/email upon approval.';
                    } elseif ($builder['verification_status'] === 'rejected') {
                        $error = 'Your contractor application has not been approved. Please contact our vendor relations desk.';
                    } else {
                        // Success
                        $_SESSION['user_id'] = $builder['id'];
                        $_SESSION['user'] = [
                            'id' => $builder['id'],
                            'name' => $builder['name'],
                            'company_name' => $builder['company_name'],
                            'email' => $builder['email'],
                            'role' => 'builder'
                        ];
                        Security::logAudit('BUILDER_LOGIN', "Builder #{$builder['id']} logged into contractor portal.");
                        header('Location: portal/builder/index.php');
                        exit;
                    }
                } else {
                    $error = 'Invalid builder credentials or not registered as a contractor partner.';
                }
            } catch (Exception $e) {
                $error = 'Database error. Please try again.';
            }
        }
    }
}

$pageTitle = "Builder Portal Login";
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5" style="background:#061121; min-height:85vh; display:flex; align-items:center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-5">
        <div class="card border-0 shadow-premium rounded-4 overflow-hidden" style="background:#0A192F; border:1px solid var(--border-gold);">
          <div class="p-4 text-center" style="background:#0E2442; color:#FFFFFF; border-bottom:1px solid var(--border-gold);">
            <div class="brand-logo-icon mx-auto mb-2" style="width:48px; height:48px; font-size:1.3rem;">
              <i class="fas fa-hard-hat"></i>
            </div>
            <h4 class="fw-bold mb-1">Contractor &amp; Builder Portal</h4>
            <p class="small text-white-50 mb-0">Zippy Enterprises Partner Network</p>
          </div>

          <div class="card-body p-4 p-md-5">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger small p-3 rounded mb-4">
                <i class="fas fa-exclamation-circle me-1"></i> <?= e($error) ?>
              </div>
            <?php endif; ?>

            <form action="builder-login.php" method="POST">
              <?= Security::csrfField() ?>

              <div class="mb-3">
                <label class="form-label small fw-bold text-warning">Contractor Email Address</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-secondary text-warning"><i class="fas fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="contractor@domain.com" value="builder@kailashconstructions.com">
                </div>
              </div>

              <div class="mb-4">
                <label class="form-label small fw-bold text-warning">Password</label>
                <div class="input-group">
                  <span class="input-group-text bg-dark border-secondary text-warning"><i class="fas fa-key"></i></span>
                  <input type="password" name="password" class="form-control bg-dark text-white border-secondary" required placeholder="••••••••" value="Builder@12345">
                </div>
              </div>

              <button type="submit" class="btn btn-gold w-100 py-2 fw-bold mb-3">
                <i class="fas fa-hard-hat me-2"></i> Access Builder Dashboard
              </button>
            </form>

            <div class="p-3 rounded bg-dark border border-secondary small text-white-50 mb-3">
              <span class="text-warning fw-bold"><i class="fas fa-key me-1"></i> Demo Builder Account:</span><br>
              <code>builder@kailashconstructions.com</code> / <code>Builder@12345</code>
            </div>

            <div class="text-center pt-2 border-top border-secondary">
              <span class="small text-white-50">Not yet an accredited contractor?</span><br>
              <a href="builder-register.php" class="small fw-bold text-warning">Apply for Builder Accreditation</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
