<?php
header('Content-Type: application/json');
include 'conf.php'; // your DB connection


$username = $_POST['patientName'] ?? '';



$sql = "SELECT * FROM medical_records WHERE patientName = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

echo json_encode($records);
?>