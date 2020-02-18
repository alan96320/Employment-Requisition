<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
  header("location: index.php");
}

try{
	$sql= "DELETE FROM `karyawan` WHERE `id_karyawan`=?";
	$stm = $pdo_conn->prepare($sql);
	$NIK=$_GET['id_karyawan'];
	if($stm->execute([$NIK]))
	{
		echo "<script> alert('Data Karyawan berhasil dihapus');
		window.location = '../admin/list-karyawan.php'</script>";
	}else{
		echo "<script> alert('Data Karyawan tidak berhasil dihapus.'); 
        history.back() </script>";
    	}
    } 
    // show errors
	catch(PDOException $e){
		die('ERROR: ' . $exception->getMessage());
    }

// header('location: ../admin/list-karyawan.php');
?>