<?php
    include("../connect.php");
    $id_angkot = $_GET['id_angkot'];

    $result=  mysqli_query($conn,"SELECT detail_hotel.id_hotel, hotel.name, st_x(st_centroid(hotel.geom)) as lng2, st_y(st_centroid(hotel.geom)) as lat2, detail_hotel.lat, detail_hotel.lng, detail_hotel.description FROM detail_hotel left join hotel on hotel.id=detail_hotel.id_hotel where id_angkot='$id_angkot' ");
    while($baris = mysqli_fetch_array($result)){
        $id=$baris['id_hotel'];
        $name=$baris['name'];
        $lat=$baris['lat'];
        $lng=$baris['lng'];
        $lat2=$baris['lat2'];
        $lng2=$baris['lng2'];
        $description=$baris['description'];
        $dataarray[]=array('id'=>$id,'name'=>$name,'lat'=>$lat,'lng'=>$lng,'lat2'=>$lat2,'lng2'=>$lng2,'description'=>$description);
    }
    echo json_encode ($dataarray);



?>