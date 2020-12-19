<?php

	include('../connect.php');
    $latit = $_GET['lat'];
    $longi = $_GET['lng'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id, name, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM worship_place where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 

	$hasil=mysqli_query($conn,$querysearch);

    while($baris = mysqli_fetch_array($hasil))
        {
            $id=$baris['id'];
            $name=$baris['name'];
            $jarak=$baris['jarak'];
            $lat=$baris['lat'];
            $lng=$baris['lng'];
            $dataarray[]=array('id'=>$id,'name'=>$name,'jarak'=>$jarak, "lat"=>$lat,"lng"=>$lng);
        }
        echo json_encode ($dataarray);
?>