<?php
include ('../../../connect.php');

$nama = $_POST['nama'];
	$periode = $_POST['periode'];
	$alamat = $_POST['alamat'];
	$no_hp = $_POST['no_hp'];
	$role = $_POST['role'];
	$id = $_POST['id'];
	$user = $_POST['username'];
	$password = $_POST['password'];
	$pass = md5(md5($password));
	$sql = mysqli_query($conn,"INSERT into admin (name, stewardship_period, address, hp, role, username, password) values ('$nama',  '$periode', '$alamat', '$no_hp','$role', '$user', '$pass')");
	if($sql){ 
		for($i=0;$i<count($_POST['id']);$i++){ 
			$id = $_POST['id'][$i]; 
			$update = mysqli_query($conn,"UPDATE hotel set username='$user' where id = '$id'"); 
			$update2 = mysqli_query($conn,"UPDATE tourism set username='$user' where id = '$id'"); 
			$update3 = mysqli_query($conn,"UPDATE souvenir set username='$user' where id = '$id'"); 
			$update4 = mysqli_query($conn,"UPDATE culinary_place set username='$user' where id = '$id'"); 
			$update5 = mysqli_query($conn,"UPDATE small_industry set username='$user' where id = '$id'"); 
 
		} 
	} 

if ($sql){
	echo "<script>
	alert ('Data Successfully Added');
	</script>";
}else{
	echo "<script>
	alert ('Error');
	</script>";
}

	echo "<script>
	eval(\"parent.location='../index.php?page=user_management '\");	
	</script>";
?>