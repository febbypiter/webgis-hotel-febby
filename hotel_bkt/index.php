<?php 
session_start();
    $username = $_SESSION['username'];
    
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website untuk pengembangan wisata Bukittinggi">
    <meta name="author" content="Ikhwan">
    <meta name="keyword" content="Hotel, SI Unand, Unand, Wisata">

    <title>Bukittinggi's Hotel</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!--  Slide -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
    .mySlides {display:none}
    .w3-left, .w3-right, .w3-badge {cursor:pointer}
    .w3-badge {height:13px;width:13px;padding:0}
    </style>

    <script src="assets/js/chart-master/Chart.js"></script>

    <script src="../config_public.js"></script>
    <script src="_map8.js"></script>
    <!-- <script src="_map (1).js"></script> -->
    <!-- <script src="_new3.js"></script> -->
    <script src="_fungsional.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDgpfxdQ0Ep_nieNjV64u4yXWeSFHAT4BE&callback=basemaps"></script>


<style type="text/css">

body {
        font-family: Arial;
        margin: 0;
      }

      * {
        box-sizing: border-box;
      }

      img {
        vertical-align: middle;
      }

      /* Position the image container (needed to position the left and right arrows) */
      .container2 {
        position: relative;
      }

      /* Hide the images by default */
      .mySlides {
        display: block;
        width: auto;
        height: auto;
        padding: 10px;
        background-color: grey;
      } 

      /* Add a pointer when hovering over the thumbnail images */
      .cursor {
        cursor: pointer;
      }

      /* Next & previous buttons */
      .prev,
      .next {
        cursor: pointer;
        position: absolute;
        top: 60%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        background-color: rgba(0,0,0,0.5);
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
      }

      .prev1,
      .next1 {
        cursor: pointer;
        position: absolute;
        top: 100%;
        width: auto;
        padding: 10px;
        margin-top: 6px;
        color: white;
        background-color: rgba(0,0,0,0.5);
        font-weight: bold;
        font-size: 20px;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
      }

      /* Position the "next button" to the right */
      .next {
        right: 0;
        border-radius: 3px 0 0 3px;
      }

      .next1 {
        right: 0;
        border-radius: 3px 0 0 3px;
      }

      .prev{
        left: 0;
        border-radius: 3px 0 0 3px;
      }

      .prev1{
        left: 0;
        border-radius: 3px 0 0 3px;
      }

      /* On hover, add a black background color with a little bit see-through */
      .prev:hover,
      .next:hover {
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
      }

      .prev1:hover,
      .next1:hover {
        background-color: rgba(255, 255, 255, 0.8);
        color: black;
      }
      .row2:after {
        
        display: none;
        clear: both;
      }

      /* Six columns side by side */
      .column {
        float: left;
        width: 25%; 
        padding: 5px;
        background-color: black;
      }

      /* Add a transparency effect for thumnbail images */
      .demo {
        opacity: 0.8;
      }

      .active,
      .demo:hover {
        opacity: 1;
        color: black;
      }

/* The dots/bullets/indicators */
.dot {
  cursor: pointer;
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}

.active, .dot:hover {
  background-color: #717171;
}

