<?php

include './product_data.php';
include '../process/connectdb.php';
$product = new Product("", "", "", "", "", "", "", "");
if (getimagesize($_FILES['product_Img']['tmp_name']) == false) {
     header("location:http://localhost:1000/PhpAssignment/admin_Product.php");
} else {
    $image = addslashes(file_get_contents($_FILES['product_Img']['tmp_name']));
    $name = $_FILES['product_Img']['name'];

    $product->set_proID($_POST["product_ID"]);
    $product->set_proName($_POST["product_Name"]);
    $product->set_cateID($_POST["category_ID"]);
    $product->set_proQuanity($_POST["quantity"]);
    $product->set_proUnit($_POST["product_Unit"]);
    $product->set_proPrice($_POST["product_Price"]);
    $product->set_proDes($_POST["description"]);
     $product->insertProduct($conn) ;
    $sql="Update product set productURL='$image' where product_ID =". $product->get_proID();
    $conn->query($sql);
    header("location:http://localhost:1000/PhpAssignment/admin_Product.php");
}


