<?php 
include ("../config/conn.php");
$username = $_POST ['username'];
$password = md5($_POST ['password']); # hash dengan md5



?>