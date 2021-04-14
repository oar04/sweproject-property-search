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
    $output = " ";
    if(isset($_POST['search'])){
        $searchq = $_POST['search'];
        $sql = "SELECT * FROM listings WHERE city LIKE '%$searchq%' or postcode LIKE '%$searchq%'";
        $query = mysqli_query($db, $sql) or die("Couldn't search");
        $count = mysqli_num_rows($query);
        if($count == 0){
            $output = 'There were no search results';
        }
        else{
            while($row = mysqli_fetch_array($query)){
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
        }

    }


    ?>

        
    </body>
    <footer class = "footer-style">
		<p class = "footer-text">Copyright &copy; 2021 FDM.</p>
	</footer>
</html>

