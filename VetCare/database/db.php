<?php
    $servername = "sql303.epizy.com";
    $username = "epiz_33420655";
    $password = "INFo2ABM8FWE1Il";
    $dbname ="epiz_33420655_vetcaredb";
    $conn = new mysqli($servername, $username, $password,$dbname);
    
    if(!$conn){
        echo "Connection Failed";
    }                               
?>