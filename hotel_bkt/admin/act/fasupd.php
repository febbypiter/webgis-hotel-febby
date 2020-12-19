<?php
include ('../../../connect.php');
$id = $_POST['id'];
$id_fasilitas = $_POST['id_fasilitas'];
$fasilitas = $_POST['fasilitas'];

$sqldel = "delete from detail_facility where id_worship_place='$id'";
$delete = mysqli_query($conn,$sqldel);

$countl = count($fasilitas);
$sqll   = "insert into detail_facility (id_worship_place, id_facility) VALUES ";
for( $i=0; $i < $countl; $i++ ){
	$sqll .= "('{$id}','{$fasilitas[$i]}')";
	$sqll .= ",";
}
$sqll = rtrim($sqll,",");
$insert = mysqli_query($conn,$sqll);
if ($insert && $delete){
	echo "<script>
		alert (' Data Successfully Change');
		</script>";
	header("location:../index1.php?page=content&id=$id");
}
else{
	echo "<script>
		alert (' Error');
		</script>";
	header("location:../index1.php?page=formfasupd&id=$id");
}

?>