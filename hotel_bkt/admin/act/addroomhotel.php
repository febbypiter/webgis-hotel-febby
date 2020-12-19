<?php
include ('../../../connect.php');
$id = $_POST['id_hotel'];
$query = mysqli_query($conn,"SELECT MAX(id) AS id FROM room");
$result = mysqli_fetch_array($query);
$idmax = $result['id'];
if ($idmax==null) {$idmax=1;}
else {$idmax++;}
$idmax2 = $idmax;
$room = $_POST['room'];
$price = $_POST['roomprice'];

$count = count($room);
$sql  = "insert into room (id, name, price) VALUES ";
 
for( $i=0; $i < $count; $i++ ){
	$sql .= "('{$idmax}','{$room[$i]}','{$price[$i]}')";
	$sql .= ",";
	$idmax++;
}
$sql = rtrim($sql,",");
$insert = mysqli_query($conn,$sql);

$sql2 = "insert into detail_room (id_room, id_hotel) VALUES ";
for( $x=0; $x< $count; $x++ ){
	$sql2 .= "('{$idmax2}','{$id}')";
	$sql2 .= ",";
	$idmax2++;
}
$sql2 = rtrim($sql2,",");
$insert2 = mysqli_query($conn,$sql2);


if ($sql && $sql2){
		echo "<script>
		alert (' Data Successfully Added');
		eval(\"parent.location='../index.php?page=formsetR&id=$id '\");	
		</script>";
}else{
	echo 'error';
}


?>