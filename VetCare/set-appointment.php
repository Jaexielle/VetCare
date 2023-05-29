<?php
include "database/db.php";
session_start();

if((!isset($_SESSION["user-id"])) && ($_SESSION["user-id"] == null)){
    header("Location: log-in.php");
    exit();
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
    <div class="set-appointment-page">
        <div class="" style="display: flex;justify-content: space-between;">
            <p class="name">Set an Appointment</p>
            <form action="appointments.php">
                <button class="btn" type="submit">View Appointments</button>
            </form>
        </div>
        <div class="box">
            <div class="form-sec">
                <label for="date">Date of Appointment:</label>
                <input name="date" type = "date" id="date" required><br>
                <label for="time">Time:</label>
                <input name = "time" type="time" id="time" required><br>
                <label for = "petname">Pet Name:</label>
                <select id="petname" name="petname" id="petname" required>
                    <?php
                    $sql = "SELECT * FROM petownerinfo WHERE login_id = '$userID';";
                    $resultset = mysqli_query($conn, $sql);
                    while( $rows = mysqli_fetch_assoc($resultset) ) {?>
                    <option value="<?php echo $rows['pet_name'];?>"><?php echo $rows['pet_name'];?></option><?php } ?>
                </select><br>
                <label for="reason">Reason for Appointment:</label> <br>
                <textarea name = "reason" id="reason" required></textarea>
                <input class="btn" type="submit" id="confirmation-modal">
            </div>
        </div>
    </div>
    
    <!---modal--->
    <div id="myModal" class="modal">
      <!-- Modal content -->
      <div class="modal-content">
        <span class="close">&times;</span>
          <p style="margin-top:20px"><strong>Please confirm all details below.</strong></p>
          <hr style="margin-bottom:20px">
          <form method="post" action="database/save-appointment.php" class="form-sec">
          <table>
            <tr>
                <td>Date:</td>  
                <td><input name="date" id="dateholder" readonly></td>
            </tr>
            <tr>
                <td>Time:</td>  
                <td><input name="time" id="timeholder" readonly></td>
            </tr>
            <tr>
                <td>Name:</td>  
                <td><input name="petname" id="nameholder" readonly></td>
            </tr>
            <tr>
                <td>Reason:</td>  
                <td style="height:5vh"><textarea name="reason" id="reasonholder" style="width: 20vw;height: 50px;padding: 5px;margin-left:5px" readonly></textarea></td>
            </tr>
          </table>
            <button type="submit" class="btn">Enter</button>
        </form>
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
    <!-----modal js---->
    <script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var bttn = document.getElementById("confirmation-modal");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal 
    bttn.onclick = function() {
      
      var date = document.getElementById("date").value;
      var time = document.getElementById("time").value;
      var name = document.getElementById("petname").value;
      var reason = document.getElementById("reason").value;
      if(date==""||time==""||name==""||reason==""){
          alert("Please input all fields.");
      }
      else{
          document.getElementById("dateholder").value = date;
          document.getElementById("timeholder").value = time;
          document.getElementById("nameholder").value = name;
          document.getElementById("reasonholder").value = reason;modal.style.display = "block";
      }
      
    
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
    
</body>
</html>