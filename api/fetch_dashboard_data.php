<?php
header('Content-Type: application/json');
require_once __DIR__ . '/../config/database.php';

try {
    $beds = $pdo->query("SELECT * FROM bed_tracker")->fetchAll(PDO::FETCH_ASSOC);
    $blood = $pdo->query("SELECT * FROM blood_inventory")->fetchAll(PDO::FETCH_ASSOC);
    $er = $pdo->query("SELECT * FROM er_cases")->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => 'success',
        'beds' => $beds,
        'blood' => $blood,
        'er_cases' => $er
    ]);
} catch (Exception $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}
?>