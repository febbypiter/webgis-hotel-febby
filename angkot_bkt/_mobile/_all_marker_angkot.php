<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
<style type='text/css'> 
  html { height: 100%;width: 100% } 
  body { height: 100%; width: 100%; margin: 0px; padding: 0px }
  #map { height: 100%; width: 100% }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true">
</script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'>
</script> 
<?php
$lat = -0.305441; 
$lng = 100.3692; 

$hotel = $_GET["hotel"];
$tourism = $_GET["tourism"];
$worship = $_GET["worship"];
$souvenir = $_GET["souvenir"];
$culinary = $_GET["culinary"];
$industry = $_GET["industry"];
$restaurant = $_GET["restaurant"];

$id_angkot = $_GET["id_angkot"];    // Isi yang dicari

?> 
<script src="../../config_public.js"></script>
<script type='text/javascript'> 
var map;
var ip_mobile= ipServerAngkotMobile;
var ip= ipServerAngkot;

  function init(){
    console.log("init jalan");
    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      map = new google.maps.Map(document.getElementById('map'), myOptions);     

    ja = new google.maps.Data();
    ja.loadGeoJson(ip_mobile+"tampilkanrute.php?id_angkot=<?php echo $id_angkot; ?>");
    ja.setStyle(function(feature){
    return({
        fillColor: 'yellow',
        strokeColor: 'red',
        strokeWeight: 3,
        fillOpacity: 0.5
        });          
    });
    ja.setMap(map);  

    if (<?php echo $hotel ?> == 1) {
        var url = ip+"_angkot_hotel.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat2;
                var lng = row.lng2;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_hotel.png'
                }); 

              }//end for               
          }});//end ajax 
      }      

    if (<?php echo $tourism ?> == 1) {
        var url = ip+"_angkot_tourism.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat2;
                var lng = row.lng2;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_tw.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $worship ?> == 1) {
        var url = ip+"_angkot_worship_place.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat2;
                var lng = row.lng2;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_masjid.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $souvenir ?> == 1) {
        var url = ip+"_angkot_souvenir.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat2;
                var lng = row.lng2;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_oo.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $culinary ?> == 1) {
        var url = ip+"_angkot_culinary_place.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat2;
                var lng = row.lng2;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_kuliner.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $industry ?> == 1) {
        var url = ip+"_angkot_small_industry.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat2;
                var lng = row.lng2;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_industri.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $restaurant ?> == 1) {
        var url = ip+"_angkot_restaurant.php?id_angkot=<?php echo $id_angkot ?>";
        console.log(url);
          $.ajax({url: url, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var lat = row.lat;
                var lng = row.lng;
                
                console.log(lat);
                var pos = new google.maps.LatLng(lat, lng); 
                var marker = new google.maps.Marker({ 
                  position:pos,
                  map: map,
                  title: '', 
                  clickable:false, 
                  icon:ip+'icon/marker_restaurant.png'
                }); 

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

