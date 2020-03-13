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
      $_SESSION ["username"] = $row ["username"];
      $_SESSION ["hak_akses"] = $row ["hak_akses"];
      $_SESSION ["id"] = $row ["user_id"];
      $_SESSION ["image"] = $row ["foto"];
      header("location: ../pages/home.php");
    }else{
      $_SESSION ["statusLogin"] = "gagal";
      header("location: ../");
    }
?>