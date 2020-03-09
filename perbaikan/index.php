<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIER : Login</title>
    <link rel="icon" href="assets/img/alcr.jpg" type="image/x-icon">
    <link rel="stylesheet" href="assets/css/custom.css">
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
</body>
</html>