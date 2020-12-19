<?php
require '../connect.php';

$cari = $_GET["cari"];	//ID

	//DATA HOTEL & TIPE HOTEL
	$querysearch	="SELECT angkot.id, angkot.destination, angkot.track, angkot.cost, angkot.number, angkot_color.color from angkot left join angkot_color on angkot.id_color = angkot_color.id where angkot.id='$cari'";   
	$hasil=mysqli_query($conn,$querysearch);
	while($baris = mysqli_fetch_array($hasil)){
		  $id=$baris['id'];
		  $destination=$baris['destination'];
          $track=$baris['track'];
          $cost=$baris['cost'];
		  $number=$baris['number'];
		  $color=$baris['color'];
		  $dataarray[]=array('id'=>$id,'destination'=>$destination,'track'=>$track,'cost'=>$cost,'number'=>$number, 'color'=>$color);
	}

    //OUTPUT
    $arr=array("data"=>$dataarray);
    echo json_encode($arr);


?>
