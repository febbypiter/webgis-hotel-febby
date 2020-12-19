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
//Objek
$lat = $_GET['lat']; 
$lng = $_GET['lng']; 

//Titik turun
$lat2 = $_GET['lat2']; 
$lng2 = $_GET['lng2']; 

//Angkot
$warna=$_GET['route_color'];
$id_angkot=$_GET['id_angkot']; 
?> 

<script type='text/javascript'> 

 function init(){

    var warna =<?php echo json_encode($warna); ?>;
    var lat =<?php echo json_encode($lat); ?>;
    var lng =<?php echo json_encode($lng); ?>;
    var latlng = new google.maps.LatLng(lat, lng); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
    var map = new google.maps.Map(document.getElementById('map'), myOptions);   

    //ANGKOT
    ja = new google.maps.Data();
    var id =<?php echo json_encode($id_angkot); ?>;
    ja.loadGeoJson('tampilkanrute.php?id_angkot='+id);
    ja.setStyle(function(feature){
    return({
        fillColor: 'yellow',
        strokeColor: warna,
        strokeWeight: 3,
        fillOpacity: 0.5
        });          
    });
    ja.setMap(map);  

    //TITIK TURUN
    var lat2 =<?php echo json_encode($lat2); ?>;
    var lng2 =<?php echo json_encode($lng2); ?>;
      var end = new google.maps.LatLng(lat2, lng2);
      var start = latlng;

      directionsService = new google.maps.DirectionsService();
      var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode.WALKING,
        unitSystem: google.maps.UnitSystem.METRIC,
        provideRouteAlternatives: true
      };

      directionsService.route(request, function(response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
         directionsDisplay.setDirections(response);
       }
      });
      
      directionsDisplay = new google.maps.DirectionsRenderer({
        draggable: false,
        polylineOptions: {
          strokeColor: 'darkorange'
        }
      });

      directionsDisplay.setMap(map);
      rute.push(directionsDisplay);          

}
</script>

</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

