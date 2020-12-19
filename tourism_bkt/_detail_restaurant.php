<?php
    include("../connect.php");
    $id = $_GET['id'];

    $result=  mysqli_query($conn,"SELECT detail_restaurant.id_angkot, angkot.route_color as color, angkot.destination, st_x(st_centroid(restaurant.geom)) as lng2, st_y(st_centroid(restaurant.geom)) as lat2, detail_restaurant.lat, detail_restaurant.lng, detail_restaurant.description FROM detail_restaurant left join restaurant on restaurant.id=detail_restaurant.id_restaurant left join angkot on angkot.id = detail_restaurant.id_angkot where detail_restaurant.id_restaurant='$id' ");

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