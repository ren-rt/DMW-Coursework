<?php
include 'conf.php';

$response = [];

$query = "SELECT * FROM specializations";
$result = mysqli_query($conn, $query);

if ($result) {
    $specializations = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $specializations[] = $row;
    }
    $response = $specializations;
} else {
    http_response_code(500);
    $response = ['error' => 'Failed to fetch specializations', 'mysql_error' => mysqli_error($conn)];
}

echo json_encode($response);
mysqli_close($conn);
?>