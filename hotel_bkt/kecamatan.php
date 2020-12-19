<?php
require '../connect.php';
$querysearch="SELECT district.id, district.name, ST_AsGeoJSON(district.geom) AS geometry, ST_X(ST_CENTROID(district.geom)) AS lon, ST_Y(ST_CENTROID(district.geom)) As lat FROM district";
$load = array(
	'type'	=> 'FeatureCollection',
	'features' => array()
	);
$hasil=mysqli_query($conn, $querysearch);
while($data=mysqli_fetch_array($hasil)){
	$features = array(
		'type' => 'Feature',
		'geometry' => json_decode($data['geometry']),
		'properties' => array(
			'id' => $data['id'],
			'nama' => $data['name'],
			'lon' => $data['lon'],
			'lat' => $data['lat']
			)
		);
	array_push($load['features'], $features);
	}
	echo json_encode($load);
?>