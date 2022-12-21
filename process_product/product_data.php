<?php

class Product {

    private $proID;
    private $proName;
    private $cateID;
    private $proQuanity;
    private $proUnit;
    private $proPrice;
    private $proDes;
    private $proURL;

    public function __construct($proID, $proName, $cateID, $proQuanity, $proUnit, $proPrice, $proDes, $proURL) {
        $this->proID = $proID;
        $this->proName = $proName;
        $this->cateID = $cateID;
        $this->proQuanity = $proQuanity;
        $this->proUnit = $proUnit;
        $this->proPrice = $proPrice;
        $this->proDes = $proDes;
        $this->proURL = $proURL;
    }

    public function get_proID() {
        return $this->proID;
    }

    public function get_proName() {
        return $this->proName;
    }

    public function get_cateID() {
        return $this->cateID;
    }

    public function get_proQuanity() {
        return $this->proQuanity;
    }

    public function get_proUnit() {
        return $this->proUnit;
    }

    public function get_proPrice() {
        return $this->proPrice;
    }

    public function get_proDes() {
        return $this->proDes;
    }

    public function get_proURL() {
        return $this->proURL;
    }

    public function set_proID($proID): void {
        $this->proID = $proID;
    }

    public function set_proName($proName): void {
        $this->proName = $proName;
    }

    public function set_cateID($cateID): void {
        $this->cateID = $cateID;
    }

    public function set_proQuanity($proQuanity): void {
        $this->proQuanity = $proQuanity;
    }

    public function set_proUnit($proUnit): void {
        $this->proUnit = $proUnit;
    }

    public function set_proPrice($proPrice): void {
        $this->proPrice = $proPrice;
    }

    public function set_proDes($proDes): void {
        $this->proDes = $proDes;
    }

    public function set_proURL($proURL): void {
        $this->proURL = $proURL;
    }

    public function ShowAllProduct($conn) {
        $sql = "select product_ID, product_Name, category_ID, product_Quantity, product_Unit, product_Price,product_Description,productURL from Product";
        $result = $conn->query($sql);
        return $result;
    }

    public function deleteProduct($conn) {
        $sql = "delete from product where product_ID=" . $this->get_proID();
        $result = $conn->query($sql);
        return $result;
    }

    public function ShowTop4Product($conn) {
        $sql = "SELECT * FROM product order by product_ID DESC LIMIT 4";
        $result = $conn->query($sql);
        return $result;
    }

    public function UpdateProduct($conn) {
        $sql = "Update product set product_Name='" . $this->get_proName() . "', category_ID=" . $this->get_cateID() . ", product_Quantity=" .
                $this->get_proQuanity() . ", product_Unit= '" . $this->get_proUnit() . "', product_Price=" . $this->get_proPrice() . " where product_ID=" . $this->get_proID();
        $result = $conn->query($sql);
        return $result;
    }

    public function insertProduct($conn) {
        $sql = "insert into product value(". $this->get_proID().", '". $this->get_proName()."',".
                $this->get_cateID().",". $this->get_proQuanity().",'". $this->get_proUnit()."',". 
                $this->get_proPrice().",'".$this->get_proDes()."','". $this->get_proURL()."')";
        $result = $conn->query($sql);
        return $result;
    }

    public function ShowAllCategory($conn) {
        $sql = "SELECT category_ID, category_Name FROM category";
        $result = $conn->query($sql);
        return $result;
    }

    public function countProduct($conn) {
        $result = $this->ShowAllProduct($conn);
        $count = 0;
        while ($row = $result->fetch_assoc()) {
            $count= $row["product_ID"];
        }
        return $count;
    }
    public function updateQuantity($conn) {
        $result = $this->ShowAllProduct($conn);
        while ($row = $result->fetch_assoc()) {
            if ($row["product_ID"]== $this->get_proID()) {
                $sql = "UPDATE product set product_Quantity =". $this->get_proQuanity()." where product_ID =". $this->get_proID();
                $conn->query($sql);
            }
        }
    }
    public function ShowProductName($conn) {
        $result = $this->ShowAllProduct($conn);
        while ($row = $result->fetch_assoc()) {
            if ($row["product_ID"]== $this->get_proID()) {
                return $row["product_Name"];
            }
        }
    }

}
