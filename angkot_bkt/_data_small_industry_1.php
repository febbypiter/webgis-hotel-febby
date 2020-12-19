<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT small_industry.id, small_industry.name, small_industry.owner, small_industry.cp, small_industry.address, small_industry.employee, industry_type.name as type_industry, st_x(st_centroid(small_industry.geom)) as lon,st_y(st_centroid(small_industry.geom)) as lat  from small_industry left join industry_type on industry_type.id = small_industry.id_industry_type where small_industry.id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $name=$baris['name'];
          $owner=$baris['owner'];
          $cp=$baris['cp'];
		  $address=$baris['address'];
		  $employee=$baris['employee'];
		  $type_industry=$baris['type_industry'];
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'cp'=>$cp, 'owner'=>$owner, 'employee'=>$employee, 'type_industry'=>$type_industry,'lng'=>$lng,'lat'=>$lat);
	}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_industry FROM industry_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_industry=$baris['gallery_industry'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_industry'=>$gallery_industry);
    }

    //OUTPUT
    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery);
    echo json_encode($arr);


?>
