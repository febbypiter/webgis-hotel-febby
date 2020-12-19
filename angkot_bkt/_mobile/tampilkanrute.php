<?php
require '../../connect.php';
$id_angkot=$_GET['id_angkot'];
$querysearch="	SELECT row_to_json(fc) 
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features 
				FROM (SELECT 'Feature' As type , ST_AsGeoJSON(a.geom)::json As geometry , row_to_json((SELECT l 
				FROM (SELECT a.id, a.destination,  a.track, a.cost, b.color, ST_X(ST_Centroid(a.geom)) AS longitude, ST_Y(ST_CENTROID(a.geom)) As latitude) As l )) As properties 
				FROM angkot As a left join angkot_color as b on b.id=a.id_color
				where a.id='$id_angkot'
				) As f ) As fc 
			  ";

$hasil=mysqli_query($conn,$querysearch);
while($data=mysqli_fetch_array($hasil))
	{
		$load=$data['row_to_json'];
	}
	echo $load;
?>

