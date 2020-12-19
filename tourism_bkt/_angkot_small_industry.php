<?php
    include("../connect.php");
    $id_angkot = $_GET['id_angkot'];

    $result=  mysqli_query($conn,"SELECT detail_small_industry.id_small_industry, small_industry.name, st_x(st_centroid(small_industry.geom)) as lng2, st_y(st_centroid(small_industry.geom)) as lat2, detail_small_industry.lat, detail_small_industry.lng, detail_small_industry.description FROM detail_small_industry left join small_industry on small_industry.id=detail_small_industry.id_small_industry where id_angkot='$id_angkot' ");

        while($baris = mysqli_fetch_array($result))
            {
                $id=$baris['id_small_industry'];
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