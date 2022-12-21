<?php

class feedback{
    private  $feedback_ID;
    private $email;
    private $fullname;
    private $datetime;
    private $content;
    public function __construct($feedback_ID, $email, $fullname, $datetime, $content) {
        $this->feedback_ID = $feedback_ID;
        $this->email = $email;
        $this->fullname = $fullname;
        $this->datetime = $datetime;
        $this->content = $content;
    }
    public function get_feedback_ID() {
        return $this->feedback_ID;
    }

    public function get_email() {
        return $this->email;
    }

    public function get_fullname() {
        return $this->fullname;
    }

    public function get_datetime() {
        return $this->datetime;
    }

    public function get_content() {
        return $this->content;
    }

    public function set_feedback_ID($feedback_ID): void {
        $this->feedback_ID = $feedback_ID;
    }

    public function set_email($email): void {
        $this->email = $email;
    }

    public function set_fullname($fullname): void {
        $this->fullname = $fullname;
    }

    public function set_datetime($datetime): void {
        $this->datetime = $datetime;
    }

    public function set_content($content): void {
        $this->content = $content;
    }

    public function showAllFeedback($conn) {
        $sql = "SELECT * FROM feedback ORDER BY feedback_ID DESC";
            $result = $conn->query($sql);
            return $result;
    }
    public function InsertFeedback($conn) {
        $sql = "insert into feedback values(". $this->get_feedback_ID().", '". 
                $this->get_email()."', '". $this->get_fullname()."', '". $this->get_datetime()."', '". $this->get_content()."')";
            $result = $conn->query($sql);
            return $result;
    }
    public function IDFeedback($conn) {
        $result = $this->showAllFeedback($conn);
        while ($row = $result->fetch_assoc()) {
            $id = $row["feedback_ID"];
            return $id;
        }
    }
    
}
