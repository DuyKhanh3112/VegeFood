<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
include './feedback_data.php';
include '../process/connectdb.php';
$feedback = new feedback("","","","","");
$feedback->set_feedback_ID($feedback->IDFeedback($conn)+1);
$feedback->set_email($_SESSION["account"]);
$feedback->set_fullname($_POST["fullname"]);
$feedback->set_datetime($_POST["date"]);
$feedback->set_content($_POST["content"]);

if ($feedback->InsertFeedback($conn)){
    require '../PHPMailer/Exception.php';
        require '../PHPMailer/PHPMailer.php';
        require '../PHPMailer/SMTP.php';

        $mail = new PHPMailer(true);
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;

        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->SMTPAuth = true;

        $mail->Username = "voduykhanh3112@gmail.com";
        $mail->Password = "vdk311202";
        $mail->From = "voduykhanh3112@gmail.com";
        $mail->FromName = "VegeFood";

        $mail->addAddress($_SESSION["account"]);

        $mail->isHTML(true);
        $mail->Subject = "Account VegeFood";
        $mail->Body = "Thanks you for shopping at Vegefood and for giving us feedback.";

        try {
            $mail->send();
            echo 'Message has been  sent successfully';
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            ;
        }
}

header("location:http://localhost:1000/PhpAssignment/feedback.php");

