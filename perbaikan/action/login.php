<?php 
include ("config.php");

    $username = $_POST ['username'];
    $password = md5($_POST ['password']);

    $stm = $pdo_conn->prepare("SELECT * FROM users WHERE username = ? AND password = ?");
    $stm->bindValue(1, $username); # stm = statement
    $stm->bindValue(2, $password); 
    $stm->execute();

    $row = $stm->fetch(PDO::FETCH_ASSOC);
    if ($row != null) {
        session_start();
        $_SESSION ["username"] = $row ["username"];
        $_SESSION ["hak_akses"] = $row ["hak_akses"];
        $_SESSION ["id"] = $row ["user_id"];
        $_SESSION ["image"] = $row ["image"];
        header("location: ../pages/home.php");
    } 
?>

<script type="text/javascript">
  alert("upss... user/password salah");
  history.back();
</script>