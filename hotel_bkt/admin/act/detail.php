<?php 
include ('../../connect.php');
session_start();
$id = $_GET["id"];
$id_hotel = $_SESSION['id'];
$username = $_SESSION['username'];
// echo "$id --> id <br>";
// echo "$id_hotel --> id_hotel " ;
// echo "$username --> username " ;


	//DATA HOTEL & TIPE HOTEL
$query = "SELECT hotel.id, hotel.name, hotel.address, hotel.cp, hotel.ktp, hotel.marriage_book, hotel.mushalla, hotel.star, hotel_type.name as type_hotel, st_x(st_centroid(hotel.geom)) as lon,st_y(st_centroid(hotel.geom)) as lat, admin.username, admin.name as nama_admin  from hotel left join hotel_type on hotel_type.id=hotel.id_type join admin on admin.username = hotel.username where hotel.username='$username'";
$hasil=mysqli_query($conn,$query);
while($baris = mysqli_fetch_array($hasil)){
  $id=$baris['id'];
  $name=$baris['name'];
  $address=$baris['address'];
  $cp=$baris['cp'];
  $ktp=$baris['ktp'];
  $marriage_book=$baris['marriage_book'];
  $mushalla=$baris['mushalla'];
  $tourism_type=$baris['type_hotel'];
  $lng=$baris['lon'];
  $lat=$baris['lat'];

  if ($lat=='' || $lng==''){
    $lat='<span style="color:red">Kosong</span>';
    $lng='<span style="color:red">Kosong</span>';
  }
}

    $syarat="-";
    if ($ktp == 1 && $marriage_book == 1) {
      $syarat = "KTP & Buku Nikah";
    }
    else if ($ktp == 1) {
      $syarat = "KTP";
    } else if ($marriage_book == 1) {
      $syarat = "Buku Nikah";
    }

    $mushalla_stat = "-";
    if ($mushalla == 1) {
      $mushalla_stat = "Ada Mushalla";
    };

//DATA FASILITAS
$facility;
$query_fasilitas="SELECT facility_hotel.id, facility_hotel.name FROM facility_hotel left join detail_facility_hotel on detail_facility_hotel.id_facility = facility_hotel.id left join hotel on hotel.id = detail_facility_hotel.id_hotel where hotel.id = '".$id."' "; 
$hasil3=mysqli_query($conn,$query_fasilitas);
while($baris = mysqli_fetch_array($hasil3)){
    $abc=$baris['name'];
    $facility=$facility."<li>".$abc."</li>";
}


//DATA KAMAR
$room;
$query_kamar="SELECT room.id, room.name, room.price FROM room left join detail_room on detail_room.id_room = room.id left join hotel on hotel.id = detail_room.id_hotel where hotel.id = '".$cari."' "; 
$hasil4=mysqli_query($conn,$query_kamar);
while($baris = mysqli_fetch_array($hasil4)){
    $name=$baris['name'];
    $price=$baris['price'];
    $abc=$name." - ".$price;
    $room=$room."<li>".$abc."</li>";
}

?>

