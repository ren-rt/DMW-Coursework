<?php
include "conf.php";     /*DB connection*/



$name = $_POST['name'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];
$date = $_POST['date'];
$doctor = $_POST['doctor'];

$sql = "INSERT INTO medical_records (patientName, Diagnosis, Treatment, Date, DoctorName)
        VALUES ('$name', '$diagnosis', '$treatment', '$date', '$doctor')";

if ($conn->query($sql) === TRUE) {
    echo "Record inserted successfully!";
    header("Location: http://localhost/renu/coursework%20final/dashboard.php");
} else {
    echo "Error: " . $conn->error;
}
$conn->close();
?>