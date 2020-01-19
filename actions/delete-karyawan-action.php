<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

$sql= "DELETE FROM `karyawan` WHERE `id_karyawan`=?";

$NIK=$_GET['id_karyawan'];

$stm = $pdo_conn->prepare($sql);
$stm->execute([$NIK]);
header('location: ../admin/list-karyawan.php');


?>