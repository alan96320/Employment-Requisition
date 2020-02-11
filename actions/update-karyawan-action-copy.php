<?php
// require_once("db.php");
include "../config/conn.php";
session_start();
if (!empty($_POST["save record"])){

  // $pdo_statement=$pdo_conn->prepare("UPDATE nama set departemen='" . $_POST['nama_dept'] . "', 
  // jabatan='" . $_POST['nama'] . "', marital_status='" . $_POST['nama'] . "' where id=" . 

$_GET["id"]);
$result = $pdo_statement->execute();
	if($result) {
  		header('location:index.php'); 
	}

}
$pdo_statement = $pdo_conn->prepare("SELECT * FROM karyawan where id=" . $_GET["id"]);
if (!$pdo_statement) {
  die("Connection failed: " . mysqli_connect_error());
} else
// header('location: ../admin/list-karyawan.php?id=' . $_GET["id"]);
 echo "Connection Sucess";

$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
?>
