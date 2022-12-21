<?php

include './product_data.php';
include '../process/connectdb.php';
$product = new Product("", "", "", "", "", "", "", "");
//update
$product->set_proID($_POST["product_ID"]);
$product->set_proName($_POST["product_Name"]);
$product->set_cateID($_POST["category_ID"]);
$product->set_proQuanity($_POST["quantity"]);
$product->set_proPrice($_POST["product_Price"]);
$product->set_proUnit($_POST["product_Unit"]);

$product->UpdateProduct($conn);
header("location:http://localhost:1000/PhpAssignment/admin_Product.php");
