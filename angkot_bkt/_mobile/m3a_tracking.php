<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />

<style type='text/css'> 
  html { height: 100%;width: 100% } 
  body { height: 100%; width: 100%; margin: 0px; padding: 0px }
  #map { height: 100%; width: 100% }
</style>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true"></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'></script> 

<?php 
$lat1 = $_GET['lat1']; 
$lng1 = $_GET['lng1']; 
$lat2 = $_GET['lat2']; 
$lng2 = $_GET['lng2']; 
$id_angkot=$_GET['id_angkot']; 
$id_angkot2=$_GET['id_angkot2']; 
?> 

<script type='text/javascript'> 

 function init(){

    var latlng = new google.maps.LatLng(<?php echo $lat1; ?>, <?php echo $lng1; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
    var map = new google.maps.Map(document.getElementById('map'), myOptions);   
    var marker = new google.maps.Marker({ position: latlng,map: map,title: '', clickable:false, icon:''}); 

  marker.info = new google.maps.InfoWindow({
      content: '<center><a>Posisi awal</a></center>',
      pixelOffset: new google.maps.Size(0, -1)
        });
    marker.info.open(map, marker)

    var latlng = new google.maps.LatLng(<?php echo $lat2; ?>, <?php echo $lng2; ?>); 
    var myOptions = { 
      zoom:14, center: latlng2, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
    var marker2 = new google.maps.Marker({ position: latlng2,map: map,title: '', clickable:false, icon:''}); 

  marker2.info = new google.maps.InfoWindow({
      content: '<center><a>Posisi tujuan</a></center>',
      pixelOffset: new google.maps.Size(0, -1)
        });
    marker2.info.open(map, marker2)

    ja = new google.maps.Data();
    var id =<?php echo json_encode($id_angkot); ?>;
    ja.loadGeoJson('tampilkanrute.php?id_angkot='+id);
    ja.setStyle(function(feature){
    return({
        fillColor: 'yellow',
        strokeColor: 'black',
        strokeWeight: 3,
        fillOpacity: 0.5
        });          
    });
    ja.setMap(map);  

    var id2 =<?php echo json_encode($id_angkot2); ?>;
    ja = new google.maps.Data();
    ja.loadGeoJson('tampilkanrute.php?id_angkot='+id2);
    ja.setStyle(function(feature){
    return({
        fillColor: 'yellow',
        strokeColor: 'orange',
        strokeWeight: 3,
        fillOpacity: 0.5
        });          
    });
    ja.setMap(map);   



}
</script>; 

</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

