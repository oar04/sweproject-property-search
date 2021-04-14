<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta content="width=device-width, initial-scale=1.0" name="viewport">

	<title>FDM Properties</title>
	<meta content="" name="description">
	<meta content="" name="keywords">

	<!-- Favicons -->
	<link href="assets/img/favicon.png" rel="icon">
	<link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

	<!-- Vendor CSS Files -->
	<link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
	<link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

	<!-- Template Main CSS File -->
	<link href="assets/css/style.css" rel="stylesheet">

	<!-- =======================================================
	* Template Name: EstateAgency - v4.1.0
	* Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
	* Author: BootstrapMade.com
	* License: https://bootstrapmade.com/license/
	======================================================== -->
</head>
	<body>
			<div class = "form">
				<div class = "login">
					<p id = "formTitle">Login Here</p>
					<form action = "login.php" method = "POST">
						<input type = "text" id = "user" name = "user" placeholder="Username" required><br>
						<input type = "password" id = "pass" name = "pass" placeholder="Password" required><br>
						<input type = "submit" name = "login" value = "login">
						<tr> <div class="link login-link text-center">Forgot Password? <a href="resetpassword.php">Reset Password</a></div></tr>
						<tr> <div class="link login-link text-center">Not yet a member? <a href="registration.php">Signup now</a></div></tr>
					</form>
				</div>
			</div>

	</body>

	<?php
    	include "footer.php"
	?>

</html>