/* Fading animation */
.fade {
  -webkit-animation-name: fade;
  -webkit-animation-duration: 1.5s;
  animation-name: fade;
  animation-duration: 1000s;
}
      #legend {
        background: white;
        padding: 10px;
        margin: 5px;
        font-size: 12px;
        font-color: black;
        font-family: Arial, sans-serif;
    
    }
    .color {
        border: 1px solid;
        height: 12px;
        width: 12px;
        margin-right: 3px;
        float: left;
    }
    .a {
        background: #f58d6f;
      }
    .b {
        background: #f58d6f;
      }
      .c {
        background: #fce8b7;
      }
    .d {
        background: #00b300;
      }
    .e {
        background: #42cb6f;
      }
    .f {
        background: #5c9ded;
      }
    .g {
        background: #373435;
      }
    .h {
        background: #d51e5a;
      }
    .i {
        background: #9398ec;
      }
    .j {
        background: #f9695d;
      }
    .k {
        background: #ec87bf;
      }
    .l {
        background: navy;
      }
   </style>
    <!--LOADER-->
    <style>
    #loader {
      border: 16px solid #f3f3f3;
      border-radius: 50%;
      border-top: 16px solid #3498db;
      width: 40px;
      margin: 5px;
      height: 40px;
      -webkit-animation: spin 2s linear infinite;
      animation: spin 2s linear infinite;
    }

    @-webkit-keyframes spin {
      0% { -webkit-transform: rotate(0deg); }
      100% { -webkit-transform: rotate(360deg); }
    }

    @keyframes spin {
      0% { transform: rotate(0deg); }
      100% { transform: rotate(360deg); }
    }
    </style>
    
  </head>

  <body onload="init();listRekom();" >

  <section id="container" >

      <!-- Modal -->
      <div class="modal fade" id="modal_gallery" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header"  style="background:black">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="mg_title">Modal Header</h4>
            </div>
            <div class="modal-body" id="mg_body">

                <!--GALERY-->
                <div id="view_galery" class="row" style="display:none">
                    <div class="col-md-12 col-sm-12 mb">
                       <div class="row centered" style="padding:10px">
                         <div class="col-sm-1 col-xs-1"></div>
                         <div id="gal" class="col-sm-10 col-xs-10" style="height:300px;">
                            <!--img class="img-responsive" src="assets/img/ny.jpg" style="width:100%;height:100%;"-->

                            <div class="w3-content w3-display-container" style="max-height:300px;max-width:600px">
                              <div id="img_gambar">

                              </div>
                              
                              <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
                                <div class="col-md-6 col-sm-6 mb">
                                    <div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
                                </div>
                                <div class="col-md-6 col-sm-6 mb">
                                    <div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
                                </div>
                                <div id="span_gambar">

                                </div>
                              </div>
                            </div>

                         </div>
                         <div class="col-sm-1 col-xs-1"></div>
                       </div>
                    </div><!-- /col-md-12 -->             
                </div><!-- /row -->   

                <div class="col-md-12 col-sm-12 mb" style="margin-top:10px">
                  <p id="mg_text" ></p>
                </div><!-- /col-md-12 -->             

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
          </div>
          
        </div>
      </div>


      <!-- Modal -->
      <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header" style="background:black">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title" id="modal_title">Modal Header</h4>
            </div>
            <div class="modal-body" id="modal_body">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
          </div>
          
        </div>
      </div>

      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg" style="background-color:black;border-bottom:1px solid black;">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation" style="color:white;"></div>
        </div>
        <!--logo start-->
        <a href="index.php" class="logo" style="color:white;"><b>WebGIS Hotel (15 1811522007 Febby Putri Milenia Piter)</b></a>
        <div class="top-menu">
        	<ul class="nav pull-right top-menu">
            <li><div id="loader" style="display:none;margin-right:5px"></div></li>
            <li id="loader_text" style="margin-top:13px;margin-right:40px;display:none"><b>Loading</b></li>
            <li class="nav pull-right top-menu">

            <?php 

              //echo "username $username, role $role,";
            if($_SESSION['C'] == false)
            {
              echo "<a href='admin/login.php' class='logo' style='font-size:14px;color:white'><i class='fa fa-sign-in'></i>
              <b>Login</b></a>";
              //echo "username $username, role $role,$_SESSION['C'] || $_SESSION['A'] || $_SESSION['P'] ";
            }
            else{
              echo "<a href='admin/act/logout.php' class='logo' style='font-size:14px;color:white'><i class='fa fa-sign-in'></i>
              <b>logout</b></a>";
              //echo "username $username, role $role";
            }

            ?>
              
            </li>
        	</ul>
        </div>
      </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <?php 
        include 'menu.php';
      ?>
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">

          <section class="wrapper">

              <div class="row">
                <div class="col-lg-8 main-chart">    
                            
                  <!--PETA-->
                  <div class="row">                   
                      <div class="col-md-12 col-sm-12 mb">
                        <div class="white-panel pns">

                          <header class="panel-heading" style="float:left">
                            <label style="color: black; margin-right:10px">Google Map with Location List</label>
                            <input type="hidden" id="myLatLocation" value="0">
                            <input type="hidden" id="myLngLocation" value="0">
                            <a class="btn btn-success" role="button" data-toggle="collapse" onclick="posisisekarang()" title="Current Position"><i class="fa fa-location-arrow" style="color:white;"></i></a>
                            <a class="btn btn-success" role="button" data-toggle="collapse" onclick="lokasimanual()" title=" Manual Position" ><i class="fa fa-map-marker" style="color:white;"></i></a>
                            <label id="tombol">
                            <a class="btn btn-success" role="button" id="showlegenda" data-toggle="collapse" onclick="legenda()" title="Legend"   ><i class="fa fa-eye" style="color:white;"></i></a></label>
                            
                          </header>

                           <div class="row">
                             <div class="col-sm-6 col-xs-6"></div>
                           </div>                        
                           <div id="map" class="centered" style="height:460px">
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->                  
                  </div><!-- /row -->          		   

                  <!--INFO OBJEK-->         
                  <div id="view_data_tengah1" class="row" style="display:none">
                      <div class="col-md-12 col-sm-12 mb">
                        <div class="white-panel pns" style="height:auto;padding-bottom:20px">
                           <div style="margin:0px 20px 10px 20px">
                             <h5 class="btn btn-compose" >Object Information</h5>
                           </div>

                            <!--OBJEK SEKITAR-->         
                            <!--a class='btn btn-default' role=button' data-toggle='collapse' onclick='' title='Nearby' aria-controls='Nearby'>
                              <i class='fa fa-compass' style='color:black;''></i>
                              <label>&nbsp Route By Google</label>
                            </a>       
                            <a class='btn btn-default' role=button' data-toggle='collapse'  onclick='' title='Nearby' aria-controls='Nearby'>
                              <i class='fa fa-compass' style='color:black;''></i>
                              <label>&nbsp Route By Angkot</label>
                            </a-->
                            <label id="label_angkot">
                              <a class='btn btn-default' role='button' data-toggle='collapse'  onclick='' title='Nearby' aria-controls='Nearby' id="btn_angkot">
                              <i class='fa fa-compass' style='color:black;'></i>
                              <label>&nbsp Angkot</label>
                              </a>
                            </label>                
                            <label id="label_gallery">
                              <a class='btn btn-default' role='button' data-toggle='collapse'  onclick='' title='Nearby' aria-controls='Nearby' id="btn_gallery">
                              <i class='fa fa-compass' style='color:black;'></i>
                              <label>&nbsp Gallery</label>
                              </a>
                            </label>                       
                            <!-- <a class='btn btn-default' role=button' data-toggle='collapse' href='#terdekat1' onclick='' title='Nearby' aria-controls='Nearby'>
                              <i class='fa fa-compass' style='color:black;'></i>
                              <label>&nbsp Attraction Nearby</label>
                            </a> -->
                            <!-- <div class='collapse' id='terdekat1'>
                              <div class='well' style='width:auto;margin: 0px 20px 20px 20px;color:black'>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_tw' type='checkbox'>Tourism</label>
                                </div>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_i' type='checkbox'>Small Industry</label>
                                </div>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_oo' type='checkbox' value=''>Souvenir</label>
                                </div>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_m' type='checkbox' value=''>Worship</label>
                                </div>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_k' type='checkbox' value=''>Culinary</label>
                                </div>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_h' type='checkbox' value='5'>Hotel</label>
                                </div>
                                <div class='checkbox'>
                                  <label style="float:left"><input id='check_r' type='checkbox' value=''>Restaurant</label>
                                </div>
                                label><b>Radius </b></label>
                                <label style='color:black' id='km1'><b>0 </b></label>
                                <label><b>m</b></label><br-->
                                <!-- <input id="inputradius2" type="range" onchange="aktifkanRadius()" name="inputradius" data-highlight="true" min="1" max="10" value="1">
                                <div id="angkot_sekitar" class="centered">
                                </div>

                              </div>
                            </div>  -->

                           <div class="row centered" style='margin-top:20px;color:black;'>
                             <div class="col-sm-1 col-xs-1"></div>
                             <div class="col-sm-10 col-xs-10">
                              <!--table class="table table-hover" id='view_table_tengah'>
                              </table-->
                              <table class="table" id='table_tengah_info'>
                                <tbody  style='vertical-align:top;'>
                                </tbody> 
                              </table> 

                             </div>
                             <div class="col-sm-1 col-xs-1"></div>
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->             
                  </div><!-- /row -->                 

                  <!--HASIL TRACKING-->
                  <div id="view_tracking" class="row" style="display:none;color:black">
                      <div class="col-md-12 col-sm-12 mb">
                        <div class="white-panel pns" style="">
                           <div class="white-header">
                             <h5 style='color:black'>Angkot Recommendations</h5>
                           </div>
                           <div class="row centered">
                             <div class="col-sm-1 col-xs-1"></div>
                             <div class="col-sm-10 col-xs-10">
                              <table class="table table-bordered">
                                <tbody id="view_tracking_table" style='color:black'></tbody>
                              </table>  
                             </div>
                             <div class="col-sm-1 col-xs-1"></div>
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->             
                  </div><!-- /row -->   

                  <!--HASIL TRACKING-->
                  <div id="view_tracking2" class="row" style="display:none;color:black">
                      <div class="col-md-12 col-sm-12 mb">
                        <div class="white-panel pns" style="">
                           <div class="white-header">
                             <h5 style='color:black'>Route</h5>
                           </div>
                           
                           <div class="row centered">
                             <div class="col-sm-1 col-xs-1"></div>
                             <div class="col-sm-10 col-xs-10">
                              <table class="table table-bordered">
                                <tbody id="view_tracking_table2" style='color:black'></tbody>
                              </table>  
                             </div>
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->             
                  </div><!-- /row -->   

                  <!--REKOMENDASI HOTEL-->
                  <div id="view_rekom" class="row" style="display:none;color:black">
                      <div class="col-md-12 col-sm-12 mb">
                        <div class="white-panel pns">
                           <div style="margin:0px 20px 10px 20px">
                             <h5 class="btn btn-compose" >Rekomendasi Hotel</h5>
                           </div>
                           <div class="row centered">
                             <div class="col-sm-1 col-xs-1"></div>
                             <div class="col-sm-10 col-xs-10">
                              <!--table class="table table-hover" id='view_rekom_table'></table-->
                              <table class="table table-bordered">
                                <tbody id="view_rekom_table" style='color:black'></tbody>
                              </table>  
                             </div>
                             <div class="col-sm-1 col-xs-1"></div>
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->             
                  </div><!-- /row -->   

                </div><!-- /col-lg-9 END SECTION MIDDLE -->
                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                      
                            


                    
                    <!-- DATA TABLE -->
                    <div id="a" class="col-md-4 col-sm-4 mb" style="margin-top:0px; display:block;">
                        <div class="white-panel pns"  id="galleryrecommendxxx"style="height:510px">
                           <div class="white-header" style="height:40px;margin:20px;background:white;color:black">
                             <h5 class="btn btn-compose" id="judul_table" style="background-color:black;border-bottom:black;color:white">Popular Hotel</h5>
                           </div>
                           <div class="row">
                             <div class="col-sm-6 col-xs-6"></div>
                           </div>
                           <div style="height:410px; overflow-y: scroll; margin:20px;">
        
                              
                           <div class="container2">
                              <div class="row2" >
                              <div class="mySlides">
                                  <a href="" onclick="galleryreco('H046')"><img src="../_foto/H0461.jpg" style="width:100%"><div class="text" style="color:white">Hotel Grand Rocky</div></a>
                                </div>
                                <div class="mySlides">
                                  <a href="" onclick="galleryreco('H016')"><img src="../_foto/H0161.jpg" style="width:100%"><div class="text" style="color:white">Hotel Grand Royal Denai</div></a>
                                </div>
                                <div class="mySlides">
                                  <a href="" onclick="galleryreco('H030')"><img src="../_foto/H0303.jpg" style="width:100%"><div class="text" style="color:white">Novotel</div></a>
                                </div>
                                <div class="mySlides">
                                  <a href="" onclick="galleryreco('H006')"><img src="../_foto/H0067.jpg" style="width:100%"><div class="text" style="color:white">Campago Resort Hotel</div></a>
                                </div>
                                
                                <a class="prev" onclick="plusSlides(-1)">❮</a>
                                <a class="next" onclick="plusSlides(1)">❯</a>
                              </div>  
                              <br>
                              <div class="row2">
                               
                                <div class="column">
                                  <img class="demo cursor" src="../_foto/H0461.jpg" style="width:100%" onclick="currentSlide(1)">
                                </div>
                                <div class="column">
                                  <img class="demo cursor" src="../_foto/H0161.jpg" style="width:100%" onclick="currentSlide(2)">
                                </div>
                                <div class="column">
                                  <img class="demo cursor" src="../_foto/H0303.jpg" style="width:100%" onclick="currentSlide(3)">
                                </div>
                                <div class="column">
                                  <img class="demo cursor" src="../_foto/H0067.jpg" style="width:100%" onclick="currentSlide(4)">
                                </div>

                                <a class="prev1" onclick="plusSlides(-1)">❮</a>
                                <a class="next1" onclick="plusSlides(1)">❯</a>
                              </div>
                            </div>
                              <table style="color:black" class="table table-bordered">
                                <tbody id='kanan_table'></tbody>
                              </table>
                              <script>
                              var slideIndex = 1;
                              showSlides(slideIndex);


                              function plusSlides(n) {
                                showSlides(slideIndex += n);
                              }

                              function currentSlide(n) {
                                showSlides(slideIndex = n);
                              }

                              function showSlides(n) {
                                var i;
                                var slides = document.getElementsByClassName("mySlides");
                                var dots = document.getElementsByClassName("demo");
                                var captionText = document.getElementById("caption");
                                if (n > slides.length) {slideIndex = 1}
                                if (n < 1) {slideIndex = slides.length}
                                for (i = 0; i < slides.length; i++) {
                                    slides[i].style.display = "none";
                                }
                                for (i = 0; i < dots.length; i++) {
                                    dots[i].className = dots[i].className.replace(" active", "");
                                }
                                slides[slideIndex-1].style.display = "block";
                                dots[slideIndex-1].className += " active";
                                captionText.innerHTML = dots[slideIndex-1].alt;
                                }
                              </script>
                           </div>
                        </div>
                      </div>
                               
                                
                      <!-- /col-md-12 -->
                      
                      <div id="view_kanan_table1" class="col-md-4 col-sm-4 mb" style="margin-top:0px; display:none;">
                        <div class="white-panel pns">
                           <div class="white-header" style="height:40px;margin:20px;background:white;color:black">
                             <h5 class="btn btn-compose" id="judul_table" style="background-color:black;color:white;" >Object Arround</h5>
                           </div>
                           <div class="row">
                             <div class="col-sm-6 col-xs-6"></div>
                           </div>
                           <div style=" margin:20px;">
                              <table style="color:black" class="table table-bordered">
                                <!-- <tr id="kanan_table1"></tr> -->
                                <tbody id='kanan_table1'></tbody>
                              </table>
                           </div>
                        </div>
                      </div>

                      <!-- DATA TABLE OBJEK SEKITAR-->
                      <div id="view_table_sekitar" class="col-md-4 col-sm-4 mb" style="display:none">
                        <div class="white-panel pns" style="height:510px">
                           <div class="white-header" style="height:40px;margin:20px;margin-top:0px;background:white;color:black">
                             <h5 class="btn btn-compose" style="background-color:black;color:white;" >Search Results Object Around</h5>
                           </div>
                           <div class="row">
                             <div class="col-sm-6 col-xs-6"></div>
                           </div>
                           <div style="height:410px; margin:20px; overflow-y: scroll;">
                              <table id="table_hotel" class="table table-bordered">
                                <tbody id='table_kanan_hotel' style='color:black'></tbody>
                              </table>  
                              <table id="table_tourism" class="table table-bordered">
                                <tbody id='table_kanan_tourism' style='color:black'></tbody>
                              </table>  
                              <table id="table_worship" class="table table-bordered">
                                <tbody id='table_kanan_worship' style='color:black'></tbody>
                              </table>  
                              <table id="table_souvenir" class="table table-bordered">
                                <tbody id='table_kanan_souvenir' style='color:black'></tbody>
                              </table>  
                              <table id="table_culinary" class="table table-bordered">
                                <tbody id='table_kanan_culinary' style='color:black'></tbody>
                              </table>  
                              <table id="table_industry" class="table table-bordered">
                                <tbody id='table_kanan_industry' style='color:black'></tbody>
                              </table>  
                              <table id="table_restaurant" class="table table-bordered">
                                <tbody id='table_kanan_restaurant' style='color:black'></tbody>
                              </table>  
                              <table id="table_angkot" class="table table-bordered">
                                <tbody id='table_kanan_angkot' style='color:black'></tbody>
                              </table>  
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->
                      <div id="view_table_sekitar1" class="col-md-4 col-sm-4 mb" style="display:none">
                        <div class="white-panel pns" style="height:510px">
                           <div class="white-header" style="height:40px;margin:20px;margin-top:0px;background:white;color:black">
                             <h5 class="btn btn-compose" style="background-color:black;color:white;" >Search Results Object Around</h5>
                           </div>
                           <div class="row">
                             <div class="col-sm-6 col-xs-6"></div>
                           </div>
                           <div style="height:410px; margin:20px; overflow-y: scroll;">  
                           </div>
                         </div>      
                       </div>      

                    <!-- FROM TRACKING ANGKOT -->
                      <div id="view_kanan_track" class="col-md-4 col-sm-4 mb" style="margin-top:20px;display:none">
                        <div class="white-panel pns">
                           <div class="white-header" style="height:40px;margin:20px;background:white;color:white">
                             <h5 class="btn btn-compose" id="judul_select">Angkot Recommendations</h5>
                           </div>
                           <div class="row">
                             <div class="col-sm-6 col-xs-6"></div>
                           </div>

                           <div style="padding:20px" >                            
                             <div class="row" style="margin:5px">
                               <div class="col-sm-5 col-xs-5">
                                  <input id="input_posisi_awal_lng" type="text" class="form-control" style="display:none">
                                  <input id="input_posisi_awal_lat" type="text" class="form-control" style="display:none">
                                  <a role='button' class='btn btn-default text-center' onclick='posisi_manual_1();' id='btnik' style="width: 100%;">Position Start </a>
                                </div>
                               <div id="text_awal" class="col-sm-7 col-xs-7" style="font-size:12px;text-align:left">
                                <div class="alert alert-warning" style="display: inline-block;padding: 6px 12px;width:100%"><b>KLIK</b> For setting position start</div>
                               </div>
                             </div>

                             <div class="row" style="margin:5px">
                               <div class="col-sm-5 col-xs-5">
                                <input id="input_posisi_tujuan_lat" type="text" class="form-control" style="display:none">
                                <input id="input_posisi_tujuan_lng" type="text" class="form-control" style="display:none">
                                <a role='button' class='btn btn-default text-center' onclick='posisi_manual_2();' id='btnik' style="width: 100%;">Position End </a>
                               </div>
                               <div id="text_tujuan" class="col-sm-7 col-xs-7" style="font-size:12px;text-align:left">
                                <div class="alert alert-warning" style="display: inline-block;padding: 6px 12px;width:100%"><b>KLIK</b> For setting position end</div>
                               </div>
                             </div> 

                             <div class="row" style="margin:5px">
                               <div class="col-sm-12 col-xs-12" id="kanan_rute">
                               </div>
                             </div>                           
                            <a role='button' class='btn btn-default text-center' style="margin-top:10px" onclick='call_rute_1();' id='btnik'>Process </a>
                            <a role='button' class='btn btn-default text-center' style="margin-top:10px" onclick='reset_rute();' id='btnik'>Reset </a>
                           </div>
                        </div>
                      </div><!-- /col-md-12 -->   

                <!-- DATA CHECKBOX REKOM -->
                <div id="view_kanan_rekom" class="col-md-4 col-sm-4 mb" style="display: none;">
                  <div class="white-panel pns" style="color:black;">
                     <div class="white-header" style="height:40px;margin:20px;background:white;color:white">
                       <h5 class="btn btn-compose" id="judul_table">Rekomendasi Hotel</h5>
                     </div>
                     <div class="row">
                       <div class="col-sm-6 col-xs-6"></div>
                     </div>
                     <div style="height:460px; overflow-y: scroll;">
                      <h6>*Rekomendasi Berdasarkan Objek Wisata</h6>
                      <div id="hotel_rekom" style="text-align:left;margin:10px;"></div>
                      <a role="button" class="btn btn-default text-center" style="margin-top:10px" onclick="rekom_hotel();" id="btnik">Tampilkan </a>
                      </table>
                     </div>
                  </div>
                </div><!-- /col-md-12 -->  

                      
              </div><!-- /row -->


      <!-- **********************************************************************************************************************************************************
      FULL CONTENT
      *********************************************************************************************************************************************************** -->     


          </section>
      </section>


  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="assets/js/sparkline-chart.js"></script>    
    <script src="assets/js/zabuto_calendar.js"></script>	
    <script type="text/javascript" src="html5gallery/html5gallery.js"></script>
  	
<script>
var slideIndex = 1;
//showDivs(slideIndex);

function plusDivs(n) {
  showDivs(slideIndex += n);
}

function currentDiv(n) {
  showDivs(slideIndex = n);
}

function showDivs(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  if (n > x.length) {slideIndex = 1}    
  if (n < 1) {slideIndex = x.length}
  for (i = 0; i < x.length; i++) {
     x[i].style.display = "none";  
  }
  for (i = 0; i < dots.length; i++) {
     dots[i].className = dots[i].className.replace(" w3-white", "");
  }
  x[slideIndex-1].style.display = "block";  
  dots[slideIndex-1].className += " w3-white";
}
</script>

  </body>
</html>
