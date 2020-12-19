<?php
include ('../../../connect.php');
$id = $_GET['id'];
echo $id;
	
	$sql   = "DELETE from admin where username='$id'";
	$sql1 = "UPDATE hotel set username = null where username='$id'";
	$sql2 = "UPDATE tourism set username = null where username='$id'";
	$sql3 = "UPDATE souvenir set username = null where username='$id'";
	$sql4 = "UPDATE culinary_place set username = null where username='$id'";
	$sql5 = "UPDATE small_industry set username = null where username='$id'";	
	
	$delete1 = mysqli_query($conn,$sql1);
	$delete2= mysqli_query($conn,$sql2);
	$delete3 = mysqli_query($conn,$sql3);
	$delete4 = mysqli_query($conn,$sql4);
	$delete5 = mysqli_query($conn,$sql5);
	$delete = mysqli_query($conn,$sql);
	if ($delete){
		echo "<script>alert ('Data Successfully Delete');</script>";
	}
	else{
		echo "<script>alert ('Error');</script>";
	}

	echo "<script>eval(\"parent.location='../?page=user_management'\");</script>";
?>