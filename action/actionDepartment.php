<?php 
    include "../action/config.php";
    session_start();

    if(isset($_GET['status'])){
        if ($_GET['status'] == "update" || $_GET['status'] == "add") {
            $nama = $_POST['nama'];
            $cost = $_POST['cost'];
            if ($_GET['status'] == "add") {
                $sql= "INSERT INTO departemen (nama_dept, cost_center) VALUES ('$nama','$cost') ";
                $sth = $pdo_conn->prepare($sql);
                $sth->execute();
                if ($sth->rowCount() > 0) { 
                    $_SESSION['alert'] = "suksesAdd";
                    header('location: ../pages/home.php?page=department');
                }else{
                    $_SESSION['alert'] = "gagal";
                    $_SESSION['error'] = $sth->errorInfo();
                    echo "<script>window.history.back();</script>";
                }
            }elseif ($_GET['status'] == "update") {
                if(isset($_GET['id'])){
                    $id = str_replace(date('mYd'),'',$_GET['id']);
                    $sql= "UPDATE departemen SET nama_dept='$nama', cost_center='$cost' WHERE id_dept=$id ";
                    $sth = $pdo_conn->prepare($sql);
                    $sth->execute();
                    if ($sth->rowCount() > 0) {
                        $_SESSION['alert'] = "suksesEdit";
                        header('location: ../pages/home.php?page=department');
                    }else{
                        $_SESSION['alert'] = "gagal";
                        $_SESSION['error'] = $sth->errorInfo();
                        echo "<script>window.history.back();</script>";
                    }
                }
            }
        }elseif ($_GET['status'] == "delete") {
            $id = $_POST['id'];
            $stm = $pdo_conn->prepare("DELETE FROM departemen WHERE id_dept = '$id' ");
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