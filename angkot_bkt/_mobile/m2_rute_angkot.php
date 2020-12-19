<?php
$id_angkot = $_GET['id_angkot']; 
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website untuk pengembangan wisata Bukittinggi">
    <meta name="author" content="Ikhwan">
    <meta name="keyword" content="Tourism, SI Unand, Unand, Wisata">

    <title>Bukittinggi Toursim</title>
    <style type="text/css">
        html, body {
            height: 100%;
            margin: 0;
        }

        #wrapper {
            min-height: 100%; 
        }
    </style>

    <script src="../../config_public.js"></script>
    <script src="_map.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true"></script>
  </head>

  <body onload="init();data_angkot_1( '<?php echo "$id_angkot";?> ');" >

    <!--PETA-->
    <div id="wrapper">                   
       <div id="map" style="height:1000px">
       </div>
    </div><!-- /row -->          				

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="../assets/js/jquery.js"></script>
    <script src="../assets/js/jquery-1.8.3.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="../assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="../assets/js/jquery.scrollTo.min.js"></script>
    <script src="../assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="../assets/js/jquery.sparkline.js"></script>

    <!--common script for all pages-->
    <script src="../assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="../assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="../assets/js/gritter-conf.js"></script>

    <!--script for this page-->
    <script src="../assets/js/sparkline-chart.js"></script>    
    <script src="../assets/js/zabuto_calendar.js"></script>  

  </body>
</html>
