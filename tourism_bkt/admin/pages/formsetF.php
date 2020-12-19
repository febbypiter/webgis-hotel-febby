<?php if (isset($_GET['id'])){
	$id_tourism=$_GET['id'];
	//$id_culinary=$_GET['id_culinary'];
	//echo $id_tourism;
?>
<section id="container" >
<div class="col-sm-12">
<section class="panel">
	<header class="panel-heading">
		<h2 class="box-title" style="text-transform:capitalize;"><b>Facility List <?php echo $data1['name']; ?></b></h2>
	</header>
	<form class="" role="form" action="act/updatefasilitastourism.php" method="post">
	<div class="row" style="clear:both;">
	<div class="col-sm-6">
		<button type="submit" class="btn btn-primary" style="float:right"><i class="fa fa-floppy-o"></i> Save</button>
		<div class="box">
			<div class="box-body">
			
				<div class="">
					<input type="text" class="form-control hidden" id="id_tourism" name="id_tourism" value="<?php echo $id_tourism ?>">
						
						<table class="table table-hover table-bordered table-striped">
						<thead><th>Choose</th><th>Facility</th></thead>
						<tbody>
						
						<tr>

						</tr>
							<?php
								$sql2 = mysqli_query($conn,"SELECT * from facility_tourism order by name");
								while($dt = mysqli_fetch_array($sql2))
								{ ?> <tr> <?php
									$sql3 = mysqli_query($conn,"SELECT * FROM detail_facility_tourism where id_tourism='$id_tourism' and id_facility='$dt[id]'");
									$data3 = mysqli_fetch_array($sql3);
									if ($dt['id']==$data3['id_facility']){
										echo "<td><input name='facility_tourism[]' value=\"$dt[id]\" type='checkbox' style='width:25px' onClick='enable(this)' checked=\"\"></td><td>$dt[name]</td>";
										
									}else{
										echo "<td><input name='facility_tourism[]' value=\"$dt[id]\" type='checkbox' onClick='enable(this)' style='width:25px'></td><td>$dt[name]</td>";
										
									}
								
							?> </tr>
							<?php } ?>
						</tbody>
						</table>

				</div>
			</div>
		</div><!-- /.box -->
	</div><!-- /.col -->
	</div>
	</form>
</section>
</div>
</section>

<?php } ?>

<!-- </div>
</div>
</div> -->
