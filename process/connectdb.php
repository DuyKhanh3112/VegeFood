<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "vegefood";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_errno) {
    die("Connect failed: " . $conn->connect_errno);
}
?>

