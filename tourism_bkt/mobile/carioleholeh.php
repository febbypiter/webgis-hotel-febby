<?php

	include('../../connect.php');
    $latit = $_GET['latitude'];
    $longi = $_GET['longitude'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id, name, owner, cp, address, id_souvenir_type, employee, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM souvenir where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 

	$hasil=mysqli_query($conn,$querysearch);

        while($baris = mysqli_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $owner=$baris['owner'];
                $cp=$baris['cp'];
                $address=$baris['address'];
                $id_souvenir_type=$baris['id_souvenir_type'];
                $employee=$baris['employee'];
                $latitude=$baris['lat'];
                $longitude=$baris['lng'];
                $dataarray[]=array('id'=>$id,'name'=>$name,'owner'=>$owner,'cp'=>$cp, 'address'=>$address,'id_souvenir_type'=>$id_souvenir_type, 'employee'=>$employee,  "latitude"=>$latitude,"longitude"=>$longitude);
            }
            echo json_encode ($dataarray);
?>