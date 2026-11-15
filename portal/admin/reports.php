<?php
/**
 * Admin Reports & Analytics with CSV Export
 * Zippy Enterprises Private Limited
 */
require_once __DIR__ . '/../../config/config.php';
require_once __DIR__ . '/../../config/security.php';
require_once __DIR__ . '/../../config/database.php';

Security::requireRole('admin');
$portalTitle = "Enterprise Reports & Export Hub";

// Check if CSV export was requested
if (isset($_GET['export'])) {
    $type = $_GET['export'];
    $db = Database::getConnection();

    if ($type === 'leads') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="zippy_leads_report_' . date('Ymd') . '.csv"');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Enquiry Number', 'Full Name', 'Email', 'Phone', 'Service', 'Location', 'Budget', 'Status', 'Date']);
        $rows = $db->query("SELECT id, enquiry_number, full_name, email, phone, service_requested, project_location, estimated_budget, status, created_at FROM leads ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) fputcsv($out, $r);
        fclose($out);
        exit;
    } elseif ($type === 'projects') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="zippy_projects_report_' . date('Ymd') . '.csv"');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['ID', 'Project Code', 'Title', 'Category', 'Built Up Area', 'Floors', 'Current Stage', 'Progress %', 'Budget', 'Status']);
        $rows = $db->query("SELECT id, project_code, title, category, built_up_area_sqft, floors_count, current_stage_id, progress_percent, total_budget, status FROM projects ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) fputcsv($out, $r);
        fclose($out);
        exit;
    } elseif ($type === 'financials') {
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="zippy_financial_disbursements_' . date('Ymd') . '.csv"');
        $out = fopen('php://output', 'w');
        fputcsv($out, ['Milestone ID', 'Project ID', 'Milestone Title', 'Percentage', 'Amount Due', 'Due Date', 'Status', 'Txn Ref']);
        $rows = $db->query("SELECT id, project_id, milestone_title, percentage_due, amount_due, due_date, payment_status, transaction_reference FROM payment_milestones ORDER BY id ASC")->fetchAll(PDO::FETCH_ASSOC);
        foreach ($rows as $r) fputcsv($out, $r);
        fclose($out);
        exit;
    }
}

try {
    $db = Database::getConnection();
    // Aggregates for charts/tables
    $leadsCountByService = $db->query("SELECT service_requested, COUNT(*) as cnt FROM leads GROUP BY service_requested ORDER BY cnt DESC")->fetchAll();
    $leadsCountByStatus  = $db->query("SELECT status, COUNT(*) as cnt FROM leads GROUP BY status ORDER BY cnt DESC")->fetchAll();
    $projectStats        = $db->query("SELECT category, COUNT(*) as cnt, SUM(total_budget) as total_val, SUM(built_up_area_sqft) as total_area FROM projects GROUP BY category")->fetchAll();
} catch (Exception $e) {
    $leadsCountByService = [];
    $leadsCountByStatus = [];
    $projectStats = [];
}

require_once __DIR__ . '/../../includes/portal-header.php';
?>

<div class="row mb-4">
  <div class="col-12">
    <div class="d-flex justify-content-between align-items-center bg-white p-4 rounded-4 shadow-sm border">
      <div>
        <h4 class="fw-bold text-navy mb-1">Reports, Intelligence &amp; Data Export</h4>
        <p class="text-muted small mb-0">Generate monthly audit reports, analyze construction velocity, and export compliance data.</p>
      </div>
      <div class="d-flex gap-2">
        <a href="reports.php?export=leads" class="btn btn-navy btn-sm">
          <i class="fas fa-file-csv me-1"></i> Export Leads CSV
        </a>
        <a href="reports.php?export=projects" class="btn btn-navy btn-sm">
          <i class="fas fa-file-csv me-1"></i> Export Projects CSV
        </a>
        <a href="reports.php?export=financials" class="btn btn-gold btn-sm">
          <i class="fas fa-file-csv me-1"></i> Export Finance CSV
        </a>
      </div>
    </div>
  </div>
</div>

<div class="row g-4 mb-4">
  <!-- Leads Distribution by Service -->
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
      <h5 class="fw-bold text-navy mb-3"><i class="fas fa-chart-pie text-warning me-2"></i> Inquiries by Construction Service</h5>
      <table class="table table-sm small">
        <thead>
          <tr class="text-muted">
            <th>Service Discipline</th>
            <th class="text-end">Volume</th>
            <th class="text-end">Share</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $totalL = array_sum(array_column($leadsCountByService, 'cnt')) ?: 1;
          foreach ($leadsCountByService as $row): 
          ?>
            <tr>
              <td class="fw-bold text-navy"><?= e($row['service_requested']) ?></td>
              <td class="text-end fw-bold"><?= $row['cnt'] ?></td>
              <td class="text-end text-muted"><?= round(($row['cnt'] / $totalL) * 100, 1) ?>%</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

  <!-- Project Breakdown by Category -->
  <div class="col-lg-6">
    <div class="card border-0 shadow-sm rounded-4 p-4 bg-white h-100">
      <h5 class="fw-bold text-navy mb-3"><i class="fas fa-cubes text-warning me-2"></i> Portfolio Area &amp; Valuation</h5>
      <table class="table table-sm small">
        <thead>
          <tr class="text-muted">
            <th>Category</th>
            <th>Sites</th>
            <th>Built-Up Area</th>
            <th class="text-end">Contract Value</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($projectStats as $ps): ?>
            <tr>
              <td class="fw-bold text-navy text-uppercase"><?= e($ps['category']) ?></td>
              <td><?= $ps['cnt'] ?></td>
              <td><?= number_format($ps['total_area']) ?> Sq.Ft</td>
              <td class="text-end fw-bold text-navy">₹<?= number_format($ps['total_val'] / 10000000, 2) ?> Cr</td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<?php require_once __DIR__ . '/../../includes/portal-footer.php'; ?>
