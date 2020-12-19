<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['long'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id, route_color, destination FROM angkot where where st_distance_sphere(ST_GeomFromText('POINT($latit $longi)', 4326), ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(geom)),' ',ST_X(ST_Centroid(geom)),')'), 4326)) <= $rad"; 
	$hasil=mysqli_query($conn,$querysearch);

    while($baris = mysqli_fetch_array($hasil)){
        $id=$baris['id'];
        $route_color=$baris['route_color'];
        $destination=$baris['destination'];
        $dataarray[]=array('id'=>$id,'route_color'=>$route_color,'destination'=>$destination);
    }
    echo json_encode ($dataarray);
?>