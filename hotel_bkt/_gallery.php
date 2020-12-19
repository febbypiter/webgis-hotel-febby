<?php
	require '../connect.php';
	$tipe=$_GET['tipe'];
	$query="SELECT a.id, a.name, st_x(st_centroid(a.geom)) as lon, st_y(st_centroid(a.geom)) as lat, b.gallery_hotel FROM hotel as a left join hotel_gallery as b on a.id=b.id";
	if($tipe){
		$query.=" left join hotel_type on a.id_type=hotel_type.id where hotel_type.id= '$tipe'";
	}
	$hasil=mysqli_query($conn,$query);
	while ($row=mysqli_fetch_array($hasil)) {
		  $id=$row['id'];
		  $name=$row['name'];
		  $lat=$row['lat'];
		  $lng=$row['lon'];
		  $img=$row['gallery_hotel'];
		  $dataarray[]=array('id'=>$id,'name'=>$name, 'lng'=>$lng, 'lat'=>$lat, 'img'=>$img);
	}
	echo json_encode ($dataarray);
?>