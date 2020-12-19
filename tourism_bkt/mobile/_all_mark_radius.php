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
$rad = $_GET["rad"];    // Isi yang dicari
$lat = $_GET["lat"];    // Isi yang dicari
$lng = $_GET["lng"];    // Isi yang dicari
?> 
<script src="../../config_public.js"></script>
<script src="ip.js"></script>
<script type='text/javascript'> 
var map;
var markersDua = [];
var centerBaru;

var lat = <?php echo json_encode($lat); ?>;
var lng = <?php echo json_encode($lng); ?>;
var rad = <?php echo json_encode($rad); ?>;
var url = server+'_sekitar_tourism.php?lat='+lat+'&lng='+lng+'&rad='+rad;

  function init(){
    console.log("init jalan");

    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      map = new google.maps.Map(document.getElementById('map'), myOptions);   

		kecamatan = new google.maps.Data();
    kecamatan.loadGeoJson('kecamatan.php');
    kecamatan.setStyle(function(feature)
    {
      var gid = feature.getProperty('id');
      if (gid == 'K001'){ 
        return({
          fillColor:'#ff3300',
          strokeWeight:0.1,
          strokeColor:'#ff3300',
          fillOpacity:0.1,
          clickable: false
        }); 
    }
      else if(gid == 'K002'){
        return({
          fillColor:'#ffd777',
          strokeWeight:0.1,
          strokeColor:'#ffd777',
          fillOpacity:0.1,
          clickable: false
        });
    }
      else if(gid == 'K003'){
        return({
          fillColor:'#00b300' ,
          strokeWeight:0.1,
          strokeColor:'#00b300' ,
          fillOpacity:0.1,
          clickable: false
        });
    }
    });
    kecamatan.setMap(map);

  tourism = new google.maps.Data();    
    tourism.loadGeoJson('tourism.php');
    tourism.setStyle(function(feature){
        return({
            fillColor: '#68dff0',
                    strokeColor: '#68dff0',
                    strokeWeight: 1,
                    fillOpacity: 0.6
          });
      });
      tourism.setMap(map);

    console.log(url);
      $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var latitude = row.lat;
            var longitude = row.lng;
			
			centerBaru = new google.maps.LatLng(latitude, longitude);
              marker = new google.maps.Marker
            ({
              position: centerBaru,
              icon:'../icon/marker_tw.png',
              map: map,
              animation: google.maps.Animation.DROP,
            });
              markersDua.push(marker);
              map.setCenter(centerBaru);
              map.setZoom(12);
          }//end for               
      }});//end ajax 
     
  }

  
</script>
</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

