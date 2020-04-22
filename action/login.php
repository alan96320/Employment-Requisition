<?php 
    include ("config.php");
    session_start();
    $username = $_POST ['username'];
    $password = md5($_POST ['password']);

    $stm = $pdo_conn->prepare("SELECT * FROM karyawan WHERE username = ? AND password = ?");
    $stm->bindValue(1, $username);
    $stm->bindValue(2, $password); 
    $stm->execute();
    $row = $stm->fetch(PDO::FETCH_ASSOC);

    $std = $pdo_conn->prepare("SELECT * FROM cangepassword WHERE oldPassword = ?");
    $std->bindValue(1, $password);
    $std->execute();
    $data = $std->fetch(PDO::FETCH_ASSOC);
    
    if ($row != null) {
      if ($data['oldPassword'] == $row['password']) {
        $_SESSION ["change"] = "change";
        $_SESSION ["id"] = $row["id_karyawan"];
        header("location: ../");
      }else{
        $_SESSION ["id"] = $row ["id_karyawan"];
        $_SESSION ["username"] = $row ["username"];
        $_SESSION ["hak_akses"] = $row ["hak_akses"];
        $_SESSION ["image"] = $row ["foto"];
        $_SESSION ["department"] = $row ["id_dept"];
        $_SESSION ["name"] = $row ["nama"];
        echo "<script>sessionStorage.setItem('hak', '".$row["hak_akses"]."');</script>";
        header("location: ../pages/home.php");
        // 234018202003
      }
    }else{
      $_SESSION ["statusLogin"] = "gagal";
      header("location: ../");
    }
?>