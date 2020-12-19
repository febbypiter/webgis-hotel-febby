<?php
session_start();
include ('../../../connect.php');
$id = $_POST['id_tourism'];
$facility = $_POST['facility_tourism'];

$sqldel = "delete from detail_facility_tourism where id_tourism='$id'";

$delete = mysqli_query($conn,$sqldel);

$countl = count($facility);
if($countl > 0){
	$sqll   = "insert into detail_facility_tourism (id_tourism, id_facility) VALUES ";
	for( $i=0; $i < $countl; $i++ ){
		$sqll .= "('{$id}','{$facility[$i]}')";
		$sqll .= ",";
	}
	$sqll = rtrim($sqll,",");
	$insert = mysqli_query($conn,$sqll);
}
if (($insert||$countl==0) && $delete){
	//echo 'ok';
	if($_SESSION['A']===true){
	header("location:../?page=tourism_detail&id=$id");
	}
	else{
		header("location:../indexu.php?page=tourism_detail&id=$id");
	}
}
else{
	echo 'error';
	
}

?>