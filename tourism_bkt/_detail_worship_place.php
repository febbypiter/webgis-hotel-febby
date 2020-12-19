<?php
    include("../connect.php");
    $id = $_GET['id'];

    $result=  mysqli_query($conn,"SELECT detail_worship_place.id_angkot, angkot.route_color as color, angkot.destination, st_x(st_centroid(worship_place.geom)) as lng2, st_y(st_centroid(worship_place.geom)) as lat2, detail_worship_place.lat, detail_worship_place.lng, detail_worship_place.description FROM detail_worship_place left join worship_place on worship_place.id=detail_worship_place.id_worship_place left join angkot on angkot.id = detail_worship_place.id_angkot where detail_worship_place.id_worship_place='$id' ");

        while($baris = mysqli_fetch_array($result))
            {
                $id=$baris['id_angkot'];
                $destination=$baris['destination'];
                $color=$baris['color'];
                $lat=$baris['lat'];
                $lng=$baris['lng'];
                $lat2=$baris['lat2'];
                $lng2=$baris['lng2'];
                $description=$baris['description'];
                $dataarray[]=array('id'=>$id,'destination'=>$destination,'lat'=>$lat,'lng'=>$lng,'lat2'=>$lat2,'lng2'=>$lng2,'color'=>$color,'description'=>$description);
            }
            echo json_encode ($dataarray);
?>