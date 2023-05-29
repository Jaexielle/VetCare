<?php 
session_start();
include "db.php";

$date = $_POST['date'];
$time = $_POST['time'];
$petname = $_POST['petname'];
$reason = $_POST['reason'];
$loginId = $_SESSION["user-id"];
$status = "Processing";
$default = "n/a";
$sql="INSERT INTO appointment(`login_id`,`date`,`time`,`pet_name`,`reason`,`status`,`cln_reason`) VALUES ('$loginId','$date','$time','$petname','$reason','$status','$default')";



if($conn->query($sql)===TRUE){
         echo "<script>
        alert('Appointment Request Sent!');
        window.location.href='../appointments.php';
        </script>";
}
else{
    echo "Error". $sql. "<br>". $conn->error;
    //header("Location:../account.php?error=$em");
}
    



$conn->close();
?>

?>