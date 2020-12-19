<?php
require '../../connect.php';
$id = $_GET["id"];
//echo "woiiiiiiiiiiiiiiiiiiiii $id";
//DATA TOURISM
$query = "SELECT tourism.id, tourism.name, tourism.address, tourism.open, tourism.close, tourism.ticket, tourism_type.name as tourism_type, st_x(st_centroid(tourism.geom)) as lon, st_y(st_centroid(tourism.geom)) as lat from tourism left join tourism_type on tourism_type.id=tourism.id_type where tourism.id ='$id'";
$hasil=mysqli_query($conn,$query);
while($baris = mysqli_fetch_array($hasil)){
  $id=$baris['id'];
  $name=$baris['name'];
  $address=$baris['address'];
  $open=$baris['open'];
  $close=$baris['close'];
  $ticket=$baris['ticket'];
  $tourism_type=$baris['tourism_type'];
  $lng=$baris['lon'];
  $lat=$baris['lat'];
  if ($lat=='' || $lng==''){
    $lat='<span style="color:red">Kosong</span>';
    $lng='<span style="color:red">Kosong</span>';
  }
}

//DATA FASILITAS
$facility;
$query_fasilitas="SELECT facility_tourism.id, facility_tourism.name FROM facility_tourism left join detail_facility_tourism on detail_facility_tourism.id_facility = facility_tourism.id left join tourism on tourism.id = detail_facility_tourism.id_tourism where tourism.id = '".$id."' "; 
$hasil3=mysqli_query($conn,$query_fasilitas);
while($baris = mysqli_fetch_array($hasil3)){
    $abc=$baris['name'];
    $facility=$facility."<li>".$abc."</li>";
}
?>

