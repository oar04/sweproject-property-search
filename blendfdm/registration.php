<?php
$error = NULL;

if(isset($_POST['submit'])){

  $e = $_POST['e'];
  $p = $_POST['p'];
  $p2 = $_POST['p2'];


  // CHECKS IF THE DOMAIN IS @FDM.COM //

  $domain = explode('@',$e)[1];
  if($domain != 'fdm.com'){
      die('This domain is not allowed to register');
  }

  if($p2 != $p){
    $error .= "<p>Your passwords do not match</p>";
  }
  else{
    $mysqli = NEW MySQLi('localhost','root','','fdmdatabase');

    $e = $mysqli->real_escape_string($e);
    $p = $mysqli->real_escape_string($p);
    $p2 = $mysqli->real_escape_string($p2);

    $vkey = md5(time().$e);
    $p = md5($p);
    $insert = $mysqli->query("INSERT INTO accounts(email,password,vkey) VALUES('$e','$p','$vkey')");

    if($insert){
      $to = $e;
      $subject = "Email Verification";
      $message = "<a href = 'http://localhost/blendfdm/verify.php?vkey=$vkey'>Register Account</a>";
      $headers .= "From: segroup36verification@hotmail.com \r\n";
      $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

      mail($to,$subject,$message,$headers);

      header('location:thankyou.php');

    }else{
      echo $mysqli->error;
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
    <td align = "right">Email Address:</td>
    <td><input type="EMAIL" name="e" required/></td>
  </tr>
  <tr>
    <td align = "right">Password:</td>
    <td><input type="PASSWORD" name="p" required/></td>
  </tr>
  <tr>
    <td align = "right">Repeat Password:</td>
    <td><input type="PASSWORD" name="p2" required/></td>
  </tr>
  <tr>
    <td colspan = "2" align = "center"><input type = "SUBMIT" name = "submit" value = "Register" required/><td>
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
