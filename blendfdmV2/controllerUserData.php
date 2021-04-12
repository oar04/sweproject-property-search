<?php
session_start();
require "connection.php";
$e = "";
$name = "";
$errors = array();

//if user signup button
if(isset($_POST['signup'])){
    $e = mysqli_real_escape_string($db, $_POST['e']);
    $p = mysqli_real_escape_string($db, $_POST['p']);
    $p2 = mysqli_real_escape_string($db, $_POST['p2']);
    if($p !== $p2){
        $errors['password'] = "Your passwords do not match.";
    }
    $e_check = "SELECT * FROM accounts WHERE email = '$e'";
    $res = mysqli_query($db, $e_check);
    if(mysqli_num_rows($res) > 0){
        $errors['email'] = "This email is already registered to FDM.";
    }
    if(count($errors) === 0){
        $p = md5($p);
        $code = rand(999999, 111111);
        $verified = "0";
        $insert_data = "INSERT INTO accounts(email,password,code) VALUES('$e','$p','$code')";
        $data_check = mysqli_query($db, $insert_data);
        if($data_check){
            $to = $e;
            $subject = "Email Verification";
            $message = "Your verification code is $code";
            $headers .= "From: segroup36verification@hotmail.com \r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
            if(mail($to,$subject,$message,$headers)){
                $info = "We've sent a verification code to your email - $e";
                $_SESSION['info'] = $info;
                $_SESSION['email'] = $e;
                $_SESSION['password'] = $p;
                header('location: user-otp.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while sending code!";
            }
        }else{
            $errors['db-error'] = "Failed while inserting data into database!";
        }
    }

}
    //if user click verification code submit button
    if(isset($_POST['check'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($db, $_POST['otp']);
        $check_code = "SELECT * FROM accounts WHERE code = $otp_code";
        $code_res = mysqli_query($db, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $fetch_code = $fetch_data['code'];
            $e = $fetch_data['email'];
            $code = 0;
            $verified = '1';
            $update_otp = "UPDATE accounts SET code = $code, verified = '$verified' WHERE code = $fetch_code";
            $update_res = mysqli_query($db, $update_otp);
            if($update_res){
                $_SESSION['email'] = $e;
                header('location: home.php');
                exit();
            }else{
                $errors['otp-error'] = "Failed while updating code!";
            }
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click login button
    if(isset($_POST['login'])){
        $e = mysqli_real_escape_string($db, $_POST['e']);
        $p = mysqli_real_escape_string($db, $_POST['p']);
        $p = md5($p);

        $check_email = "SELECT * FROM accounts WHERE email = '$e' AND password = '$p' LIMIT 1";
        $res = mysqli_query($db, $check_email);
        if(mysqli_num_rows($res) != 0){
            $fetch = mysqli_fetch_assoc($res);
            $fetch_pass = $fetch['password'];
            $_SESSION['email'] = $e;
            $verified = $fetch['verified'];
            if($verified == '1'){
              $_SESSION['email'] = $e;
              $_SESSION['password'] = $p;
              header('location: home.php');
            }else{
                $info = "It's look like you haven't still verify your email - $e";
                $_SESSION['info'] = $info;
                header('location: user-otp.php');
            }
        }else{
            $errors['email'] = "Incorrect email or password! Click on the bottom link to signup if this email is not an FDM member.";
        }
    }

    //if user click continue button in forgot password form
    if(isset($_POST['check-email'])){
        $e = mysqli_real_escape_string($db, $_POST['e']);
        $check_email = "SELECT * FROM accounts WHERE email='$e'";
        $run_sql = mysqli_query($db, $check_email);
        if(mysqli_num_rows($run_sql) > 0){
            $code = rand(999999, 111111);
            $insert_code = "UPDATE accounts SET code = $code WHERE email = '$e'";
            $run_query =  mysqli_query($db, $insert_code);
            if($run_query){
                $to = $e;
                $subject = "Password Reset Code";
                $message = "Your password reset code is $code";
                $headers .= "From: segroup36verification@hotmail.com \r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                if(mail($to,$subject,$message,$headers)){
                  $info = "We've sent a passwrod reset code to your email - $e";
                    $_SESSION['info'] = $info;
                    $_SESSION['email'] = $e;
                    header('location: reset-code.php');
                    exit();
                }else{
                    $errors['otp-error'] = "Failed while sending code!";
                }
            }else{
                $errors['db-error'] = "Something went wrong!";
            }
        }else{
            $errors['email'] = "This email address does not exist!";
        }
    }

    //if user click check reset otp button
    if(isset($_POST['check-reset-otp'])){
        $_SESSION['info'] = "";
        $otp_code = mysqli_real_escape_string($db, $_POST['otp']);
        $check_code = "SELECT * FROM accounts WHERE code = $otp_code";
        $code_res = mysqli_query($db, $check_code);
        if(mysqli_num_rows($code_res) > 0){
            $fetch_data = mysqli_fetch_assoc($code_res);
            $e = $fetch_data['email'];
            $_SESSION['email'] = $e;
            $info = "Please create a new password that you don't use on any other site.";
            $_SESSION['info'] = $info;
            header('location: new-password.php');
            exit();
        }else{
            $errors['otp-error'] = "You've entered incorrect code!";
        }
    }

    //if user click change password button
    if(isset($_POST['change-password'])){
        $_SESSION['info'] = "";
        $p = mysqli_real_escape_string($db, $_POST['p']);
        $p2 = mysqli_real_escape_string($db, $_POST['p2']);
        if($p !== $p2){
            $errors['password'] = "Confirm password not matched!";
        }else{
            $code = 0;
            $e = $_SESSION['email']; //getting this email using session
            $p = md5($p);
            $update_pass = "UPDATE accounts SET code = $code, password = '$p' WHERE email = '$e'";
            $run_query = mysqli_query($db, $update_pass);
            if($run_query){
                $info = "Your password changed. Now you can login with your new password.";
                $_SESSION['info'] = $info;
                header('Location: password-changed.php');
            }else{
                $errors['db-error'] = "Failed to change your password!";
            }
        }
    }

   //if login now button click
    if(isset($_POST['login-now'])){
        header('Location: login-user.php');
    }
?>
