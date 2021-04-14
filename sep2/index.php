<?php

    session_start();
    if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] == true) {
    echo "logged in";
    } 
    //if a user tries to access this page to enter a blog post without being logged in, it will automatically redirect them to the login page
    else {
        header("Location: loginpage.php");
        
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <title>FDM Flat Finder</title>
    </head>
    <body>
        <p>Welcome</p>
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['admin'] == true){
            echo 'hello admin';
        }
        ?>
        <a href="listings.php">View Properties</a>
        <p></p>
        <?php

        //only people logged in as either a landlord or an admin will have the ability to upload a listing
        if (isset($_SESSION['loggedIn']) && $_SESSION['landlord'] == true){
            echo '<a href="uploadListing.php">Upload a listing</a>';
        }

        elseif (isset($_SESSION['loggedIn']) && $_SESSION['admin'] == true){
            echo '<a href="uploadListing.php">Upload a listing</a>';
        }

        ?>
        <p></p>
        <a href="logout.php">Logout</a>
        
        
        
    </body>
    
</html>

<?php
    include "footer.php"
?>




