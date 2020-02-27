<?php 
	
$dsn = "mysql:host=localhost;dbname=tugas_akhir";
          //nama host       //namadatabase
$user = "root";      //Username
$passwd = "";        // isilah password jika ada password 

$pdo_conn= new PDO($dsn, $user, $passwd); # dsn = data source number

//echo"berhasil koneksi";

function lihat($v){
	echo "<pre>";
	print_r($v);
	echo "</pre>";
	exit;
}
?>