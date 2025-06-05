<?php
include "conf.php";     



$name = $_POST['name'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];
$date = $_POST['date'];
$doctor = $_POST['doctor'];

$sql = "INSERT INTO prescription_records (name, diagnosis, treatment, date, doctor)
        VALUES ('$name', '$diagnosis', '$treatment', '$date', '$doctor')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>