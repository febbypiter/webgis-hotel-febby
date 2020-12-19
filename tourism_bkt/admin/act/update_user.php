<?php
include ('../../../connect.php');

//$id = $_POST['id'];
$stewardship_period = $_POST['stewardship_period'];
$id_hotel = $_POST['aset'];
$nama = $_POST['nama'];
$password = $_POST['password'];
$pass = md5(md5($password));
$role = $_POST['role'];
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$periode = $_POST['periode'];
$username = $_POST['username'];
$aset = $_POST['aset'];
//echo "username $username, $nama,$role";

$sql  = "UPDATE admin set name='$nama', password='$pass', role='$role', hp='$no_hp', address='$alamat', stewardship_period='$periode', username='$username' where username='$username'";

$updateKuliner = mysqli_query($conn,"UPDATE culinary_place set username=null where username='$username'"); 
$updateSouvenir = mysqli_query($conn,"UPDATE souvenir set username=null where username='$username'"); 
$updateSmallIndustry = mysqli_query($conn,"UPDATE small_industry set username=null where username='$username'"); 
$updateHotel = mysqli_query($conn,"UPDATE hotel set username=null where username='$username'"); 
$updateTourism = mysqli_query($conn,"UPDATE tourism set username=null where username='$username'");


$insert = mysqli_query($conn,$sql);
if($insert){
	for($i=0;$i<count($_POST['aset']);$i++){ 
		//echo"ini username $username";
		$id = $_POST['aset'][$i]; 
		//echo "ini id $id";
		$updateKuliner = mysqli_query($conn,"UPDATE culinary_place set username='$username' where id = '$id'"); 
		$updateSouvenir = mysqli_query($conn,"UPDATE souvenir set username='$username' where id = '$id'"); 
		$updateSmallIndustry = mysqli_query($conn,"UPDATE small_industry set username='$username' where id = '$id'"); 
		$updateHotel = mysqli_query($conn,"UPDATE hotel set username='$username' where id = '$id'"); 
		$updateTourism = mysqli_query($conn,"UPDATE tourism set username='$username' where id = '$id'"); 
	} 
}

if ($insert)
	{
	echo "<script>alert ('Data Successfully Change');</script>";
	}
else
	{
	echo "<script>alert ('Error');</script>";
	}
	echo "<script>
		eval(\"parent.location='../?page=user_management'\");
		</script>";
?>