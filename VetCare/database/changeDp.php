<?php
session_start();
include "db.php";
$userID =  $_SESSION["user-id"];
$sql_u = "SELECT * FROM petownerinfo WHERE login_id ='$userID' AND pet_id = '{$_SESSION['petID']}'";
$res_u = mysqli_query($conn, $sql_u);
//$sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";
  
    if($_FILES['profile']['size']!==0){
        //for($i=0; $i < $imageCount; $i++){
            $imageName = $_FILES['profile']['name'];
            $imageTempName = $_FILES['profile']['tmp_name'];
            $targetPath = "../userPetPictures/".$imageName;
            if(move_uploaded_file($imageTempName,$targetPath)){
                if(mysqli_num_rows($res_u) > 0) {
                    $sql = "UPDATE petownerinfo SET pet_picture = '$imageName' WHERE pet_id='{$_SESSION['petID']}'";
                    $result = mysqli_query($conn, $sql);
                    
                }
                else{
                    echo "error";
                }
                //echo "yes";
            }
            //array_push($imageSesh,''.$imageName);
        //}
        if($result){
            echo "success";
            header('location:../pet-details.php?pet-details.php?varname='.$_SESSION['petID']);
        }
        //$_SESSION['imageName']=$imageSesh;
    }
    else {
        echo "error";
    }
?>