<?php 
session_start();
include '../../../connect.php';
$id = $_POST['id'];
$nama = $_SESSION['username'];
$info = $_POST['info'];
//$user = $_SESSION['userusername'];
//echo "ini id $id, ini user $user, ini info $info, $role,$nama";

$cariMax = "select max(id_informasi) as max from information_admin";
$queryMax = mysqli_query($conn,$cariMax);
$dataMax = mysqli_fetch_array($queryMax);

$id_informasi = 0;
if($dataMax['max'] == null){
	$id_informasi = 1;
} else {
	$id_informasi = $dataMax['max'] + 1;
}

$tanggal = date("Y-m-d");


$sql = "";
if(strpos($id,"H") !== false){
	$sql = "insert into information_admin(username,id_hotel,informasi,tanggal,id_informasi) values('$nama','$id','$info','$tanggal','$id_informasi')";
} else if(strpos($id,"SO") !== false){
	$sql = "insert into information_admin(username,id_souvenir,informasi,tanggal,id_informasi) values('$nama','$id','$info','$tanggal','$id_informasi')";
} else if(strpos($id,"IK") !== false){
	$sql = "insert into information_admin(username,id_ik,informasi,tanggal,id_informasi) values('$nama','$id','$info','$tanggal','$id_informasi')";
} else if(strpos($id,"RM") !== false){
	$sql = "insert into information_admin(username,id_kuliner,informasi,tanggal,id_informasi) values('$nama','$id','$info','$tanggal','$id_informasi')";
} else if(strpos($id,"tw") !== false){
	$sql = "insert into information_admin(username,id_ow,informasi,tanggal,id_informasi) values('$nama','$id','$info','$tanggal','$id_informasi')";
}

$query_sql = mysqli_query($conn,$sql);
if($query_sql){
	echo "<script>alert ('Data Successfully Added');</script>";
	if($_SESSION['A']===true){
	header("location:../?page=hotel_detail&id=$id");}
	else{
		header("location:../indexu.php?page=hotel_detail&id=$id");}
	}
}else{
	echo "<script>alert ('Error');</script>";
}


 ?>