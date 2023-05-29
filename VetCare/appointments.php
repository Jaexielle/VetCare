<?php
include "database/db.php";
session_start();

if((isset($_SESSION["role"])) &&($_SESSION["role"] == 'admin')){
    header("Location: admin-reviewappointments.php");
    exit();
}
if (!isset($_SESSION['user-id'])){
    //echo "<script> alert('Log in to access this section')</script>";
		header('location:unauthorized-access.php');
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
    <div class="appointments-page">
        <div class="set-appointment-top" style="display: flex;justify-content: space-between;">
            <p class="name">Appointments</p>
            <form action="set-appointment.php">
                <button class="btn" type="submit">Set an Appointment</button>
            </form>
        </div>
          <div class="mytabs">
    <input type="radio" id="tabfree" name="mytabs" checked="checked">
    <label for="tabfree">Accepted</label>
    <div class="tab">
      <?php
        $sql = "SELECT * FROM appointment WHERE status = 'Accepted' AND login_id = {$_SESSION["user-id"]}";
        $resultset = mysqli_query($conn, $sql);
        while( $rows = mysqli_fetch_assoc($resultset) ) {
       ?>  
      <div class="box box3">
            <div class="row">
                    <div class="col3" style="border-right:1px solid white;margin:2px auto"><p><?php echo $rows['pet_name']; ?></p></div>
                    <div class="col3" style="border-right:1px solid white;margin:auto"><p><?php echo $rows['date']; ?></p></div>
                    <div class="col3" style="margin:auto"><p><?php echo $rows['time']; ?></p></div>
                    <div class="" style="flex-basis:100%;border-top:1px solid white;"><p><strong>Reason:</strong></p><p style="text-align:center"><?php echo $rows['reason']; ?></p></div>
            </div>
        </div>
        <?php } ?>
    </div>

    <input type="radio" id="tabsilver" name="mytabs">
    <label for="tabsilver">Processing</label>
    <div class="tab">
      <?php
        $sql = "SELECT * FROM appointment WHERE status = 'Processing' AND login_id = {$_SESSION["user-id"]}";
        $resultset = mysqli_query($conn, $sql);
        while( $rows = mysqli_fetch_assoc($resultset) ) {
       ?>  
      <div class="box box3">
            <div class="row">
                    <div class="col3" style="border-right:1px solid white;margin:2px auto"><p><?php echo $rows['pet_name']; ?></p></div>
                    <div class="col3" style="border-right:1px solid white;margin:auto"><p><?php echo $rows['date']; ?></p></div>
                    <div class="col3" style="margin:auto"><p><?php echo $rows['time']; ?></p></div>
                    <div class="" style="flex-basis:100%;border-top:1px solid white;"><p><strong>Reason:</strong></p><p style="text-align:center"><?php echo $rows['reason']; ?></p></div>
            </div>
        </div>
        <?php } ?>
    </div>

    <input type="radio" id="tabgold" name="mytabs">
    <label for="tabgold">Cancelled</label>
    <div class="tab">
      <?php
        $sql = "SELECT * FROM appointment WHERE status = 'Cancelled' AND login_id = {$_SESSION["user-id"]}";
        $resultset = mysqli_query($conn, $sql);
        while( $rows = mysqli_fetch_assoc($resultset) ) {
       ?>  
      <div class="box box3">
            <div class="row">
                    <div class="col3" style="border-right:1px solid white;margin:2px auto"><p><?php echo $rows['pet_name']; ?></p></div>
                    <div class="col3" style="border-right:1px solid white;margin:auto"><p><?php echo $rows['date']; ?></p></div>
                    <div class="col3" style="margin:auto"><p><?php echo $rows['time']; ?></p></div>
                    <div class="" style="flex-basis:50%;border-top:1px solid white;"><p><strong>Reason:</strong></p><p style="text-align:center"><?php echo $rows['reason']; ?></p></div>
                    <div class="" style="flex-basis:50%;border-top:1px solid white;border-left:1px solid white;padding-left:1px"><p><strong>Cancelled due to:</strong></p><p style="text-align:center"><?php echo $rows['cln_reason']; ?></p></div>
            </div>
        </div>
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