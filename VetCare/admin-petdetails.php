<?php
include "database/db.php";
session_start();

if((!isset($_SESSION["user-id"])) && ($_SESSION["user-id"] == null)){
    header("Location: log-in.php");
    exit();
}

if(isset($_GET['varname'])){
    $_SESSION['petID'] = $_GET['varname'];
}


$petID = $_SESSION['petID'];
$userID =  $_SESSION["user-id"];
$sql_u = "SELECT * FROM petownerinfo WHERE pet_id = '$petID'";
$res_u = mysqli_query($conn, $sql_u);
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
    <div class="pet-profile-page">
        <div class="row">
            <div class="box box1">
                <div class="pet-info">
                    <?php 
                        if(mysqli_num_rows($res_u) > 0) {
                        $sql = "SELECT * FROM petownerinfo WHERE pet_id = '{$petID}'";
                        $resultset = mysqli_query($conn, $sql);
                        while( $rows = mysqli_fetch_assoc($resultset) ) {?>
                            <img src="userPetPictures/<?php echo $rows['pet_picture']; ?>" style="width:13vw;height:13vw;margin:auto">
                            
                    
                    <!--img src="images/uploads/santa.jpg" style="width:13vw;height:13vw;margin:auto"-->
                    <p class="name"><?php echo $rows['pet_name']; ?></p>
                    <p><?php echo $rows['pet_age']; ?></p>
                    <?php
                            }
                        }?>
                </div>
            </div>
            <div class="box box2">
                <div style="display: flex; justify-content: flex-end;">
                    <i class="fa fa fa-solid fa-filter" id="filter"></i>
                    <i class="fa fa fa-solid fa-plus" id="plus"></i>
                </div>
                <?php
                
                if(!isset($_GET['type']) || $_GET['type']=="all"){
                    $sql = "SELECT * FROM medications WHERE pet_id = '{$petID}' ORDER BY med_id DESC";  
                }
                else{
                    $sql = "SELECT * FROM medications WHERE pet_id = '{$petID}' AND med_type = '{$_GET['type']}' ORDER BY med_id DESC";
                }
                
                //$sql = "SELECT * FROM medications WHERE pet_id = '{$petID}' AND med_type = '{$_GET['type']}' ORDER BY med_id DESC";
                $resultset = mysqli_query($conn, $sql);
                while( $rows = mysqli_fetch_assoc($resultset) ) {
               ?>  
                <div class="box box3">
                    <div class="row">
                        <div class="col4" style="border-right:1px solid white;padding-right:5px;">
                            <p><?php echo $rows['med_type'] ?></p></div>
                        <div class="col2" style="border-right:1px solid white;padding-right:5px;">
                            <p><?php echo $rows['med_name'] ?></p></div>
                        <div class="col4" style="flex-basis:"><p><?php echo $rows['date'] ?></p></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!---filter-modal--->
        <div id="myModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="close">&times;</span>
            <form action="">
                  <p>Please select below:</p>
                  <input type="radio" id="all" name="type" value="all">
                  <label for="all">All</label><br>
                  <input type="radio" id="vax" name="type" value="Vaccination">
                  <label for="vax">Vaccinations</label><br>
                  <input type="radio" id="med" name="type" value="Medication">
                  <label for="med">Medications</label><br>
                  <input type="radio" id="next" name="type" value="Upcoming">
                  <label for="next">Upcoming</label>
                <button type="submit" class="btn">Enter</button>
            </form>
          </div>
        </div> 
        <!---add-medtype-modal--->
        <div id="medTypeModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="exit">&times;</span>
            <form method="post" action="database/save-medications.php">
                  <label for="action">Action taken</label><br>
                  <select id="action" name="action" id="petname" style="width:100%;border:1px solid gray;height:30px;padding:5px 10px;margin:0;margin-bottom:10px" required>
                  <option value="Vaccination">Vaccination</option>
                  <option value="Medication">Medication</option>
                  <option value="Upcoming">Upcoming</option>
                  </select>
                  <label for="med">Medication or Vaccine Name</label><br>
                  <input type="text" name="med" style="width:100%;border:1px solid gray;height:30px;padding:5px 10px;margin:0;margin-bottom:10px" required>
                  <label for="date">Date</label><br>
                  <input type="date" name="date" style="width:100%;border:1px solid gray;height:30px;padding:5px 10px;margin:0;margin-bottom:10px" required>
                <button type="submit" class="btn">Enter</button>
            </form>
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
    <!----filter-modal js---->
    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("filter");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    btn.onclick = function() {
      modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
      modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
    </script>
    <!----add-medtype-modal js---->
    <script>
    // Get the modal
    var medModal = document.getElementById("medTypeModal");

    // Get the button that opens the modal
    var plusbtn = document.getElementById("plus");

    // Get the <span> element that closes the modal
    var medSpan = document.getElementsByClassName("exit")[0];

    // When the user clicks the button, open the modal 
    plusbtn.onclick = function() {
      medModal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    medSpan.onclick = function() {
      medModal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
      if (event.target == medModal) {
        medModal.style.display = "none";
      }
    }
    </script>
    
</body>
</html>