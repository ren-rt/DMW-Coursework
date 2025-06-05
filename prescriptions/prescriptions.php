<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session at the VERY TOP
session_start();

// Redirect if not logged in


// Get role from session (with null coalescing operator)
$role = $_SESSION['role'] ?? '';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Prescription Management</title>
    
</head>
<body>
    <div class="container">
        <!-- Patient View -->
        <?php if ($role === 'patient'): ?>
        <div class="patient">
            <h1>Prescription Management</h1>
            <form id="details" method="POST" action="view.php">
                <label>Patient Name: </label>
                <input type="text" name="name" placeholder="Enter your name" required>
                <button type="submit" id="viewButton">VIEW</button>
            </form>
        </div>

        <!-- Doctor Interface -->
        <?php elseif ($role === 'doctor'): ?>
        <div class="insertForm">
            <h2>Insert Patient Record</h2>
            <form id="record" action="insert.php" method="post">
                <input type="text" name="name" placeholder="Patient Name" required><br>
                <input type="text" name="diagnosis" placeholder="Diagnosis" required><br>
                <input type="text" name="treatment" placeholder="Treatment" required><br>
                <input type="date" name="date" required><br>
                <input type="text" name="doctor" placeholder="Doctor Name" required><br>
                <button type="submit">Insert Record</button>
            </form>
        </div>
        <?php endif; ?>
    </div>
    <script src="prescription.js"></script>
</body>
</html>
