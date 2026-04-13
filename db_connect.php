<?php

$host = "127.0.0.1";
$dbname = "u443959289_products";
$username = "u443959289";
$password = "EleanorJ2023!!";

$conn = new mysqli($host, $username, $password, $dbname);

if($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>