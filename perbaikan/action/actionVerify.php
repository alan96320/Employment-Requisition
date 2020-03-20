<?php 
    include "../action/config.php";
    require '../vendor/autoload.php';
    session_start();
    date_default_timezone_set("Asia/Bangkok");
    $options = array(
        'cluster' => 'ap1',
        'useTLS' => true
    );
    $pusher = new Pusher\Pusher(
        'e9afb284b65046a5d995',
        '542706c8b9d3024bccb3',
        '966829',
        $options
    );
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        $id = $_GET['id'];
        $komentar = $_GET['komentar'];
        $date = date('Y-m-d H:i:s');
        if ($status == "verify") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=1, isReadP=null, timeVerify='$date', komentarA='$komentar' WHERE idFormulir='$id' ");
            $link = 'verify';
            $alert = "suksesVerify";
            $data['message'] = 'Ada pengajuan yang verify oleh admin, silahkan reload brouwser untuk get data.';
            $data['status'] = 1;
            $pusher->trigger('my-channel', 'my-event', $data);
        }elseif ($status == "notVerify") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=2, isReadP=null, timeVerify='$date', komentarA='$komentar' WHERE idFormulir='$id' ");
            $link = 'verify';
            $alert = "notVerify";
            $data['message'] = 'Ada pengajuan yang reject oleh admin, silahkan reload brouwser untuk get data.';
            $data['status'] = 2;
            $pusher->trigger('my-channel', 'my-event', $data);
        }elseif($status == "approve") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=3, isReadP=null, timeApprove='$date', komentarM='$komentar' WHERE idFormulir='$id' ");
            $link = 'approval';
            $alert = "suksesVerify";
            $data['message'] = 'Ada pengajuan yang Approve oleh manager, silahkan reload brouwser untuk get data.';
            $data['status'] = 3;
            $pusher->trigger('my-channel', 'my-event', $data);
        }elseif ($status == "notApprove") {
            $query = mysqli_query($conn, "UPDATE statusapproval SET status=4, isReadP=null, timeApprove='$date', komentarM='$komentar' WHERE idFormulir='$id' ");
            $link = 'approval';
            $alert = "notVerify";
            $data['message'] = 'Ada pengajuan yang Reject oleh manager, silahkan reload brouwser untuk get data.';
            $data['status'] = 4;
            $pusher->trigger('my-channel', 'my-event', $data);
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