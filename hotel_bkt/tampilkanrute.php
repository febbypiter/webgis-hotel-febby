<?php
require '../connect.php';
$id_angkot=$_GET['id_angkot'];
$querysearch="SELECT id, destination, track, route_color, ST_AsGeoJson(geom) AS geom, ST_Y(ST_CENTROID(geom)) AS lat, ST_X(ST_CENTROID(geom)) AS lng FROM angkot where id='$id_angkot'";

$result=mysqli_query($conn, $querysearch);
$hasil = array(
	'type'  => 'FeatureCollection',
	'features' => array()
	);
  while ($isinya = mysqli_fetch_assoc($result)) {
	$features = array(
	  'type' => 'Feature',
	  'geometry' => json_decode($isinya['geom']),
	  
	  'properties' => array(
		'id' => $isinya['id'],
		'destination' => $isinya['destination'],
		'track' => $isinya['track'], 
		'route_color' => $isinya['route_color'],
		'latitude' => $isinya['lat'],
		'longitude' => $isinya['lng']
		)
	  );
	array_push($hasil['features'], $features);
  }
echo json_encode($hasil);
?>