<?php

    //connect to the database
    $mysqli = new mysqli("localhost", "root", "", "login");
    //checks database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>
