sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <p class="centered"><a href="index.php"><img src="icon/home.png" class="img-circle" width="60"></a></p>
              	  <h5 class="centered">Local Transport (LT)</h5>

                  <li class="sub">
                      <a onclick="listAngkot();" style="cursor:pointer;background:none"><i class="fa fa-taxi"></i>List LT</a>
                  </li>

                  <li class="sub">
                      <a onclick="" style="cursor:pointer;background:none"><i class="fa fa-thumb-tack"></i>LT Around You</a>
                      <ul class="treeview-menu">
                        <!-- <li style="margin-top:10px"><input id="inputradius" type="range" name="inputradius" data-highlight="true" min="1" max="10" value="1"></li>                             
                        <li><a onclick="angkot_sekitar_user();" style="cursor:pointer;background:none">Search</a></li> -->
                        <div class=" form-group" style="color: white;" > <!-- <br> -->
                          <!-- <label>Based On Radius</label><br> -->
                          <label for="inputradius" style="font-size: 10pt";>Radius : </label>
                          <label  id="nilai"  style="font-size: 10pt";>0</label> m
                          
                          <input  type="range" onchange="angkot_sekitar_user();cekkk();aktifkanRadiuss()" id="inputradius" 
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

                 <!--  <li class="sub">
                      <a style="cursor:pointer;background:none">Search By Destination</a>
                      <ul class="sub">
                        <li style="margin-top:10px"><input id="input_jurusan" type="text" class="form-control"></li>                             
                        <li><a onclick="angkot_sekitar_destination(1)" style="cursor:pointer;background:none">Search</a></li>
                      </ul>
                  </li>

                  <li class="sub">
                      <a style="cursor:pointer;background:none">Search By Track</a>
                      <ul class="sub">
                        <li style="margin-top:10px"><input id="input_track" type="text" class="form-control"></li>                             
                        <li><a onclick="angkot_sekitar_destination(2)" style="cursor:pointer;background:none">Search</a></li>
                      </ul>
                  </li>

                  <li class="sub">
                      <a style="cursor:pointer;background:none">Search By Color</a>
                      <ul class="sub">
                        <li style="margin-top:10px">
                        <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_jenis">
                          <?php                      
                          include('../connect.php');    
                          $querysearch="SELECT id, color FROM angkot_color"; 
                          $hasil=mysqli_query($conn,$querysearch);

                            while($baris = mysqli_fetch_array($hasil)){
                                $id=$baris['id'];
                                $color=$baris['color'];
                                echo "<option value='$id'>$color</option>";
                            }
                          ?>
                        </select>
                        </li>                             
                        <li><a onclick="angkot_sekitar_destination(3)" style="cursor:pointer;background:none">Search</a></li>
                      </ul>
                  </li> -->

                  <li class="sub-menu">
                    <a href="javascript:;" >
                        <i class="fa fa-search"></i>
                        <span>Search LT By</span>
                    </a>
                    <ul class="sub">
                      <li class="sub-menu">
                      <a  href="javascript:;">
                        <i class="fa fa-search"></i> <span>By Destination</span></a>
                      <ul class="sub">
                        <li style="margin-top:10px"><input id="input_jurusan" type="text" class="form-control"></li>                             
                        <li><a onclick="angkot_sekitar_destination(1)" style="cursor:pointer;background:none">Search</a></li>
                      </ul>
                    </li>
                
                    <li class="sub-menu">
                      <a  href="javascript:;"><i class="fa fa-search"></i> By Track</a>
                      <ul class="sub">
                        <li style="margin-top:10px"><input id="input_track" type="text" class="form-control"></li>                             
                        <li><a onclick="angkot_sekitar_destination(2)" style="cursor:pointer;background:none">Search</a></li>
                      </ul>
                    </li>
                  
                    <li class="sub-menu">
                      <a href="javascript:;"><i class="fa fa-search"></i> By Color</a>
                      <ul class="sub">
                        <li style="margin-top:10px">
                        <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_jenis">
                          <?php                      
                          include('../connect.php');    
                          $querysearch="SELECT id, color FROM angkot_color"; 
                          $hasil=mysqli_query($conn,$querysearch);

                            while($baris = mysqli_fetch_array($hasil)){
                                $id=$baris['id'];
                                $color=$baris['color'];
                                echo "<option value='$id'>$color</option>";
                            }
                          ?>
                        </select>
                        </li>                             
                        <li><a onclick="angkot_sekitar_destination(3)" style="cursor:pointer;background:none">Search</a></li>
                      </ul>
                    </li>
                  </ul>


                  </li>

                  <li class="sub">
                      <a onclick="hapus_Semua();menu_angkot_track()" style="cursor:pointer;background:none"><i class="fa fa-road"></i>LT Recommendations</a>
                  </li>

                  <!-- <li class="sub">
                      <a href="apps.apk" download><i class="fa fa-download" ></i>Download Android Apps</a>
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