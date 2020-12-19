<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT souvenir.id, souvenir.name, souvenir.owner, souvenir.cp, souvenir.address, souvenir.employee, souvenir_type.name as type_souvenir, st_x(st_centroid(souvenir.geom)) as lon,st_y(st_centroid(souvenir.geom)) as lat from souvenir left join souvenir_type on souvenir_type.id = souvenir.id_souvenir_type where souvenir.id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $name=$baris['name'];
          $owner=$baris['owner'];
          $cp=$baris['cp'];
		  $address=$baris['address'];
		  $employee=$baris['employee'];
		  $type_souvenir=$baris['type_souvenir'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'owner'=>$owner,'address'=>$address,'cp'=>$cp, 'employee'=>$employee,'type_souvenir'=>$type_souvenir, 'lng'=>$lng,'lat'=>$lat);
	}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_souvenir FROM souvenir_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_souvenir=$baris['gallery_souvenir'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_souvenir'=>$gallery_souvenir);
    }

    //OUTPUT
    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery);
    echo json_encode($arr);


?>
