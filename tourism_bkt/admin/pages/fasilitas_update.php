<div class="col-sm-12"> <!-- menampilkan form add facility-->
    <section class="panel">
        <div class="panel-body">
            <a class="btn btn-compose" style='pointer-events:none'>Add Facility</a>
        	<div class="box-body" >
				<?php  if (isset($_GET['id'])){
							$id=$_GET['id'];
							$sql = mysqli_query($conn,"SELECT * FROM facility_tourism where id='".$id."'");
							$data = mysqli_fetch_array($sql)
						?> 
				<form role="form" action="act/fasilitas_update.php" method="post">
					<input type="text" class="form-control hidden" name="id_fasilitas" value="<?php echo $data['id'] ?>">
					<div class="form-group" style="clear:both">
						<label for="nama">Facility</label>
						<input type="text" class="form-control" name="fasilitas" value="<?php echo $data['name'] ?>" required>
					</div>
					<button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>
				</form>
				<?php } ?>
      		</div>
        </div>
    </section>
</div>