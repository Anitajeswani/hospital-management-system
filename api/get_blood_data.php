<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "anita_hospital");

if (!$conn) {
    die(json_encode(["error" => "Database connection failed"]));
}

// Database se available blood bags count karne ki query
$query = "SELECT blood_group, COUNT(*) as total FROM blood_bank WHERE status = 'Available' GROUP BY blood_group";
$result = mysqli_query($conn, $query);

$inventory = ['A+' => 0, 'O-' => 0, 'B+' => 0, 'AB+' => 0];
if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        $inventory[$row['blood_group']] = $row['total'];
    }
}

// JSON format mein data return karna
header('Content-Type: application/json');
echo json_encode($inventory);
?>