<?php 
session_start();
include "db.php";

if(!empty($_POST['username-login'])&& !empty($_POST['password-login'])){
    //function to clean data
    function validate($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $un = validate($_POST['username-login']);
    $pass = validate ($_POST['password-login']);
    
    $stmt = $conn->prepare("SELECT * FROM `login` WHERE `username` = ? AND `password` = ?");
    $stmt->bind_param("ss",$un, $pass);
    $stmt->execute();
    
    $result = $stmt->get_result();
    if($result->num_rows === 0){
        $_SESSION['error'] = "Incorrect Credentials";

        header("Location: ../log-in.php?incorrect-credentials");
        exit();
    }
    
    $row = $result->fetch_assoc();
    $_SESSION["user-data"] = $row;
    $_SESSION["user-id"] = $row["login_id"];
    $_SESSION["role"] = $row["role"];
    
    mysqli_close($conn); 
    header("Location: ../log-in.php");
    exit();

} else {
    header("Location: ../account.php?login-incomplete");
    exit();
}
?>
<script src="../script.js"></script>