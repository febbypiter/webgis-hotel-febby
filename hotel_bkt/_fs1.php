<?php
require '../connect.php';

$min=$_GET['min']; //harga min
$max=$_GET['max']; //harga max
$fas=$_GET['fas']; //fasilitas
$tipe=$_GET['tipe']; //tipe hotel

$querysearch	="SELECT DISTINCT hotel.id, hotel.name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel left join detail_room on hotel.id = detail_room.id_hotel left join room on room.id=detail_room.id_room left join detail_facility_hotel on detail_facility_hotel.id_hotel = hotel.id left join facility_hotel on detail_facility_hotel.id_facility = facility_hotel.id left join hotel_type on hotel.id_type=hotel_type.id where ";
if ($min!="") {
	$querysearch	.="room.price >= ".$min." and room.price <= ".$max." ";
}
if($min!=""&&$fas!=""){
	$querysearch	.="and ";
}
if($fas!=""){
	$querysearch	.="facility_hotel.id in ($fas) ";
}
if ($min==""&&$fas=="") {
	
}else{
	$querysearch	.="and ";
}
if ($tipe!="") {
	$querysearch	.="hotel_type.id = '$tipe'";	
}
$hasil=mysqli_query($conn, $querysearch);
while($baris = mysqli_fetch_array($hasil))
	{
		  $id=$baris['id'];
		  $name=$baris['name'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name, 'lng'=>$lng, 'lat'=>$lat);
	}
echo json_encode ($dataarray);

?>