<?php
session_start();
include "db.php";
$userID =  $_SESSION["user-id"];
$petName = $_POST["name"];
$petAge = $_POST["age"];

$sql="UPDATE `petownerinfo` SET `pet_name` = '{$petName}', `pet_age` = '{$petAge}' WHERE `petownerinfo`.`login_id` = '{$userID}' AND `petownerinfo`.`pet_id` = '{$_SESSION['petID']}' ";

    if($conn->query($sql)===TRUE){
        echo "<script>
            window.location.href='../pet-details.php';
            </script>";
    }
    else{
        echo "Error". $sql. "<br>". $conn->error;
        //header("Location:../account.php?error=$em");    }
    }
$conn->close();
?>