<?php
    include("../connect.php");
    $id_angkot = $_GET['id_angkot'];

    $result=  mysqli_query($conn,"SELECT detail_souvenir.id_souvenir, souvenir.name, st_x(st_centroid(souvenir.geom)) as lng2, st_y(st_centroid(souvenir.geom)) as lat2, detail_souvenir.lat, detail_souvenir.lng, detail_souvenir.description FROM detail_souvenir left join souvenir on souvenir.id = detail_souvenir.id_souvenir WHERE id_angkot='$id_angkot' ");

        while($baris = mysqli_fetch_array($result))
            {
                $id=$baris['id_souvenir'];
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