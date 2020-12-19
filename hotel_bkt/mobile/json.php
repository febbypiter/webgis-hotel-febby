<?php
	
	//header('content-type: application/json');
	header('content-type: application/json; charset=utf8');
	header("access-control-allow-origin: *");
	include "../../connect.php";
	$query = file_get_contents("php://input");
    $sth = mysqli_query($conn,$query);
	$items = array();
	while($row = mysqli_fetch_assoc($sth)){
		$items[] = $row;
	}
	print json_encode($items);
?>
