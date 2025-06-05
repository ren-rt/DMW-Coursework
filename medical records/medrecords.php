<?php
// Start the session at the top of the file
session_start();

// Redirect to login if not logged in

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Medical Reports</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="mscript.js"></script>
</head>
<body>
    <!--Main container-->
    <div class="container py-4">
        <h1>Medical Reports</h1>

        <!--Patient interface (only shown for patients)-->
        <?php if ($_SESSION['role'] === 'patient'): ?>
            <div class="card mb-3">
                <div class="card-header">Your Medical Records</div>
                <div class="card-body">
                    <form id="search">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="searchInput" name="patientName" placeholder="Enter your Patient Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Search Records</button>
                    </form>
                    <div id="recordDisplay" class="mt-3"></div>
                </div>
            </div>
        <?php endif; ?>

        <!--Doctor interface (only shown for doctors)-->
        <?php if ($_SESSION['role'] === 'doctor'): ?>
            <div class="card mb-3">
                <div class="card-header">Patient Medical Records</div>
                <div class="card-body">
                    <form id="search">
                        <div class="mb-3">
                            <input type="text" class="form-control" id="searchInput" name="patientName" placeholder="Enter Patient Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Search Records</button>
                    </form>
                    <div id="recordDisplay" class="mt-3"></div>
                </div>
            </div>
            <!--Insert records form (only for doctors)-->
            <div class="card mb-3">
                <div class="card-header">Insert Patient Record</div>
                <div class="card-body">
                    <form id="record" action="Insert.php" method="post">
                        <div class="mb-3">
                            <input type="text" class="form-control" name="name" placeholder="Patient Name" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="diagnosis" placeholder="Diagnosis" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="treatment" placeholder="Treatment" required>
                        </div>
                        <div class="mb-3">
                            <input type="date" class="form-control" name="date" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" name="doctor" placeholder="Doctor Name" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Insert Record</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
            <div class="mb-3">
             <a href="/renu/coursework final/dashboard.php" class="btn btn-secondary">&larr; Back to Dashboard</a>
            </div>
       
    </div>

    
</body>
</html>
