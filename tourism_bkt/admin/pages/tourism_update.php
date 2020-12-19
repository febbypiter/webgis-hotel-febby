<div class="col-sm-6"> <!-- menampilkan peta-->
  <section class="panel">
    <header class="panel-heading">
      <h3>                    
        <input id="latlng" type="text" class="form-control" style="width:200px" value="" placeholder="Latitude, Longitude">
          <button class="btn btn-default my-btn" id="btnlatlng" type="button" title="Geocode"><i class="fa fa-search"></i></button>
          <button class="btn btn-default my-btn" id="delete-button" type="button" title="Remove shape"><i class="fa fa-trash"></i></button>
      </h3>              
    </header>
      
    <div class="panel-body">
      <div id="map" style="width:100%;height:420px; z-index:50"></div>
    </div>
  </section>
</div>
			  
<div class="col-sm-6"> <!-- menampilkan form add mosque-->
  <section class="panel">
    <div class="panel-body">
      <a class="btn btn-compose">Update Information</a>
      <div class="box-body">
        <div class="form-group" id="hasilcari1">
				  <?php if (isset($_GET['id'])){
    	 			$id=$_GET['id'];
    				$sql = mysqli_query($conn,"SELECT id, name, address, open, close, ST_AsText(geom) as geom, id_type, ticket FROM tourism where id='$id'");
    				$data =  mysqli_fetch_array($sql);
    			?>
          <form role="form" action="act/tourism_update.php" enctype="multipart/form-data" method="post">                        
            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $id ?>">
            <div class="form-group">
              <label for="geom">Koordinat</label>
              <textarea class="form-control" id="geom" name="geom" readonly><?php echo $data['geom'] ?></textarea>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="<?php echo $data['name'] ?>">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address" value="<?php echo $data['address'] ?>">
            </div>
            <div class="form-group">
              <label for="open">Open</label>
              <!--input type="text" class="form-control" name="open" value="<?php echo $dataopen ?>" -->
              <input type="time" class="form-control" name="open" value="<?php echo $data['open'] ?>" >
            </div>
            <div class="form-group">
              <label for="close">Close</label>
              <!--input type="text" class="form-control" name="close" value="<?php echo $dataclose ?>" -->
              <input type="time" class="form-control" name="close" value="<?php echo $data['close'] ?>" >
            </div>
            <div class="form-group">
              <label for="ticket">Ticket</label>
              <input type="text" class="form-control" name="ticket" value="<?php echo $data['ticket'] ?>">
            </div>
            <div class="form-group">
              <label for="type">Type</label>
              <select name="type" id="type" class="form-control">
                <?php                 
                  $kategori=mysqli_query($conn,"select * from tourism_type ");
                  while($rowkategori = mysqli_fetch_assoc($kategori)){
      				      if ($data[id_type]==$rowkategori[id]){
    									echo "<option value=\"$rowkategori[id]\" selected>$rowkategori[name]</option>";}
      								else{
    									echo "<option value=\"$rowkategori[id]\">$rowkategori[name]</option>";}
    								} 
                  }
                ?>                  
              </select>
            </div>  
            <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>   
          </form> 
        </div><!-- Form Group -->
      </div><!-- Box Body -->                   
    </div><!-- Panel Body --> 
  </section>
</div>
<script src="inc/mapupd.js" type="text/javascript"></script>