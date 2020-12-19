<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' /><style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map { height: 100%; width: 100% }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBh7Xfdh42Ro9CNFPkvoZhFVhEpTeOP16g"></script></script>
<script src="../../config_public.js"></script>
<script src="ip.js"></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'></script> 
<? 
$lat = -0.305441; 
$lng = 100.3692; 

$hotel = $_GET["hotel"];
$tourism = $_GET["tourism"];
$worship = $_GET["worship"];
$souvenir = $_GET["souvenir"];
$culinary = $_GET["culinary"];
$industry = $_GET["industry"];
$restaurant = $_GET["restaurant"];

$latitude = $_GET["latitude"];    // Isi yang dicari
$longitude = $_GET["longitude"];  
$rad = $_GET["rad"];  

?> 
<script type='text/javascript'> 
var map;
var ip=server;
var markersDua = [];

  function init(){
    console.log("init jalan");
    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      map = new google.maps.Map(document.getElementById('map'), myOptions); 

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

    if (<?php echo $hotel ?> == 1) {
      console.log("huuuuu");
      var url = ip+"carihotel.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_hotel.png',
                  animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);

              }//end for               
          }});//end ajax 
      }      

    if (<?php echo $tourism ?> == 1) {
        var url = ip+"cariow.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_tw.png',
                  animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $worship ?> == 1) {
        var url = ip+"cariworship.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_masjid.png',
                animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $souvenir ?> == 1) {
        var url =ip+"carioleholeh.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_oo.png',
                animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $culinary ?> == 1) {
        var url =ip+"carikuline.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_kuliner.png',
                  animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $industry ?> == 1) {
        var url =ip+"cariindustri.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_industri.png',
              animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);
              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $restaurant ?> == 1) {
        var url =ip+"carirestaurant.php?latitude=<?php echo $latitude ?>&longitude=<?php echo $longitude ?>&rad=<?php echo $rad ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.latitude;
                var lng = row.longitude;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:'../icon/marker_kuliner.png',
                animation: google.maps.Animation.DROP,
                }); 
                markersDua.push(marker);
                map.setCenter(pos);

              }//end for               
          }});//end ajax 
      } 


    }

  
</script>
</head>
<body onload='init()'> 
<div id='map'></div>
</body>
</html>

