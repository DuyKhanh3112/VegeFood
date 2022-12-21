<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
session_start();
include './order_data.php';
include '../process/connectdb.php';
include '../process_product/product_data.php';
$order = new order("", "", "", "", "", "", "", "", "");
$product = new Product("", "", "", "", "", "", "", "");

$order->set_email($_POST["email"]);
$order->set_phone($_POST["phone"]);
$order->set_address($_POST["address"]);
$order->set_order_Date(date("d-m-Y, h:i:s"));
$order->set_fee($_SESSION["fee"]);
$order->set_order_ID($order->getOrderID($conn) + 1);
$order->set_total($_SESSION["total"]);

$order->insertOrder($conn);

if (isset($_SESSION[$_SESSION["account"]]) && $_SESSION[$_SESSION["account"]]) {
    foreach ($_SESSION[$_SESSION["account"]] as $id => $value) {
        $arrProductID[] = $id;
    }
    $strIDs = implode(",", $arrProductID);
    $stmt = $conn->prepare("select * from product where product_ID in ($strIDs)");
    $stmt->execute();
    $result = $stmt->get_result();
    while ($row = $result->fetch_assoc()) {
        $order->set_product_ID($row["product_ID"]);
        $order->set_quantity($_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity']);
        $order->insertOrderDetails($conn);
        $product->set_proID($row["product_ID"]);
        $product->set_proQuanity($row["product_Quantity"]-$_SESSION[$_SESSION["account"]][$row['product_ID']]['quantity']);
        $product->updateQuantity($conn);
    }
}
unset($_SESSION[$_SESSION["account"]]);
header("location:http://localhost:1000/PhpAssignment/index.php");

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

$mail->addAddress($order->get_email());

$mail->isHTML(true);
$mail->Subject = "Account VegeFood";
$mail->Body = "Your order is being shipped to you";

try {
    $mail->send();
    echo 'Message has been  sent successfully';
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}
