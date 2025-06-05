
<!DOCTYPE html>
<html>
<head>
    <title>Doctor Notes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <form id="details" method="POST" action="insert.php">
            <div class="notes">
                <input type="text" name="name" placeholder="Patient Name" required>
                <input type="number" name="age" placeholder="Age" required>
                <input type="date" name="date" required><br>
            </div>
            <div id="diagnosis">
                <input type="text" name="diagnosis" placeholder="Diagnosis" required><br>
                <input type="text" name="treatment" placeholder="Treatment" required><br>
            </div>
            <div id="docNotes">
                <input type="text" name="notes" placeholder="Enter patient notes" required><br>
                <button type="submit" name="save">Save</button>
            </div>
            <!--Record display (removed)-->
        </form>
    </div>
</body>
</html>
