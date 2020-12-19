<?php
require '../../connect.php';
$querysearch="	SELECT row_to_json(fc) 
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features 
				FROM (SELECT 'Feature' As type , ST_AsGeoJSON(a.geom)::json As geometry , row_to_json((SELECT l 
				FROM (SELECT a.name,ST_X(ST_Centroid(a.geom)) AS lon, ST_Y(ST_CENTROID(a.geom)) As lat) As l )) As properties 
				FROM tourism As a  
				) As f ) As fc
			  ";

$hasil=mysqli_query($conn,$querysearch);
while($data=mysqli_fetch_array($hasil))
	{
		$load=$data['row_to_json'];
	}
	echo $load;
?>