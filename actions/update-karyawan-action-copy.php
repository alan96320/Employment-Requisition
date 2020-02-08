<?php
require_once("db.php");
if (!empty($_POST["save record"])){

  $pdo_statement=$pdo_conn->prepare("update nama set departemen='" . $_POST['nama_dept'] . "', 
  jabatan='" . $_POST['nama'] . "', marital_status='" . $_POST['nama'] . "' where id=" . 

$_GET["id"]);
$result = $pdo_statement->execute();
if($result) {
  header('location:index.php');
}
}
$pdo_statement = $pdo_conn->prepare("SELECT * FROM karyawan where id=" . $_GET["id"]);
$pdo_statement->execute();
$result = $pdo_statement->fetchAll();
?>

