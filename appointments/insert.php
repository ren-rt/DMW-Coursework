<?php
include 'conf.php';

$name  = $_POST['name'];
$age   = $_POST['age'];
$pno   = $_POST['pno'];
$email = $_POST['email'];
$date         = $_POST['date'];
$specialisation = $_POST['doctorspec'];
$doctor       = $_POST['doctorList'];

$sql = "INSERT INTO patient_details (patientName, patientAge, patientPhone, patientEmail, appointmentdate, specialisation, doctor)
        VALUES ('$name', '$age', '$pno', '$email', '$date', '$specialisation', '$doctor')";

if (mysqli_query($conn, $sql)) {
    // Set flag in localStorage and redirect back to html page
    echo "<script>
        alert('Appointment booked successfully!');
        window.location.href = 'http://localhost/renu/coursework%20final/dashboard.php';
    </script>";
} else {
    echo 'Error: ' . mysqli_error($conn);
}

mysqli_close($conn);
?>