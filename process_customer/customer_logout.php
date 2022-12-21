<?php
session_start();
$_SESSION["account"]=null;
header("location:http://localhost:1000/PhpAssignment/index.php");
