<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' /><style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100%; width: 100% }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh7Xfdh42Ro9CNFPkvoZhFVhEpTeOP16g"></script>
</script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'>
</script> 
<?php 
$lat = $_GET['lat']; $lng = $_GET['lng'];
?>

<script type="text/javascript">
  var lat = "<?php echo $lat; ?>";
  var lng = "<?php echo $lng; ?>";
  function init(){
    map = new google.maps.Map(document.getElementById('map'), 
        {
          zoom: 13,
          center: new google.maps.LatLng(lat,lng),
          mapTypeId: google.maps.MapTypeId.ROADMAP
      });

    //MARKER    
      var pos = new google.maps.LatLng(lat, lng); 
      var marker = new google.maps.Marker({ 
        position:pos,
        map: map,
        title: '', 
        clickable:false, 
        icon:'../icon/marker_tw.png',
        animation: google.maps.Animation.DROP,
      }); 
      map.setCenter(pos);
      map.setZoom(12); 
  }
</script>

</head>
<body onload='init()'> 
<div id='map' style="width: 100%; height: 100%;"></div>
</body>
</html>