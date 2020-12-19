<?php
    include("../connect.php");
    $id_tourism = $_GET['id_tourism'];

    $result=  mysqli_query($conn,"SELECT detail_tourism.id_angkot, tourism.name, angkot.destination, angkot.route_color as color, st_x(st_centroid(tourism.geom)) as lng2, st_y(st_centroid(tourism.geom)) as lat2, detail_tourism.lat, detail_tourism.lng, detail_tourism.description FROM detail_tourism left join tourism on tourism.id = detail_tourism.id_tourism left join angkot on angkot.id = detail_tourism.id_angkot where detail_tourism.id_tourism='$id_tourism' ");

    while($baris = mysqli_fetch_array($result)){
        $id=$baris['id_angkot'];
        $name=$baris['name'];
        $destination=$baris['destination'];
        $lat=$baris['lat'];
        $lng=$baris['lng'];
        $lat2=$baris['lat2'];
        $lng2=$baris['lng2'];
        $color=$baris['color'];
        $description=$baris['description'];
        $dataarray[]=array('id'=>$id,'destination'=>$destination,'name'=>$name,'lat'=>$lat,'lng'=>$lng,'lat2'=>$lat2,'lng2'=>$lng2,'color'=>$color,'description'=>$description);
    }
    echo json_encode ($dataarray);
?>