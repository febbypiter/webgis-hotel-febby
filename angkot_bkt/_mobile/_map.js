        var map;
        var server = ipServerAngkot;
        var cekRadiusStatus = "off";   //RADIUS
        var circles = []; //RADIUS
        var rad; //RADIUS
        var rute = [];  //NAVIGASI
        var directionsDisplay;  //NAVIGASI

        var markers = []; //MARKER UNTUK POSISI SAAT INI
        var pos ='null'; //lat & lng POSISI SAAT INI
        var centerLokasi; //lat & lng POSISI SAAT INI

        var infowindow; //JENDELA INFO
        var infoDua=[]; //HIMPUNAN JENDELA INFO
        var markersDua = []; //HIMPUNAN MARKER
        
        var info_landmark=[]; //HIMPUNAN JENDELA INFO 
        var markers_landmark = []; //HIMPUNAN MARKER

        var centerBaru; //POSISI MAP
        var ja;
        var angkot = [];

        var rekom_object=0;
        var jumlah_tw = 0;

        //tracking angkot
        var marker_1 = []; //MARKER UNTUK POSISI SAAT INI
        var marker_2 = []; //MARKER UNTUK POSISI SAAT INI
        var route_awal = ""; 
        var route_tujuan = "";
        var awal = 0;
        var tujuan = 0;

        //tracking
        var directionsDisplay;
        var rute = [];

        function init(){
              basemap();
          }

        function basemap(){
          map = new google.maps.Map(document.getElementById('map'), 
              {
                zoom: 13,
                center: new google.maps.LatLng(-0.3051596, 100.3673319),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
          }

      //Posisi Saat Ini
      function geo(){ // 1 Panggil
          navigator.geolocation.getCurrentPosition(function(position) {
            pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude

            };
            console.log(pos.lat);
            marker = new google.maps.Marker({
            position: pos,
            map: map,
            animation: google.maps.Animation.DROP,
            });
              centerLokasi = new google.maps.LatLng(pos.lat, pos.lng);

            //MARKER
            markers.push(marker);

            //JENDELA INFO
            infowindow = new google.maps.InfoWindow({
            position: pos,
            content: 'Anda Disini'
            });
            infowindow.open(map, marker);
            map.setCenter(pos);
          });   
      }

      //Posisi Saat Ini
      function marker(lat,lng){

        // POSISI MARKER
        centerBaru = new google.maps.LatLng(lat, lng);
        var marker = new google.maps.Marker({map: map, position: centerBaru, 
        /*icon:'icon/marker_tw.png',*/
        animation: google.maps.Animation.DROP,
        clickable: true});

        //POSISI KAMERA
        map.setCenter(centerBaru);

        //INFO WINDOW
        marker.info = new google.maps.InfoWindow({
            content: "<bold>Anda Disini</bold>",
            pixelOffset: new google.maps.Size(0, -1)
              });

        marker.info.open(map, marker);
      }

      function data_angkot_1(id_angkot){ // ANGKOT - KLIK TOMBOL RUTE - DATA 1 ANGKOT
          $.ajax({url: server+'/tampilkanrute.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows.features) 
              { 
                var id_angkot=rows.features[i].properties.id;
                var warna=rows.features[i].properties.destination;
                var latitude  = rows.features[i].properties.latitude; 
                var longitude = rows.features[i].properties.longitude ;
                var track  = rows.features[i].properties.track; 
                var cost = rows.features[i].properties.cost ;
                var color=rows.features[i].properties.color;
                listgeom_tw(id_angkot);  //INFO WINDOW
                tampilrute(id_angkot, "red", latitude, longitude);  //TAMPILKAN RUTE                  
              }//end for                          
          }});//end ajax           
        }

      function listgeom_tw(id_angkot){ //INFO WINDOW
        $.ajax({url: server+'/tampilkanrute.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          arraylatlngangkot=[];
          var count=0;
          for (var i in rows.features[0].geometry.coordinates){ 
            for (var n in rows.features[0].geometry.coordinates[i]){
              var latlng=rows.features[0].geometry.coordinates[i][n];
              count++;
              arraylatlngangkot.push(latlng);
            }//end for
          } //end for
          if(count%2==1){
            count++;
          }
          var mid=count/2;
          var lat=arraylatlngangkot[mid][1];
          var lon=arraylatlngangkot[mid][0];
          var id_angkot=rows.features[0].properties.id;
          var track  = rows.features[i].properties.track; 
          var cost = rows.features[i].properties.cost ;
          var color=rows.features[i].properties.color;

          //POSISI MAP
          var centerBaru      = new google.maps.LatLng(lat, lon);
          map.setCenter(centerBaru);

          //JENDELA INFO
          var infowindow = new google.maps.InfoWindow({
                position: centerBaru,
                content: "<bold>INFORMASI</bold><br>Kode Trayek: "+id_angkot+"<br>Jurusan: "+destination+"<br>Jalur Angkot: "+track+"<br>Warna Angkot: "+color+"<br>Biaya Angkot: "+cost+"<br>",
              });
          infowindow.open(map);
          infoDua.push(infowindow); 
          infowindow.open(map);  
         }});//end ajax
      }

      function tampilrute(id_angkot, warna, latitude, longitude){ //TAMPILKAN RUTE
        ja = new google.maps.Data();
        console.log(warna);
        ja.loadGeoJson(server+'tampilkanrute.php?id_angkot='+id_angkot);
        ja.setStyle(function(feature){
          return({
              fillColor: 'yellow',
              strokeColor: warna,
              strokeWeight: 2,
              fillOpacity: 0.5
              });          
        });
        ja.setMap(map);  
        angkot.push(ja);
        map.setZoom(15);
      }


