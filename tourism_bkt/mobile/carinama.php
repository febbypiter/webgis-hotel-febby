
<?php
require '../../connect.php';

$cari_nama = $_GET["cari_nama"];
 

$querysearch	=" 	SELECT distinct a.id,a.name,a.address,ST_X(ST_Centroid(a.geom)) AS longitude, ST_Y(ST_CENTROID(a.geom)) As latitude	FROM tourism as a where upper(a.name) like upper('%$cari_nama%')";
			   
$hasil=mysqli_query($conn,$querysearch);
while($row = mysqli_fetch_array($hasil))
    {
          $id=$row['id'];
          $name=$row['name'];
          $address=$row['address'];
          $longitude=$row['longitude'];
          $latitude=$row['latitude'];
          $dataarray[]=array('id'=>$id, 'name'=>$name, 'address'=>$address, 'longitude'=>$longitude,'latitude'=>$latitude);
    }
echo json_encode ($dataarray);
?>