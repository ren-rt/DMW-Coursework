<?php

include 'conf.php';



$inputusern = $_POST['usern'];
$inputuserp = $_POST['passw'];

echo $inputusern;
echo $inputuserp;

$sql = "SELECT * FROM Users";
$result = mysqli_query($conn, $sql);


if(mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
        $id = $row['ID'];
        $name = $row['Username'];
        $password = $row['Password'];
        $role = $row['Role'];
        
        if ($inputusern == $name)
        {
            if ($inputuserp == $password)
            {
                session_start();
                $_SESSION['username'] = $name;
                $_SESSION['role'] = $role;
                header("Location: dashboard.php");
                exit();
            }
            else {
                echo "<script>alert('Invalid username or password.'); window.location.href='login.html';</script>";
                
            }
        }
        else 
        {
            echo "<script>alert('Invalid username or password.'); window.location.href='login.html';</script>";
            
        }

        
}
}

?>