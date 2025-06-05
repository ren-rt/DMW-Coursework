<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Start session for authentication
session_start();

// Only allow doctors
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'doctor') {
    header("Location: login.html");
    exit();
}

// Database connection
include 'conf.php';

// Initialize variables
$searchResults = [];
$searchName = '';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchName = $_POST['patientname'] ?? '';
    if (!empty($searchName)) {
        $sql = "SELECT * FROM doctor_notes WHERE patientName LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeName = "%$searchName%";
        $stmt->bind_param("s", $likeName);
        $stmt->execute();
        $result = $stmt->get_result();
        $searchResults = $result->fetch_all(MYSQLI_ASSOC);
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Patient Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>View Patient Notes</h1>
        <form method="POST">
            <div class="search">
                <input type="text" name="patientname" placeholder="Patient Name" required>
                <button type="submit">Search</button>
            </div>
        </form>

        <!-- Record display -->
        <div id="recordDisplay">
            <?php if (!empty($searchResults)): ?>
                <table border="1" cellspacing="2" cellpadding="5">
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Diagnosis</th>
                        <th>Treatment</th>
                        <th>Notes</th>
                    </tr>
                    <?php foreach ($searchResults as $row): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['patientName']) ?></td>
                            <td><?= htmlspecialchars($row['age']) ?></td>
                            <td><?= htmlspecialchars($row['diagnosis']) ?></td>
                            <td><?= htmlspecialchars($row['treatment']) ?></td>
                            <td><?= htmlspecialchars($row['notes']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($searchResults)): ?>
                <p>No notes found for this patient.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
