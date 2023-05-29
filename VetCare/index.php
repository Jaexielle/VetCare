<?php
include "database/db.php";
session_start();?>
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
    <div class="headInfo">
        <div class="caption"> <span class="border">“Until one has loved an animal, a part of one’s soul remains unawakened.” – Anatole France</span> </div>
    </div>
     
    <div class="content"style="background: linear-gradient(#cad2c5,#fff,#fff);padding-top:100px;display: none">
        <div class="row">
            <div class="col2 home box">
                <div class="col2" style="border-right: 2px solid white;padding: 10vh">
                    <h1>Promo</h1>
                    <br>
                    <p>We are offering December Discounts on December 21-23. All our services will be 20% off. Set an appointment now.</p>
                </div>
                <div class="col2">
                    <img src="images/uploads/santa.jpg">
                </div>
            </div>
        </div>
    </div>
    
    <div style="background: linear-gradient(#fff,#fff,#cad2c5,#354f52);">
    <div class="content">
        <h1>Services</h1>
        <hr>
        <div class="row" style="margin-bottom: 10vh">
            <div class="col4 serviceHome">
                <img src="images/services/doc.jpg">
                <p>Veterinarians in the house.</p>
            </div>
            <div class="col4 serviceHome">
                <img src="images/services/vax.jpg">
                <p>Vaccines and medications to keep your pet healthy.</p>
            </div>
            <div class="col4 serviceHome">
                <img src="images/services/dog.jpg">
                <p>Keep your pet clean and shiny.</p>
            </div>
            <div class="col4 serviceHome">
                <img src="images/services/products.jpg">
                <p>Give what your furbabies deserve.</p>
            </div>
        </div>
    </div>
    
    <div class="content start">
        <h1>Start Now</h1> <!--will use API map if there's time --->
        <hr style="margin-bottom: 10px">
        <div class="row card" style="margin-top:2vh;">
            <div class="col2 startCard box">
                <div>
                    <h3>Come and Join Us</h3><br><br>
                    <p>We created this site to allow pet owners easily inquire to our clinic and this is also to show transparency on their pet's condition. We encourage you to create an account to keep you updated on your pet's medications, conditions, and even setting an appointments to the doctor</p>
                    <br>
                    <br>
                    <a href="log-in.php"><p>Create an Account</p></a>
                    <a href="log-in.php"><p>Log In</p></a>
                </div>
            </div>
            <div class="col2 startCard box" style="">
                <h3>Visit Us</h3>
                <div class="map" style:"border:1px solid black">
                    <div id="map"></div>
                </div>
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

        //map
        // Initialize and add the map
        function initMap() {
            
        var latValue = 14.5995;
        var longValue = 120.9842;
          // The location of Uluru
          const locationholder = { lat: parseFloat(latValue), lng: parseFloat(longValue) };
          // The map, centered at Uluru
          const map = new google.maps.Map(document.getElementById("map"), {
            zoom: 15,
            center: locationholder,
          });
          // The marker, positioned at Uluru
          const marker = new google.maps.Marker({
            position: locationholder,
            map: map,
          });
        }

        window.initMap = initMap;

    //marker
        
    </script>
    
    <script src="app.js"></script>
    <script async
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA_zeD1oQ_ihpIZ4_5ddEUNjBPmDzRrJJg&callback=initMap">
    </script>
    
</body>
</html>