<?php
include("../connect.php");
$querysearch="select id, name,  ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from hotel order by id ASC";

$result=mysqli_query($conn,$querysearch);
  while($baris = mysqli_fetch_array($result))
    {
        $id=$baris['id'];
        $nama=$baris['name'];
        $longitude=$baris['lng'];
		$latitude=$baris['lat'];
		$dataarray[]=array('id'=>$id,'nama'=>$nama,'longitude'=>$longitude,'latitude'=>$latitude);
    }
   echo json_encode ($dataarray);
