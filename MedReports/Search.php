<?php
header('Content-Type: application/json');
include 'conf.php'; // your DB connection

$role = $_POST['role'] ?? '';
$patientID = $_POST['patientID'] ?? '';

if (empty($patientID) || empty($role)) {
    echo json_encode(["error" => "Missing patient ID or role"]);
    exit;
}

$sql = "SELECT * FROM medical_records WHERE patientID = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patientID);
$stmt->execute();
$result = $stmt->get_result();

$records = [];
while ($row = $result->fetch_assoc()) {
    $records[] = $row;
}

echo json_encode($records);
?>