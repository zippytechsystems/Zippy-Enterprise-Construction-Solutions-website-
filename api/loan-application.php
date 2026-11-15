<?php
/**
 * API: Self-Construction Loan Application
 * Zippy Enterprises Private Limited
 */

header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/database.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method.']);
    exit;
}

if (!Security::verifyCsrf()) {
    echo json_encode(['success' => false, 'message' => 'Security token invalid. Please refresh.']);
    exit;
}

$name       = Security::clean($_POST['applicant_name'] ?? '');
$phone      = Security::clean($_POST['phone'] ?? '');
$email      = Security::clean($_POST['email'] ?? '');
$ownership  = Security::clean($_POST['plot_ownership'] ?? 'self_owned');
$location   = Security::clean($_POST['plot_location'] ?? 'Hyderabad');
$estBudget  = (float)($_POST['estimated_construction_budget'] ?? 0);
$desiredLoan = (float)($_POST['desired_loan_amount'] ?? 0);
$income     = (float)($_POST['monthly_income'] ?? 0);
$empType    = Security::clean($_POST['employment_type'] ?? 'salaried');
$banks      = Security::clean($_POST['preferred_banks'] ?? 'SBI, HDFC, ICICI');
$userId     = Security::user()['id'] ?? null;

if (empty($name) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please provide applicant name and contact phone number.']);
    exit;
}

try {
    $db = Database::getConnection();
    $sql = Database::getDriver() === 'mysql'
        ? "INSERT INTO loan_applications (user_id, applicant_name, phone, email, plot_ownership, plot_location, estimated_construction_budget, desired_loan_amount, monthly_income, employment_type, preferred_banks, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'submitted', NOW())"
        : "INSERT INTO loan_applications (user_id, applicant_name, phone, email, plot_ownership, plot_location, estimated_construction_budget, desired_loan_amount, monthly_income, employment_type, preferred_banks, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'submitted', datetime('now'))";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        $userId, $name, $phone, $email, $ownership, $location, $estBudget, $desiredLoan, $income, $empType, $banks
    ]);

    // Also register lead into CRM
    $enqNum = 'ZIP-LN-' . date('Y') . '-' . rand(100, 999);
    $leadSql = Database::getDriver() === 'mysql'
        ? "INSERT INTO leads (enquiry_number, full_name, email, phone, service_requested, project_location, estimated_budget, source, status, notes, created_at) VALUES (?, ?, ?, ?, 'Self-Construction Loan Assistance', ?, ?, 'website', 'new', ?, NOW())"
        : "INSERT INTO leads (enquiry_number, full_name, email, phone, service_requested, project_location, estimated_budget, source, status, notes, created_at) VALUES (?, ?, ?, ?, 'Self-Construction Loan Assistance', ?, ?, 'website', 'new', ?, datetime('now'))";
    
    $leadStmt = $db->prepare($leadSql);
    $leadStmt->execute([
        $enqNum, $name, $email, $phone, $location, "₹" . ($desiredLoan/100000) . " Lakhs Loan", "Plot: {$ownership}, Monthly Inc: ₹{$income}, Banks: {$banks}"
    ]);

    // Notify Admin
    $adminUser = $db->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1")->fetch();
    if ($adminUser) {
        Security::createNotification(
            (int)$adminUser['id'],
            "New Self-Construction Loan File",
            "{$name} applied for ₹" . number_format($desiredLoan) . " loan assistance for {$location}.",
            "leads.php"
        );
    }

    Security::logAudit("LOAN_APPLICATION_SUBMITTED", "Loan assistance requested by {$name} for ₹{$desiredLoan}");

    echo json_encode([
        'success' => true,
        'message' => "Loan assistance file registered successfully! Our Banking & Estimation Liaison Officer will contact you within 24 hours to coordinate your certified estimate."
    ]);
} catch (Exception $e) {
    error_log("Loan application error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error recording loan assistance request.']);
}
