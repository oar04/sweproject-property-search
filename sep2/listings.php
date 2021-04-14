

<!DOCTYPE html>
<html>
    <head>
        <title>FDM Flat Finder</title>
    </head>
    <body>

    <form action = "searchresult.php" method = "post">
        <input type = "text" name = "search" placeholder = "City">
        <input type = "submit" value = "Search">

    </form>
        
    <?php

        $db = mysqli_connect("localhost", "root", "", "login");
        $sql = "SELECT * FROM listings";
        $result = mysqli_query($db, $sql);
        while($row = mysqli_fetch_array($result)){
            echo "<div id='img_div'>";
                echo "<a href='property.php?id=".$row['id']."'><img src='images/".$row['image']."'></a>";
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