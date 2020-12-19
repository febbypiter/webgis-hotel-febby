<?php
include ('../../../connect.php');
$id = $_POST['id'];
$nama = $_POST['name'];
$address = $_POST['address'];
$cp = $_POST['cp'];
$type = $_POST['type'];
$mushalla = $_POST['mushalla'];
$geom = $_POST['geom'];	

$ktp = $_POST['ktp'];
$marriage_book = $_POST['marriage_book'];
if ($ktp != 1) {
	$ktp=0;
}
if ($marriage_book != 1) {
	$marriage_book=0;
}
$sql = mysqli_query($conn,"insert into hotel (id, name, address, cp, geom, ktp, marriage_book, mushalla, id_type) values ('$id', '$nama', '$address', '$cp', ST_GeomFromText('$geom'), '$ktp', '$marriage_book', '$mushalla', '$type')");
if ($sql){
	echo "<script>alert ('Data Successfully Added');</script>";
}else{
	echo "<script>alert ('Error');</script>";
}
echo "<script>eval(\"parent.location='../'\");</script>";
?>