<?php 
$pdo_conn= new PDO("mysql:host=localhost;dbname=tugas_akhir", "root", "");
$conn = mysqli_connect("localhost","root","","tugas_akhir");
function lihat($v)
{
	echo "<pre>";
	print_r($v);
	echo "</pre>";
	exit;
}

?>