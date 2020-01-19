<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: login.html");
}

$sql= "INSERT INTO karyawan (`id_karyawan`, `nama`, `id_dept`, `jabatan`, `tanggal_masuk`, `marital_status`, `username`, `password`, `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, `alamat`, `email`, `no_telepon`, `hak_akses`) 
      VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$NIK=$_POST['id_karyawan'];
$Nama=$_POST['nama'];
$Departemen=$_POST['departemen'];
$Jabatan=$_POST['jabatan'];
$TanggalMasuk=$_POST['tanggal_masuk'];
$Status=$_POST['status'];

$stm = $pdo_conn->prepare($sql);
$stm->execute([$NIK, $Nama, $Departemen, $Jabatan, $TanggalMasuk, $Status, null, null, null, null, null, null, null, null, null, 1]);

header('location: ../admin/list-karyawan.php');
?>
