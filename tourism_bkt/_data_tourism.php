<?php
include("../connect.php");
$querysearch="select id, name,  ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from tourism order by id ASC";

$result=mysqli_query($conn,$querysearch);
  while($baris = mysqli_fetch_array($result))
    {
        $id=$baris['id'];
        $nama=$baris['name'];
        $lng=$baris['lng'];
		$lat=$baris['lat'];
		$dataarray[]=array('id'=>$id,'name'=>$nama,'lng'=>$lng,'lat'=>$lat);
    }
   echo json_encode ($dataarray);
