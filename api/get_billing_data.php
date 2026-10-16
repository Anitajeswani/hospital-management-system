<?php
header('Content-Type: application/json');

// Make sure the database name matches your phpMyAdmin database
$conn = mysqli_connect("localhost", "root", "", "ack_carepulse_db");

if (!$conn) {
    echo json_encode(["error" => "Database connection failed"]);
    exit;
}

$query = "SELECT * FROM hospital_billing ORDER BY created_at DESC";
$result = mysqli_query($conn, $query);

$invoices = [];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $invoices[] = $row;
    }
}

echo json_encode($invoices);
?>