<?php 
    include "../action/config.php";
    session_start();

    if(isset($_GET['status'])){
        if ($_GET['status'] == "update" || $_GET['status'] == "add") {
            $nama = $_POST['nama'];
            if ($_GET['status'] == "add") {
                $sql= "INSERT INTO jabatan (nama_jbt) VALUES ('$nama') ";
                $sth = $pdo_conn->prepare($sql);
                $sth->execute();
                if ($sth->rowCount() > 0) { 
                    $_SESSION['alert'] = "suksesAdd";
                    header('location: ../pages/home.php?page=jabatan');
                }else{
                    $_SESSION['alert'] = "gagal";
                    $_SESSION['error'] = $sth->errorInfo();
                    echo "<script>window.history.back();</script>";
                }
            }elseif ($_GET['status'] == "update") {
                if(isset($_GET['id'])){
                    $id = str_replace(date('mYd'),'',$_GET['id']);
                    $sql= "UPDATE jabatan SET nama_jbt='$nama' WHERE id_jabatan=$id ";
                    $sth = $pdo_conn->prepare($sql);
                    $sth->execute();
                    if ($sth->rowCount() > 0) {
                        $_SESSION['alert'] = "suksesEdit";
                        header('location: ../pages/home.php?page=jabatan');
                    }else{
                        $_SESSION['alert'] = "gagal";
                        $_SESSION['error'] = $sth->errorInfo();
                        echo "<script>window.history.back();</script>";
                    }
                }
            }
        }elseif ($_GET['status'] == "delete") {
            $id = $_POST['id'];
            $stm = $pdo_conn->prepare("DELETE FROM jabatan WHERE id_jabatan = '$id' ");
            $stm->execute();
            if ($stm->rowCount() > 0) {
                $_SESSION['alert'] = "suksesDelete";
                echo "sukses";
            }else{
                echo "gagal";
            }
        }
    }
?>