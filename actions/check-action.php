<?php

session_start();

$username = $_POST["username"];
$error = "username/password incorrect";

if($username == "admin"){
    $_SESSION["username"] = $username;
    header("location: ../admin/index.php"); //send user to homepage, for example.
}else{
    $_SESSION["error"] = $error;
    header("location: ../actions/loginaction.php"); //send user back to the login page.
}

?>