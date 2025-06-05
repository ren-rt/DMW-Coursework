<?php

include 'conf.php';

 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="container py-4">
    <h2><?php session_start();
echo "Welcome, " . htmlspecialchars($_SESSION['username']); ?></h2>

    <?php if ($_SESSION['role'] === 'patient'): ?>
        <div class="card mb-3">
            <div class="card-header">Upcoming Appointments</div>
            <div class="card-body">
                 <?php
            // Get current patient's email or username
            $username = $_SESSION['username'];
            // Fetch patient email from patient_details
            $patientQuery = "SELECT patientEmail FROM patient_details WHERE patientName = ?";
            $stmt = $conn->prepare($patientQuery);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($patientEmail);
            $stmt->fetch();
            $stmt->close();

            // Fetch upcoming appointments for this patient
            $apptQuery = "SELECT appointmentdate, specialisation, doctor FROM patient_details WHERE patientEmail = ? AND appointmentdate >= CURDATE() ORDER BY appointmentdate ASC";
            $stmt = $conn->prepare($apptQuery);
            $stmt->bind_param("s", $patientEmail);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                echo '<table class="table table-bordered"><thead><tr><th>Date</th><th>Specialization</th><th>Doctor</th></tr></thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['appointmentdate']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['specialisation']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['doctor']) . '</td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p>No upcoming appointments found.</p>';
            }
            $stmt->close();
            ?>
            </div>

            </div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Book Appointment</div>
            <div class="card-body"><a href="/renu/coursework%20final/appointments/appointments.php" class="btn btn-primary mt-3">Book New Appointment</a></div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Medical Records</div>
            <div class="card-body"><a href="/renu/coursework final/medical records/medrecords.php" class="btn btn-primary mt-3">View Medical Records</a></div>
        </div> 
        <div class="card mb-3">
            <div class="card-header">Prescriptions</div>
            <div class="card-body"><a href="/renu/coursework final/prescriptions/prescriptions.php" class="btn btn-primary mt-3">View Prescriptions</a></div>
        </div>
    <?php elseif ($_SESSION['role'] === 'doctor'): ?>
        <div class="card mb-3">
            <div class="card-header">Upcoming Appointments</div>
            <div class="card-body"><?php
            // Get current doctor's name
            $username = $_SESSION['username'];
            // Fetch doctor name from doc_details
            $docQuery = "SELECT doctorName FROM doc_details WHERE doctorName = ?";
            $stmt = $conn->prepare($docQuery);
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->bind_result($doctorName);
            $stmt->fetch();
            $stmt->close();

            // Fetch upcoming appointments for this doctor
            $apptQuery = "SELECT patientName, appointmentdate, specialisation FROM patient_details WHERE doctor = ? AND appointmentdate >= CURDATE() ORDER BY appointmentdate ASC";
            $stmt = $conn->prepare($apptQuery);
            $stmt->bind_param("s", $doctorName);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result && $result->num_rows > 0) {
                echo '<table class="table table-bordered"><thead><tr><th>Date</th><th>Patient</th><th>Specialization</th></tr></thead><tbody>';
                while ($row = $result->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($row['appointmentdate']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['patientName']) . '</td>';
                    echo '<td>' . htmlspecialchars($row['specialisation']) . '</td>';
                    echo '</tr>';
                }
                echo '</tbody></table>';
            } else {
                echo '<p>No upcoming appointments found.</p>';
            }
            $stmt->close();
            ?></div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Doctor's Notes</div>
            <div class="card-body"><a href="/renu/coursework final/DocNotes/doctornotes.php" class="btn btn-primary mt-3">Doctor's Notes</a>
        <a href="/renu/coursework final/DocNotes/viewnotes.php" class="btn btn-info mt-3">View Notes</a></div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Patient Medical Records</div>
            <div class="card-body"><a href="/renu/coursework final/medical records/medrecords.php" class="btn btn-primary mt-3">Medical Records</a></div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Prescriptions</div>
            <div class="card-body"><a href="/renu/coursework final/prescriptions/prescriptions.php" class="btn btn-primary mt-3">Prescriptions</a>
        </div>
        </div>
    <?php elseif ($_SESSION['role'] === 'admin'): ?>
        <div class="card mb-3">
            <div class="card-header">Doctor's Details</div>
            <div class="card-body">[Doctor's details here]</div>
        </div>
        <div class="card mb-3">
            <div class="card-header">Patients Details</div>
            <div class="card-body">[Patients details here]</div>
        </div>
    <?php else: ?>
        <div class="alert alert-warning">No dashboard features available for your role.</div>
    <?php endif; ?>
</div>

</body>

<div class="container py-4" style="max-width: 500px; margin: 0 auto;">
    <div class="d-flex justify-content-end mb-3">
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
</html>

