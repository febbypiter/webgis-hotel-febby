<?php
require '../connect.php';

$cari = $_GET["cari"];

$querysearch	="SELECT tourism.id, tourism.name, tourism.address, tourism.open, tourism.close, tourism.ticket, tourism_type.name as tourism_type, st_x(st_centroid(tourism.geom)) as lon, st_y(st_centroid(tourism.geom)) as lat from tourism left join tourism_type on tourism_type.id=tourism.id_type where tourism.id ='$cari'";			   
$hasil=mysqli_query($conn,$querysearch);
while($baris = mysqli_fetch_array($hasil)){
	  $id=$baris['id'];
	  $name=$baris['name'];
	  $address=$baris['address'];
	  $open=$baris['open'];
	  $close=$baris['close'];
	  $ticket=$baris['ticket'];
	  $tourism_type=$baris['tourism_type'];
	  $longitude=$baris['lon'];
	  $latitude=$baris['lat'];
	  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'open'=>$open, 'close'=>$close,'ticket'=>$ticket,'tourism_type'=>$tourism_type,'longitude'=>$longitude,'latitude'=>$latitude);
}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_tourism FROM tourism_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_hotel=$baris['gallery_hotel'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_hotel'=>$gallery_hotel);
    }

    //DATA FASILITAS
    $query_fasilitas="SELECT facility_tourism.id, facility_tourism.name FROM facility_tourism left join detail_facility_tourism on detail_facility_tourism.id_facility = facility_tourism.id left join tourism on tourism.id = detail_facility_tourism.id_tourism where tourism.id = '".$cari."' "; 
    $hasil3=mysqli_query($conn,$query_fasilitas);
    while($baris = mysqli_fetch_array($hasil3)){
        $id=$baris['id'];
        $name=$baris['name'];
        $data_fasilitas[]=array('id'=>$id,'name'=>$name);
    }

    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery, "fasilitas"=>$data_fasilitas);
    echo json_encode($arr);

//echo json_encode ($dataarray);
?>
