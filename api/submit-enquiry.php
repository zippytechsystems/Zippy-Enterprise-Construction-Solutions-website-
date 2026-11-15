<?php
/**
 * API: Submit Enquiry / Lead Capture
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
    echo json_encode(['success' => false, 'message' => 'Security token expired or invalid. Please refresh the page and try again.']);
    exit;
}

$fullName = Security::clean($_POST['full_name'] ?? '');
$phone    = Security::clean($_POST['phone'] ?? '');
$email    = Security::clean($_POST['email'] ?? '');
$service  = Security::clean($_POST['service_requested'] ?? 'General Construction Enquiry');
$location = Security::clean($_POST['project_location'] ?? 'Hyderabad');
$budget   = Security::clean($_POST['estimated_budget'] ?? 'Not Specified');
$source   = Security::clean($_POST['source'] ?? 'website');
$notes    = Security::clean($_POST['notes'] ?? '');

if (empty($fullName) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please provide your full name and contact phone number.']);
    exit;
}

try {
    $db = Database::getConnection();
    
    // Auto-generate unique enquiry ID
    $enquiryNumber = 'ZIP-ENQ-' . date('Y') . '-' . rand(1000, 9999);
    
    $sql = Database::getDriver() === 'mysql'
        ? "INSERT INTO leads (enquiry_number, full_name, email, phone, service_requested, project_location, estimated_budget, source, status, notes, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'new', ?, NOW())"
        : "INSERT INTO leads (enquiry_number, full_name, email, phone, service_requested, project_location, estimated_budget, source, status, notes, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'new', ?, datetime('now'))";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        $enquiryNumber,
        $fullName,
        $email,
        $phone,
        $service,
        $location,
        $budget,
        $source,
        $notes
    ]);

    // Notify Admin
    $adminUser = $db->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1")->fetch();
    if ($adminUser) {
        Security::createNotification(
            (int)$adminUser['id'],
            "New Enquiry: {$enquiryNumber}",
            "{$fullName} submitted an enquiry for {$service} at {$location} (Budget: {$budget}).",
            "leads.php"
        );
    }

    // Audit Log
    Security::logAudit("LEAD_CAPTURED", "Enquiry {$enquiryNumber} received from {$fullName} ({$phone})");

    echo json_encode([
        'success' => true,
        'message' => "Thank you, {$fullName}! Your enquiry [{$enquiryNumber}] has been assigned to our Project Advisory Team. We will contact you within 2 hours.",
        'enquiry_number' => $enquiryNumber
    ]);
} catch (Exception $e) {
    error_log("Enquiry submission error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred. Please call our hotline directly.']);
}
