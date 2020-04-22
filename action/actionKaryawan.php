<?php
include "../action/config.php";
session_start();
if (isset($_GET['status'])) {
    if ($_GET['status'] == "update" || $_GET['status'] == "add") {
        $addPassword = false;
        if ($_POST['hak'] == "karyawan") {
            $username = null;
            $password = null;
        } else {
            if ($_POST['username'] == "") {
                $username = $_POST['nik'];
                $password = md5($_POST['nik']);
                $_SESSION['sendUSername'] = $username;
                $addPassword = true;
            } else {
                $username = $_POST['username'];
                $password = $_POST['password'];
            }
        }

        $folder = "../assets/uploadImage/"; // tempat menyimpan foto
        $foto = $_FILES["foto"]["name"]; // get nama foto
        $temp = explode(".", $foto); // kita potong nama foro yg kita upload dan sisakan extencen nya saja
        $newfilename = round(microtime(true)) . '.' . end($temp); // lalu kita rubah dengan nomor acak di tambah extencen tadi
        $path = $folder . $newfilename; // kita gabungkan folder penyimpanan dengan nama filenya
        $allowed = array('jpeg', 'png', 'jpg', 'JPEG', 'JPG', 'PNG'); // dan kita group kan dulu type file apa saja yg boleh masuk
        $ext = pathinfo($newfilename, PATHINFO_EXTENSION); // dan kita ambil extencen file yg kita upload untuk di check
        $id = $_POST['nik'];
        $departemen = $_POST['departemen'];
        $jabatan = $_POST['jabatan'];
        $marital = $_POST['marital'];
        $ttm = date('Y-m-d', strtotime($_POST['ttm']));
        $jk = $_POST['jk'];
        $sk = $_POST['sk'];
        $tl = $_POST['tl'];
        $ttl = date('Y-m-d', strtotime($_POST['ttl']));
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $nomor = $_POST['nomor'];
        $hak = $_POST['hak'];
        if (isset($_GET['status'])) {
            $status = $_GET['status'];
            if ($status == 'update') {
                $sql = $pdo_conn->prepare("SELECT * FROM karyawan WHERE id_karyawan='$id'");
                $sql->execute();
                $getData = $sql->fetch(PDO::FETCH_ASSOC);
                if ($foto == "") {
                    $newfilename = $getData['foto'];
                }
            }
        }
        $params = [
            $id,
            $departemen,
            $username,
            $password,
            $nama,
            $jabatan,
            $marital,
            $ttm,
            $jk,
            $sk,
            $tl,
            $ttl,
            $alamat,
            $email,
            $nomor,
            $newfilename,
            $hak,
        ];
    }
    if (isset($_GET['status'])) {
        $status = $_GET['status'];
        if ($status == "update") {
            if ($foto !== "") {
                if (!in_array($ext, $allowed)) {
                    $_SESSION['alert'] = "gagalUpload";
                    echo "<script>window.history.back();</script>";
                } else {
                    move_uploaded_file($_FILES['foto']['tmp_name'], $path);
                }
            }
            $sql = "UPDATE karyawan SET id_dept='$departemen', username='$username', password='$password', nama='$nama', id_jabatan='$jabatan', marital_status='$marital', tanggal_masuk='$ttm', jenis_kelamin='$jk', status_karyawan='$sk', tempat_lahir='$tl', tanggal_lahir='$ttl', alamat='$alamat', email='$email', no_telepon='$nomor', foto='$newfilename', hak_akses='$hak' WHERE id_karyawan=$id ";
            $sth = $pdo_conn->prepare($sql);
            $sth->execute();
            if ($sth->rowCount() > 0) {
                if ($addPassword == true) {
                    mysqli_query($conn, "INSERT INTO cangepassword (idUser, oldPassword) VALUES ('$id', '$password') ");
                }
                $_SESSION['alert'] = "suksesEdit";
                header('location: ../pages/home.php?page=karyawan');
            } else {
                if ($foto !== "") {
                    unlink($path);
                }
                $_SESSION['alert'] = "gagal";
                $_SESSION['error'] = $sth->errorInfo();
                echo "<script>window.history.back();</script>";
            }
        } elseif ($status == "add") {
            if ($foto !== "") {
                if (!in_array($ext, $allowed)) {
                    $_SESSION['alert'] = "gagalUpload";
                    echo "<script>window.history.back();</script>";
                } else {
                    move_uploaded_file($_FILES['foto']['tmp_name'], $path);
                }
            } else {
                $newfilename = null;
            }
            $sql = "INSERT INTO karyawan (id_karyawan, id_dept,username,password,nama,id_jabatan, marital_status, tanggal_masuk, jenis_kelamin, status_karyawan, tempat_lahir, tanggal_lahir, alamat,email,no_telepon,foto,hak_akses) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
            $sth = $pdo_conn->prepare($sql);
            $sth->execute($params);
            if ($sth->rowCount() > 0) {
                if ($addPassword == true) {
                    mysqli_query($conn, "INSERT INTO cangepassword (idUser, oldPassword) VALUES ('$id', '$password') ");
                }
                $_SESSION['alert'] = "suksesAdd";
                header('location: ../pages/home.php?page=karyawan');
            } else {
                if ($foto !== "") {
                    unlink($path);
                }
                $_SESSION['alert'] = "gagal";
                $_SESSION['error'] = $sth->errorInfo();
                echo "<script>window.history.back();</script>";
            }
        } elseif ($status == "delete") {
            $id = $_POST['id'];
            $stm = $pdo_conn->prepare("DELETE FROM karyawan WHERE id_karyawan = '$id' ");
            $stm->execute();
            if ($stm->rowCount() > 0) {
                mysqli_query($conn, "DELETE FROM cangepassword WHERE idUser = '$id' ");
                $_SESSION['alert'] = "suksesDelete";
                echo "sukses";
            } else {
                echo "gagal";
            }
        }
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SIER : Halaman Karyawan </title>
    <!-- Favicon-->
    <link rel="icon" href="../img/alcr.jpg" type="image/x-icon">

    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>