<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

$blood_group = $_POST['blood_group'] ?? '';
$bags = $_POST['bags'] ?? 0;

if ($blood_group) {
    $stmt = $pdo->prepare("INSERT INTO blood_inventory (blood_group, bags_available, status_label) VALUES (?, ?, 'Available')");
    $stmt->execute([$blood_group, $bags]);
    echo json_encode(['status' => 'success', 'message' => 'Blood unit added successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Missing fields']);
}
?>