<?php

$error = NULL;
if(isset($_POST['submit'])){
  //if user click continue button in forgot password form
      $e = $_POST['e'];
      $mysqli = NEW MySQLi('localhost','root','','login');
      $e = $mysqli->real_escape_string($e);

      $check_email = "SELECT * FROM accounts WHERE email='$e'";
      $run_sql = mysqli_query($mysqli, $check_email);
      if(mysqli_num_rows($run_sql) > 0){
          $code = rand(999999, 111111);
          $insert_code = "UPDATE accounts SET code = $code WHERE email = '$e'";
          $run_query =  mysqli_query($mysqli, $insert_code);
          session_start();
          $_SESSION['email'] = $e;
          if($run_query){
              $to = $e;
              $subject = "Password Reset Code";
              $message = "Your password reset code is $code";
              $headers .= "From: segroup36verification@hotmail.com \r\n";
              $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
              mail($to, $subject, $message, $headers);
              echo "We've sent a password reset code to your email - $e";
              header('location: resetcode.php');
              exit();
          }else{
              $error .= "<p>Something went wrong!</p>";
          }
      }else{
          $error .= "<p>This email address does not exist!</p>";
      }
  }
?>
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
<form method="POST" action="">
  <table border="0" align="center" cellpadding="5">
  <tr>
    <td align = "right">Email Address:</td>
    <td><input type="EMAIL" name="e" required/></td>
  </tr>
  <tr>
    <td colspan = "2" align = "center"><input type = "SUBMIT" name = "submit" value = "Reset Password" required/><td>
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
