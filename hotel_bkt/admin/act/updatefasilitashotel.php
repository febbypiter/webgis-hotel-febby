<?php
include ('../../../connect.php');
$id_hotel = $_POST['id_hotel'];
$facility = $_POST['facility_hotel'];
echo "id = $id_hotel";
$sqldel = "delete from detail_facility_hotel where id_hotel='$id_hotel'";

$delete = mysqli_query($conn,$sqldel);

$countl = count($facility);
if($countl > 0){
	$sqll   = "insert into detail_facility_hotel (id_hotel, id_facility) VALUES ";
	for( $i=0; $i < $countl; $i++ ){
		$sqll .= "('{$id_hotel}','{$facility[$i]}')";
		$sqll .= ",";
	}
	$sqll = rtrim($sqll,",");
	$insert = mysqli_query($conn,$sqll);
}
if (($insert||$countl==0) && $delete){
	//echo 'ok';
	if($_SESSION['A']===true){
	header("location:../index.php?page=hotel_detail&id=$id_hotel");}
	else{
		header("location:../indexu.php?page=hotel_detail&id=$id_hotel");
	}
}
else{
	echo 'error';
	header("location:../?page=hotel_detail&id=$id_hotel");
}

?>