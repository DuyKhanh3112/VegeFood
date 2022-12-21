<?php

require_once '../process/connectdb.php';
require_once './product_data.php';
$product = new Product("", "", "", "", "", "", "", "");
if (isset($_GET["action"]) && $_GET["action"] == "remove") {
    $product->set_proID(intval($_GET["id"]));
    echo $product->get_proID();
    $product->deleteProduct($conn);
    header("location:http://localhost:1000/PhpAssignment/admin_Product.php");
}

