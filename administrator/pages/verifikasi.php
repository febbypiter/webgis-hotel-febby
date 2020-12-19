<?php
include ('../../../connect.php');

$edit = mysqli_query($conn,"update admin set role='C' where username='$_GET[user]'");

if($edit){
	header('location:http://localhost/html/hotel_bkt/admin/login.php');
}
