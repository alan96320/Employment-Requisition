<?php
include "../config/conn.php";
session_start();
if (!isset($_SESSION['username'])) {
	header("location: index.php");
}

$sql = "INSERT INTO formulir (`id_pic`, `id_formulir`, `id_departemen`, `requester`, `job_type`, 
		`status_verif`, `status_approved`, `approved_by`, `verif_by`, `open_position`, 
		`join_date`, `budget`, `education_req`, `major_function`, `experience_backgrnd`)
	   VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

$IdPic = $_POST['id_pic'];
$FormNo = $_POST['id_formulir'];
$Departemen = $_POST['id_departemen'];
$Requester = $_POST['requester'];
$JobType = $_POST['job_type'];
$StatVerif = $_POST['status_verif'];
$StatAppr = $_POST['status_approved'];
$AppBy = $_POST['approved_by'];
$VerBy = $_POST['verif_by'];
$OpPost = $_POST['open_position'];
$JoDate = $_POST['join_date'];
$Budget = $_POST['budget'];
$EduReq = $_POST['education_req'];
$MajFunc = $_POST['major_function'];
$ExpBack = $_POST['experience_backgrnd'];

$stm = $pdo_conn->prepare($sql);
$stm->execute([
	$IdPic, $FormNo, $Departemen, $Requester, $JobType,
	$StatVerif, $StatAppr, $AppBy, $VerBy, $OpPost,
	$JoDate, $Budget, $EduReq, $MajFunc, $ExpBack
]);

//echo $stm->debugDumpParams();
header('location: ../pic/formER.php');
