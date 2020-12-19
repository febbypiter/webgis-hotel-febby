<?php
    include("connect.php");
    $id_angkot = $_GET['id_angkot'];

    $result=  mysqli_query($conn,"SELECT detail_tourism.id_tourism, tourism.name, st_x(st_centroid(tourism.geom)) as lng2, st_y(st_centroid(tourism.geom)) as lat2, detail_tourism.lat, detail_tourism.lng, detail_tourism.description FROM detail_tourism left join tourism on tourism.id = detail_tourism.id_tourism where id_angkot='$id_angkot' ");

    while($baris = mysqli_fetch_array($result)){
        $id=$baris['id_tourism'];
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