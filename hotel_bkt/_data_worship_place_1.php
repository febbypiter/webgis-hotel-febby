<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT worship_place.id, worship_place.name, worship_place.address, worship_place.land_size, worship_place.park_area_size, worship_place.building_size, worship_place.capacity, worship_place.est, worship_place.last_renovation, worship_place.jamaah, worship_place.imam, worship_place.teenager, category_worship_place.name as category, st_x(st_centroid(worship_place.geom)) as lon,st_y(st_centroid(worship_place.geom)) as lat  from worship_place left join category_worship_place on category_worship_place.id = worship_place.id_category where worship_place.id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $name=$baris['name'];
		  $address=$baris['address'];
          $land_size=$baris['land_size'];
		  $park_area_size=$baris['park_area_size'];
		  $building_size=$baris['building_size'];
		  $capacity=$baris['capacity'];
		  $est=$baris['est'];
		  $last_renovation=$baris['last_renovation'];
		  $jamaah=$baris['jamaah'];
		  $imam=$baris['imam'];
		  $teenager=$baris['teenager'];
		  $category=$baris['category'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'land_size'=>$land_size, 'park_area_size'=>$park_area_size,'building_size'=>$building_size,'capacity'=>$capacity, 'est'=>$est, 'last_renovation'=>$last_renovation, 'jamaah'=>$jamaah, 'imam'=>$imam, 'teenager'=>$teenager, 'category'=>$category,'lng'=>$lng,'lat'=>$lat);
	}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_worship_place FROM worship_place_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_worship_place=$baris['gallery_worship_place'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_worship_place'=>$gallery_worship_place);
    }

    //OUTPUT
    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery);
    echo json_encode($arr);


?>
