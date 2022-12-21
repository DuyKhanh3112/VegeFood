<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once '../process/connectdb.php';
include_once '../process_customer/customer_data.php';
$customer = new customer("", "", "", "", "");
$customer->set_email($_POST["email"]);
$customer->set_phone($_POST["phone"]);
$result = $customer->forgetPass($conn);
if ($result != 0) {
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

    $mail->addAddress($_POST["email"]);

    $mail->isHTML(true);
    $mail->Subject = "Account VegeFood";
    $mail->Body = "Information Account: <br> Email: " . $_POST["email"] . "<br> Password: " . $result;

    try {
        $mail->send();
        echo 'Message has been  sent successfully';
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
        ;
    }
    ?> <script >
            alert('Password is sent to your Email');
    </script>
    <?php

} else {
    ?> <script >
            alert('No Found !!!');
    </script>
    <?php
}
header("location:http://localhost:1000/PhpAssignment/login.php");