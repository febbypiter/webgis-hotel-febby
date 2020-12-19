sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              	  <p class="centered"><a href="index.php"><img src="icon/home.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered"><?php echo $_SESSION['username'] ?></h5>

                  <li class="sub">
                      <a onclick="init();listTourism();" style="cursor:pointer;background:none"><i class="fa fa-list"></i>List Tourism</a>
                  </li>

                  <li class="sub">
                      <a onclick="" style="cursor:pointer;background:none"><i class="fa fa-thumb-tack"></i>Tourism Around You</a>
                      <ul class="treeview-menu">
                        <!-- <li style="margin-top:10px"><input id="inputradius" type="range" name="inputradius" data-highlight="true" min="1" max="10" value="1"></li>                             
                        <li><a onclick="init();tourism_sekitar_user();" style="cursor:pointer;background:none">Search</a></li> -->
                        <div class=" form-group" style="color: white;" > <!-- <br> -->
                          <!-- <label>Based On Radius</label><br> -->
                          <label for="inputradius" style="font-size: 10pt";>Radius : </label>
                          <label  id="nilai"  style="font-size: 10pt";>0</label> m
                          
                          <input  type="range" onchange="init();tourism_sekitar_user();cekkk();" id="inputradius" 
                                  name="inputradius" data-highlight="true" min="0" max="20" value="0" >
                          <script>
                            function cekkk()
                            {
                              document.getElementById('nilai').innerHTML=document.getElementById('inputradius').value*100
                            }
                          </script>
                        </div>
                      </ul>                     
                  </li>

                  <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-search"></i>
                        <span>Search Tourism By</span>
                    </a>
                    <ul class="sub">
                  



                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Name</a>
                          <ul class="sub">
                            <li style="margin-top:10px"><input id="input_name" type="text" class="form-control"></li>                             
                            <li><a onclick="init();cari_tourism(1)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>

                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Address</a>
                          <ul class="sub">
                            <li style="margin-top:10px"><input id="input_address" type="text" class="form-control"></li>                             
                            <li><a onclick="init();cari_tourism(2)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>

                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Type</a>
                          <ul class="sub">
                            <li style="margin-top:10px">
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_jenis">
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM tourism_type"; 
                              $hasil=mysqli_query($conn,$querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    echo "<option value='$id'>$name</option>";
                                }
                              ?>
                            </select>
                            </li>                             
                            <li><a onclick="init();cari_tourism(3)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>

                      <li class="sub">
                          <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Fasility</a>
                          <ul class="sub">
                            <li style="margin-top:10px"><input id="input_fasility" type="text" class="form-control"></li>                                 
                            <li><a onclick="init();cari_tourism(4)" style="cursor:pointer;background:none">Search</a></li>
                          </ul>
                      </li>
                    </ul>
                  </li>
                  <!-- <li class="sub">
                      <a href="apps.apk" download>
                      <i class="fa fa-download" ></i>Download Android Apps</a>
                  </li> -->
                   <li class="sub-menu">
                      <a class="active" href=".././">
                          <i class="fa fa-hand-o-left"></i>
                          <span>Dashboard</span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end