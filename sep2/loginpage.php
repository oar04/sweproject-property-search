<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Property Finder</title>
	</head>
	<body>
			<div class = "form">
				<div class = "login">
					<p id = "formTitle">Login Here</p>
					<form action = "login.php" method = "POST">
						<input type = "text" id = "user" name = "user" placeholder="Username" required><br>
						<input type = "password" id = "pass" name = "pass" placeholder="Password" required><br>
						<input type = "submit" name = "login" value = "login">
						<tr> <div class="link login-link text-center">Not yet a member? <a href="registration.php">Signup now</a></div></tr>
					</form>
				</div>
			</div>

	</body>

	<?php
    	include "footer.php"
	?>

</html>
