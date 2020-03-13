<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

$sql= "INSERT INTO karyawan (`id_karyawan`, `nama`, `id_dept`, `jabatan`, `tanggal_masuk`, 
		`marital_status`, `jenis_kelamin`, `status_karyawan`, `tempat_lahir`, `tanggal_lahir`, 
		`alamat`,`hak_akses`)  
	   VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";

$NIK=$_POST['id_karyawan'];
$Nama=$_POST['nama'];
$Departemen=$_POST['departemen'];
$Jabatan=$_POST['jabatan'];
$TanggalMasuk=$_POST['tanggal_masuk'];
$MaritalStatus=$_POST['status'];
$Status=$_POST['status_karyawan'];
$jkelamin=$_POST['jenis_kelamin'];
$tgl_lahir=$_POST['tanggal_lahir'];
$tmpt_lahir=$_POST['tempat_lahir'];
$alamat=$_POST['alamat'];

$stm = $pdo_conn->prepare($sql);
$stm->execute([$NIK, $Nama, $Departemen, $Jabatan, $TanggalMasuk, $MaritalStatus, $jkelamin, 
				$Status, $tmpt_lahir, $tgl_lahir, $alamat, "karyawan"]);

//echo $stm->debugDumpParams();
	header('location: ../admin/list-karyawan.php');

?>
