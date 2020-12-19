<?php
include ('../../../connect.php');
$id_room = $_GET['id_room'];
$id_hotel = $_POST['id_hotel2'];
echo $id_hotel;

	$sql1   = "DELETE from detail_room where id_room=$id_room";
	$sql   = "delete from room where id=$id_room";
	
	$delete1 = mysqli_query($conn,$sql1);
	if ($delete1){
	echo "<script>
		alert (' Data Successfully Delete');
		eval(\"parent.location='../?page=home'\");
		</script>";
	}
	else{
		echo 'error';

	}
	
	$delete = mysqli_query($conn,$sql);
	if ($delete){
			echo "<script>
		alert (' Data Successfully Delete');
		eval(\"parent.location='../?page=home'\");
		</script>";
	}
	else{
		echo 'error';

	}

?>