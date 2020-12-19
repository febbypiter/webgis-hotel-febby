
<?php
require '../connect.php';

$tipe = $_GET["tipe"];		// Cari berdasarkan apa
$nilai = $_GET["nilai"];	// Isi yang dicari

/*
ISI TIPE:
	1 => Tujuan
	2 => Jalur yang dilewati
*/

if ($tipe == 1) {
	$querysearch	="SELECT angkot.id, angkot.destination, angkot.track, angkot.cost, angkot.number, angkot.route_color, angkot.geom, ST_X(ST_Centroid(angkot.geom)) AS lon, ST_Y(ST_CENTROID(angkot.geom)) As lat, angkot_color.color FROM angkot left join angkot_color on angkot_color.id = angkot.id_color  where LOWER(angkot.destination) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 2) {
	$querysearch	="SELECT angkot.id, angkot.destination, angkot.track, angkot.cost, angkot.number, angkot.route_color, angkot.geom, ST_X(ST_Centroid(angkot.geom)) AS lon, ST_Y(ST_CENTROID(angkot.geom)) As lat, angkot_color.color FROM angkot left join angkot_color on angkot_color.id = angkot.id_color  where LOWER(angkot.track) like '%' || LOWER('$nilai') || '%'";
} elseif ($tipe == 3) {
	$querysearch	="SELECT angkot.id, angkot.destination, angkot.track, angkot.cost, angkot.number, angkot.route_color, angkot.geom, ST_X(ST_Centroid(angkot.geom)) AS lon, ST_Y(ST_CENTROID(angkot.geom)) As lat, angkot_color.color FROM angkot left join angkot_color on angkot_color.id = angkot.id_color  where angkot_color.id = $nilai";
}
  
$hasil=mysqli_query($conn,$querysearch);
while($baris = mysqli_fetch_array($hasil))
	{
		  $id=$baris['id'];
		  $destination=$baris['destination'];
		  $track=$baris['track'];
		  $cost=$baris['cost'];
		  $number=$baris['number'];
		  $color=$baris['color'];
		  $route_color=$baris['route_color'];
		  $lat=$baris['lat'];
          $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'destination'=>$destination,'track'=>$track,'cost'=>$cost, 'number'=>$number, 'color'=>$color, 'route_color'=>$route_color, 'lng'=>$lng, 'lat'=>$lat);
	}
echo json_encode ($dataarray);
?>
