<?php
/**
 * API: Construction Cost Calculation & Quotation Record
 * Zippy Enterprises Private Limited
 */

header('Content-Type: application/json');
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../config/security.php';
require_once __DIR__ . '/../config/database.php';

$area     = (float)($_POST['builtup_area'] ?? 2500);
$floors   = (int)($_POST['floors'] ?? 2);
$package  = Security::clean($_POST['package'] ?? 'premium');
$category = Security::clean($_POST['category'] ?? 'residential');

$rates = [
    'classic'      => 1750,
    'premium'      => 2150,
    'luxury'       => 2850,
    'ultra_luxury' => 3650
];

$ratePerSqft = $rates[$package] ?? 2150;
if ($category === 'commercial') $ratePerSqft *= 1.15;
if ($category === 'apartment')  $ratePerSqft *= 0.95;

$totalCost = $area * $ratePerSqft;
$structureCost = round($totalCost * 0.46);
$finishingCost = round($totalCost * 0.24);
$mepCost       = round($totalCost * 0.15);
$labourCost    = round($totalCost * 0.15);

// Check if user requested to save quotation
if (!empty($_POST['save_quote']) && Security::verifyCsrf()) {
    try {
        $db = Database::getConnection();
        $quoteNumber = 'ZIP-EST-' . date('Y') . '-' . rand(100, 999);
        $customerId = Security::user()['id'] ?? null;
        
        $sql = Database::getDriver() === 'mysql'
            ? "INSERT INTO quotations (quote_number, customer_id, plot_area_sqft, built_up_area_sqft, floors, package_tier, structure_cost, finishing_cost, mep_cost, labour_cost, contingency_and_tax, total_estimated_cost, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, 'sent', NOW())"
            : "INSERT INTO quotations (quote_number, customer_id, plot_area_sqft, built_up_area_sqft, floors, package_tier, structure_cost, finishing_cost, mep_cost, labour_cost, contingency_and_tax, total_estimated_cost, status, created_at) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0, ?, 'sent', datetime('now'))";

        $stmt = $db->prepare($sql);
        $stmt->execute([
            $quoteNumber,
            $customerId,
            $area * 0.8,
            $area,
            $floors,
            $package,
            $structureCost,
            $finishingCost,
            $mepCost,
            $labourCost,
            $totalCost
        ]);

        echo json_encode([
            'success' => true,
            'quote_number' => $quoteNumber,
            'total_cost' => $totalCost,
            'rate_per_sqft' => $ratePerSqft,
            'structure_cost' => $structureCost,
            'finishing_cost' => $finishingCost,
            'mep_cost' => $mepCost,
            'labour_cost' => $labourCost
        ]);
        exit;
    } catch (Exception $e) {
        error_log("Quote saving error: " . $e->getMessage());
    }
}

echo json_encode([
    'success' => true,
    'total_cost' => $totalCost,
    'rate_per_sqft' => $ratePerSqft,
    'structure_cost' => $structureCost,
    'finishing_cost' => $finishingCost,
    'mep_cost' => $mepCost,
    'labour_cost' => $labourCost
]);
