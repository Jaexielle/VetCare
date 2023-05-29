<?php 
session_start();
include "db.php";

$userID = $_POST['username'];
$petName = $_POST['furname'];
$age = $_POST['age'];
$defaultImg = "default.jpg";

//echo "-".$userID ."-".$petName."-".$age."-";

$sql="INSERT INTO petownerinfo(`login_id`,`pet_name`,`pet_age`,`pet_picture`) VALUES ('$userID','$petName','$age','$defaultImg')";



if($conn->query($sql)===TRUE){
    echo "<script>
        alert('Inserted to the database!');
        window.location.href='../admin.php';
        </script>";
    //header("Location:../admin-petdetails.php");
}
else{
    echo "Error". $sql. "<br>". $conn->error;
    //header("Location:../account.php?error=$em");
}



$conn->close();
?>