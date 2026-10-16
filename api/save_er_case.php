<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

$case_id = $_POST['case_id'] ?? '';
$patient_name = $_POST['patient_name'] ?? '';
$chief_complaint = $_POST['chief_complaint'] ?? '';
$triage_priority = $_POST['triage_priority'] ?? '';
$assigned_bay = $_POST['assigned_bay'] ?? '';
$status = $_POST['status'] ?? 'Admitted Active';

if ($case_id && $patient_name) {
    try {
        $stmt = $pdo->prepare("INSERT INTO er_cases (case_id, patient_name, chief_complaint, triage_priority, assigned_bay, status) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$case_id, $patient_name, $chief_complaint, $triage_priority, $assigned_bay, $status]);
        echo json_encode(['status' => 'success', 'message' => 'ER Case Admitted & Saved in Database Successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
}
?>