<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $lng = $_GET['lng'];
	$rad=$_GET['rad'];

	$querysearch="select id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat FROM small_industry where st_distance_sphere(ST_GeomFromText('POINT($latit $lng)', 4326), ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) <= $rad"; 

	$hasil=mysqli_query($conn,$querysearch);
        while($baris = mysqli_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $jarak=$baris['jarak'];
                $lat=$baris['lat'];
                $lng=$baris['lng'];
                $dataarray[]=array('id'=>$id, 'name'=>$name,'jarak'=>$jarak, "lat"=>$lat,"lng"=>$lng);
            }
            echo json_encode ($dataarray);
?>