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
        // $id = $_GET['id'];
        // $komentar = $_GET['komentar'];
        // $date = date('Y-m-d h:i:s');
        // if ($status == "verify") {
        //     $query = mysqli_query($conn, "UPDATE statusapproval SET status=1, timeVerify='$date', komentarA='$komentar' WHERE idFormulir='$id' ");
        //     $link = 'verify';
        //     $alert = "suksesVerify";
        // }elseif ($status == "notVerify") {
        //     $query = mysqli_query($conn, "UPDATE statusapproval SET status=2, timeVerify='$date', komentarA='$komentar' WHERE idFormulir='$id' ");
        //     $link = 'verify';
        //     $alert = "notVerify";
        // }elseif($status == "approve") {
        //     $query = mysqli_query($conn, "UPDATE statusapproval SET status=3, timeApprove='$date', komentarM='$komentar' WHERE idFormulir='$id' ");
        //     $link = 'approval';
        //     $alert = "suksesVerify";
        // }elseif ($status == "notApprove") {
        //     $query = mysqli_query($conn, "UPDATE statusapproval SET status=4, timeApprove='$date', komentarM='$komentar' WHERE idFormulir='$id' ");
        //     $link = 'approval';
        //     $alert = "notVerify";
        // }
        // if (mysqli_affected_rows($conn) > 0) {
        //     $_SESSION['alert'] = $alert;
        //     header('location: ../pages/home.php?page='.$link);
        // }else{
        //     $_SESSION['alert'] = "error";
        //     $_SESSION['error'] = mysqli_error($conn); 
        //     echo "<script>window.history.back();</script>";
            
        // }
        

    }

?>