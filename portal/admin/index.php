<?php
/**
 * Enterprise Admin Dashboard Overview
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$user = Security::user();
$portalTitle = "Enterprise Executive Administration";

try {
    $db = Database::getConnection();

    // Key Performance Indicators (KPIs)
    $totalEnquiries = (int)$db->query("SELECT COUNT(*) FROM leads")->fetchColumn();
    $newLeads = (int)$db->query("SELECT COUNT(*) FROM leads WHERE status = 'new'")->fetchColumn();
    $activeCustomers = (int)$db->query("SELECT COUNT(*) FROM users WHERE role = 'customer' AND status = 'active'")->fetchColumn();
    $registeredBuilders = (int)$db->query("SELECT COUNT(*) FROM builder_profiles")->fetchColumn();
    $pendingBuilders = (int)$db->query("SELECT COUNT(*) FROM builder_profiles WHERE verification_status = 'pending'")->fetchColumn();
    $activeProjects = (int)$db->query("SELECT COUNT(*) FROM projects WHERE status = 'in_progress'")->fetchColumn();
    $completedProjects = (int)$db->query("SELECT COUNT(*) FROM projects WHERE status = 'completed'")->fetchColumn();
    $pendingQuotations = (int)$db->query("SELECT COUNT(*) FROM quotations WHERE status = 'sent'")->fetchColumn();
    $totalRevenue = (float)$db->query("SELECT SUM(total_budget) FROM projects")->fetchColumn();
    $collectedPayments = (float)$db->query("SELECT SUM(amount_due) FROM payment_milestones WHERE payment_status = 'paid'")->fetchColumn();
    $pendingPayments = (float)$db->query("SELECT SUM(amount_due) FROM payment_milestones WHERE payment_status = 'pending'")->fetchColumn();

    // Recent 5 leads
    $recentLeads = $db->query("SELECT * FROM leads ORDER BY id DESC LIMIT 5")->fetchAll();

    // Recent projects
    $recentProjects = $db->query("SELECT p.*, bp.company_name as builder_name, u.name as customer_name FROM projects p LEFT JOIN builder_profiles bp ON p.builder_id = bp.id JOIN users u ON p.customer_id = u.id ORDER BY p.id ASC LIMIT 5")->fetchAll();

} catch (Exception $e) {
    die("Admin DB Error: " . $e->getMessage());
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<!-- EXECUTIVE SUMMARY BANNER -->
<div class="row mb-4">
  <div class="col-12">
    <div class="p-4 rounded-4 shadow-sm" style="background:#0A192F; color:#FFFFFF; border:1px solid var(--border-gold);">
      <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center">
        <div>
          <span class="badge-gold mb-2">EXECUTIVE COMMAND CENTER</span>
          <h2 class="text-white fw-bold mb-1">Enterprise Operations &amp; Construction Analytics</h2>
          <p class="text-white-50 mb-0">Live real-time monitoring across Hyderabad site developments, CRM pipeline, and contractor network.</p>
        </div>
        <div class="d-flex gap-2 mt-3 mt-md-0">
          <a href="projects.php?action=create" class="btn btn-gold btn-sm px-3">
            <i class="fas fa-plus me-1"></i> New Project
          </a>
          <a href="reports.php" class="btn btn-outline-warning text-white border-warning btn-sm px-3">
            <i class="fas fa-file-export me-1"></i> Export Data
          </a>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- 8 CORE KPI STAT CARDS -->
<div class="row g-3 mb-4">
  <!-- 1. Total Leads -->
  <div class="col-sm-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">CRM Inquiries</div>
          <div class="h3 fw-bold text-navy mb-0"><?= $totalEnquiries ?></div>
          <small class="text-success fw-bold"><i class="fas fa-arrow-up me-1"></i> <?= $newLeads ?> New Leads</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-gold">
          <i class="fas fa-funnel-dollar"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- 2. Active Projects -->
  <div class="col-sm-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Active Projects</div>
          <div class="h3 fw-bold text-navy mb-0"><?= $activeProjects ?> Sites</div>
          <small class="text-muted"><?= $completedProjects ?> Delivered Handover</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-navy">
          <i class="fas fa-city"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- 3. Total Project Portfolio Revenue -->
  <div class="col-sm-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Portfolio Value</div>
          <div class="h3 fw-bold text-navy mb-0">₹<?= number_format($totalRevenue / 10000000, 2) ?> Cr</div>
          <small class="text-success fw-bold"><i class="fas fa-check-circle me-1"></i> ₹<?= number_format($collectedPayments / 10000000, 2) ?> Cr Realized</small>
        </div>
        <div class="stat-icon-wrapper stat-icon-green">
          <i class="fas fa-chart-line"></i>
        </div>
      </div>
    </div>
  </div>

  <!-- 4. Registered Contractors -->
  <div class="col-sm-6 col-xl-3">
    <div class="portal-stat-card">
      <div class="d-flex justify-content-between align-items-start">
        <div>
          <div class="small text-muted fw-bold text-uppercase mb-1">Builder Network</div>
          <div class="h3 fw-bold text-navy mb-0"><?= $registeredBuilders ?> Firms</div>
          <?php if ($pendingBuilders > 0): ?>
            <a href="builders.php" class="text-danger small fw-bold"><i class="fas fa-clock me-1"></i> <?= $pendingBuilders ?> Awaiting Audit</a>
          <?php else: ?>
            <small class="text-success fw-bold"><i class="fas fa-check-double me-1"></i> All Verified</small>
          <?php endif; ?>
        </div>
        <div class="stat-icon-wrapper stat-icon-purple">
          <i class="fas fa-hard-hat"></i>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ACTIVE SITES & RECENT LEADS -->
<div class="row g-4 mb-4">
  <!-- Active Projects Table -->
  <div class="col-lg-8">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
          <h5 class="fw-bold text-navy mb-0">Active Construction Projects</h5>
          <small class="text-muted">Multi-stage verified civil execution sites</small>
        </div>
        <a href="projects.php" class="btn btn-sm btn-outline-secondary">Manage All</a>
      </div>
      <div class="table-responsive">
        <table class="portal-table">
          <thead>
            <tr>
              <th>Project &amp; Code</th>
              <th>Customer</th>
              <th>Builder</th>
              <th>Stage</th>
              <th>Progress</th>
              <th>Budget</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($recentProjects as $p): ?>
              <tr>
                <td>
                  <span class="fw-bold text-navy"><?= e($p['title']) ?></span><br>
                  <small class="badge bg-light text-navy border"><?= e($p['project_code']) ?></small>
                </td>
                <td><?= e($p['customer_name']) ?></td>
                <td><small class="text-muted"><?= e($p['builder_name'] ?: 'In-House Team') ?></small></td>
                <td><span class="badge bg-warning text-dark fw-bold">Stage <?= $p['current_stage_id'] ?></span></td>
                <td>
                  <div class="d-flex align-items-center gap-2">
                    <div class="progress" style="width: 60px; height: 6px;">
                      <div class="progress-bar bg-warning" style="width: <?= $p['progress_percent'] ?>%;"></div>
                    </div>
                    <span class="small fw-bold"><?= $p['progress_percent'] ?>%</span>
                  </div>
                </td>
                <td class="fw-bold text-navy">₹<?= number_format($p['total_budget'] / 10000000, 2) ?> Cr</td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Recent Leads Pipeline -->
  <div class="col-lg-4">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
      <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
        <div>
          <h5 class="fw-bold text-navy mb-0">Recent CRM Inquiries</h5>
          <small class="text-muted">Website, Calculator &amp; WhatsApp</small>
        </div>
        <a href="leads.php" class="btn btn-sm btn-outline-secondary">View All</a>
      </div>
      <div class="p-3">
        <?php foreach ($recentLeads as $lead): ?>
          <div class="p-3 rounded-3 mb-2 border" style="background:#F8FAFC;">
            <div class="d-flex justify-content-between align-items-start mb-1">
              <span class="fw-bold text-navy small"><?= e($lead['full_name']) ?></span>
              <span class="badge-status <?= $lead['status'] ?>"><?= strtoupper(e($lead['status'])) ?></span>
            </div>
            <small class="text-muted d-block"><i class="fas fa-tools text-warning me-1"></i> <?= e($lead['service_requested']) ?></small>
            <div class="d-flex justify-content-between align-items-center mt-2 pt-2 border-top">
              <small class="text-muted"><i class="fas fa-map-marker-alt text-warning me-1"></i> <?= e($lead['project_location']) ?></small>
              <small class="fw-bold text-navy"><?= e($lead['estimated_budget']) ?></small>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</div>

<!-- FINANCIAL HEALTH BAR -->
<div class="row">
  <div class="col-12">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white">
      <div class="row align-items-center">
        <div class="col-md-3">
          <h6 class="fw-bold text-navy mb-1">Milestone Cashflow Status</h6>
          <small class="text-muted">Collected vs Pending Disbursements</small>
        </div>
        <div class="col-md-6 my-3 my-md-0">
          <?php 
          $totalBilling = $collectedPayments + $pendingPayments;
          $collectedPercent = $totalBilling > 0 ? round(($collectedPayments / $totalBilling) * 100, 1) : 0;
          ?>
          <div class="d-flex justify-content-between small text-muted mb-1">
            <span>Collected: ₹<?= number_format($collectedPayments / 100000, 2) ?> L (<?= $collectedPercent ?>%)</span>
            <span>Pending Due: ₹<?= number_format($pendingPayments / 100000, 2) ?> L</span>
          </div>
          <div class="progress" style="height: 12px; border-radius:10px;">
            <div class="progress-bar bg-success" style="width: <?= $collectedPercent ?>%;"></div>
            <div class="progress-bar bg-warning" style="width: <?= 100 - $collectedPercent ?>%;"></div>
          </div>
        </div>
        <div class="col-md-3 text-md-end">
          <a href="finance.php" class="btn btn-navy btn-sm">Financial Management <i class="fas fa-arrow-right ms-1"></i></a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
