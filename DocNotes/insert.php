<?php
include 'conf.php';

// Get values from the form in doctornotes.php
$patientName = $_POST['name'];
$age = $_POST['age'];
$note = $_POST['notes'];
$date = $_POST['date'];
$diagnosis = $_POST['diagnosis'];
$treatment = $_POST['treatment'];

$sql = "INSERT INTO doctor_notes (patientName, age, diagnosis, treatment, notes)
        VALUES ('$patientName','$age', '$diagnosis', '$treatment', '$note')";

if (mysqli_query($conn, $sql)) {
    echo "<script>
        alert('Doctor note added successfully!');
        window.location.href = '/renu/coursework final/DocNotes/doctornotes.php';
    </script>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
?>