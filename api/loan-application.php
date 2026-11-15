<?php
/**
 * API: Self-Construction Loan Enquiry
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
    echo json_encode(['success' => false, 'message' => 'Security session expired. Please refresh.']);
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

if (empty($name) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please provide applicant name and contact phone number.']);
    exit;
}

try {
    $db = Database::getConnection();
    $refNumber = 'ZIP-LN-' . date('Y') . '-' . rand(100, 999);

    $sql = Database::getDriver() === 'mysql'
        ? "INSERT INTO loan_enquiries (reference_number, applicant_name, phone, email, plot_ownership, plot_location, estimated_budget, desired_loan, monthly_income, employment_type, preferred_banks, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())"
        : "INSERT INTO loan_enquiries (reference_number, applicant_name, phone, email, plot_ownership, plot_location, estimated_budget, desired_loan, monthly_income, employment_type, preferred_banks, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, datetime('now'))";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        $refNumber, $name, $phone, $email, $ownership, $location, $estBudget, $desiredLoan, $income, $empType, $banks
    ]);

    echo json_encode([
        'success' => true,
        'reference_number' => $refNumber,
        'message' => "Loan assistance enquiry [{$refNumber}] recorded successfully! Our Banking & Estimation Liaison Officer will contact you within 24 hours to coordinate your certified estimate."
    ]);
} catch (Exception $e) {
    error_log("Loan application error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Error recording loan assistance request.']);
}
