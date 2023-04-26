<?php
include '../database/connections.php';
session_start();

include '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;




function sendmail($email, $reset_token)
{
    require('../vendor/phpmailer/phpmailer/src/PHPMailer.php');
    require('../vendor/phpmailer/phpmailer/src/Exception.php');
    require('../vendor/phpmailer/phpmailer/src/SMTP.php');
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.capestart.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ivin.austan@capestart.com';
        $mail->Password = '23011998@cape';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;
        $mail->setFrom('ivin.austan@capestart.com');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Password Reset link form Aatmaninfo';
        $mail->Body = "we got a request form you to reset Password! <br>Click the link bellow: <br>
        <a href='https://localhost:85/reset_password.php?email=$email&reset_token=$reset_token'>reset password</a>";
        $mail->send();
        return true;
    } catch (Exception $e) {
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
            $sql = "UPDATE users SET resettoken ='$reset_token' WHERE email = '$email'";

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