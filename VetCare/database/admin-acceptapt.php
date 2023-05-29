<?php 
session_start();
include "db.php";

if (isset($_GET['accept']))   {
    $id = $_GET['accept'];
    $sql="UPDATE `appointment` SET `status` = 'Accepted' WHERE `appointment`.`apt_id` = '{$id}'";

    if($conn->query($sql)===TRUE){
        echo "<script>
            window.location.href='../admin-reviewappointments.php';
            </script>";
    }
    else{
        echo "Error". $sql. "<br>". $conn->error;
        //header("Location:../account.php?error=$em");    }
    }
}

if (isset($_GET['cancel']))   {
    $id = $_GET['cancel'];
    $reason = $_POST['reason'];
    $sql="UPDATE `appointment` SET `status` = 'Cancelled',`cln_reason` = '{$reason}' WHERE `appointment`.`apt_id` = '{$id}'";
    
    if($conn->query($sql)===TRUE){
        echo "<script>
            window.location.href='../admin-reviewappointments.php';
            </script>";
    }
    else{
        echo "Error". $sql. "<br>". $conn->error;
        //header("Location:../account.php?error=$em");    }
    }
}




$conn->close();
?>