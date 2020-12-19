<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT restaurant.id, restaurant.name, restaurant.cp, restaurant.address, restaurant.open, restaurant.close, restaurant.capacity, restaurant.employee, restaurant.mushalla, restaurant.park_area, restaurant.bathroom, restaurant_category.name as type_restaurant, st_x(st_centroid(restaurant.geom)) as lon,st_y(st_centroid(restaurant.geom)) as lat from restaurant left join restaurant_category on restaurant_category.id = restaurant.id_category where restaurant.id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $name=$baris['name'];
          $cp=$baris['cp'];
		  $address=$baris['address'];
          $open=$baris['open'];
		  $close=$baris['close'];
		  $capacity=$baris['capacity'];
		  $employee=$baris['employee'];
		  $mushalla=$baris['mushalla'];
		  $park_area=$baris['park_area'];
		  $bathroom=$baris['bathroom'];
		  $type_restaurant=$baris['type_restaurant'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'cp'=>$cp,'open'=>$open,'close'=>$close,'capacity'=>$capacity,'employee'=>$employee,'mushalla'=>$mushalla,'park_area'=>$park_area,'bathroom'=>$bathroom,'type_restaurant'=>$type_restaurant, 'lng'=>$lng,'lat'=>$lat);
	}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_restaurant FROM restaurant_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_restaurant=$baris['gallery_restaurant'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_restaurant'=>$gallery_restaurant);
    }

    //OUTPUT
    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery);
    echo json_encode($arr);


?>
