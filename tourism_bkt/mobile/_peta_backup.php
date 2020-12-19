<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' /><style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100%; width: 100% }
</style>
<script type='text/javascript' src='http://maps.google.com/maps/api/js?sensor=true'></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'></script> 
<? 
$lat = $_GET['lat']; 
$lng = $_GET['lng'];
$route_color=$_GET['route_color'];
$id_angkot=$_GET['id_angkot']; 
$latTujuan=$_GET['latTujuan'];
$lngTujuan=$_GET['lngTujuan'];
$bool=false;

if(isset($_GET['lathenti'])){
  $lathenti=$_GET['lathenti'];
  $lnghenti=$_GET['lnghenti'];
  $bool=true;
}else{
  $lathenti='0';
  $lnghenti='0';
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
    
    var id_angkot =<?php echo json_encode($id_angkot); ?>;
    var route_color =<?php echo json_encode($route_color); ?>;
    if (id_angkot != 0) {
      angkot = new google.maps.Data();
      angkot.loadGeoJson('tampilkanrute.php?id_angkot='+id_angkot);
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

    var marker0 = new google.maps.Marker({ position: latlng,  icon:'../assets/ico/marker_masjid.png', map: map,title: '', animation: google.maps.Animation.DROP, clickable:false}); 
    mesjid.addListener('click', function(event){
    infowindow.setContent(event.feature.getProperty('name'));
    infowindow.setPosition(event.latLng);
    infowindow.open(map);
    });
}

</script>

</head>
<body onload='init()'> 
<div id='map' style="width: 100%; height: 100%;"></div>
</body>
</html>