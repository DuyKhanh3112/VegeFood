<?php

session_start();
include'../process/connectdb.php';
include './admin_data.php';
$admin = new Admin("","");
$admin->set_email($_POST["email"]);
$result = $admin->loginAdmin($conn);
if ($result == $_POST["password"]) {
    header("location:http://localhost:1000/PhpAssignment/admin_Customer.php");
} else {
    header("location:http://localhost:1000/PhpAssignment/login_admin.php");
}





