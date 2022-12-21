<?php

session_start();
include './order_data.php';
include '../process/connectdb.php';
$order = new order("", "", "", "", "", "", "", "", "");
$id = $_GET["id"];
if (isset($_GET["action"])) {
    if ($_GET["action"] == "add") {
        echo $_SESSION[$_SESSION["account"]][$id]['quantity'] += 1;
    }
    if ($_GET["action"] == "remove") {
        unset($_SESSION[$_SESSION["account"]][$id]);
    }
    if ($_GET["action"] == "minus") {
        echo $_SESSION[$_SESSION["account"]][$id]['quantity'] -= 1;
        if ($_SESSION[$_SESSION["account"]][$id]['quantity']<=0) {
            unset($_SESSION[$_SESSION["account"]][$id]);
        }
    }
    header("location:http://localhost:1000/PhpAssignment/cart.php");
}

    