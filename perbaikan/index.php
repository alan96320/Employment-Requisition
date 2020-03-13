<?php 
	session_start();
	if (!isset($_SESSION ["username"])) { ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIER : Login</title>
    <link rel="icon" href="assets/img/alcr.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/custom.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
    
</head>
<body>
    <h2>Sistem Informasi Employment Requisition</h2>
	<div class="bg-img">
		<form action="action/login.php" method="post" class="container">
			<h1 style="color: aliceblue">Login</h1>

			<label for="username"><b>Username</b></label>
			<input type="text" placeholder="Enter Username" name="username" required>

			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="password" required>

			<button class="btn btn-primary" type="submit">Login</button>
		</form>
    </div>
    <div class="footer">
		<div class="copyright text-center my-auto">
			<span>Copyright &copy; Sistem Informasi Employment Requisition 2019</span>
		</div>
	</div>


	<!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
	<?php 
		if(isset($_SESSION['statusLogin'])){
			if ($_SESSION['statusLogin'] === "gagal") { ?>
				<script>
					const Toast = Swal.mixin({
						toast: true,
						position: 'top-end',
						showConfirmButton: false,
						timer: 3000,
						timerProgressBar: true,
						onOpen: (toast) => {
						toast.addEventListener('mouseenter', swal.stopTimer);
						toast.addEventListener('mouseleave', swal.resumeTimer);
						}
					});
					Toast.fire({
						icon: 'error',
						title: 'Username Atau Password Salah'
					});
				</script>
				<?php
				unset($_SESSION['statusLogin']);
			}
		}
	?>
	
	
	
</body>
</html>

<?php
	}else{
		header("location: pages/home.php");
	}
?>