<?php
$error = NULL;
if(isset($_POST['submit'])){
      $mysqli = NEW MySQLi('localhost','root','','login');
      $code = mysqli_real_escape_string($mysqli, $_POST['codeverify']);
      $check_code = "SELECT * FROM accounts WHERE code = $code";
      $code_res = mysqli_query($mysqli, $check_code);
      if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $e = $fetch_data['email'];
            echo "Please create a new password that you don't use on any other site.";
            header('location: newpassword.php');
            exit();
        }else{
            $error .= "You've entered incorrect code!";
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
    <td align = "right">Code Verification:</td>
    <td><input type="number" name="codeverify" placeholder="Enter code" required/></td>
  </tr>
  <tr>
    <td colspan = "2" align = "center"><input type = "SUBMIT" name = "submit" value = "Submit" required/><td>
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
