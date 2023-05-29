<?php
include "database/db.php";
session_start();

if((!isset($_SESSION["user-id"])) && ($_SESSION["user-id"] == null)){
    header("Location: log-in.php");
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" />


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
    <div class="admin-page">
        <div class="box">
            <div style="">
                <?php 
                if(!isset($_GET['search'])|| ($_GET['search']=="")){}
                else{?>
                    <a href="admin.php"><i class="fa fa fa-solid fa-arrow-left" style="margin-right:20px;font-size:2em"></i></a>
                <?php }?>
                <form method="get" autocomplete="off" style="display: inline; padding-right:20px">
                        <label for="search">Search</label>
                        <input type="text" name="search" style="width: 250px;border:1px solid black;border-radius:10px;height:30px;" placeholder="Pet Name">
                </form>
            </div>
                <div style="display:flex; justify-content:center;height:50vh;overflow: auto;">
                    <?php
                    $sql = "SELECT * FROM login WHERE role = 'client'";
                    $resultset = mysqli_query($conn, $sql);
                    while( $rows = mysqli_fetch_assoc($resultset) ) {
                        if(!isset($_GET['search'])|| ($_GET['search']=="")){
                            $sqlPet = "SELECT * FROM petownerinfo WHERE login_id = '{$rows['login_id']}'";
                        }
                        else{
                            $sqlPet = "SELECT * FROM petownerinfo WHERE login_id = '{$rows['login_id']}'AND pet_name LIKE '%{$_GET['search']}%'";
                        }
                        
                        $resultsetPet = mysqli_query($conn, $sqlPet);
                        while( $rowsPet = mysqli_fetch_assoc($resultsetPet) ) {?>
                            <a href="admin-petdetails.php?varname=<?php echo $rowsPet['pet_id'];?>">
                            <div class="sub-box" style="margin-right:5px">
                                <div class="row">
                                    <div class="col4" style="border-right:3px solid #207567;">
                                        <img src="userPetPictures/<?php echo $rowsPet['pet_picture'] ?>" style="width:10vh;height:10vh;border-radius:50%;border:1px solid gray;center;display:flex;margin:auto 10px">
                                    </div>
                                    <div class="col2" style="">
                                        <p><strong><?php echo $rowsPet['pet_name'];?></strong><br>
                                        <small><?php echo $rows['username'];?></small></p>
                                    </div>
                                </div>
                            </div>
                            </a>
                        <?php }
                    }
                   ?>
                </div>
            <div class="btn add-pet" style="float:right;height:90px;width:80px;padding:5px;border-radius:50%">
                <i class="fa fa fa-solid fa-plus" id="plus" style="text-align:center;width:100%"></i>
            </div>
        </div>
        <!---add-medtype-modal--->
        <div id="medTypeModal" class="modal">
          <!-- Modal content -->
          <div class="modal-content">
            <span class="exit">&times;</span>
            <form method="post" action="database/save-petdetails.php">
                  <label for="username">FurParent Username:</label><br>
                  <select id="select-state" name="username" placeholder="Select username" style="width:100%;border:1px solid gray;height:30px;margin:0;margin-bottom:10px" required>
                    <option value="">Select a state...</option>
                    <?php
                    $sql = "SELECT * FROM login WHERE role = 'client'";
                    $resultset = mysqli_query($conn, $sql);
                    while( $rows = mysqli_fetch_assoc($resultset) ) {?>
                    <option value="<?php echo $rows['login_id']?>"><?php echo $rows['username']?></option><?php } ?>
                  </select>
                  <label for="furname">Furbaby's Name:</label><br>
                  <input type="text" name="furname" style="width:100%;border:1px solid gray;height:30px;padding:5px 10px;margin:0;margin-bottom:10px" required>
                  <label for="age">Age</label><br>
                  <input type="text" name="age" style="width:100%;border:1px solid gray;height:30px;padding:5px 10px;margin:0;margin-bottom:10px" required>
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
    
    $(document).ready(function () {
      $('select').selectize({
          sortField: 'text'
      });
    });
    </script>
</body>
</html>