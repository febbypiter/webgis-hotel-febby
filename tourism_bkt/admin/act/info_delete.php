<?php
session_start();
include ('../../../connect.php');
$id_info = $_GET['id_informasi'];
$id_hotel = $_POST['id_hotel'];
//echo "$id_info --> id_info";

	$sql1   = "delete from information_admin where id_informasi = $id_info";
	$delete1 = mysqli_query($conn,$sql1);
	if ($delete1){
		echo "<script>alert ('Data Successfully Delete');</script>";
	}
	else{
		echo "<script>alert ('Error');</script>";
	}
	
	if($_SESSION['A']===true){
	echo "<script>eval(\"location:../?page=hotel_detail&id=$id_hotel\");</script>";
	}
	else{
		echo "<script>eval(\"location:../indexu.php?page=hotel_detail&id=$id_hotel\");</script>";
	}
?>