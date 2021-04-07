<?php


    $dbhost = getenv("MYSQL_SERVICE_HOST");
    $dbport = getenv("MYSQL_SERVICE_PORT");
    $dbuser = getenv("DATABASE_USER");
    $dbpwd = getenv("DATABASE_PASSWORD");
    $dbname = getenv("DATABASE_NAME"); 
    //database connection
    $conn = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
    //checks database connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

?>