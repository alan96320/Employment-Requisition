<?php 
session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["hak_akses"]);
    unset($_SESSION["id"]);
    unset($_SESSION["image"]);
    unset($_SESSION ["department"]);
    unset($_SESSION ["name"]);
    header("location: ../");
?>