<div class="col-sm-12">
	<div class="col-sm-6"> 
	  	<section class="panel">
	      	<header class="panel-heading">
				<h2 class="box-title" style="text-transform:capitalize;"><b> <?php echo $name ?></b></h2>
	        </header>

	        <div class="panel-body">
				<table>
					<tbody  style='vertical-align:top;'>
						<tr><td width="150px"><b>Address</b></td><td> :&nbsp; </td><td style='text-transform:capitalize;'><?php echo $address ?></td></tr>
						<tr><td><b>Open</b></td><td>:</td><td><?php echo $open ?></td></tr>
						<tr><td><b>Close</b></td> <td> :</td><td><?php echo $close ?></td></tr>
						<tr><td><b>Ticket<b> </td><td>: </td><td><?php echo $ticket ?></td></tr>
						<tr><td><b>Type<b> </td><td>: </td><td><?php echo $tourism_type ?></td></tr>
						<tr><td><b>Koordinat<b> </td><td>: </td><td><b>Latitude</b> : <?php echo $lat ?> <br><b>Longitude</b> : <?php echo $lng ?></td></tr>
						<tr><td><b>Fasility<b> </td><td>: </td><td><?php echo $facility ?></td></tr>
						<tr><td><a href="?page=formsetF&id=<?php echo $id ?>" class="btn btn-round btn-warning"><i class="fa fa-edit"></i> Set Facility</a></td></tr></tr>
						<tr><td><br></td></tr>
					</tbody>					
				</table>

				<div class="btn-group">
					<a href="?page=tourism_update&id=<?php echo $id ?>" class="btn btn-default"><i class="fa fa-edit"></i>&nbsp Edit Data</a>
					<a class='btn btn-round' role=button' data-toggle='collapse' href='#info' onclick='' title='Nearby' aria-controls='Nearby'><i class='fa fa-plus' style='color:black;'></i><label>&nbsp Add Info</label>
                            </a>
				</div>

				<div class='collapse' id='info'>
					<form method="post" action="act/addinfo.php">
						<input type="text" class="form-control hidden " id="id" name="id" value="<?php echo $id ?>">
						<input type="text" class="form-control hidden " id="username" name="username" value="<?php echo $username ?>">
						<table class="table">
							<tbody  style='vertical-align:top;'>
								<tr><td><b>Essential Information :</td><td><textarea cols="40" rows="5" name="info"></textarea></td></tr>
		                        <tr><td><input type="submit" value="Post Information"/></td><td></td></tr>

								
							</tbody>					
						</table>

					</form>
		     	</div>
		     	 <?php 
                     
                      $id = $_GET["id"];
                      //echo "ini $id";

                      if(strpos($id,"H") !== false){
                        $sqlreview = "SELECT * from information_admin where id_hotel = '$id'";
                      }elseif (strpos($id,"RM") !== false) {
                        $sqlreview = "SELECT * from information_admin where id_kuliner = '$id'";
                      }elseif (strpos($id, "SO") !== false) {
                        $sqlreview = "SELECT * from information_admin where id_souvenir = '$id'";
                      }elseif (strpos($id,"IK") !== false) {
                         $sqlreview = "SELECT * from information_admin where id_ik = '$id'";
                      }elseif (strpos($id,"tw")!== false) {
                         $sqlreview = "SELECT * from information_admin where id_ow = '$id'";
                      }
                        
                      $result = mysqli_query($conn,$sqlreview);
                    ?>
                    <table class="table">
                    	<thead><th>Tanggal</th><th class="centered">Info</th><th>action</th></thead>
                    <?php  
                      while ($rows = mysqli_fetch_array($result)) 
                        {
                          $tgl = $rows['tanggal'];
                          $info = $rows['informasi'];
                          $id_info =$rows['id_informasi'];
                          echo "<tr><td>$tgl</td><td>$info</td><td><a href='act/info_delete.php?id_informasi=$id_info' class='btn btn-sm btn-default' title='Delete'><i class='fa fa-trash-o'></i></a></td></tr>";
                        }
                    

                       ?>               
                    
                  </table>
	      </div>
		</section>
	</div>
	
	<div class="col-sm-6"> <!-- menampilkan peta-->
		<div class"row">
			<div class="col-sm-12"> <!-- menampilkan peta-->
			    <section class="panel">
				    <header class="panel-heading">
				        <h3> Picture of <?php echo $name ?></h3>
			        </header>
			  
			        <div class="panel-body">
                        <div class="html5gallery" style="max-height:700px;overflow:auto;" data-skin="horizontal" data-width="350" data-height="200" data-resizemode="fit">  
				    	<?php
							$id=$_GET['id'];
							$querysearch="SELECT gallery_tourism FROM tourism_gallery where id='$id'";
							$hasil=mysqli_query($conn,$querysearch);			 
							$xx = 0;
					     	while($baris = mysqli_fetch_array($hasil)){
				     			$nilai=$baris['gallery_tourism'];
				     			$xx++;
					 	?>
							<image src="../../_foto/<?php echo $nilai; ?>" style="width:10%;">
							<!--image src="../foto/tw002_a.jpg" style="width:10%;"-->
						<?php
				    		}
				    		if($xx==0){
						?>
							<image src="../../_foto/no.png" style="width:10%;">
						<?php
				    		}
				    		echo "nilai foto $nilai";
						?>
						</div>
			        </div>				  					  
			    </section>
			</div>

			<div class="col-sm-12"> <!-- menampilkan peta-->
			  	<section class="panel">
			      	<header class="panel-heading">
			          <h3>Upload Picture of <?php echo $name ?></h3>
				    </header>
			        
			        <div class="panel-body">
						<form role="form" action="act/tourism_upload_photo.php" enctype="multipart/form-data" method="post">
				  			<div class="box-body">
								<input type="text" class="form-control hidden" name="id" value="<?php echo $id ?>">
								<div class="form-group">
					 			<input type="file" class="" style="background:none;border:none;" name="image" required>
								</div>
								<span style="color:red;">*Maximum image size 500kb</span>
				  			</div><!-- /.box-body -->

							<div class="box-footer">
								<button type="submit" class="btn btn-primary"><i class="fa fa-upload"></i> Upload</button>
						    </div>
						</form>
			        </div>			  
			  	</section>
			</div>
		</div>
	</div>

</div>		 
              