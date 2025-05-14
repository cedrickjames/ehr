<?php


session_start();


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


    $subject = 'Fit to Work';
    $message = 'Hi Sir ';


    require 'vendor/autoload.php';

   
    $mail = new PHPMailer(true);
    
    try {
      //Server settings
        $mail->isSMTP();                                      // Set mailer to use SMTP
        $mail->Host       = 'smtp.office365.com';                       // Specify main and backup SMTP servers
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rpa.notification@glory.com.ph';                 //SMTP username
        $mail->Password   = 'P.445772523991az';                          // Your Password
        $mail->Port       = 587;     
        $mail->SMTPSecure = 'tls';
 

      //Send Email
      // $mail->setFrom('Helpdesk'); //eto ang mag front  notificationsys01@gmail.com

      //Recipients
      $mail->SetFrom("rpa.notification@glory.com.ph"," Service Request System");
      $mail->addAddress('ict@glory.com.ph');
      $mail->AddCC('b.solomon@glory.com.ph');
      $mail->isHTML(true);
      $mail->Subject = $subject;
      $mail->Body    = $message;
      $mail->send();

      $_SESSION['message'] = 'Message has been sent';
      echo "<script>alert('Email Sent') </script>";
    //   echo "<script> location.href='index.php'; </script>";


      // header("location: form.php");
    } catch (Exception $e) {
      $_SESSION['message'] = 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
      echo "<script>alert('$mail->ErrorInfo') </script>";
    }

?>