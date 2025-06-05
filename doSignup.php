<?php 
include 'conf.php';


$firstName = $_POST['firstName'];
$lastName = $_POST['lastName'];
$username = $_POST['username'];
$dateOfBirth = $_POST['dateOfBirth'];
$gender = $_POST['gender'];
$contactNo = $_POST['contactNo'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmPassword = $_POST['confirmPassword'];
$role = $_POST['role'];



$sql = "INSERT INTO signup_details (firstname, lastname, gender, contactno, email, username, password, role)
        VALUES ('$firstName', '$lastName', '$gender', '$contactNo', '$email', '$username', '$password', '$role')";

 if (mysqli_query($conn, $sql)) {
    echo " New record created successfully ";
 }
 else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
 }

 session_start();
$_SESSION['username'] = $username;
$_SESSION['role'] = $role;
header("Location: dashboard.php");
exit();
?>