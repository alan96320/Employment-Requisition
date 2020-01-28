<?php

session_start();
  if(isset($_SESSION ["hak_akses"])){
    if ($_SESSION ["hak_akses"] == 'admin'){
      header("location: ./admin/index.php");
    }elseif ($_SESSION ["hak_akses"] == 'pic') {
      header("location: ./pic/index.php");
    }elseif ($_SESSION ["hak_akses"] == 'manager') {
      header("location: ./manager/index.php");
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

 	<title>SIER : Login</title>
  	<!-- Favicon-->
  	<link rel="icon" href="img/alcr.jpg" type="image/x-icon">

	<style>
		body, html {
		height: 100%;
		font-family: Arial, Helvetica, sans-serif;
		}

		* {
		box-sizing: border-box;
		}

		.bg-img {
		/* The image used */
		background-image: url("img/CVB.jpg");

		min-height: 70%;

		/* Center and scale the image nicely */
		background-position: center;
		background-repeat: no-repeat;
		background-size: cover;
		position: relative;
		}

		/* Add styles to the form container */
		.container {
		position: absolute;
		right: 0;
		margin: 20px;
		max-width: 300px;
		padding: 16px;
		background-color: white;
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
		width: 100%;
		padding: 15px;
		margin: 5px 0 22px 0;
		border: none;
		background: #f1f1f1;
		}

		input[type=text]:focus, input[type=password]:focus {
		background-color: #ddd;
		outline: none;
		}

		/* Set a style for the submit button */
		.btn {
		background-color: #40a8f7;
		color: white;
		padding: 16px 20px;
		border: none;
		cursor: pointer;
		width: 100%;
		opacity: 0.9;
		}

		.btn:hover {
		opacity: 1;
		}

		.footer {
		position: fixed;
		left: 0;
		bottom: 0;
		width: 100%;
		background-color: #4080f7;
		color: white;
		text-align: center;
		}

	</style>

</head>

<body>

	<h2>Sistem Informasi Employment Requisition</h2>

	<div class="bg-img">
	  <form  action="actions/loginaction.php" method="post" class="container">
	    <h1>Login</h1>

	    <label for="username"><b>Username</b></label>
	    <input type="text" placeholder="Enter Username" name="username" required>

	    <label for="password"><b>Password</b></label>
	    <input type="password" placeholder="Enter Password" name="password" required>

	    <button class="btn btn-primary" type="submit" >Login</button>
	  </form>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- Core plugin JavaScript-->
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<!-- Custom scripts for all pages-->
	<script src="assets/js/sb-admin-2.min.js"></script>

  <!-- Footer -->
      <div class="footer">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Sistem Informasi Employment Requisition 2019</span>
		</div>
      </div>
  </footer>
  <!-- End of Footer -->

</body>

</html>
