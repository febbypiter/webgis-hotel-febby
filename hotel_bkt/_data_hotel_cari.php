<?php
require '../connect.php';

$tipe = $_GET["tipe"];		// Cari berdasarkan apa
$nilai = $_GET["nilai"];	// Isi yang dicari

/*
ISI TIPE:
	1 => Nama
	2 => Adress
	3 => Tipe
	4 => Kecamatan
	5 => Fasilitas
*/

if ($tipe == 1) {
	$querysearch	="SELECT id, name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from bkt_tourism.hotel where  LOWER(name) like LOWER('%" . $nilai . "%')";
} elseif ($tipe == 2) {
	$querysearch	="SELECT id, name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel where  LOWER(address) like LOWER('%" . $nilai . "%')";
} elseif ($tipe == 3) {
	$querysearch	="SELECT hotel.id, hotel.name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel left join hotel_type on hotel_type.id = hotel.id_type where  LOWER(hotel_type.id) like LOWER('%" . $nilai . "%')";
} elseif ($tipe == 4) {
	$querysearch	="SELECT hotel.id, hotel.name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel, district where ST_Within(hotel.geom,district.geom) and LOWER(district.id) like LOWER('%" . $nilai . "%')";
} elseif ($tipe == 5) {
	$querysearch	="SELECT hotel.id, hotel.name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel left join detail_facility_hotel on detail_facility_hotel.id_hotel = hotel.id left join facility_hotel on detail_facility_hotel.id_facility = facility_hotel.id where facility_hotel.id = $nilai";
}
  
$hasil=mysqli_query($conn,$querysearch);
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
