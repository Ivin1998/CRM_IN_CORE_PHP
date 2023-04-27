<?php
include '../database/connections.php';
session_start();

include '../vendor/autoload.php';

require('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
require('../vendor/phpmailer/phpmailer/src/Exception.php');
require('../vendor/phpmailer/phpmailer/src/SMTP.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

function sendmail($email, $reset_token)
{
  
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ivin.austan@capestart.com';
        $mail->Password = 'oqpmbdultzmplyuk';
        $mail->SMTPSecure ='tls';
        $mail->Port = 587;
        $mail->setFrom('ivin.austan@capestart.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset link form Ivin_app';
        $mail->Body = "We got a request form you to reset Password! <br>Click the link bellow: <br>
        <a href='http://localhost:85/users/login_users/reset_password.php?email=$email&reset_token=$reset_token'>reset password</a>";
        $mail->send();
        return true;
    } catch (Exception $e) {
        echo 'Exception Message: ' .$e->getMessage();       
          return false;
    }
}

if (isset($_POST['send-link'])) {
    $email = $_POST['email'];
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        if ($row = $result->fetch_assoc()) {
            $reset_token = bin2hex(random_bytes(16));
            date_default_timezone_set('Asia/kolkata');
            $date = date("Y-m-d");
            $sql = "UPDATE users SET resettoken ='$reset_token', resettokenexp = '$date' WHERE email = '$email'";
            if (($con->query($sql) === TRUE) && sendmail($email, $reset_token) === TRUE) {
                echo "<script> alert('Password reset link send to mail.');
                window.location.href='../index.php'
                </script>";
            } else {
               echo "
                <script>
                    alert('Something got Wrong');
                    window.location.href='forgot_password.php'
                </script>"; 
            }
        }
    } else {
        echo "
            <script>
                alert('Server Down');
                window.location.href='forgot_password.php'
            </script>";
    }

}
?>