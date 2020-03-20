<?php 
    include "../action/config.php";
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $id = $_GET['id'];
        $komentar = $_GET['komentar'];
        $date = date('Y-m-d H:i:s');
        if ($status == "verify") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=1, isReadP=null, timeVerify='$date', komentarA='$komentar' WHERE idFormulir='$id' ");
            $link = 'verify';
            $alert = "suksesVerify";
        }elseif ($status == "notVerify") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=2, isReadP=null, timeVerify='$date', komentarA='$komentar' WHERE idFormulir='$id' ");
            $link = 'verify';
            $alert = "notVerify";
        }elseif($status == "approve") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=3, isReadP=null, timeApprove='$date', komentarM='$komentar' WHERE idFormulir='$id' ");
            $link = 'approval';
            $alert = "suksesVerify";
        }elseif ($status == "notApprove") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=4, isReadP=null, timeApprove='$date', komentarM='$komentar' WHERE idFormulir='$id' ");
            $link = 'approval';
            $alert = "notVerify";
        }
        if (mysqli_affected_rows($conn) > 0) {
            $_SESSION['alert'] = $alert;
            header('location: ../pages/home.php?page='.$link);
        }else{
            $_SESSION['alert'] = "error";
            $_SESSION['error'] = mysqli_error($conn); 
            echo "<script>window.history.back();</script>";
            
        }
        

    }

?>