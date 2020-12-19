  <!-- Fungsional Salsa (Hotel -> Harga Kamar + Fasilitas + Tipe Hotel) -->
  <li class="sub-menu">
                    <a href="javascript:;">
                      <i class="fa fa-search"></i>
                      <span>Fungsional By Salsa</span>
                    </a>
                    <ul class="sub">
                      <!-- Pencarian berdasarkan Harga Kamar -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Room Price</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <span style="background: none;color: white">Minimum Prie</span>
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fs1_hmin">
                              <option value=""> - </option>
                              <option value="30000">Rp. 30.000,-</option>
                              <option value="100000">Rp. 100.000,-</option>
                              <option value="500000">Rp. 500.000,-</option>
                              <option value="1000000">Rp. 1.000.000,-</option>
                            </select>
                            <span style="background: none;color: white">Maximum Price</span>
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fs1_hmax">
                              <option value=""> - </option>
                              <option value="500000">Rp. 500.000,-</option>
                              <option value="1000000">Rp. 1.000.000,-</option>
                              <option value="2000000">Rp. 2.000.000,-</option>
                              <option value="3000000">Rp. 3.000.000,-</option>
                            </select>
                          </li>                             
                        </ul>
                      </li>
                      <!-- Pencarian berdasarkan Fasilitas -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Facility</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <!-- <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_facility"> -->
                              <!-- <option value=""> - </option> -->
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM facility_hotel"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    // echo "<option value='$id'>$name</option>";
                                    echo "<input type='checkbox' name='fas' id='fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            <!-- </select> -->
                          </li>
                        </ul>
                      </li>
                      <!-- Pencarian berdasarkan Tipe Hotel -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Type</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="tipee">
                              <option value=""> - </option>
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM hotel_type"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    echo "<option value='$id'>$name</option>";
                                    // echo "<input type='checkbox' name='fas' id='fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            </select>
                          </li>
                        </ul>
                      </li>
                      <li><a onclick="init();_fs1()" style="cursor:pointer;background:none">Search</a></li>
                    </ul>
                  </li>


                  <!-- Fungsional Adnan  (Hotel -> Kategori Tempat Ibadah + Fasilitas + Tipe Hotel)-->
                  <li class="sub-menu">
                    <a href="javascript:;">
                      <i class="fa fa-search"></i>
                      <span>Fungsional By Adnan</span>
                    </a>
                    <ul class="sub">
                      <!-- Pencarian berdasarkan Kategori Tempat Ibadah -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Worship Place</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fs2_category">
                              <option value=""> - </option>
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM category_worship_place"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    echo "<option value='$id'>$name</option>";
                                    // echo "<input type='checkbox' name='fas' id='fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            </select>
                          </li>
                        </ul>
                      </li>
                      <!-- Pencarian berdasarkan Fasilitas -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Facility</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <!-- <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_facility"> -->
                              <!-- <option value=""> - </option> -->
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM facility_hotel"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    // echo "<option value='$id'>$name</option>";
                                    echo "<input type='checkbox' name='fs2_fas' id='fs2_fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            <!-- </select> -->
                          </li>
                        </ul>
                      </li>
                      <!-- Pencarian berdasarkan Tipe Hotel -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Type</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fs2_type">
                              <option value=""> - </option>
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM hotel_type"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    echo "<option value='$id'>$name</option>";
                                    // echo "<input type='checkbox' name='fas' id='fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            </select>
                          </li>
                        </ul>
                      </li>
                      <li><a onclick="init();_fs2()" style="cursor:pointer;background:none">Search</a></li>
                    </ul>
                  </li>

                  <!-- Fungsional Flo (Hotel -> Harga Kamar + Fasilitas + Destinasi) -->
                  <li class="sub-menu">
                    <a href="javascript:;">
                      <i class="fa fa-search"></i>
                      <span>Fungsional By Flo </span>
                    </a>
                    <ul class="sub">
                      <!-- Pencarian berdasarkan Harga Kamar -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Room Price</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <span style="background: none;color: white"> Minimum Price</span>
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fr1_hmin">
                              <option value=""> - </option>
                              <option value="30000">Rp. 30.000,-</option>
                              <option value="100000">Rp. 100.000,-</option>
                              <option value="500000">Rp. 500.000,-</option>
                              <option value="1000000">Rp. 1.000.000,-</option>
                            </select>
                            <span style="background: none;color: white">Maximum Price</span>
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fr1_hmax">
                              <option value=""> - </option>
                              <option value="500000">Rp. 500.000,-</option>
                              <option value="1000000">Rp. 1.000.000,-</option>
                              <option value="2000000">Rp. 2.000.000,-</option>
                              <option value="3000000">Rp. 3.000.000,-</option>
                            </select>
                          </li>                             
                        </ul>
                      </li>

                      <!-- Pencarian berdasarkan Fasilitas -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Facility</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <!-- <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="select_facility"> -->
                              <!-- <option value=""> - </option> -->
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, name FROM facility_hotel"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['name'];
                                    // echo "<option value='$id'>$name</option>";
                                    echo "<input type='checkbox' name='fr1_fas' id='fr1_fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            <!-- </select> -->
                          </li>
                        </ul>
                      </li>

                      <!-- Pencarian berdasarkan Destinasi Angkot -->
                      <li class="sub">
                        <a style="cursor:pointer;background:none"><i class="fa fa-search"></i> By Destination</a>
                        <ul class="sub">
                          <li style="margin-top:10px">
                            <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="fr1_destinasi">
                              <option value=""> - </option>
                              <?php                      
                              include('../connect.php');    
                              $querysearch="SELECT id, destination FROM angkot"; 
                              $hasil=mysqli_query($conn, $querysearch);

                                while($baris = mysqli_fetch_array($hasil)){
                                    $id=$baris['id'];
                                    $name=$baris['destination'];
                                    echo "<option value='$id'>$name</option>";
                                    // echo "<input type='checkbox' name='fas' id='fas' value='$id'>$name</input><br>";
                                }
                              ?>
                            </select>
                          </li>
                        </ul>
                      </li>

                      <li><a onclick="init();_fr1()" style="cursor:pointer;background:none">Search</a></li>
                    </ul>
                  </li>


                  <!-- List Gallery -->
                  <li class="sub">
                      <a onclick="init();listGallery();" style="cursor:pointer;background:none"><i class="fa fa-image"></i>List Gallery</a>
                  </li>

                  <!-- Gellery by Hotel Type -->
                  <li class="sub">
                      <a onclick="" style="cursor:pointer;background:none"><i class="fa fa-image"></i>Gallery by Hotel Type</a>
                      <ul class="treeview-menu">
                        <li>  
                          <select class="form-control kota text-center" style="width:100%;margin-top:10px" id="gal_ht">
                            <option value=""> - </option>
                            <?php                      
                            include('../connect.php');    
                            $querysearch="SELECT id, name FROM hotel_type"; 
                            $hasil=mysqli_query($conn, $querysearch);

                              while($baris = mysqli_fetch_array($hasil)){
                                  $id=$baris['id'];
                                  $name=$baris['name'];
                                  echo "<option value='$id'><span style='font-size:8pt'>$name</span></option>";
                                  // echo "<input type='checkbox' name='fas' id='fas' value='$id'><span style='font-size:8pt'>$name</span></input><br>";
                              }
                            ?>
                          </select>
                        </li>
                        <li><a onclick="init();galleryType()" style="cursor:pointer;background:none">Search</a></li>
                      </ul>                     
                  </li>
                  
                  <li class="sub">
                      <a onclick="init();menu_rekom();" style="cursor:pointer;background:none">Recomendation</a>
                  </li>

