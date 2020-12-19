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

$hotel = $_GET["hotel"];
$nilai_1 = $_GET["nilai_1"];    // Isi yang dicari

$tourism = $_GET["tourism"];
$nilai_2 = $_GET["nilai_2"];    // Isi yang dicari

$worship = $_GET["worship"];
$nilai_3 = $_GET["nilai_3"];    // Isi yang dicari

$souvenir = $_GET["souvenir"];
$nilai_4 = $_GET["nilai_4"];    // Isi yang dicari

$culinary = $_GET["culinary"];
$nilai_5 = $_GET["nilai_5"];    // Isi yang dicari

$industry = $_GET["industry"];
$nilai_6 = $_GET["nilai_6"];    // Isi yang dicari

$restaurant = $_GET["restaurant"];
$nilai_7 = $_GET["nilai_7"];    // Isi yang dicari

?> 
<script src="../../config_public.js"></script>
<script type='text/javascript'> 
var map;
var ip=ipServerAngkotMobile;

  function init(){
    console.log("init jalan");
    var latlng = new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>); 
    var myOptions = { 
      zoom:14, center: latlng, mapTypeId: google.maps.MapTypeId.ROADMAP }; 
      map = new google.maps.Map(document.getElementById('map'), myOptions);     

    if (<?php echo $hotel ?> == 1) {
        var id = <?php echo json_encode($nilai_1); ?>;
        var url = ip+'_data_cari.php?table=hotel&nilai='+id;
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
                  icon:ip+'marker_hotel.png'
                }); 

              }//end for               
          }});//end ajax 
      }      

    if (<?php echo $tourism ?> == 1) {
        var id = <?php echo json_encode($nilai_2); ?>;
        var url = ip+'_data_cari.php?table=tourism&nilai='+id;
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
                  icon:ip+'marker_tw.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $worship ?> == 1) {
//        var id = "<?php echo $nilai_3; ?>";
        var id = <?php echo json_encode($nilai_3); ?>;
        var url = ip+'_data_cari.php?table=worship_place&nilai='+id;
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
                  icon:ip+'marker_masjid.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $souvenir ?> == 1) {
        var id = <?php echo json_encode($nilai_4); ?>;
        var url = ip+'_data_cari.php?table=souvenir&nilai='+id;
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
                  icon:ip+'marker_oo.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $culinary ?> == 1) {
        var id = <?php echo json_encode($nilai_5); ?>;
        var url = ip+'_data_cari.php?table=culinary_place&nilai='+id;
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
                  icon:ip+'marker_kuliner.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $industry ?> == 1) {
        var id = <?php echo json_encode($nilai_6); ?>;
        var url = ip+'_data_cari.php?table=small_industry&nilai='+id;
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
                  icon:ip+'marker_industri.png'
                }); 

              }//end for               
          }});//end ajax 
      } 

    if (<?php echo $restaurant ?> == 1) {
        var id = <?php echo json_encode($nilai_7); ?>;
        var url = ip+'_data_cari.php?table=restaurant&nilai='+id;
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
                  icon:ip+'marker_restaurant.png'
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

