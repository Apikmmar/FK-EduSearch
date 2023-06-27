<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "module2";

try {
	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	echo("<script>console.log('connection on')</script>");
} catch (PDOException $e) {
	echo $e->getMessage();
}