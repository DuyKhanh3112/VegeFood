<?php

session_start();
include'../process/connectdb.php';
include '../process_customer/customer_data.php';

$customer = new customer("", "", "", "", "");
$customer->set_email($_POST["email"]);
$result = $customer->login($conn);
if ($result == $_POST["password"]) {
    $account = $customer->showAll($conn);
    while ($row = $account->fetch_assoc()) {
        if ($row["email"] == $_POST["email"]) {
            $_SESSION["account"] = $row["email"];
        }
    }
    header("location:http://localhost:1000/PhpAssignment/index.php");
} else {
    header("location:http://localhost:1000/PhpAssignment/login.php");
}



