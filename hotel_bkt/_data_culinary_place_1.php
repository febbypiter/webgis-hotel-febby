<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT id, name, cp, address, capacity, open, close, employee, st_x(st_centroid(geom)) as lon,st_y(st_centroid(geom)) as lat  from culinary_place where id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $name=$baris['name'];
          $cp=$baris['cp'];
		  $address=$baris['address'];
          $capacity=$baris['capacity'];
		  $open=$baris['open'];
		  $close=$baris['close'];
		  $employee=$baris['employee'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'cp'=>$cp, 'capacity'=>$capacity,'open'=>$open,'close'=>$close, 'employee'=>$employee,'lng'=>$lng,'lat'=>$lat);
	}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_culinary FROM culinary_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_culinary=$baris['gallery_culinary'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_culinary'=>$gallery_culinary);
    }

    //OUTPUT
    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery);
    echo json_encode($arr);


?>
