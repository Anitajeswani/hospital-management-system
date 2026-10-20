<?php
header('Content-Type: application/json');
require_once __DIR__ . '/database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $patient_name   = $_POST['patient_name'] ?? '';
    $age            = $_POST['age'] ?? '';
    $doctor_name    = $_POST['doctor_name'] ?? '';
    $health_issue   = $_POST['health_issue'] ?? '';

    // Age aur health issue ko combine kar ke primary_symptom mein save kar lete hain taake age miss na ho
    $primary_symptom = "Age: " . $age . " | Issue: " . $health_issue;

    if (!empty($patient_name) && !empty($doctor_name)) {
        try {
            $token_number = 'TK-' . rand(100, 999);
            $appointment_date = date('Y-m-d');
            $time_slot = date('h:i A');

            $stmt = $pdo->prepare("INSERT INTO appointments (token_number, patient_name, doctor_name, appointment_date, time_slot, primary_symptom, status) VALUES (?, ?, ?, ?, ?, ?, 'Waiting')");
            $stmt->execute([$token_number, $patient_name, $doctor_name, $appointment_date, $time_slot, $primary_symptom]);

            echo json_encode(['status' => 'success', 'message' => 'Record Saved Successfully']);
        } catch (PDOException $e) {
            echo json_encode(['status' => 'error', 'message' => 'DB Error: ' . $e->getMessage()]);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Required fields are missing']);
    }
}
exit;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo "PHP File is working fine! Send a POST request from the form.";
    exit;
}
?>