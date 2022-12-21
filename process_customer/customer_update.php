<?php
require_once '../process/connectdb.php';
require_once './customer_data.php';

$customer = new customer("", "", "", "", "");
$customer->set_email($_POST["email"]);
$customer->set_fullname($_POST["name"]);
$customer->set_address($_POST["address"]);
$customer->set_phone($_POST["phone"]);
$customer->updateCustomer($conn);
header("location:http://localhost:1000/PhpAssignment/account.php");
?>

