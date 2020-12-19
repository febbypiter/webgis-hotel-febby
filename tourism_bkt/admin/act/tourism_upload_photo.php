<?php 
	include ('../../../connect.php');
	$id = $_POST['id'];
	$querysearch="select serial_number from tourism_gallery where id='$id' order by serial_number desc limit 1";


	 $hasil=mysqli_query($conn,$querysearch);
	 $serial_number = 1;
	 while($baris = mysqli_fetch_array($hasil))
	 {
	 	$angka = $baris['serial_number'] + 1;
	 	$serial_number = $angka;
	 }

	$jenis_gambar=$_FILES['image']['type'];
	if(($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg" || $jenis_gambar=="image/gif"  || $jenis_gambar=="image/png") && ($_FILES["image"]["size"] <= 5000000)){
		$sourcename=$_FILES["image"]["name"];
		$name=$sourcename;
		$name=$id.$serial_number.".jpg";
		$filepath="../../../_foto/".$name;
		move_uploaded_file($_FILES["image"]["tmp_name"],$filepath);
		$sql = mysqli_query($conn,"insert into tourism_gallery(serial_number, id, gallery_tourism) values('$serial_number','$id','$name')");
		if($sql){
			header("location:../index.php?page=tourism_detail&id=$id");
		}
	}

	else{
		echo "The Picture Isn't Valid!<br>";
		echo "Go Back To <a href='../index.php?page=tourism_detail&id=$id'></a>";
	}
?>