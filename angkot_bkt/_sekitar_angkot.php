<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['long'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id, route_color, destination, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 
	$hasil=mysqli_query($conn,$querysearch);

    while($baris = mysqli_fetch_array($hasil)){
        $id=$baris['id'];
        $route_color=$baris['route_color'];
        $destination=$baris['destination'];
        $dataarray[]=array('id'=>$id,'route_color'=>$route_color,'destination'=>$destination);
    }
    echo json_encode ($dataarray);
?>