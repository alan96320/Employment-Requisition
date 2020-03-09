<?php 
$pdo_conn= new PDO("mysql:host=localhost;dbname=tugas_akhir", "root", "");

function lihat($v)
{
	echo "<pre>";
	print_r($v);
	echo "</pre>";
	exit;
}

?>