<?php
include ('../../../connect.php');
$id = $_GET['id'];
	$sql1 = mysqli_query($conn,"Delete from tourism_gallery where id ='$id'");
	$sql2 = mysqli_query($conn,"Delete from detail_facility_tourism where id_tourism = '$id'");
	$sql   = "delete from tourism where id='$id'";

	
	$delete = mysqli_query($conn,$sql);
	if ($delete){
		echo "<script>
		alert (' Data Successfully Delete');
		</script>";
	}
	else{
		echo "<script>
		alert ('Error');
		</script>";
	}

echo "<script>
eval(\"parent.location='../?page=home'\");
</script>";

?>