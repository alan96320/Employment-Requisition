<?php 
    include "../action/config.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $date = date('Y-m-d h:i:s');
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $status = $_SESSION ["hak_akses"];
        if ($status == "pic") {
            $result = mysqli_query($conn, "UPDATE statusapproval SET isReadP=1 WHERE idFormulir='$id' ");
        } elseif ($status == "admin") {
            $result = mysqli_query($conn, "UPDATE statusapproval SET isReadA=1 WHERE idFormulir='$id' ");
        } elseif ($status == "manager") {
            $result = mysqli_query($conn, "UPDATE statusapproval SET isReadM=1 WHERE idFormulir='$id' ");
        }
        if (mysqli_affected_rows($conn) > 0) {
            header('location: ../pages/home.php?page=details&id='.date("mYd").$id);
        }
        

    }

?>