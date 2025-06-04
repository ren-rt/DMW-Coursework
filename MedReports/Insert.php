<?php
include "conf.php";     /*DB connection*/


$patientID = $_POST['patientID'];
$name = $_POST['name'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];
$date = $_POST['date'];
$doctor = $_POST['doctor'];

$sql = "INSERT INTO medical_records (patientID, name, diagnosis, treatment, date, doctor)
        VALUES ('$patientID', '$name', '$diagnosis', '$treatment', '$date', '$doctor')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>