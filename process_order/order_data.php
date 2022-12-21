<?php

class order {

    private $order_ID;
    private $fee;
    private $order_Date;
    private $quantity;
    private $email;
    private $address;
    private $product_ID;
    private $phone;
    private $total;
    public function get_total() {
        return $this->total;
    }

    public function set_total($total): void {
        $this->total = $total;
    }

        public function __construct($order_ID, $fee, $order_Date, $quantity, $email, $address, $product_ID, $phone,$total) {
        $this->order_ID = $order_ID;
        $this->fee = $fee;
        $this->order_Date = $order_Date;
        $this->quantity = $quantity;
        $this->email = $email;
        $this->address = $address;
        $this->product_ID = $product_ID;
        $this->phone = $phone;
        $this->total= $total;
    }

    public function get_order_ID() {
        return $this->order_ID;
    }

    public function get_fee() {
        return $this->fee;
    }

    public function get_order_Date() {
        return $this->order_Date;
    }

    public function get_quantity() {
        return $this->quantity;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_address() {
        return $this->address;
    }

    public function get_product_ID() {
        return $this->product_ID;
    }

    public function get_phone() {
        return $this->phone;
    }

    public function set_order_ID($order_ID): void {
        $this->order_ID = $order_ID;
    }

    public function set_fee($fee): void {
        $this->fee = $fee;
    }

    public function set_order_Date($order_Date): void {
        $this->order_Date = $order_Date;
    }

    public function set_quantity($quantity): void {
        $this->quantity = $quantity;
    }

    public function set_email($email): void {
        $this->email = $email;
    }

    public function set_address($address): void {
        $this->address = $address;
    }

    public function set_product_ID($product_ID): void {
        $this->product_ID = $product_ID;
    }

    public function set_phone($phone): void {
        $this->phone = $phone;
    }

    public function insertOrder($conn) {
        $sql = "insert into orders values(?,?,?,?,?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("issssdd", $this->get_order_ID(), $this->get_email(), $this->get_phone(), $this->get_order_Date(),$this->get_address(), $this->get_total(), $this->get_fee());
        $result = $stmt->execute();
        return $result;
    }

    public function insertOrderDetails($conn) {
        $sql = "insert into order_details values(?,?,?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $this->get_order_ID(), $this->get_product_ID(), $this->get_quantity());
        $result = $stmt->execute();
        return $result;
    }
    public function getOrderID($conn) {
        $sql = "select * from orders";
        $count =0;
        $result =$conn->query($sql);
        while ($row = $result->fetch_assoc()) {
            $count= $row["order_ID"];
        }
        return $count;
    }
    
    public function showAllOrder($conn) {
        $sql = "select * from orders";
        $result =$conn->query($sql);
        return $result;
    }
    public function showAllOrderDetails($conn) {
        $sql = "select * from order_details";
        $result =$conn->query($sql);
        return $result;
    }
}
