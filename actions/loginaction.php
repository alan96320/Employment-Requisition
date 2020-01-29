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
            $_SESSION ["hak_akses"] = $row ["hak_akses"];
            
            if ($row ['hak_akses'] == 'admin'){
                header("location: ../admin/index.php");
            }elseif ($row ['hak_akses'] == 'pic') {
                header("location: ../pic/index.php");
            }else {
                header("location: ../manager/index.php");
            }
        }elseif ($username = "empty") {
            } echo "<p class='error'> You did not fill in all fields!</p>";  
                        exit(); 
            
//var_dump($row ['username']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

    <title>SIER : Login Action </title>
    <!-- Favicon-->
    <link rel="icon" href="../img/alcr.jpg" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>
<body>
            <div class="alert alert-danger" role="alert">;
                This is a danger alert—check it out!
            </div>
</body>
</html>