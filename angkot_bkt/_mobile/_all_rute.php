<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' /><style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map { height: 100%; width: 100% }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true">
</script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'>
</script> 

<?php 
$lat = -0.305441; 
$lng = 100.3692; 
$nilai = $_GET["nilai"];    // Isi yang dicari

?> 
<script src="../../config_public.js"></script>
<script type='text/javascript'> 
var map;

  function init(){
    console.log("init jalan");
    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      map = new google.maps.Map(document.getElementById('map'), myOptions);     

    var id = <?php echo json_encode($nilai); ?>;;
    var url = ipServerAngkotMobile+'_data_angkot_cari.php?nilai='+id;
    console.log(url);
      $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var destination = row.destination;
            var track = row.track;
            var cost = row.cost;
            var number = row.number;
            var route_color = row.route_color;
            var color = row.color;

            console.log(route_color);
            angkot(id,route_color);

          }//end for               
      }});//end ajax 
  }

  function angkot(id,color){
    console.log("jalan");      
        ja = new google.maps.Data();
        ja.loadGeoJson('tampilkanrute.php?id_angkot='+id);
        ja.setStyle(function(feature){
        return({
            fillColor: 'yellow',
            strokeColor: color,
            strokeWeight: 3,
            fillOpacity: 0.5
            });          
        });
        ja.setMap(map);     
  }
  
</script>
</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

