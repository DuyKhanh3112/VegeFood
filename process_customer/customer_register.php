<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

include_once '../process/connectdb.php';
include_once '../process_customer/customer_data.php';
$password = $_POST["password"];
$cofpass = $_POST["confpass"];
if ($password == $cofpass) {
    $customer = new customer("", "", "", "", "");
    $customer->set_fullname($_POST["fullname"]);
    $customer->set_email($_POST["email"]);
    $customer->set_phone($_POST["phone"]);
    $customer->set_address($_POST["address"]);
    $customer->set_password($_POST["password"]);
    $result = $customer->register($conn);
    if ($result == TRUE) {
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
        $mail->Body = "Information Account: <br> Email: " . $_POST["email"] . "<br> Password: " . $_POST["password"];

        try {
            $mail->send();
            echo 'Message has been  sent successfully';
        } catch (Exception $e) {
            echo 'Mailer Error: ' . $mail->ErrorInfo;
            ;
        }
        header("location:http://localhost:1000/PhpAssignment/login.php");
    } else {
        ?> <script >
            alert('Register is Not Nuccessfully !!!');
        </script>
        <?php

        header("location:http://localhost:1000/PhpAssignment/register.php");
    }
} else {
    ?> <script>
        alert('Password Confirm must be the same as Password');
    </script>
    <?php

    header("location:http://localhost:1000/PhpAssignment/register.php");
}


