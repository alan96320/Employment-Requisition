<?php 
include ("../config/conn.php");
$username = $_POST ['username'];
$password = md5($_POST ['password']); # hash dengan md5

// $stm = $pdo_conn->prepare("SELECT * FROM users WHERE username = ?");
// $stm->bindValue(1, $username); # stm = statement
// $stm->execute() or die(print_r($db->errorInfo(), true)); // incorrect

// $row = $stm->fetch(PDO::FETCH_ASSOC);

// if ($row != null) {
//     header("location: ../index.php");
// }

// var_dump($row ['username']);

// echo "berhasil " . $username. " ". $password;
?>