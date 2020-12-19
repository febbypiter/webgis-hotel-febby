<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' /><style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map { height: 100%; width: 100% }
</style>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true'>
</script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'>
</script> 
<?php 
$lat = $_GET['lat']; $lng = $_GET['lng']; $warna=$_GET['warna'];$id_angkot=$_GET['id_angkot']; $latTujuan=$_GET['latTujuan'];
  $lngTujuan=$_GET['lngTujuan'];
$bool=false;
if(isset($_GET['latsimpang'])){
  $latsimpang=$_GET['latsimpang'];
  $lngsimpang=$_GET['lngsimpang'];
  $bool=true;
}else{
  $latsimpang='0';
  $lngsimpang='0';
}
?> 
<script type='text/javascript'> 

 function init(){

    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      var map = new google.maps.Map(document.getElementById('map'), myOptions);   
      
      var objIK = new google.maps.Data();
      objIK.loadGeoJson('industrikecil.php');

      objIK.setStyle(function(feature){
      return({
            fillColor: 'green',
            strokeColor: 'green',
            strokeWeight: 3,
            fillOpacity: 0.0
          });
      });
      objIK.setMap(map); 

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
    
  var marker0 = new google.maps.Marker({ position: latlng,map: map,title: '', clickable:false, icon:''}); 
  objIK.addListener('click', function(event){
  infowindow.setContent(event.feature.getProperty('nama'));
  infowindow.setPosition(event.latLng);
  infowindow.open(map);
  });
  calsimpang();
  function calsimpang(){
    var directionsDisplay;
    var directionsService = new google.maps.DirectionsService();
    directionsDisplay = new google.maps.DirectionsRenderer({ draggable: false, polylineOptions: {strokeColor: 'black' }});   
  

  var awal = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
  var akhir = new google.maps.LatLng(<?php echo $latsimpang; ?>, <?php echo $lngsimpang; ?>); 
  var request = {origin:awal,destination:akhir,travelMode: google.maps.TravelMode.DRIVING};
  console.log('done');
  directionsService.route(request, function(response, status) {if (status == google.maps.DirectionsStatus.OK) {directionsDisplay.setDirections(response);
  console.log('done2');
  }}); directionsDisplay.setMap(map);
  } 

}
</script>
</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

