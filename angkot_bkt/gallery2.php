<!DOCTYPE html>
<html lang="en">
  
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

    <title>Bukittinggi Tourism</title>

    <link href="assets/css/bootstrap.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="assets/js/fancybox/jquery.fancybox.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">
    <script type="text/javascript" src="html5gallery/html5gallery.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  
  </head>

  <body>

   <section id="container" >
      <header class="header black-bg">
        <div class="sidebar-toggle-box">
          <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
            <!--logo start-->
        <a href="index.php" class="logo"><b>Bukittinggi Tourism</b></a>
        <div class="top-menu">
          <ul class="nav pull-right top-menu">
            <li><div id="loader" style="display:none"></div></li>
            <li id="loader_text" style="margin-top:13px;display:none"><b>Loading</b></li>
          </ul>
        </div>
      </header>

      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <ul class="sidebar-menu" id="nav-accordion">
              
                  <!--p class="centered"><a href="profile.html"><img src="assets/img/masjid.png" class="img-circle" width="90"></a></p-->
          
                  <li class="sub-menu">
                      <a href="index.php">
                          <i class="fa fa-arrow-left"></i>
                          <span>Back To Home</span>
                      </a>
                  </li> 

        </ul>
          </div>
      </aside>
      <section id="main-content">
      <section class="wrapper site-min-height">
          <div class="row mt">
              <div class="col-sm-8" id="result">
    <section class="panel">
                    <div class="panel-body">
                        <a class="btn btn-compose">Gallery</a>
                        <div class="content" style="text-align:center;">
                        <div class="html5gallery" style="max-height:700px;overflow:auto;" data-skin="horizontal" data-width="700" data-height="400" data-resizemode="fit">  
                        <?php
                        require '../connect.php';

                        $id = $_GET["idgallery"];
                        $x=0;

                        $querysearch  ="SELECT a.id, b.gallery_angkot FROM angkot as a left join angkot_gallery as b on a.id=b.id where a.id='$id' ";       
                        $hasil=mysqli_query($conn,$querysearch);
                        while($baris = mysqli_fetch_assoc($hasil)){
                          if(($baris['gallery_angkot']=='-')||($baris['gallery_angkot']=='')){
                            echo "<a href='foto/foto.jpg'><img src='foto/foto.jpg' ></a>";
                          }
                          else{
                            echo "<a href='foto/".$baris['gallery_angkot']."'><img src='foto/".$baris['gallery_angkot']."'></a>";
                            $x++;
                          }
                        }

                        if ($x == 0) {
                          //echo "<a href='foto/foto.jpg'><img src='foto/foto.jpg' ></a>";
                        }

                    ?>
                                  
                        </div>
                        </div>
                    </div>
                </section>
                 </div>
                      
                </div>
    </section>
         
      </section>
      <footer class="site-footer">
          <div class="text-center">
              1311522013 - Ikhwan
              <a href="index.html#" class="go-top">
                  <i class="fa fa-angle-up"></i>
              </a>
          </div>
      </footer>
  </section>


    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
  <script src="assets/js/fancybox/jquery.fancybox.js"></script>    
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>
    <script src="_map.js" type="text/javascript"></script>
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
  <script src="assets/js/advanced-form-components.js"></script>      
    <script type="text/javascript">
      $(function() {
        //    fancybox
          jQuery(".fancybox").fancybox();
      });

  </script>
  </body>
</html>
