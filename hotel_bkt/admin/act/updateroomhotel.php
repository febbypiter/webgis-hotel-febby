<?php
include ('../../../connect.php');
$id = $_POST['id_hotel'];
$id_room	= $_POST['id_room'];
$room = $_POST['name_room'];
$price = $_POST['price_room'];


$sql  = "update room set name='$room', price = '$price' where id='$id_room'";
$insert = mysqli_query($conn,$sql);

if ($insert){
	echo "<script>alert ('Data Successfully Change');</script>";
}else{
	echo "<script>alert ('Error');</script>";
}
	if($_SESSION['A']===true){
	header("location:../?page=hotel_detail&id=$id");}
	else{
		header("location:../indexu.php");
	}
?>