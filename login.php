<?php
/**
 * Customer & General Portal Login
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/config/config.php';
require_once __DIR__ . '/config/security.php';
require_once __DIR__ . '/config/database.php';

$error = '';
$requestedRole = $_GET['role'] ?? 'customer';

// If already logged in, redirect to respective dashboard
if (Security::check()) {
    $role = Security::role();
    if ($role === 'admin') header('Location: portal/admin/index.php');
    elseif ($role === 'builder') header('Location: portal/builder/index.php');
    else header('Location: portal/customer/index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::verifyCsrf()) {
        $error = 'Session security token expired. Please reload and try again.';
    } else {
        $email = Security::clean($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $error = 'Please enter your registered email and password.';
        } else {
            try {
                $db = Database::getConnection();
                $stmt = $db->prepare("SELECT * FROM users WHERE email = ? LIMIT 1");
                $stmt->execute([$email]);
                $user = $stmt->fetch();

                if ($user && password_verify($password, $user['password_hash'])) {
                    if ($user['status'] === 'suspended') {
                        $error = 'Your account has been deactivated. Please contact enterprise administration.';
                    } else {
                        // Successful authentication
                        $_SESSION['user_id'] = $user['id'];
                        $_SESSION['user'] = [
                            'id' => $user['id'],
                            'name' => $user['name'],
                            'email' => $user['email'],
                            'role' => $user['role'],
                            'phone' => $user['phone']
                        ];

                        Security::logAudit('LOGIN_SUCCESS', "User #{$user['id']} ({$user['role']}) logged in.");

                        // Redirect based on role
                        if ($user['role'] === 'admin') {
                            header('Location: portal/admin/index.php');
                        } elseif ($user['role'] === 'builder') {
                            header('Location: portal/builder/index.php');
                        } else {
                            header('Location: portal/customer/index.php');
                        }
                        exit;
                    }
                } else {
                    $error = 'Invalid credentials. Please verify your email and password.';
                    Security::logAudit('LOGIN_FAILED', "Failed login attempt for email: {$email}");
                }
            } catch (Exception $e) {
                $error = 'System error during login. Please contact support.';
            }
        }
    }
}

$pageTitle = "Portal Sign In";
require_once __DIR__ . '/includes/header.php';
?>

<section class="py-5" style="background:#F1F5F9; min-height:80vh; display:flex; align-items:center;">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8 col-lg-5">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
          <div class="p-4 text-center" style="background:#0A192F; color:#FFFFFF; border-bottom:1px solid var(--border-gold);">
            <div class="brand-logo-icon mx-auto mb-2" style="width:48px; height:48px; font-size:1.3rem;">
              <i class="fas fa-lock"></i>
            </div>
            <h4 class="fw-bold mb-1">Enterprise Portal Sign In</h4>
            <p class="small text-white-50 mb-0">Zippy Enterprises Private Limited</p>
          </div>

          <div class="card-body p-4 p-md-5 bg-white">
            <?php if (!empty($error)): ?>
              <div class="alert alert-danger small p-3 rounded mb-4">
                <i class="fas fa-exclamation-circle me-1"></i> <?= e($error) ?>
              </div>
            <?php endif; ?>

            <?php if ($flash = Security::getFlash('error')): ?>
              <div class="alert alert-warning small p-3 rounded mb-4">
                <i class="fas fa-info-circle me-1"></i> <?= e($flash) ?>
              </div>
            <?php endif; ?>

            <?php if ($flash = Security::getFlash('success')): ?>
              <div class="alert alert-success small p-3 rounded mb-4">
                <i class="fas fa-check-circle me-1"></i> <?= e($flash) ?>
              </div>
            <?php endif; ?>

            <form action="login.php" method="POST">
              <?= Security::csrfField() ?>
              
              <div class="mb-3">
                <label class="form-label small fw-bold text-navy">Registered Email Address</label>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted"><i class="fas fa-envelope"></i></span>
                  <input type="email" name="email" class="form-control" required placeholder="name@domain.com" 
                         value="<?= $requestedRole === 'admin' ? 'admin@zippyenterprises.com' : 'rajesh.verma@example.com' ?>">
                </div>
              </div>

              <div class="mb-4">
                <div class="d-flex justify-content-between align-items-center mb-1">
                  <label class="form-label small fw-bold text-navy mb-0">Secure Password</label>
                  <a href="#" class="small text-muted" onclick="alert('For demo access, please use the pre-filled credentials or contact administrator.'); return false;">Forgot?</a>
                </div>
                <div class="input-group">
                  <span class="input-group-text bg-light text-muted"><i class="fas fa-key"></i></span>
                  <input type="password" name="password" class="form-control" required placeholder="••••••••" 
                         value="<?= $requestedRole === 'admin' ? 'Admin@12345' : 'Customer@12345' ?>">
                </div>
              </div>

              <button type="submit" class="btn btn-gold w-100 py-2 fw-bold mb-3">
                <i class="fas fa-sign-in-alt me-2"></i> Access My Portal
              </button>
            </form>

            <div class="p-3 rounded bg-light border small text-muted mb-3">
              <div class="fw-bold text-navy mb-1"><i class="fas fa-info-circle text-warning me-1"></i> Pre-Configured Demo Access:</div>
              <div><strong>Admin Suite:</strong> <code>admin@zippyenterprises.com</code> / <code>Admin@12345</code></div>
              <div><strong>Customer Portal:</strong> <code>rajesh.verma@example.com</code> / <code>Customer@12345</code></div>
              <div><strong>Builder Portal:</strong> <code>builder@kailashconstructions.com</code> / <code>Builder@12345</code></div>
            </div>

            <div class="text-center pt-2 border-top">
              <span class="small text-muted">New project client?</span>
              <a href="register.php" class="small fw-bold text-navy ms-1">Create Customer Account</a>
              <br>
              <span class="small text-muted">Are you a contractor?</span>
              <a href="builder-login.php" class="small fw-bold text-warning ms-1">Builder Sign In</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
