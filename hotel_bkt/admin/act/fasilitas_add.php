<?php
include ('../../../connect.php');

$query = mysqli_query($conn,"SELECT MAX(id) AS id FROM facility_hotel");
$result = mysqli_fetch_array($query);
$idmax = $result['id'];
if ($idmax==null) {$idmax=1;}
else {$idmax++;}

$fasilitas = $_POST['fasilitas'];
$count = count($fasilitas);
$sql  = "insert into facility_hotel (id, name) VALUES "; 

for( $i=0; $i < $count; $i++ ){
	$sql .= "('{$idmax}','{$fasilitas[$i]}')";
	$sql .= ",";
	$idmax++;
}
$sql = rtrim($sql,",");
$insert = mysqli_query($conn,$sql);

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
	eval(\"parent.location='../index.php?page=fasilitas '\");	
	</script>";
?>