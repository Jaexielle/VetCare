<?php 
session_start();
include "db.php";

$action = $_POST['action'];
$medName = $_POST['med'];
$date = $_POST['date'];
$petID = $_SESSION['petID'];

//echo "-".$action."-".$medName."-".$date."-".$petID;med_id	pet_id	med_type	med_name	date	

$sql="INSERT INTO medications(`pet_id`,`med_type`,`med_name`,`date`) VALUES ('$petID','$action','$medName','$date')";



if($conn->query($sql)===TRUE){
    echo "<script>
        alert('Inserted to the database!');
        window.location.href='../admin-petdetails.php';
        </script>";
    //header("Location:../admin-petdetails.php");
}
else{
    echo "Error". $sql. "<br>". $conn->error;
    //header("Location:../account.php?error=$em");
}



$conn->close();
?>