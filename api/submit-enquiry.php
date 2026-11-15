<?php
/**
 * API: Project Enquiry Submission (10-Field System)
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
    echo json_encode(['success' => false, 'message' => 'Security session expired. Please refresh the page and try again.']);
    exit;
}

// 10 Fields as per Section 13
$fullName     = Security::clean($_POST['full_name'] ?? '');
$phone        = Security::clean($_POST['phone'] ?? '');
$email        = Security::clean($_POST['email'] ?? '');
$location     = Security::clean($_POST['project_location'] ?? 'Hyderabad');
$type         = Security::clean($_POST['construction_type'] ?? 'Residential Construction');
$plotSize     = Security::clean($_POST['plot_size'] ?? 'Not specified');
$builtUpArea  = Security::clean($_POST['built_up_area'] ?? 'Not specified');
$floors       = Security::clean($_POST['number_of_floors'] ?? 'G+1');
$budget       = Security::clean($_POST['approx_budget'] ?? 'Not specified');
$requirements = Security::clean($_POST['project_requirements'] ?? '');
$source       = Security::clean($_POST['source'] ?? 'website_enquiry');

// Mandatory fields validation
if (empty($fullName) || empty($phone)) {
    echo json_encode(['success' => false, 'message' => 'Please provide your full name and contact mobile number.']);
    exit;
}

try {
    $db = Database::getConnection();

    // Generate unique automatic enquiry reference number
    $enquiryNumber = 'ZIP-ENQ-' . date('Y') . '-' . rand(1000, 9999);

    $sql = Database::getDriver() === 'mysql'
        ? "INSERT INTO enquiries (enquiry_number, full_name, phone, email, project_location, construction_type, plot_size, built_up_area, number_of_floors, approx_budget, project_requirements, source, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'new', NOW())"
        : "INSERT INTO enquiries (enquiry_number, full_name, phone, email, project_location, construction_type, plot_size, built_up_area, number_of_floors, approx_budget, project_requirements, source, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'new', datetime('now'))";

    $stmt = $db->prepare($sql);
    $stmt->execute([
        $enquiryNumber,
        $fullName,
        $phone,
        $email,
        $location,
        $type,
        $plotSize,
        $builtUpArea,
        $floors,
        $budget,
        $requirements,
        $source
    ]);

    // Format WhatsApp message pre-fill
    $waText = "Hello Zippy Enterprises! I submitted an enquiry (Ref: {$enquiryNumber}) for {$type} at {$location}. Budget: {$budget}. Name: {$fullName}.";
    $whatsappUrl = "https://wa.me/" . COMPANY_WHATSAPP . "?text=" . urlencode($waText);

    // Business email notification simulation / dispatch
    $emailSubject = "New Project Enquiry [{$enquiryNumber}] - {$fullName}";
    $emailBody = "New Construction Enquiry Received:\n\nReference: {$enquiryNumber}\nName: {$fullName}\nPhone: {$phone}\nEmail: {$email}\nLocation: {$location}\nType: {$type}\nPlot Size: {$plotSize}\nBuilt-up: {$builtUpArea}\nFloors: {$floors}\nBudget: {$budget}\nRequirements: {$requirements}\n";
    // Send via PHP mail if configured
    @mail(COMPANY_SALES_EMAIL, $emailSubject, $emailBody, "From: no-reply@zippyenterprises.com\r\nReply-To: {$email}\r\n");

    echo json_encode([
        'success' => true,
        'enquiry_number' => $enquiryNumber,
        'message' => "Thank you, {$fullName}! Your construction enquiry [{$enquiryNumber}] has been logged. Our Senior Project Consultant will review your plot requirements and contact you within 2 business hours.",
        'whatsapp_url' => $whatsappUrl
    ]);

} catch (Exception $e) {
    error_log("Enquiry submission error: " . $e->getMessage());
    echo json_encode(['success' => false, 'message' => 'Database error occurred. Please call +91 91212 87654 directly.']);
}
