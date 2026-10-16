<?php
header('Content-Type: application/json');
require_once __DIR__ . '/database.php';

$token_number     = $_POST['token_number'] ?? '';
$patient_name     = $_POST['patient_name'] ?? '';
$doctor_name      = $_POST['doctor_name'] ?? '';
$appointment_date = $_POST['appointment_date'] ?? '';
$time_slot        = $_POST['time_slot'] ?? '';
$primary_symptom  = $_POST['primary_symptom'] ?? '';

if ($patient_name && $doctor_name) {
    try {
        $stmt = $pdo->prepare("INSERT INTO appointments (token_number, patient_name, doctor_name, appointment_date, time_slot, primary_symptom, status) VALUES (?, ?, ?, ?, ?, ?, 'Confirmed')");
        $stmt->execute([$token_number, $patient_name, $doctor_name, $appointment_date, $time_slot, $primary_symptom]);
        echo json_encode(['status' => 'success', 'message' => 'Appointment Booked Successfully']);
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database Error: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'All fields are required']);
}
?>