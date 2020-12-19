<!DOCTYPE html>
<html>
<head>
<meta name='viewport' content='initial-scale=1.0, user-scalable=no' />
<style type='text/css'> 
html { height: 100%;width: 100% } 
body { height: 100%; width: 100%; margin: 0px; padding: 0px }
#map_canvas { height: 100%; width: 100% }
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBNnzxae2AewMUN0Tt_fC3gN38goeLVdVE&sensor=true"></script>
<script src='http://code.jquery.com/jquery-1.11.0.min.js' type='text/javascript'></script> 
<script type="text/javascript">
        function init(){
          var lat=-0.303791; 
          var lng=100.372666;
            map = new google.maps.Map(document.getElementById('map'), 
                {
                  zoom: 13,
                  center: new google.maps.LatLng(lat,lng),
                  mapTypeId: google.maps.MapTypeId.ROADMAP
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

            // tourism = new google.maps.Data();    
            //   tourism.loadGeoJson('tourism.php');
            //   tourism.setStyle(function(feature){
            //       return({
            //           fillColor: '#68dff0',
            //                   strokeColor: '#68dff0',
            //                   strokeWeight: 1,
            //                   fillOpacity: 0.6
            //         });
            //     });
            //     tourism.setMap(map);
        }
</script>
<body onload='init()'>
<div id='map' style="width: 100%; height: 100%;"></div>
</body>
</html>