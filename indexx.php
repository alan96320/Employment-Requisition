<?php

session_start();
      if ($_SESSION ["hak_akses"] == 'admin'){
        header("location: ../admin/index.php");
      }elseif ($_SESSION ["hak_akses"] == 'pic') {
        header("location: ../pic/index.php");
      }else {
        header("location: ../manager/index.php");
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

  <title>SIER : Login</title>
  <!-- Favicon-->
  <link rel="icon" href="img/alcr.jpg" type="image/x-icon">

  <!-- Custom fonts for this template-->
  <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <linkhref="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <!-- menampilkan images Ciba -->
              <div class="col-lg-1 d-none d-lg-block"> 
                <img src="img/CVB.jpg" style="
                        width: 885px;
                        height: 450px;
                        margin-left: 11px;
                        margin-right: 11px;
                ">
              </div>
              <div class="col-lg-4">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h2 text-gray-900 mb-4">Welcome</h1>
                  </div>
                  <!-- <form class="user" method="post" action="actions/loginaction.php"> -->
                    <div class="form-group">
                      <input name = "username" type="text" class="form-control form-control-user"
                        aria-describedby="text" placeholder="Enter Username" required>
                    </div>
                    <div class="form-group">
                      <input name = "password"type="password" class="form-control form-control-user"
                        placeholder="Enter Password" required>
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                  </form>

                  <!-- <hr> -->
                  <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div>
                    
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
  <!-- End of container -->

  <!-- Bootstrap core JavaScript-->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- Core plugin JavaScript-->
  <script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
  <!-- Custom scripts for all pages-->
  <script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Footer -->
  <footer class="sticky-footer bg-white">
    <div class="container my-auto">
      <div class="copyright text-center my-auto">
        <span>Copyright &copy; Sistem Informasi Employment Requisition 2019</span>
      </div>
    </div>
  </footer>
  <!-- End of Footer -->

</body>

</html>