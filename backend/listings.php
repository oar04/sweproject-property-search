<!DOCTYPE html>
<html>
    <head>
        <title>FDM Flat Finder</title>
    </head>
    <body>
        
    <?php

        $db = mysqli_connect("localhost", "root", "", "login");
        $sql = "SELECT * FROM listings";
        $result = mysqli_query($db, $sql);
        while($row = mysqli_fetch_array($result)){
            echo "<div id='img_div'>";
                echo "<img src='images/".$row['image']."'>";
                echo "<p>Street: ".$row['address']."</p>";
                echo "<p>City: ".$row['city']."</p>";
                echo "<p>Postcode: ".$row['postcode']."</p>";
                echo "<p>Rent: ".$row['rent']."</p>";
                echo "<p>Description: ".$row['description']."</p>";
                echo "<p>____________________________________________________________</p>";
            echo "</div>";
    }

    ?>
        
    </body>
    <footer class = "footer-style">
		<p class = "footer-text">Copyright &copy; 2021 FDM.</p>
	</footer>
</html>