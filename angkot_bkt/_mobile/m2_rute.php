<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />

<style type='text/css'> 
  html { height: 100%;width: 100% } 
  body { height: 100%; width: 100%; margin: 0px; padding: 0px }
  #map { height: 100%; width: 100% }
</style>

<!--script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true'></script-->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true"></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'></script> 

<?php 
$lat = $_GET['lat']; 
$lng = $_GET['lng']; 
$warna=$_GET['warna'];
$id_angkot=$_GET['id_angkot']; 
?> 

<script type='text/javascript'> 

 function init(){

    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
    var map = new google.maps.Map(document.getElementById('map'), myOptions);   

    ja = new google.maps.Data();
    var id =<?php echo json_encode($id_angkot); ?>;
    ja.loadGeoJson('tampilkanrute.php?id_angkot='+id);
    ja.setStyle(function(feature){
    return({
        fillColor: 'yellow',
        strokeColor: '$warna',
        strokeWeight: 3,
        fillOpacity: 0.5
        });          
    });
    ja.setMap(map);  
      
    var marker = new google.maps.Marker({ position: latlng,map: map,title: '', clickable:false, icon:''}); 
    marker.open(map,marker);
}
</script></head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

