<?php


	//connect to the database
  $mysqli = new mysqli("localhost", "root", "", "login");
	//get form data
	$email = $mysqli->real_escape_string($_POST['user']);
	$password = $mysqli->real_escape_string($_POST['pass']);

	//query the database
	$resultSet = $mysqli->query("SELECT * FROM accounts WHERE email = '$email' AND password = '$password' LIMIT 1");
	$row = $resultSet->fetch_assoc();
	if($resultSet->num_rows !=0){
		session_start();
	 	$_SESSION['loggedIn'] = true;
		$_SESSION['email'] = $email;
	 	$_SESSION['password'] = $password;
		//set specific session variables to ensure only the correct pages can be accessed
		if ($row['type'] == "admin") {
      echo "admin";
			$_SESSION['admin'] = true;
			$_SESSION['landlord'] = false;
			$_SESSION['consultant'] = false;
      header("Location: index.php");
		}
      elseif ($row['type'] == "landlord") {
      echo "landlord";
			$_SESSION['landlord'] = true;
			$_SESSION['consultant'] = false;
			$_SESSION['admin'] = false;
      header("Location: index.php"); //insert appropriate page per user type
		}
      elseif ($row['type'] == "consultant"){
      echo "consultant";
			$_SESSION['consultant'] = true;
			$_SESSION['admin'] = false;
			$_SESSION['landlord'] = false;
      header("Location: index.php"); //insert appropriate page per user type

		}
	}
	else{
		echo "Failed to log in";
		//header("Location: loginpage.php");
	}

	include "footer.php";
?>
