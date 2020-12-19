<?php
	$host = "localhost";
	$user = "root";
	$pass = "password";
	$dbname = "bkt_tourism5";
	$conn = mysqli_connect($host, $user, $pass, $dbname);
	if (!$conn) {
    	die("Connection failed: " . mysqli_connect_error());
	}
	// echo "Connected successfully";
?>

