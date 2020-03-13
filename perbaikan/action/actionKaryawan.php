<?php
    include "../action/config.php";
    session_start();
if(isset($_GET['status'])){
    if ($_GET['status'] == "update" || $_GET['status'] == "add") {
        if ($_POST['hak'] == "karyawan") {
            $username = null;
            $password = null;
        }else{
            if ($_POST['username'] == "") {
                $username = "user";
                $password = md5("user");
            }else{
                $username = $_POST['username'];
                $password = $_POST['password'];
            }
        }
    
        $folder ="../assets/uploadImage/"; // tempat menyimpan foto
        $foto = $_FILES["foto"]["name"]; // get nama foto
        $temp = explode(".", $foto); // kita potong nama foro yg kita upload dan sisakan extencen nya saja
        $newfilename = round(microtime(true)) . '.' . end($temp); // lalu kita rubah dengan nomor acak di tambah extencen tadi
        $path = $folder . $newfilename ; // kita gabungkan folder penyimpanan dengan nama filenya
        $allowed = array('jpeg','png' ,'jpg', 'JPEG', 'JPG', 'PNG'); // dan kita group kan dulu type file apa saja yg boleh masuk
        $ext = pathinfo($newfilename, PATHINFO_EXTENSION); // dan kita ambil extencen file yg kita upload untuk di check
        $id = $_POST['nik'];
        $departemen = $_POST['departemen'];
        $jabatan = $_POST['jabatan'];
        $marital = $_POST['marital'];
        $ttm = date('Y-m-d', strtotime($_POST['ttm']));
        $jk =$_POST['jk'];
        $sk = $_POST['sk'];
        $tl = $_POST['tl'];
        $ttl = date('Y-m-d', strtotime($_POST['ttl']));
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $nomor = $_POST['nomor'];
        $hak = $_POST['hak'];
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            if($status == 'update'){
                $sql = $pdo_conn->prepare("SELECT * FROM karyawan WHERE id_karyawan='$id'");
                $sql->execute();
                $getData = $sql->fetch(PDO::FETCH_ASSOC);
                if($foto == ""){
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
        if(isset($_GET['status'])){
            $status = $_GET['status'];
            if($status == "update"){
                if($foto !== ""){
                    if(!in_array($ext, $allowed) ) { 
                        $_SESSION['alert'] = "gagalUpload";
                        echo "<script>window.history.back();</script>";
                    }else{
                        move_uploaded_file( $_FILES['foto'] ['tmp_name'], $path);
                    }
                }else{
                    $newfilename = null ;
                }
                $sql= "UPDATE karyawan SET id_dept='$departemen', username='$username', password='$password', nama='$nama', id_jabatan='$jabatan', marital_status='$marital', tanggal_masuk='$ttm', jenis_kelamin='$jk', status_karyawan='$sk', tempat_lahir='$tl', tanggal_lahir='$ttl', alamat='$alamat', email='$email', no_telepon='$nomor', foto='$newfilename', hak_akses='$hak' WHERE id_karyawan=$id ";
                $sth = $pdo_conn->prepare($sql);
                $sth->execute();
                if ($sth->rowCount() > 0) {
                $_SESSION['alert'] = "suksesEdit";
                header('location: ../pages/home.php?page=karyawan');
                }else{
                    if($foto !== ""){
                        unlink($path);
                    }
                    $_SESSION['alert'] = "gagal";
                    $_SESSION['error'] = $sth->errorInfo();
                    print_r($sth->errorInfo());
                    // echo "<script>window.history.back();</script>";
                }
            }elseif($status == "add"){
                if($foto !== ""){
                    if(!in_array($ext, $allowed) ) { 
                        $_SESSION['alert'] = "gagalUpload";
                        echo "<script>window.history.back();</script>";
                    }else{
                        move_uploaded_file( $_FILES['foto'] ['tmp_name'], $path);
                    }
                }else{
                    $newfilename = null ;
                }
                $sql= "INSERT INTO karyawan (id_karyawan, id_dept,username,password,nama,id_jabatan, marital_status, tanggal_masuk, jenis_kelamin, status_karyawan, tempat_lahir, tanggal_lahir, alamat,email,no_telepon,foto,hak_akses) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ";
                $sth = $pdo_conn->prepare($sql);
                $sth->execute($params);
                if ($sth->rowCount() > 0) { 
                $_SESSION['alert'] = "suksesAdd";
                header('location: ../pages/home.php?page=karyawan');
                }else{
                    if($foto !== ""){
                        unlink($path);
                    }
                    $_SESSION['alert'] = "gagal";
                    $_SESSION['error'] = $sth->errorInfo();
                    echo "<script>window.history.back();</script>";
                }
            }elseif($status == "delete"){
                $_SESSION['alert'] = "suksesDelete";
                $id = $_POST['id'];
                $stm = $pdo_conn->prepare("DELETE FROM karyawan WHERE id_karyawan = '$id' ");
                $stm->execute();
                if ($stm->rowCount() > 0) {
                    $_SESSION['alert'] = "suksesDelete";
                    echo "sukses";
                }else{
                    echo "gagal";
                }
            }
        }
}

    

?>




















