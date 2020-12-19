<?php
$a1 = $_GET['a1'];
$a2 = $_GET['a2'];
$b1 = $_GET['b1'];
$b2 = $_GET['b2'];
?>
<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
<style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100%; width: 100% }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh7Xfdh42Ro9CNFPkvoZhFVhEpTeOP16g"></script>
<script src="../../config_public.js"></script>
<script src="ip.js"></script>
<script type="text/javascript">
	var map;
	var ip = server;

	function initialize()
	{
		var pos= new google.maps.LatLng(<?php echo $a1;?>,<?php echo $a2;?>);
		var mapOptions = {zoom:8,center:pos}
		map = new google.maps.Map(document.getElementById('map_canvas'),mapOptions);

		//
    	var tpk = new google.maps.Data();
      	tpk.loadGeoJson(ip+'hotel.php');
    	tpk.setStyle(function(feature){
    	return({
          fillColor: '#00923F',
          strokeColor: 'blue',
          strokeWeight: 3,
          fillOpacity: 0.5
        });
   		});
    	tpk.setMap(map);
		tpk.addListener('click', function(event){
		  infowindow.setContent(event.feature.getProperty('name'));
		  infowindow.setPosition(event.latLng);
		  infowindow.open(map);
		  });

    	var kecamatan = new google.maps.Data();
      	kecamatan.loadGeoJson(ip+'kecamatan.php');
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
	    
     //RUTE
        var directionsDisplay;
		var start = new google.maps.LatLng(<?php echo $a1;?>,<?php echo $a2;?>);
		var end = new google.maps.LatLng(<?php echo $b1;?>,<?php echo $b2;?>);
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
	          strokeColor: "darkorange"
	        }
	      });

	      directionsDisplay.setMap(map);
	}
</script>
</head>
<body onload="initialize()">
	<div id="map_canvas"></div>
	<div class='panel panel-default'>
		<div class='panel-heading'>
			<h4>Info Rute</h4>
		</div>
	<div class='panel-body'>
		<div id="detailrute">
		</div>
	</div>
	</div>
</body>
</html>