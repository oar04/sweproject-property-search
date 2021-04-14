<?php
$error = NULL;
//if user click change password button
if(isset($_POST['submit'])){
    $mysqli = NEW MySQLi('localhost','root','','login');
    $p = $_POST['p'];
    $p2 = $_POST['p2'];
    $p = $mysqli->real_escape_string($p);
    $p2 = $mysqli->real_escape_string($p2);
    if($p !== $p2){
        $error .= "<p>Your passwords do not match</p>";
    }else{
        $code = 0;
        #$p = md5($p);
        session_start();
        $e = $_SESSION['email'];
        $update_pass = "UPDATE accounts SET code = $code, password = '$p' WHERE email = '$e'";
        $run_query = mysqli_query($mysqli, $update_pass);
        if($run_query){
            echo "Your password changed. Now you can login with your new password.";
            header('location: loginpage.php');
        }else{
            $error .= "<p>Failed to change your password</p>";
        }
    }
}

?>
<html>
<head>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<form method="POST" action="">
  <table border="0" align="center" cellpadding="5">
  <tr>
    <td align = "right">Password:</td>
    <td><input type="PASSWORD" name="p" required/></td>
  </tr>
  <tr>
    <td align = "right">Confirm Password:</td>
    <td><input type="PASSWORD" name="p2" required/></td>
  </tr>
  <tr>
    <td colspan = "2" align = "center"><input type = "SUBMIT" name = "submit" value = "Change" required/><td>
  </tr>
  </table>
</form>
<center>
  <?php
  echo $error ;
  ?>
</center>
</body>
</html>
