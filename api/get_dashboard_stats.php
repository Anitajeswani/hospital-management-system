<?php
header('Content-Type: application/json');
$conn = mysqli_connect("localhost", "root", "", "ack_carepulse_db");

if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

// 1. ICU Beds Count (Misal ke taur par total 50 mein se occupied beds minus kar ke ya direct query)
// Agar aapke paas bed_tracker table hai, toh wahan se count kar sakte hain:
$beds_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM bed_tracker WHERE status = 'Occupied'");
$beds_row = mysqli_fetch_assoc($beds_result);
$occupied_beds =$beds_row['total'] ?? 18;
$available_beds = 50 -$occupied_beds;

// 2. Registered Doctors Count
$doctors_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM doctors");
$doctors_row = mysqli_fetch_assoc($doctors_result);
$total_doctors =$doctors_row['total'] ?? 2;

// 3. Appointments Count
$appointments_result = mysqli_query($conn, "SELECT COUNT(*) as total FROM appointments");
$appointments_row = mysqli_fetch_assoc($appointments_result);
$total_appointments =$appointments_row['total'] ?? 2;

// 4. Today Revenue (Billing table se sum)
$revenue_result = mysqli_query($conn, "SELECT SUM(amount) as total FROM hospital_billing WHERE status = 'PAID'");
$revenue_row = mysqli_fetch_assoc($revenue_result);
$total_revenue =$revenue_row['total'] ?? 24850.00;

echo json_encode([
    "available_beds" => $available_beds,
    "total_doctors" => $total_doctors,
    "total_appointments" => $total_appointments,
    "total_revenue" => $total_revenue
]);
?>