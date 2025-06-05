<!DOCTYPE html>
<html>
    <head>
        <title>Make Appointment</title>
        <link rel="stylesheet" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        
    </head>
    <body>
        <div class="container">         <!--Main container-->
            

            <form id="details" method="POST" action="insert.php">
                <div class="patient">
                <h1>Patient Details</h1>
                <label>Name: </label><br>
                <br>
                <input type="text" name="name" placeholder="Enter your name" required><br>
                <label>Age: </label><br>
                <br>
                <input type="number" name="age" placeholder="Enter your age" required><br>
                <label>Phone Number: </label><br>
                <br>
                <input type="tel" name="pno" placeholder="Enter your phone number" required><br>
                <label>Email: </label><br>
                <br>
                <input type="email" name="email" placeholder="Enter your E-mail" required><br>
                <label>Appointment Date</label>
                <input type="date" name="date"><br>
                <br>


                <label>Specialization</label>
                <select id="doctorOptions" name = "doctorspec" required>
                        <option value="selectType" disabled selected>Select</option>       <!--keeps the select role selected and disabled when page loaded and forces user to select from the options-->
                        <option value="neurology">Neurology</option>
                        <option value="cardiology">Cardiology</option>
                        <option value="dermatology">Dermatology</option>
                        <option value="oncology">Oncology</option>
                        <option value="Pediatrics">Pediatrics</option>
                </select>
                <?php
                    include 'conf.php';
                    $sql = "SELECT * FROM doc_details";
                    $result = mysqli_query($conn, $sql);
                    ?>

                    <label for="doctorList">Select Doctor</label>
                    <select id="doctorList" name="doctorList" required>
                        <option value="">Select a doctor</option>
                        <?php
                        if(mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $name = htmlspecialchars($row['doctorName']);
                                $specialisation = htmlspecialchars($row['specialisation']);
                                echo "<option value=\"$name\">$name ($specialisation)</option>";
                            }
                        }
                        ?>
                    </select>
                    <br><br>
                <?php
                    include 'conf.php';
                    $sql = "SELECT * FROM doc_details";
                    $result = mysqli_query($conn, $sql);
                    echo '<table border = "1" cellspacing = "2" cellpading = "2">
                    <tr>
                    <td>Name</td>
                    <td>Specialisation</td>
                    </tr>
                    ';

                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            
                            $name = $row['doctorName'];
                            $specialisation = $row['specialisation'];

                            echo '<tr>
                            <td>'.$name.'</td>
                            <td>'.$specialisation.'</td>
                            </tr>';
                        }
                    }
                    ?>

                <button type="submit">Book Appointment</button>
                

            </form>

            
        </div>
        <script src="script.js"></script>
    </body>
</html>
