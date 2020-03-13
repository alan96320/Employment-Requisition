<?php 
include ("../config/conn.php");
session_start();
$username = $_POST ['username'];
$password = md5($_POST ['password']); # hash dengan md5


// $sql= INSERT INTO formulir VALUES (`id_formulir`, `id_departemen`, `requester`, `job_type`, `status_verif`, `status_approved`, `approved_by`, `verif_by`, `open_position`, `join_date`, `budget`, `education_req`, `major_function`, `experience_backgrnd`);

window.location('../pic/formER.php');

// lihat($data_user);

?>