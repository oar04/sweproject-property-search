<?php

    //connect to the database
    $mysqli = new mysqli("localhost", "root", "", "login");

    if(isset($_POST['delete'])){
        
    $idDelete = $_POST["id-delete"];

        $sql = "DELETE FROM listings WHERE id = $idDelete";

        if(mysqli_query($mysqli, $sql)){
            header('Location: listings.php');
        }
        else{
            echo 'query error: '.mysqli_error($mysqli);
        }

    }
    
	


?>