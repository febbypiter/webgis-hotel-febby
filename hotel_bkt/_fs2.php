<?php
require '../connect.php';
$category=$_GET['category'];	//kategori tempat ibadah sekitar
$fas=$_GET['fas'];				//fasilitas hotel
$tipe=$_GET['tipe'];			//tipe hotel

$querysearch	="SELECT DISTINCT hotel.id as id, hotel.name as name, st_x(st_centroid(hotel.geom)) as lon, st_y(st_centroid(hotel.geom)) as lat from hotel left join detail_room on hotel.id = detail_room.id_hotel left join detail_facility_hotel on detail_facility_hotel.id_hotel = hotel.id left join facility_hotel on detail_facility_hotel.id_facility = facility_hotel.id left join hotel_type on hotel.id_type=hotel_type.id, worship_place left join category_worship_place on worship_place.id_category=category_worship_place.id where category_worship_place.id = $category and st_distance_sphere(ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(hotel.geom)),' ',ST_X(ST_Centroid(hotel.geom)),')'), 4326), ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(worship_place.geom)),' ',ST_X(ST_Centroid(worship_place.geom)),')'), 4326)) <= 300 and facility_hotel.id in ($fas) and hotel_type.id = '$tipe'";

$hasil=mysqli_query($conn, $querysearch);
while($baris = mysqli_fetch_array($hasil))
	{
		  $query="SELECT worship_place.id as id2, st_x(st_centroid(worship_place.geom)) as lon2, st_y(st_centroid(worship_place.geom)) as lat2 from hotel, worship_place where st_distance_sphere(ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(hotel.geom)),' ',ST_X(ST_Centroid(hotel.geom)),')'), 4326), ST_GeomFromText(concat('POINT(',ST_Y(ST_CENTROID(worship_place.geom)),' ',ST_X(ST_Centroid(worship_place.geom)),')'), 4326)) <= 300 and hotel.id='".$baris['id']."'";
		$id=$baris['id'];
		$name=$baris['name'];
		$lat=$baris['lat'];
		$lng=$baris['lon'];
		$res=mysqli_query($conn, $query);
		while($row=mysqli_fetch_array($res)){
			$id2=$row['id2'];
			$lat2=$row['lat2'];
			$lng2=$row['lon2'];
		}
		$dataarray[]=array('id'=>$id,'name'=>$name, 'id2'=>$id2,'name2'=>$name2,'lng'=>$lng, 'lat'=>$lat, 'lng2'=>$lng2, 'lat2'=>$lat2);
	}
echo json_encode ($dataarray);
// echo $querysearch;
?>