<?php
/**
 * Careers Page
 * Zippy Enterprises Private Limited
 */
$pageTitle = "Careers in Construction & Engineering";
$pageDescription = "Build your engineering career with Zippy Enterprises Private Limited. Explore openings for Civil Project Managers, Structural Design Engineers, and Site Supervisors in Hyderabad.";
require_once __DIR__ . '/includes/header.php';
require_once __DIR__ . '/config/database.php';

$jobSubmitted = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && Security::verifyCsrf()) {
    $name     = Security::clean($_POST['applicant_name'] ?? '');
    $email    = Security::clean($_POST['email'] ?? '');
    $phone    = Security::clean($_POST['phone'] ?? '');
    $position = Security::clean($_POST['position'] ?? '');
    $exp      = (int)($_POST['experience_years'] ?? 0);
    $note     = Security::clean($_POST['cover_note'] ?? '');

    try {
        $db = Database::getConnection();
        $sql = Database::getDriver() === 'mysql'
            ? "INSERT INTO careers_applications (applicant_name, email, phone, position, experience_years, cover_note, created_at) VALUES (?, ?, ?, ?, ?, ?, NOW())"
            : "INSERT INTO careers_applications (applicant_name, email, phone, position, experience_years, cover_note, created_at) VALUES (?, ?, ?, ?, ?, ?, datetime('now'))";
        $stmt = $db->prepare($sql);
        $stmt->execute([$name, $email, $phone, $position, $exp, $note]);
        $jobSubmitted = true;
    } catch (Exception $e) {
        $errorMsg = "Submission error: " . $e->getMessage();
    }
}
?>

<!-- BANNER -->
<section class="page-banner">
  <img src="assets/images/hero-bg.jpg" alt="Careers at Zippy Enterprises" class="page-banner-bg">
  <div class="container page-banner-content">
    <div class="badge-gold mb-2">JOIN OUR ENGINEERING TEAM</div>
    <h1 class="page-banner-title">Build Your Career With Zippy Enterprises</h1>
    <div class="breadcrumb-custom">
      <a href="index.php"><i class="fas fa-home me-1"></i> Home</a>
      <span>/</span>
      <span>Careers</span>
    </div>
  </div>
</section>

