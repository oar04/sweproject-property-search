

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>FDM Properties</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: EstateAgency - v4.1.0
  * Template URL: https://bootstrapmade.com/real-estate-agency-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
                echo "<a href='property.php?id=".$row['id']."'>".$row['address']."</p>";
                echo "<a href='property.php?id=".$row['id']."'><img src='images/".$row['image']."'></a>";
                echo "<p>Street: ".$row['address']."</p>";
                echo "<p>City: ".$row['city']."</p>";
                echo "<p>Postcode: ".$row['postcode']."</p>";
                echo "<p>Rent: ".$row['rent']."</p>";
                echo "<p>Area: ".$row['area']."m^2</p>";
                echo "<p>Bedrooms: ".$row['bed']."</p>";
                echo "<p>Bathrooms: ".$row['bath']."</p>";
                echo "<p>Garage: ".$row['garage']."</p>";
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
