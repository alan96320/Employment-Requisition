<?php 
include ("../config/conn.php");
$username = $_POST ['username'];
$password = md5($_POST ['password']); # hash dengan md5

$stm = $pdo_conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
$stm->bindValue(1, $username); # stm = statement
$stm->bindValue(2, $password); 
$stm->execute();

$row = $stm->fetch(PDO::FETCH_ASSOC);

if ($row != null) {
    session_start();
    $_SESSION ["username"] = $row ["username"];
    if ($row ['hak_akses'] == 'admin'){
        header("location: ../admin/index.php");
    }elseif ($row ['hak_akses'] == 'pic') {
        header("location: ../pic/index.php");
    }else {
        header("location: ../manager/index.php");
    }
}else {
    echo "user tidak ditemukan"; 
}

//var_dump($row ['username']);
?>