<?php
header('Content-Type: application/json');
require_once __DIR__ . '/database.php';

$full_name       = $_POST['full_name'] ?? '';
$specialization  = $_POST['specialization'] ?? '';
$opd_room        = $_POST['opd_room'] ?? '';
$consultation_fee = $_POST['consultation_fee'] ?? '';
$shift_timing    = $_POST['shift_timing'] ?? '';

if ($full_name && $specialization) {
    try {
        $stmt = $pdo->prepare("INSERT INTO doctors (full_name, specialization, opd_room, consultation_fee, shift_timing, status) VALUES (?, ?, ?, ?, ?, 'On Duty')");
        $stmt->execute([$full_name, $specialization, $opd_room, $consultation_fee, $shift_timing]);
        echo json_encode(['status' => 'success', 'message' => 'Doctor Registered Successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'All required fields must be filled']);
}
?>