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
      <a class="btn btn-compose">Add Information</a>
      <div class="box-body">
        <div class="form-group" id="hasilcari1">
          <form role="form" action="act/hotel_add.php" enctype="multipart/form-data" method="post">
             <?php
            $query = mysqli_query($conn,"SELECT MAX(id) AS id FROM hotel");
            $result = mysqli_fetch_array($query);
            $idmax = $result['id'];
              if ($idmax==null) 
                {$idmax=1;}
              else 
                {
                  $idmax++;
                }
                
          ?>
            <input type="text" class="form-control hidden" id="id" name="id" value="<?php echo $idmax ?>">
            
            <div class="form-group">

              <label for="geom">Koordinat</label>
              <textarea class="form-control" id="geom" name="geom" readonly></textarea>
            </div>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name" value="">
            </div>
            <div class="form-group">
              <label for="address">Address</label>
              <input type="text" class="form-control" name="address" value="">
            </div>
            <div class="form-group">
              <label for="address">Cp</label>
              <input type="text" class="form-control" name="cp" value="">
            </div>
            <div class="form-group">
              <label for="type">Type</label>
              <select name="type" id="type" class="form-control">
                <?php                 
                  $kategori=mysqli_query($conn,"select * from hotel_type ");
                  while($rowkategori = mysqli_fetch_assoc($kategori)){
                    echo "<option value=\"$rowkategori[id]\">$rowkategori[name]</option>";
                  }
                ?>                  
              </select>
            </div>
            <div class="form-group">
              <label for="type">Mushalla</label>
              <select name="mushalla" id="mushalla" class="form-control">        
                <option value="1">Ada</option>          
                <option value="0">Tidak Ada</option>            
              </select>
            </div>  
            <br>
            <h4>Syarat Inap</h4>
            <div class="form-group">
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="ktp" value="1">KTP
                </label>
              </div>
              <div class="checkbox">
                <label>
                  <input type="checkbox" name="marriage_book" value="1">Marriage Book
                </label>
              </div>
            </div>
            <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>   
          </form> 
        </div><!-- Form Group -->
      </div><!-- Box Body -->                   
    </div><!-- Panel Body --> 
  </section>
</div>
<script src="inc/mapupd.js" type="text/javascript"></script>