<!-- CAREERS BODY -->
<section class="py-5" style="background:#FFFFFF;">
  <div class="container py-4">
    <?php if ($jobSubmitted): ?>
      <div class="alert alert-success p-4 rounded-3 shadow-sm mb-4">
        <h4 class="fw-bold"><i class="fas fa-check-circle me-2"></i> Application Received!</h4>
        <p class="mb-0">Thank you for your interest in Zippy Enterprises Private Limited. Our Human Resources &amp; Technical Talent acquisition team will review your credentials and contact you shortly.</p>
      </div>
    <?php endif; ?>

    <div class="row g-5">
      <div class="col-lg-7">
        <span class="section-subtitle">Work Culture &amp; Growth</span>
        <h2 class="section-title">Shape The Skyline of Hyderabad</h2>
        <p class="section-desc">
          At Zippy Enterprises, we empower civil engineers, structural analysts, and architectural designers with state-of-the-art tools, competitive compensation, and high-impact landmark projects.
        </p>

        <!-- Current Openings -->
        <h4 class="fw-bold text-navy mt-4 mb-3">Current Open Positions</h4>
        
        <div class="card border mb-3 shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="fw-bold text-navy mb-0">Senior Civil Project Manager (PMC)</h5>
              <span class="badge bg-warning text-dark fw-bold">Full Time &bull; Hyderabad</span>
            </div>
            <p class="text-muted small mb-3">Responsible for multi-site execution, contractor management, slump/cube test QA/QC compliance, and milestone delivery for luxury villa projects in Jubilee Hills and Gachibowli.</p>
            <div class="d-flex gap-3 small text-muted">
              <span><i class="fas fa-briefcase text-warning me-1"></i> 8-12 Years Experience</span>
              <span><i class="fas fa-graduation-cap text-warning me-1"></i> B.Tech / M.Tech Civil</span>
            </div>
          </div>
        </div>

        <div class="card border mb-3 shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="fw-bold text-navy mb-0">Structural Design Engineer (STAAD-Pro / ETABS)</h5>
              <span class="badge bg-warning text-dark fw-bold">Full Time &bull; Hyderabad</span>
            </div>
            <p class="text-muted small mb-3">Execute finite element structural modeling, seismic and wind load analysis, foundation design, and rebar optimization for commercial and residential high-rise buildings.</p>
            <div class="d-flex gap-3 small text-muted">
              <span><i class="fas fa-briefcase text-warning me-1"></i> 4-7 Years Experience</span>
              <span><i class="fas fa-graduation-cap text-warning me-1"></i> M.Tech Structural Engineering</span>
            </div>
          </div>
        </div>

        <div class="card border mb-3 shadow-sm">
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-start mb-2">
              <h5 class="fw-bold text-navy mb-0">Site Supervisor / Quality Inspector</h5>
              <span class="badge bg-warning text-dark fw-bold">Full Time &bull; Site-Based</span>
            </div>
            <p class="text-muted small mb-3">Daily site supervision, daily labour management, rebar placement verification before slab casting, and daily milestone photo documentation for quality reporting.</p>
            <div class="d-flex gap-3 small text-muted">
              <span><i class="fas fa-briefcase text-warning me-1"></i> 3-5 Years Experience</span>
              <span><i class="fas fa-graduation-cap text-warning me-1"></i> Diploma / B.Tech Civil</span>
            </div>
          </div>
        </div>
      </div>

      <!-- APPLICATION FORM -->
      <div class="col-lg-5">
        <div class="card border-0 shadow-lg p-4 sticky-top" style="top: 100px; background:#0A192F; color:#FFFFFF; border-radius:16px; border:1px solid var(--border-gold);">
          <div class="badge-gold mb-2">DIRECT APPLICATION</div>
          <h4 class="text-white fw-bold mb-2">Apply for a Position</h4>
          <p class="text-white-50 small mb-3">Submit your career profile directly to our Engineering Talent Acquisition board.</p>

          <form action="careers.php" method="POST">
            <?= Security::csrfField() ?>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Full Name *</label>
              <input type="text" name="applicant_name" class="form-control bg-dark text-white border-secondary" required placeholder="Enter your full name">
            </div>
            <div class="row g-2 mb-3">
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Email *</label>
                <input type="email" name="email" class="form-control bg-dark text-white border-secondary" required placeholder="name@email.com">
              </div>
              <div class="col-6">
                <label class="form-label text-warning small fw-bold">Phone *</label>
                <input type="tel" name="phone" class="form-control bg-dark text-white border-secondary" required placeholder="+91 98765 43210">
              </div>
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Target Position *</label>
              <select name="position" class="form-select bg-dark text-white border-secondary" required>
                <option value="Senior Civil Project Manager">Senior Civil Project Manager</option>
                <option value="Structural Design Engineer">Structural Design Engineer</option>
                <option value="Site Supervisor / Quality Inspector">Site Supervisor / Quality Inspector</option>
                <option value="Architectural 3D Visualizer">Architectural 3D Visualizer</option>
                <option value="Other Technical Role">Other Technical Role</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Years of Civil / Construction Experience</label>
              <input type="number" name="experience_years" class="form-control bg-dark text-white border-secondary" required min="0" max="40" value="4">
            </div>
            <div class="mb-3">
              <label class="form-label text-warning small fw-bold">Professional Summary &amp; Projects</label>
              <textarea name="cover_note" rows="3" class="form-control bg-dark text-white border-secondary" placeholder="Summarize your engineering background, software proficiency (AutoCAD, STAAD, Revit), and major projects delivered..."></textarea>
            </div>
            <button type="submit" class="btn btn-gold w-100 py-2 fw-bold">Submit Job Application</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
