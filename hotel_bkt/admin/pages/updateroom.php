<div class="col-sm-12"> <!-- menampilkan form add facility-->
        <section class="panel">
                    <div class="panel-body">

                       <h2 style="text-transform:capitalize;">Update Room <?php echo $data1['name'] ?></h2>

        <?php  if (isset($_GET['id'])){
					$id=$_GET['id'];
					$sql = mysqli_query($conn,"SELECT * FROM room where id=$id");
					$data = mysqli_fetch_array($sql)
				?> 

		<form role="form" action="act/updateroomhotel.php" method="post">
					<button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>
					<input type="text" class="form-control hidden" name="id_room" value="<?php echo $data['id'] ?>">
					<div class="form-group" style="clear:both">
						
						<input type="text" class="form-control" name="name_room" value="<?php echo $data['name'] ?>" required>
						<input type="text" class="form-control" name="price_room" value="<?php echo $data['price'] ?>" required>
					</div>
				</form>
				<?php } ?>
				
                  </div>
                    </div>
                </section>
                 </div>