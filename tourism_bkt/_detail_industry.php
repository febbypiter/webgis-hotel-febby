<?php
    include("../connect.php");
    $id = $_GET['id'];

    $result=  mysqli_query($conn,"SELECT detail_small_industry.id_angkot, angkot.route_color as color, angkot.destination, st_x(st_centroid(small_industry.geom)) as lng2, st_y(st_centroid(small_industry.geom)) as lat2, detail_small_industry.lat, detail_small_industry.lng, detail_small_industry.description FROM detail_small_industry left join small_industry on small_industry.id=detail_small_industry.id_small_industry left join angkot on angkot.id = detail_small_industry.id_angkot where detail_small_industry.id_small_industry='$id' ");

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