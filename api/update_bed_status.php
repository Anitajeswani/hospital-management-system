<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

$id = $_POST['id'] ?? null;
$status = $_POST['status'] ?? null;
$patient_name = $_POST['patient_name'] ?? 'None';

if ($id) {
    $stmt = $pdo->prepare("UPDATE bed_tracker SET status = ?, patient_name = ? WHERE id = ?");
    $stmt->execute([$status, $patient_name, $id]);
    echo json_encode(['status' => 'success', 'message' => 'Bed status updated successfully']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid bed ID']);
}
?>