<?php

	//get values from login form

	$username = $_POST['user'];
	$password = $_POST['pass'];
	
	//add sql injection preventions

	//connect to database

    // mysqli_connect("localhost", "root", "");
    // mysqli_select_db("login");
    $mysqli = new mysqli("localhost", "root", "", "login");


    

	$result = $mysqli->query("select * from users where username = '$username' and password = '$password'"); //or die("Unable to login".mysql_error());
    $row = $result->fetch_assoc();
	if($row['username'] == $username and $row['password'] == $password){
		session_start();
	 	$_SESSION['loggedIn'] = true;
		$_SESSION['username'] = $username;
	 	$_SESSION['password'] = $password;
	 	header("Location: index.php");
	}
	else{
		echo "Failed to log in";
	}

		 	
	
		
?>
