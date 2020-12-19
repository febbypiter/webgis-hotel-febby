<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' /><style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map { height: 100%; width: 100% }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true"></script>  
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'>
</script> 
<?php
$lat = $_GET['lat']; $lng = $_GET['lng']; 
?> 
<script type='text/javascript'> 

 function init(){

    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>);
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      var map = new google.maps.Map(document.getElementById('map'), myOptions);  
    var marker = new google.maps.Marker({ position: latlng,map: map,title: '', clickable:false, icon:''}); 

    marker.info = new google.maps.InfoWindow({
      content: '<center><a>Posisi anda</a></center>',
      pixelOffset: new google.maps.Size(0, -1)
        });
    marker.info.open(map, marker)
 
}
</script></head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

