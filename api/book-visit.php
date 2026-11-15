<?php
/**
 * API: Book Site Visit
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

Security::requireAuth();
$user = Security::user();
$userId = (int)$user['id'];

$projectId = !empty($_POST['project_id']) ? (int)$_POST['project_id'] : null;
$date = Security::clean($_POST['requested_date'] ?? '');
$timeSlot = Security::clean($_POST['time_slot'] ?? '10:00 AM - 12:00 PM');
$purpose = Security::clean($_POST['visit_purpose'] ?? 'Site Inspection & Milestone Review');

if (empty($date)) {
    echo json_encode(['success' => false, 'message' => 'Please select a preferred visit date.']);
    exit;
}

try {
    $db = Database::getConnection();
    $sql = Database::getDriver() === 'mysql'
        ? "INSERT INTO site_visits (project_id, user_id, requested_date, time_slot, visit_purpose, status, created_at) VALUES (?, ?, ?, ?, ?, 'requested', NOW())"
        : "INSERT INTO site_visits (project_id, user_id, requested_date, time_slot, visit_purpose, status, created_at) VALUES (?, ?, ?, ?, ?, 'requested', datetime('now'))";

    $stmt = $db->prepare($sql);
    $stmt->execute([$projectId, $userId, $date, $timeSlot, $purpose]);

    // Notify Admin
    $adminUser = $db->query("SELECT id FROM users WHERE role = 'admin' LIMIT 1")->fetch();
    if ($adminUser) {
        Security::createNotification(
            (int)$adminUser['id'],
            "New Site Visit Request",
            "{$user['name']} requested a site visit on {$date} ({$timeSlot}). Purpose: {$purpose}",
            "customers.php"
        );
    }

    Security::logAudit("SITE_VISIT_REQUESTED", "Site visit requested by user #{$userId} for date {$date}");

    echo json_encode(['success' => true, 'message' => "Site inspection appointment requested for {$date} ({$timeSlot}). Our project engineer will confirm shortly."]);
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Failed to record site visit request.']);
}
