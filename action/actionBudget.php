<?php 
    include "../action/config.php";
    session_start();

    if(isset($_GET['status'])){
        if ($_GET['status'] == "update" || $_GET['status'] == "add") {
            $departemen = $_POST['departemen'];
            $periode = $_POST['periode'];
            $budget = $_POST['budget'];
            if ($_GET['status'] == "add") {
                $sql= "INSERT INTO budget (idDepartment, periode, budget) VALUES ('$departemen','$periode','$budget') ";
                $sth = $pdo_conn->prepare($sql);
                $sth->execute();
                if ($sth->rowCount() > 0) { 
                    $_SESSION['alert'] = "suksesAdd";
                    header('location: ../pages/home.php?page=budget');
                }else{
                    $_SESSION['alert'] = "gagal";
                    $_SESSION['error'] = $sth->errorInfo();
                    echo "<script>window.history.back();</script>";
                }
            }elseif ($_GET['status'] == "update") {
                if(isset($_GET['id'])){
                    $id = str_replace(date('mYd'),'',$_GET['id']);
                    $sql= "UPDATE budget SET idDepartment='$departemen', periode='$periode', budget='$budget' WHERE idBudget=$id ";
                    $sth = $pdo_conn->prepare($sql);
                    $sth->execute();
                    if ($sth->rowCount() > 0) {
                        $_SESSION['alert'] = "suksesEdit";
                        header('location: ../pages/home.php?page=budget');
                    }else{
                        $_SESSION['alert'] = "gagal";
                        $_SESSION['error'] = $sth->errorInfo();
                        echo "<script>window.history.back();</script>";
                    }
                }
            }
        }elseif ($_GET['status'] == "delete") {
            $id = $_POST['id'];
            $stm = $pdo_conn->prepare("DELETE FROM budget WHERE idBudget = '$id' ");
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