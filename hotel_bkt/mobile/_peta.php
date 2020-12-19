<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
<style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100%; width: 100% }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true"></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'></script> 
<?php 
$lat = $_GET['lat']; 
$lng = $_GET['lng'];

if(isset($_GET['lathenti'])){
  $lathenti=$_GET['lathenti'];
  $lnghenti=$_GET['lnghenti'];
}else{
  $lathenti='0';
  $lnghenti='0';
}

if(isset($_GET['id_angkot'])){
  $route_color=$_GET['route_color'];
  $id_angkot=$_GET['id_angkot']; 
}else{
  $route_color='0';
  $id_angkot='0';
}
?> 
<script type='text/javascript'> 
 function init(){
  var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
  var myOptions = {zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
  var map = new google.maps.Map(document.getElementById('map'), myOptions); 
    
  map.setCenter(latlng);
  var marker = new google.maps.Marker({
    position: latlng,              
    animation: google.maps.Animation.DROP,
    map: map
  });

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

  hotel = new google.maps.Data();    
    hotel.loadGeoJson('hotel.php');
    hotel.setStyle(function(feature){
        return({
            fillColor: '#68dff0',
                    strokeColor: '#68dff0',
                    strokeWeight: 1,
                    fillOpacity: 0.6
          });
      });
      hotel.setMap(map);

//ANGKOT
    var idangkot =<?php echo json_encode($id_angkot); ?>;
    var route_color =<?php echo json_encode($route_color); ?>;
    if (idangkot != 0) {
      angkot = new google.maps.Data();
      angkot.loadGeoJson('tampilkanrute.php?id_angkot='+idangkot);
      angkot.setStyle(function(feature){
      return({
          fillColor: 'yellow',
          strokeColor: route_color,
          strokeWeight: 3,
          fillOpacity: 0.5
          });          
      });
      angkot.setMap(map); 
    }

//TITIK TURUN
    var lathenti = <?php echo json_encode($lathenti); ?>;
    if (lathenti != 0) {
      var lnghenti = <?php echo json_encode($lnghenti); ?>;
      var start = new google.maps.LatLng(lathenti, lnghenti);
      var end = latlng;

      directionsService = new google.maps.DirectionsService();
      var request = {
        origin:start,
        destination:end,
        travelMode: google.maps.TravelMode.DRIVING,
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
}

</script>
</head>
<body onload='init()'> 
<div id='map' style="width: 100%; height: 100%;"></div>
</body>
</html>