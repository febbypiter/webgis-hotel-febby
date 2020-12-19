<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT hotel.id, hotel.name, hotel.address, hotel.cp, hotel.ktp, hotel.marriage_book, hotel.mushalla, hotel.star, hotel_type.name as type_hotel, st_x(st_centroid(hotel.geom)) as lon,st_y(st_centroid(hotel.geom)) as lat  from hotel left join hotel_type on hotel_type.id=hotel.id_type where hotel.id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $name=$baris['name'];
		  $address=$baris['address'];
		  $cp=$baris['cp'];
		  $ktp=$baris['ktp'];
		  $marriage_book=$baris['marriage_book'];
		  $mushalla=$baris['mushalla'];
		  $star=$baris['star'];	
		  $type_hotel=$baris['type_hotel'];	
		  $lat=$baris['lat'];
		  $lng=$baris['lon'];
		  $dataarray[]=array('id'=>$id,'name'=>$name,'address'=>$address,'cp'=>$cp, 'ktp'=>$ktp, 'marriage_book'=>$marriage_book, 'mushalla'=>$mushalla, 'star'=>$star, 'type_hotel'=>$type_hotel,'lng'=>$lng,'lat'=>$lat);
	}

	//DATA GALLERY
    $query_gallery="SELECT serial_number, gallery_hotel FROM hotel_gallery where id = '".$cari."' "; 
    $hasil2=mysqli_query($conn,$query_gallery);
    while($baris = mysqli_fetch_array($hasil2)){
        $serial_number=$baris['serial_number'];
        $gallery_hotel=$baris['gallery_hotel'];
        $data_gallery[]=array('serial_number'=>$serial_number,'gallery_hotel'=>$gallery_hotel);
    }

    //DATA FASILITAS
    $query_fasilitas="SELECT facility_hotel.id, facility_hotel.name FROM facility_hotel left join detail_facility_hotel on detail_facility_hotel.id_facility = facility_hotel.id left join hotel on hotel.id = detail_facility_hotel.id_hotel where hotel.id = '".$cari."' "; 
    $hasil3=mysqli_query($conn,$query_fasilitas);
    while($baris = mysqli_fetch_array($hasil3)){
        $id=$baris['id'];
        $name=$baris['name'];
        $data_fasilitas[]=array('id'=>$id,'name'=>$name);
    }

    //DATA KAMAR
    $query_kamar="SELECT room.id, room.name, room.price FROM room left join detail_room on detail_room.id_room = room.id left join hotel on hotel.id = detail_room.id_hotel where hotel.id = '".$cari."' "; 
    $hasil4=mysqli_query($conn,$query_kamar);
    while($baris = mysqli_fetch_array($hasil4)){
        $id=$baris['id'];
        $name=$baris['name'];
        $price=$baris['price'];
        $data_kamar[]=array('id'=>$id,'name'=>$name,'price'=>$price);
    }

    //OUTPUT
    $arr=array("data"=>$dataarray, "gallery"=>$data_gallery, "fasilitas"=>$data_fasilitas, "kamar"=>$data_kamar);
    echo json_encode($arr);


?>
