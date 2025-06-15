<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';

function send_otp_mail($user_email, $user_name, $OTP_CODE)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'loginpagelaboratory@gmail.com';        //SMTP username
        $mail->Password   = 'ccslunhrovrhhbpw';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('loginpagelaboratory@gmail.com', 'FLEXIFIT');
        $mail->addAddress($user_email, $user_name);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'OTP CODE';
        $mail->Body    = 'YOUR OTP CODE IS: ' . $OTP_CODE;
        $mail->AltBody = 'YOUR OTP CODE IS: ' . $OTP_CODE;

        $mail->send();
        echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}

function send_forgot_password_link($user_email, $url, $token)
{
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host = 'smtp.gmail.com';                             //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'loginpagelaboratory@gmail.com';        //SMTP username
        $mail->Password   = 'ccslunhrovrhhbpw';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('loginpagelaboratory@gmail.com', 'FLEXIFIT');
        $mail->addAddress($user_email);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'RESET PASSWORD';
        $mail->Body    = "YOUR RESET LINK IS: <a href='{$url}?token={$token}'>RESET PASSWORD LINK</a> <br> This link will expire in 1 hour";
        $mail->AltBody = 'YOUR RESET LINK IS: ';

        $mail->send();
        echo 'Message has been sent';
        return true;
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        return false;
    }
}
