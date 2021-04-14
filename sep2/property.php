<?php
        session_start();
?>

<?php

    $db = mysqli_connect("localhost", "root", "", "login");

    //check GET req id
    if(isset($_GET['id'])){

        $id = $_GET['id'];

        //db query
        $sql = "SELECT * FROM listings WHERE id = $id";
        //get the result
        $result = mysqli_query($db, $sql);

        $property = mysqli_fetch_assoc($result);

        mysqli_free_result($result);
        mysqli_close($db);
    }
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset = "utf-8">
		<title>Property Finder</title>
	</head>
	<body>
        <?php if($property): ?>
            <?php $imageName = $property['image']; ?>
            <?php $id = $property['id']; ?>
            <?php echo "<img src='images/$imageName'>"; ?>
            <p><?php echo htmlspecialchars($property['address']); ?></p>
            <p><?php echo htmlspecialchars($property['city']); ?></p>
            <p><?php echo htmlspecialchars($property['postcode']); ?></p>
            <p><?php echo htmlspecialchars($property['rent']); ?></p>
            <p><?php echo htmlspecialchars($property['description']); ?></p>

            <?php

            if (isset($_SESSION['loggedIn']) && $_SESSION['admin'] == true){ ?>
                    <form action = 'delete.php' method = 'post'>
                            <input type = 'hidden' name = 'id-delete' value =<?php echo $id; ?>>
                            <input type = 'submit' name = 'delete' value = 'Delete'>
                            </form>
                

        <?php } else{ echo 'nothing';} ?>

        <?php endif; ?>
        
	</body>

</html>