<?php
include 'conf.php';

    $inputusern = $_POST['usern'];
    $inputuserp = $_POST['passw'];


    $sql = "SELECT * FROM Users";
    $result = mysqli_query($conn, $sql); 
    if (empty($inputusern) || empty($inputuserp)) {
        header("Location: login.html?error=Please enter both username and password");
        exit();
    }

    // Prepare SQL query to prevent SQL injection
    if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['ID'];
        $name = $row['Username'];
        $password = $row['Password'];
        $role = $row['Role'];
        
        echo $name, $password, $role;
        if ($inputusern == $name)
        {
            if ($inputuserp == $password)
            {
                header("Location: dashboard.php");
                exit(); 

            }
        }
    }
}







?>