<?php

class Admin {

    private $email;
    private $password;

    public function __construct($email, $password) {
        $this->email = $email;
        $this->password = $password;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_password() {
        return $this->password;
    }

    public function set_email($email): void {
        $this->email = $email;
    }

    public function set_password($password): void {
        $this->password = $password;
    }

    public function loginAdmin($conn) {
        $sql = "select password from admin where email = '" . $this->get_email() . "';";
        $result = $conn->query($sql);
         while ($row = $result->fetch_assoc()) {
             return $row["password"];
         }
    }

}
