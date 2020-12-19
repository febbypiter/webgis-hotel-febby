<?php
require '../connect.php';

$tipe = $_GET["tipe"];		// Cari berdasarkan apa
$nilai = $_GET["nilai"];	// Isi yang dicari

/*
ISI TIPE:
	1 => Nama
	2 => Alamat
	3 => Harga Tiket
	4 => Tipe tourism
	5 => Fasilitas
*/

if ($tipe == 1) {
	$querysearch	="SELECT id, name, st_x(st_centroid(geom)) as lon ,st_y(st_centroid(geom)) as lat  from tourism where  LOWER(name) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 2) {
	$querysearch	="SELECT id, name, st_x(st_centroid(geom)) as lon ,st_y(st_centroid(geom)) as lat  from tourism where  LOWER(address) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 3) {
	$querysearch	="SELECT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat  from tourism left join tourism_type on tourism_type.id = tourism.id_type where tourism.id_type = '$nilai'";
} elseif ($tipe == 4) {
	$querysearch	="SELECT tourism.id, tourism.name, st_x(st_centroid(tourism.geom)) as lon ,st_y(st_centroid(tourism.geom)) as lat  from tourism left join detail_facility_tourism on detail_facility_tourism.id_tourism=tourism.id left join facility_tourism on facility_tourism.id = detail_facility_tourism.id_facility where  LOWER(facility_tourism.name) like '%' || LOWER('$nilai') || '%'  GROUP BY (tourism.id)";
}
			   
$hasil=mysqli_query($conn,$querysearch);
while($baris = mysqli_fetch_array($hasil))
	{
		  $id=$baris['id'];
		  $name=$baris['name'];
		  $lng=$baris['lon'];
		  $lat=$baris['lat'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'lng'=>$lng,'lat'=>$lat);
	}
echo json_encode ($dataarray);
?>
