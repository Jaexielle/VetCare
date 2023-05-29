<?php
include "database/db.php";
session_start();

if((isset($_SESSION["user-id"])) && ($_SESSION["user-id"] !== null)){
    header("Location: profile.php");
    exit();
}

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
<!---account-->
    <div class="account-page">
            <div class="row">
                <div class="col2">
                    <div style="margin:auto">
                            <img src="images/uploads/login.png" style="height:60vh;width:70vh">
                    </div>
                </div>
                <div class="col2">
                    <div class="form-container">
                        <div class="form-btn">
                            <span onclick="login()">Login</span>
                            <span onclick="register()">Sign-up</span>
                            <hr id="Indicator">
                        </div>
                        <form method="post" action="database/login.php" id="LoginForm">
                            <input type="text" name="username-login" placeholder="Username" required>
                            <input type="password" name="password-login" placeholder="Password" required>
                            <button type="submit" class="btn">Login</button>
                        </form>
                        
                        <form method="post" action="database/sign-up.php" id="RegForm">
                            <input type="text" name="username" placeholder="Username" required>
                            <input type="email" name="email" placeholder="Email" required>
                            <input type="password" name="password" placeholder="Password" required>
                            <button type="submit" class="btn">Register</button>
                        </form>
                    </div>
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
    <!--toggle form--->
    <script>
    var LoginForm = document.getElementById("LoginForm");
        var RegForm = document.getElementById("RegForm");
        var Indicator = document.getElementById("Indicator");
    
            function register(){
                RegForm.style.transform = "translateX(0px)";
                LoginForm.style.transform = "translateX(0px)";
                Indicator.style.transform = "translateX(100px)";
            }
            
            function login(){
                RegForm.style.transform = "translateX(300px)";
                LoginForm.style.transform = "translateX(300px)";
                Indicator.style.transform = "translateX(0px)";
            }
    </script>
  
</body>
</html>