<?php 
    include "../action/config.php";
    session_start();
    $id = $_POST['id'];
    $stm = $pdo_conn->prepare("DELETE FROM karyawan WHERE id_karyawan = '$id' ");
    $stm->execute();
    if ($stm->rowCount() > 0) {
        $_SESSION['alert'] = "suksesDelete";
        echo "sukses";
    }else{
        echo "gagal";
    }
?>