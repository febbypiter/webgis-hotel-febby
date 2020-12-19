<div class="col-sm-12"> <!-- menampilkan form add facility-->
  <section class="panel">
    <div class="panel-body">
      <a class="btn btn-compose">Add User</a>
      <div class="box-body" >

      <div class="form-group">
        <?php if (!isset($_GET['user'])){
          ?>
        <form class="form-horizontal style-form" role="form" action="act/add_user.php" method="post" >
            
              <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="user">Name</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="nama" value="">
              </div>
                </div>
            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="user">Stewardship Period</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="periode" value="">
              </div>
                </div>
            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="user">Address</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="alamat" value="">
              </div>
                </div>
            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="user">Contact</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="no_hp" value="">
              </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="user">Role</label>
              <div class="col-sm-10">
                  <select required name="role" class="form-control">
                    <option value="A">Admin</option>
                    <option value="P">Owner's Admin</option>                       
                  </select>
              </div>
            </div>
            <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="id_hotel">Hotel</label>
              <div class="col-sm-10">
                  <select  name="id[]" multiple id="id" class="form-control"> 
              <option value='0'>None</option>
                
                      <?php                   
                      $hotel=mysqli_query($conn,"SELECT * from hotel where username is null"); 
                      while($hot = mysqli_fetch_assoc($hotel)) 
                      { 
                      echo"<option value=".$hot['id'].">".$hot['name']."</option>"; 
                      } 
                      ?> 
 
 
                      <?php                   
                      $tempatwisata=mysqli_query($conn,"SELECT * from tourism where username is null"); 
                      while($tw = mysqli_fetch_assoc($tempatwisata)) 
                      { 
                      echo"<option value=".$tw['id'].">".$tw['name']."</option>"; 
                      } 
                      ?>  
                      <?php                 
                      $kuliner=mysqli_query($conn,"SELECT * from cullinary_place where username is null"); 
                       
                      while($kul = mysqli_fetch_assoc($kuliner)) 
                      { 
                      echo"<option value=".$kul['id'].">".$kul['name']."</option>"; 
                      } 
                      ?> 
 
 
                      <?php                   
                      $souvenir=mysqli_query($conn,"SELECT * from souvenir where username is null"); 
                      while($sou = mysqli_fetch_assoc($souvenir)) 
                      { 
                      echo"<option value=".$sou['id'].">".$sou['name']."</option>"; 
                      } 
                      ?> 
 
 
                     

                      <?php                   
                      $ik=mysqli_query($conn,"SELECT * from small_industry where username is null"); 
                      while($tw = mysqli_fetch_assoc($ik)) 
                      { 
                      echo"<option value=".$tw['id'].">".$tw['name']."</option>"; 
                      } 
                      ?> 
                                      
                  </select>
              </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="user">Username</label>
              <div class="col-sm-10">
                  <input type="text" class="form-control" name="username" value="">
              </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-2 col-sm-2 control-label" for="pass">Password</label>
              <div class="col-sm-10">
                  <input type="password" class="form-control" name="password" value="">
              </div>
                </div>  
                <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>  
        </form>
        <?php } ?>
        </form>
      </div>
    </div>
  </section>
</div>