<?php
include ('../../../connect.php');
$id = $_POST['id'];
$nama = $_POST['name'];
$address = $_POST['address'];
$open = $_POST['open'];
$close = $_POST['close'];
$ticket = $_POST['ticket'];
$type = $_POST['type'];
$geom = $_POST['geom'];
$sql = mysqli_query($conn,"UPDATE tourism set name='$nama', address='$address', open='$open', close='$close', ticket='$ticket', id_type='$type', geom=ST_GeomFromText('$geom') where id='$id'");
	if ($sql){
		echo "<script>alert('Data Successfully Change');</script>";
	}else{
		echo "<script>alert('Error');</script>";
	}
	if($_SESSION['A']===true){
	echo "<script>eval(\"parent.location='../index.php?page=tourism_detail&id=$id '\");</script>";
}
else{
	echo "<script>eval(\"parent.location='../indexu.php?page=tourism_detail&id=$id '\");</script>";
}
?>