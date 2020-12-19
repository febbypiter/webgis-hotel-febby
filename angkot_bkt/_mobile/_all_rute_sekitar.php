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
<? 
$lat = -0.305441; 
$lng = 100.3692; 
$lat = $_GET["lat"];    // Isi yang dicari
$lng = $_GET["lng"];
$rad = $_GET["rad"];

?> 
<script src="../../config_public.js"></script>
<script type='text/javascript'> 
var map;
var lat = <?php echo json_encode($lat); ?>;
var lng = <?php echo json_encode($lng); ?>;
var rad = <?php echo json_encode($rad); ?>;

  function init(){
    console.log("init jalan");
    var latlng = new google.maps.LatLng(lat,lng); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      map = new google.maps.Map(document.getElementById('map'), myOptions);     

    var marker = new google.maps.Marker({ position: latlng,map: map,title: '', clickable:false, icon:''}); 
    marker.info = new google.maps.InfoWindow({
      content: '<center><a>Your Position</a></center>',
      pixelOffset: new google.maps.Size(0, -1)
        });
    marker.info.open(map, marker)

    var circle = new google.maps.Circle({
      center: latlng,
      radius: rad,      
      map: map,
      strokeColor: "blue",
      strokeOpacity: 0.5,
      strokeWeight: 1,
      fillColor: "blue",
      fillOpacity: 0.35
    });        

    var url = ipServerAngkot+'_sekitar_angkot.php?lat='+lat+'&long='+lng+"&rad="+rad;
    console.log(url);
      $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var route_color = row.route_color;

            console.log(route_color);
            angkot(id,route_color);

          }//end for               
      }});//end ajax 
  }

  function angkot(id,color){
    console.log("jalan");      
        ja = new google.maps.Data();
        ja.loadGeoJson('tampilkanrute.php?id_angkot='+id);
        ja.setStyle(function(feature){
        return({
            fillColor: 'yellow',
            strokeColor: color,
            strokeWeight: 3,
            fillOpacity: 0.5
            });          
        });
        ja.setMap(map);     
  }
  
</script>
</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

