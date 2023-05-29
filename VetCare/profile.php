<?php
include "database/db.php";
session_start();

if((isset($_SESSION["role"])) &&($_SESSION["role"] == 'admin')){
    header("Location: admin.php");
    exit();
}
if (!isset($_SESSION['user-id'])){
    //echo "<script> alert('Log in to access this section')</script>";
		header('location:log-in.php');
}
$userID =  $_SESSION["user-id"];

?>
<!DOCTYPE html>
<html lang = "en">
<head>
    <meta charset ="UTF-8">
    <meta name="viewport" content="width-device width, initial scale=1.0">
    <title>VetCare | Veterinary Clinic</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,700;1,300;1,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div class="header">
    <div class="navbar">
        <div class= "logo">
            <a href="index.html">VetCare</a>
        </div>
        <nav>
            <ul id="MenuItems">
                <li><a href="index.php">Home</a></li>
                <li><a href="appointments.php">Appointment</a></li>
                <li><a href="log-in.php">Account</a></li>
                <?php
                if((isset($_SESSION["user-id"])) && ($_SESSION["user-id"] !== null)){
                ?>
                <li><a href="database/logout.php">Logout</a></li>
                <?php } ?>
            </ul>
            <img src="images/menu.png" class="menu-icon" onclick="menutoggle()">
        </nav>
    </div>
</div>
<div class="container">
    <div class="profile-page">
        <div class="box">
            <p style="font-size:1.5em;text-align:center;font-weight:500">Select which furbaby you want to check.</p>
            <img src="images/uploads/green.jpg" style="width:100%;height:1vh">
            <div class="row">
                <?php
                $sql = "SELECT * FROM petownerinfo WHERE login_id = '$userID';";
                $resultset = mysqli_query($conn, $sql);
                while( $rows = mysqli_fetch_assoc($resultset) ) {
               ?>
                <a href="pet-details.php?varname=<?php echo $rows['pet_id'];?>">
                <div class="sub-box">
                    <div class="row">
                        <div class="col4" style="border-right:3px solid #207567;">
                            <img src="userPetPictures/<?php echo $rows['pet_picture']; ?>" style="width:13vh;height:13vh;border-radius:50%;border:1px solid gray;center;display:flex;margin:auto 10px">
                        </div>
                        <div class="col2" style="">
                            <p><strong><?php echo $rows['pet_name']; ?></strong><br><small><?php echo $rows['pet_age']; ?></small></p>
                        </div>
                    </div>
                </div>
                </a>
               <?php } ?>
            </div>
        </div>
    </div>
</div>   
<!---footer--->
    <div class="footer">
    Copyright 2022-VetCare
    </div>

    <!----toogle---->
    <script>
        var MenuItems= document.getElementById("MenuItems");
        
        MenuItems.style.maxHeight = "0px";
        
        function menutoggle(){
            if(MenuItems.style.maxHeight == "0px")
                {
                    MenuItems.style.maxHeight = "200px"
                }
            else{
        MenuItems.style.maxHeight = "0px";
            }
            
        }
        
    </script>
    
</body>
</html>