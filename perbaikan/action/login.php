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
    if ($row != null) {
      $_SESSION ["id"] = $row ["id_karyawan"];
      $_SESSION ["username"] = $row ["username"];
      $_SESSION ["hak_akses"] = $row ["hak_akses"];
      $_SESSION ["image"] = $row ["foto"];
      $_SESSION ["department"] = $row ["id_dept"];
      $_SESSION ["name"] = $row ["nama"];
      header("location: ../pages/home.php");
    }else{
      $_SESSION ["statusLogin"] = "gagal";
      header("location: ../");
    }
?>