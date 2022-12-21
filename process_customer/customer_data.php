<?php
class customer {
    private $fullname;
    private $email;
    private $phone;
    private $address;
    private $password;

    public function __construct($fullname, $email, $phone, $address, $password) {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->phone = $phone;
        $this->address = $address;
        $this->password = $password;
    }

    public function get_fullname() {
        return $this->fullname;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_phone() {
        return $this->phone;
    }

    public function get_address() {
        return $this->address;
    }

    public function get_password() {
        return $this->password;
    }

    public function set_fullname($fullname): void {
        $this->fullname = $fullname;
    }

    public function set_email($email): void {
        $this->email = $email;
    }

    public function set_phone($phone): void {
        $this->phone = $phone;
    }

    public function set_address($address): void {
        $this->address = $address;
    }

    public function set_password($password): void {
        $this->password = $password;
    }

    public function register($conn) {
        $sql = "insert into customer (fullname, email, phone, address, password) "
                . "values ('" . $this->get_fullname() . "', '" . $this->get_email() .
                "','" . $this->get_phone() . "', '" . $this->get_address() . "', '" . $this->get_password() . "')";
        $result = $conn->query($sql);
        return $result;
    }

    public function forgetPass($conn) {
        $result = $this->showAll($conn);
        while ($row = $result->fetch_assoc()) {
            if ($row["email"] == $this->get_email() && $row["phone"] == $this->get_phone()) {
                return $row["password"];
            }
        }
        return 0;
    }

    public function login($conn) {
        $resul = $this->showAll($conn);
        while ($row = $resul->fetch_assoc()) {
            if ($row["email"] == $this->get_email()) {
                return $row["password"];
            }
        }
        return 0;
    }

    public function showAll($conn) {
        $sql = "select fullname, email, phone, address, password from customer ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return 0;
        }
    }

    public function deleteCustomer($conn) {
        $sql = "delete from customer where email= '" . $this->get_email() . "'";
        $result = $conn->query($sql);
        return $result;
    }

    public function updateCustomer($conn) {
        $sql = "UPDATE customer set  fullname ='" . $this->get_fullname() . "', address='" . $this->get_address() .
                "', phone='" . $this->get_phone() . "' where email ='" . $this->get_email() . "'";
        $result = $conn->query($sql);
        return $result;
    }

    public function ShowName($conn) {
        $resul = $this->showAll($conn);
        while ($row = $resul->fetch_assoc()) {
            if ($row["email"] == $this->get_email()) {
                return $row["fullname"];
            }
        }
        return $result;
    }

}
