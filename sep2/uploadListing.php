

<?php
    $msg = "";
    //if upload button is pressed
    if(isset($_POST["upload"])){
        //path to store uploaded files
        $target = "images/".basename($_FILES['image']['name']);
        
        //connect to database
        $db = mysqli_connect("localhost", "root", "", "login");

        //get submitted data from the form
        $image = $_FILES['image']['name'];
        $address = $_POST['address'];
        $city = $_POST['city'];
        $postcode = $_POST['postcode'];
        $rent = $_POST['rent'];
        $description = $_POST['text'];

        $sql = "INSERT INTO listings (image, address, city, postcode, rent, description) VALUES ('$image', '$address', '$city', '$postcode', '$rent', '$description')";
        mysqli_query($db, $sql); //stores submitted data to db

        //upload images to image folder
        if(move_uploaded_file($_FILES['image']['tmp_name'], $target)){
            $msg = "Successful Upload!";
        }
        else{
            $msg = "There was an issue uploading, please try again. If the problem persists please contact a system admin here [add link to chat page]";
        }
        

    }

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Listing Upload</title>
    </head>
    <body>
    <?php

        // $db = mysqli_connect("localhost", "root", "", "login");
        // $sql = "SELECT * FROM listings";
        // $result = mysqli_query($db, $sql);
        // while($row = mysqli_fetch_array($result)){
        //     echo "<div id='img_div'>";
        //         echo "<img src='images/".$row['image']."'>";
        //         echo "<p>".$row['address']."</p>";
        //         echo "<p>".$row['city']."</p>";
        //         echo "<p>".$row['postcode']."</p>";
        //         echo "<p>".$row['rent']."</p>";
        //         echo "<p>".$row['description']."</p>";
        //     echo "</div>";

        // }

    ?>
        <div class = "form">
            <div class = "upload-listing">
                <form method = "post" action = "uploadListing.php" enctype = "multipart/form-data">
                    <input type = "hidden" name = "size" value = "100000">
                    <label>image</label>
                    <input type = "file" name = "image">
                    <label>address</label>
                    <input type = "text" name = "address">
                    <label>city</label>
                    <input type = "text" name = "city">
                    <label>postcode</label>
                    <input type = "text" name = "postcode">
                    <label>rent</label>
                    <input type = "text" name = "rent">
                    <textarea name = "text" cols = "50" rows = "4" placeholder = "Listing Description..."></textarea>
                    <input type = "submit" name = "upload" value = "upload">
                </form>
            </div>
        </div>
    </body>

    <?php
        include "footer.php"
    ?>

</html>