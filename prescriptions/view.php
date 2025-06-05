<?php
include 'conf.php'; 

$patientName = $_POST['name'] ?? '';

if (empty($patientName) ) {
    echo json_encode(["error" => "Missing patient name "]);
    exit;
}

$sql = "SELECT * FROM prescription_records WHERE name = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $patientName);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo '<h2>Prescriptions for ' . htmlspecialchars($patientName) . '</h2>';
    echo '<table border="1" cellpadding="5" cellspacing="0">';
    echo '<thead><tr>';
    // Output table headers dynamically
    $fields = $result->fetch_fields();
    foreach ($fields as $field) {
        echo '<th>' . htmlspecialchars($field->name) . '</th>';
    }
    echo '</tr></thead><tbody>';
    // Output table rows
    $result->data_seek(0); // Reset pointer after fetch_fields
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        foreach ($row as $value) {
            echo '<td>' . htmlspecialchars($value) . '</td>';
        }
        echo '</tr>';
    }
    echo '</tbody></table>';
} else {
    echo '<p>No prescriptions found for ' . htmlspecialchars($patientName) . '.</p>';
}
?>