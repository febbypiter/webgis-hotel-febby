<?php

	include('../../connect.php');
    $latit = $_GET['latitude'];
    $longi = $_GET['longitude'];
	$rad=$_GET['rad'];

	$querysearch="SELECT id, name, address, cp, ktp, marriage_book, mushalla, star, id_type, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) as jarak FROM hotel where st_distance_sphere(ST_GeomFromText('POINT(".$longi." ".$latit.")',-1), geom) <= ".$rad.""; 

	$hasil=mysqli_query($conn,$querysearch);

        while($baris = mysqli_fetch_array($hasil))
            {
                $id=$baris['id'];
                $name=$baris['name'];
                $address=$baris['address'];
                $cp=$baris['cp'];
                $ktp=$baris['ktp'];
                $marriage_book=$baris['marriage_book'];
                $mushalla=$baris['mushalla'];
                $star=$baris['star'];
                $id_type=$baris['id_type'];
                $latitude=$baris['lat'];
                $longitude=$baris['lng'];
                $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'cp'=>$cp, 'fasilitas'=>$fasilitas, 'tipe_kamar'=>$tipe_kamar, 'harga'=>$harga, 'ktp'=>$ktp, 'marriage_book'=>$marriage_book, 'mushalla'=>$mushalla, 'star'=>$star, 'id_type'=>$id_type, 'latitude'=>$latitude,'longitude'=>$longitude);
            }
            echo json_encode ($dataarray);
?>