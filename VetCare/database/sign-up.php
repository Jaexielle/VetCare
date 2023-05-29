<?php 
session_start();
include "db.php";

$un = $_POST['username'];
$email = $_POST['email'];
$pass = $_POST['password'];
$role = "client";

$sql_u = "SELECT * FROM login WHERE username='$un'";
$sql_e = "SELECT * FROM login WHERE email='$email'";
$res_u = mysqli_query($conn, $sql_u);
$res_e = mysqli_query($conn, $sql_e);

if (mysqli_num_rows($res_u) > 0) {
  	  $_SESSION['name_error'] = "Username is already taken";
    header("Location:../log-in.php");
}
else if(mysqli_num_rows($res_e) > 0){
  	  $_SESSION['email_error'] = "Email is already taken"; 
    header("Location:../log-in.php");
}
else{
        
$sql="INSERT INTO login(`username`, `email`,`password`,`role`) VALUES ('$un','$email','$pass','$role')";



if($conn->query($sql)===TRUE){
    header("Location:../log-in.php");
}
else{
    echo "Error". $sql. "<br>". $conn->error;
    //header("Location:../account.php?error=$em");
}



$conn->close();}
?>