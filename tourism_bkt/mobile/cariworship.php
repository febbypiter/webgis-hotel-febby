<?php

	include('../../connect.php');
    $latit = $_GET['latitude'];
    $longi = $_GET['longitude'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id, name, address, capacity, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM worship_place where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 

	$hasil=mysqli_query($conn,$querysearch);

    while($baris = mysqli_fetch_array($hasil))
        {
            $id=$baris['id'];
            $name=$baris['name'];
            $address=$baris['address'];
            $capacity=$baris['capacity'];
            $latitude=$baris['lat'];
            $longitude=$baris['lng'];
            $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'capacity'=>$capacity,  "latitude"=>$latitude,"longitude"=>$longitude);
        }
        echo json_encode ($dataarray);
?>