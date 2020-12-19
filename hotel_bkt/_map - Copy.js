        var map;
        var server = "http://localhost/html/hotel_bkt/";
        var cekRadiusStatus = "off";   //RADIUS
        var circles = []; //RADIUS
        var rad; //RADIUS

        var markers = []; //MARKER UNTUK POSISI SAAT INI
        var pos ='null'; //lat & lng POSISI SAAT INI
        var centerLokasi; //lat & lng POSISI SAAT INI

        var infowindow; //JENDELA INFO
        var infoDua=[]; //HIMPUNAN JENDELA INFO
        var markersDua = []; //HIMPUNAN MARKER
        var markersManual = []; //HIMPUNAN MARKER
        
        var info_landmark=[]; //HIMPUNAN JENDELA INFO 
        var markers_landmark = []; //HIMPUNAN MARKER

        var centerBaru; //POSISI MAP
        var ja;
        var angkot = [];

        var rekom_object=0;
        var jumlah_tw = 0;

        var rad_lat=0;
        var rad_lng=0;
        var pos_lat=0;
        var pos_lng=0;

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
              kecamatanTampil();
          }

        function basemap(){   // GOOGLE MAP
          map = new google.maps.Map(document.getElementById('map'), 
              {
                zoom: 13,
                center: new google.maps.LatLng(-0.3051596, 100.3673319),
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
        }
        
        function kecamatanTampil(){   // PENAMPILAN PEMBAGIAN KECAMATAN DI BUKITTINGGI
          kecamatan = new google.maps.Data();
          kecamatan.loadGeoJson(server+'kecamatan.php');
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
        }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      DATA
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

        function hapus_Semua(){  // HAPUS SEMUA DATA - REBUILD GOOGLE MAP
          //set posisi
          init();

          //hapus semua data
          hapus_landmark();
          hapus_kecuali_landmark();
        }

        function hapus_kecuali_landmark(){ //
          hapusRadius();        //circles
          hapusMarkerObject();  //markesDua
          hapusInfo();          //infoDua
          clearangkot();        //angkot
          clearroute();         //rute
        }

        function hapusMarkerObject() {  // HAPUS MARKER DUA
            for (var i = 0; i < markersDua.length; i++) {
                  markersDua[i].setMap(null);
              }
          }

        function hapusRadius(){ // HAPUS RADIUS
          for(var i=0;i<circles.length;i++)
           {
               circles[i].setMap(null);
           }
          circles=[];
          cekRadiusStatus = 'off';
          }

        function hapus_landmark(){ // HAPUS MARKER & INFO LANDMARK
          for (var i = 0; i < info_landmark.length; i++) {
              info_landmark[i].setMap(null);
          }
          for (var i = 0; i < markers_landmark.length; i++) {
                markers_landmark[i].setMap(null);
          }
        }

        function hapusInfo() {  // HAPUS INFO WINDOW 2
          for (var i = 0; i < infoDua.length; i++) {
              infoDua[i].setMap(null);
            }
        }

        function clearangkot(){ // HAPUS ANGKOT
          for (i in angkot){
              angkot[i].setMap(null);
            } 
            angkot=[]; 
        }

        function clearroute(){  // HAPUS RUTE
          for (i in rute){
            rute[i].setMap(null);
          } 
          rute=[]; 
        }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      WINDOW
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

      function menu_angkot() { // KLIK MENU ANGKOT KIRI
          $("#view_kanan_table").show();

          //ANGKOT
          $("#view_kanan_track").hide();
          $("#view_tracking").hide();
          $("#view_object_sekitar").hide();  

          //TW
          $("#view_kanan_data").hide();        
          $("#view_kanan_select").hide();

          $("#view_galery").hide();

          //HOTEL
          $("#view_rekom").hide(); 
          $("#view_kanan_rekom").hide();         
      }

      function menu_rekom() {
          $("#view_kanan_rekom").show();

          $("#view_kanan_table").hide();
          $("#view_kanan_track").hide();
          $("#view_tracking").hide();
          $("#view_object_sekitar").hide();  
          $("#view_kanan_data").hide();        
          $("#view_kanan_select").hide();

          $("#view_galery").hide();

          $("#view_rekom").hide();         
      }

      function hapus_menu() { //
          $("#view_data_tengah").hide();
          $("#view_tracking").hide();
          $("#view_kanan_table").hide();
          $("#view_table_sekitar").hide();
          $("#view_kanan_track").hide();
      }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      FUNGSI DIPAKAI BERSAMA
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */   

        function route_angkot_1(id,color){
          console.log("jalan");      
          console.log(color);      
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
              angkot.push(ja); 
        }

        function galeri(a){    
            console.log(a);
            window.open(server+'gallery.php?idgallery='+a);    
         }

      function posisisekarang(){
        google.maps.event.clearListeners(map, 'click');
        navigator.geolocation.getCurrentPosition(function(position)
        {
          pos = {
            lat: position.coords.latitude,
            lng: position.coords.longitude};
          koordinat = {
            lat: position.coords.latitude,
            lng: position.coords.longitude };

          centerBaru = new google.maps.LatLng(koordinat.lat, koordinat.lng);
          centerLokasi = centerBaru;
          map.setCenter(centerBaru)
          map.setZoom(15);
          
          var marker = new google.maps.Marker({
                    position: koordinat,
                    animation: google.maps.Animation.DROP,
                    map: map});

          marker.info = new google.maps.InfoWindow({
              content: "<center><a style='color:black;'>Anda Disini <br> lat : "+koordinat.lat+" <br> long : "+koordinat.lng+"</a></center>",
              pixelOffset: new google.maps.Size(0, -1)
                });
              marker.info.open(map, marker);

          pos_lat = koordinat.lat;
          pos_lng = koordinat.lng;
          console.log(pos_lat);
          console.log(pos_lng);
        })
      }

      function lokasimanual(){
        alert('Klik Peta');
        map.addListener('click', function(event) {
          addMarker_Manual(event.latLng);
          });
      }
    
      function addMarker_Manual(location){
        for (var i = 0; i < markersManual.length; i++) {
          markersManual[i].setMap(null);       
        } 

        marker = new google.maps.Marker({
         //icon: "assets/img/biru1.ico",
          position : location,
          map: map,
          animation: google.maps.Animation.DROP,
          });

        koordinat = {
          lat: location.lat(),
          lng: location.lng() };

        centerLokasi = new google.maps.LatLng(koordinat.lat, koordinat.lng);        

        marker.info = new google.maps.InfoWindow({
            content: "<center><a style='color:black;'>Anda Disini <br> lat : "+koordinat.lat+" <br> long : "+koordinat.lng+"</a></center>",
            pixelOffset: new google.maps.Size(0, -1)
              });
        marker.info.open(map, marker);
        map.setCenter(koordinat)
        map.setZoom(15);
        markersManual.push(marker);

        pos_lat = koordinat.lat;
        pos_lng = koordinat.lng;
        console.log(pos_lat);
        console.log(pos_lng);
     }

      function set_center(lat,lon,nama){

        //Hapus Info Sebelumnya
        hapusInfo();

        //POSISI MAP
        var centerBaru      = new google.maps.LatLng(lat, lon);
        map.setCenter(centerBaru);

        //JENDELA INFO
        var infowindow = new google.maps.InfoWindow({
              position: centerBaru,
              content: "<bold style='color:black'>"+nama+"</bold>",
            });
        infoDua.push(infowindow); 
        infowindow.open(map);  

      }

      function add_marker(lat,lng,name,tipe){
        var pos = new google.maps.LatLng(lat, lng);
        marker = new google.maps.Marker({
         //icon: "assets/img/biru1.ico",
          position : pos,
          map: map,
          animation: google.maps.Animation.DROP,
          });
        if (name != "") {
          marker.info = new google.maps.InfoWindow({
              content: "<center><a style='color:black;'>"+name+"</a></center>",
              pixelOffset: new google.maps.Size(0, -1)
                });
          marker.info.open(map, marker);          
        }
        markersDua.push(marker);
      }

      function data_hotel_1_info(ids){ // DATA 1 TOURISM
        hapus_kecuali_landmark();
        basemap();
        hapus_landmark();
        $("#view_data_tengah").show();

        $('#table_tengah_info').empty();
        $.ajax({url: server+'_data_hotel_1.php?cari='+ids, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var address = row.address;
            var cp = row.cp;
            var ktp = row.ktp;
            var marriage_book = row.marriage_book;
            var mushalla = row.mushalla;
            var star = row.star;
            var type_hotel = row.type_hotel;
            var lat=row.lat;
            var lng = row.lng;
            console.log(name);
            var syarat="-";
            if (ktp == 1 && marriage_book == 1) {
              syarat = "KTP & Buku Nikah";
            }
            else if (ktp == 1) {
              syarat = "KTP";
            } else if (marriage_book == 1) {
              syarat = "Buku Nikah";
            }

            var mushalla_stat = "-";
            if (mushalla == 1) {
              mushalla_stat = "Ada Mushalla"
            };
            $('#table_tengah_info').append("<tr><td style='text-align:left'>Name</td><td>:</td><td style='text-align:left'> "+name+"</td></tr><tr><td style='text-align:left'>Address</td><td>:</td><td style='text-align:left'> "+address+"</td></tr><tr><td style='text-align:left'>Cp</td><td>:</td><td style='text-align:left'> "+cp+"</td></tr><tr><td style='text-align:left'>Syarat Menginap</td><td>:</td><td style='text-align:left'> "+syarat+"</td></tr><tr><td style='text-align:left'>Mushalla</td><td>:</td><td style='text-align:left'> "+mushalla_stat+"</td></tr><tr><td style='text-align:left'>Type</td><td>:</td><td style='text-align:left'> "+type_hotel+"</td></tr>");

            //MARKER
            rad_lat = lat;
            rad_lng = lng;
            console.log(rad_lat);
            console.log(rad_lng);
            var pos = new google.maps.LatLng(rad_lat, rad_lng);
            marker = new google.maps.Marker({
             icon: "icon/marker_hotel.png",
              position : pos,
              map: map,
              animation: google.maps.Animation.DROP,
              });
            marker.info = new google.maps.InfoWindow({
                content: "<center><a style='color:black;'>"+name+"</a></center>",
                pixelOffset: new google.maps.Size(0, -1)
                  });
            marker.info.open(map, marker);
            markers_landmark.push(marker);
          }//end for

          //FASILITAS HOTEL
          var isi="<tr><td style='text-align:left'>Fasility</td><td>:</td><td><ol style='text-align:left'>";
          for (var i in rows.fasilitas){ 
            var row = rows.fasilitas[i];
            var id = row.id;
            var name = row.name;
            console.log(name);
            isi = isi+"<li>"+name+"</li>";
          }//end for
          isi = isi + "</ol>";
          $('#table_tengah_info').append(isi+"</td></tr>")

          //ROOM HOTEL
          var isi="<tr><td style='text-align:left'>Room</td><td>:</td><td><ol style='text-align:left'>";
          for (var i in rows.kamar){ 
            var row = rows.kamar[i];
            var id = row.id;
            var name = row.name;
            var price = row.price;
            console.log(name);
            isi = isi+"<li>"+name+" - "+price+"</li>";
          }//end for
          isi = isi + "</ol>";
          $('#table_tengah_info').append(isi+"</td></tr>")

          // Tombol Angkot
          $('#label_angkot').empty();
          $('#label_angkot').append("<a class='btn btn-default' role=button' data-toggle='collapse'  onclick='angkot_sekitar(\""+ids+"\")' title='Nearby' aria-controls='Nearby' id='btn_angkot'><i class='fa fa-compass' style='color:black;''></i><label>&nbsp Angkot</label></a>")

          // Tombol Gllaery
          $('#label_gallery').empty();
          $('#label_gallery').append("<a class='btn btn-default' role=button' data-toggle='collapse'  onclick='galeri(\""+ids+"\")' title='Nearby' aria-controls='Nearby' id='btn_gallery'><i class='fa fa-compass' style='color:black;''></i><label>&nbsp Gallery</label></a>")

        }});//end ajax  
        
      }

      function tampilrute(id, warna, latitude, longitude){ //TAMPILKAN RUTE
        ja = new google.maps.Data();
        ja.loadGeoJson(server+'tampilkanrute.php?id_angkot='+id);
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

      function route_angkot(lat1,lng1,lat,lng,id_angkot,id) {

          /*
          lat1  Titik Turun
          lng1
          lat   Objek
          lng
          id -> untuk marker
          */
          init(); // FORMAT MAP

          //MARKER
          centerBaru = new google.maps.LatLng(lat1, lng1);
          map.setCenter(centerBaru);
          map.setZoom(16);  
          if (id.includes("H")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_hotel.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          } else if (id.includes("tw")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_tw.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          } else if (id.includes("RM")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_kuliner.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          } else if (id.includes("M")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_masjid.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          } else if (id.includes("SO")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_oo.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          } else if (id.includes("IK")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_industri.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          } else if (id.includes("R")) {
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_kuliner.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
          }
          markersDua.push(marker);

          tampilrute(id_angkot, "red", lat1, lng1);  //TAMPILKAN RUTE  ANGKOT

          var end = new google.maps.LatLng(lat1, lng1);
          var start = new google.maps.LatLng(lat, lng);

          if(directionsDisplay){
              clearroute();  
              hapusInfo();
          }

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
          rute.push(directionsDisplay);          
      }


      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      MENU 1 LIST TOURISM
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */      

        function listHotel(){ // Menu Hotel
          //clearangkot();
          hapus_menu();
          $('#view_kanan_table').show();
          document.getElementById('judul_table').innerHTML="List Hotel";

          $('#kanan_table').empty();
          $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered'>Action</th></tr>");
          $.ajax({ 
          url: server+'/_data_hotel.php', data: "", dataType: 'json', success: function(rows) 
          { 
              for (var i in rows){ 
                var row = rows[i];
                var id = row.id;
                var name = row.nama;
                var latitude=row.latitude;
                var longitude = row.longitude;
                console.log(id + latitude +longitude);
                $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' onclick='data_hotel_1_info(\""+id+"\")'>&nbsp&nbsp&nbspInfo</a><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+pos_lat+"\",\""+pos_lng+"\",\""+latitude+"\",\""+longitude+"\")'>Route</a></td></tr>");  

                //MARKER
                centerBaru = new google.maps.LatLng(latitude, longitude);
                map.setCenter(centerBaru);
                map.setZoom(16); 
                var marker = new google.maps.Marker({
                  position: centerBaru,              
                  icon:'icon/marker_hotel.png',
                  animation: google.maps.Animation.DROP,
                  map: map
                  });
                markersDua.push(marker);
              }    
            } 
          });  
          
        }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      MENU 2 TOURISM DISEKITAR
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

      function hotel_sekitar_user(){ // Menu Angkot Sekitar
        hapus_Semua();  
        hapus_menu(); 

        if (pos_lat == 0 || pos_lng == 0) {
          alert ('Determine your position first');
        } else {

          console.log(rad_lat);
          console.log(rad_lng);
          rad_lat=pos_lat;
          rad_lng=pos_lng;

          //radius
          var pos = new google.maps.LatLng(rad_lat, rad_lng);
          map.setCenter(pos);
          map.setZoom(16);  

          var inputradius=document.getElementById("inputradius").value;
          rad = parseFloat(inputradius*100);
          var circle = new google.maps.Circle({
            center: pos,
            radius: rad,      
            map: map,
            strokeColor: "blue",
            strokeOpacity: 0.5,
            strokeWeight: 1,
            fillColor: "blue",
            fillOpacity: 0.35
          });        
          circles.push(circle);     

          menu_angkot();
          ht_sekitar_user(rad_lat,rad_lng,rad);

          //MARKER
          centerLokasi = new google.maps.LatLng(rad_lat, rad_lng);        
          marker = new google.maps.Marker({
           //icon: "assets/img/biru1.ico",
            position : centerLokasi,
            map: map,
            animation: google.maps.Animation.DROP,
            });
          marker.info = new google.maps.InfoWindow({
              content: "<center><a style='color:black;'>Anda Disini <br> lat : "+rad_lat+" <br> long : "+rad_lng+"</a></center>",
              pixelOffset: new google.maps.Size(0, -1)
                });
          marker.info.open(map, marker);
          map.setCenter(centerLokasi);

          map.setZoom(15);
          markersManual.push(marker);
        }
      }

      function ht_sekitar_user(latitude,longitude,rad){ // TEMPAT WISATA SEKITAR USER

          $('#kanan_table').empty();
          $('#kanan_table').append("<tr><th class='centered'>Hotel's Name</th><th class='centered'>Action</th></tr>");
          $.ajax({url: server+'_sekitar_hotel.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var jarak = row.jarak;
              var lat = row.lat;
              var lon = row.lng;

              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat, lon);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_hotel.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' onclick='data_hotel_1_info(\""+id+"\")'>&nbsp&nbsp&nbspInfo</a><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a></td></tr>"); 
            }//end for
          }});//end ajax  

        }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      MENU 3 4 5 Tourism's Search
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

      function cari_hotel(tipe){ // PENCARIAN ANGKUTAN KOTA
          console.log("menu jalan")
          hapus_menu();   
          hapus_Semua();

          // DEKLARASI
          var y = "";
          if (tipe == 1) {
            document.getElementById('judul_table').innerHTML="Search hotel by name";
            y = document.getElementById('input_name').value;            
          } else if (tipe == 2) {
            document.getElementById('judul_table').innerHTML="Search hotel by address";
            y = document.getElementById('input_address').value;   
          } else if (tipe == 3) {
            document.getElementById('judul_table').innerHTML="Search hotel by type";
            y = document.getElementById('select_jenis').value;   
          }

          if (y == "") {          
            document.getElementById('modal_title').innerHTML="Info";
            document.getElementById('modal_body').innerHTML="Silahkan isi form terlebih dahulu";
            $('#myModal').modal('show'); 
            return;
          } else {
            $("#view_kanan_table").show();
            $('#kanan_table').empty();            
          }

          //kosongkan input pencarian
          document.getElementById('input_name').value=""; 
          document.getElementById('input_address').value=""; 

          $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered'>Action</th></tr>");
          console.log(server+'_data_hotel_cari.php?tipe='+tipe+'&nilai='+y);
          $.ajax({url: server+'_data_hotel_cari.php?tipe='+tipe+'&nilai='+y, data: "", dataType: 'json', success: function(rows){ 
              for (var i in rows){ 
                var row = rows[i];
                var id = row.id;
                var name = row.name;
                var lng = row.lng;
                var lat = row.lat;
                $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' onclick='data_hotel_1_info(\""+id+"\")'>&nbsp&nbsp&nbspInfo</a></td></tr>");  

                //MARKER
                centerBaru = new google.maps.LatLng(lat, lng);
                map.setCenter(centerBaru);
                map.setZoom(16);  
                var marker = new google.maps.Marker({
                  position: centerBaru,              
                  icon:'icon/marker_hotel.png',
                  animation: google.maps.Animation.DROP,
                  map: map
                  });
                markersDua.push(marker);
              }//end for               
          }});//end ajax 
      }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      SEKITAR ANGKOT - BUTTON
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

      function objek_sekitar_angkot(id_angkot){ // KLIK TAMPILKAN, SETELAH MEMILIH OBJECT NYA DENGAN CHECK BOX

        hapusMarkerObject();
        $('#table_kanan_hotel').empty();
        $('#table_kanan_tourism').empty();
        $('#table_kanan_worship').empty();
        $('#table_kanan_souvenir').empty();
        $('#table_kanan_culinary').empty();
        $('#table_kanan_industry').empty();
        $('#table_kanan_restaurant').empty();

        $('#table_hotel').hide();
        $('#table_tourism').hide();
        $('#table_worship').hide();
        $('#table_souvenir').hide();
        $('#table_culinary').hide();
        $('#table_industry').hide();
        $('#table_restaurant').hide();

        // td = Table Detail
        if (document.getElementById("check_i").checked) {
          $('#table_industry').show();
          td_industri_angkot(id_angkot);
        }        
        if (document.getElementById("check_k").checked) {
          $('#table_culinary').show();
          td_kuliner_angkot(id_angkot);
        }      
        if (document.getElementById("check_m").checked) {
          $('#table_worship').show();
          td_masjid_angkot(id_angkot);
        }      
        if (document.getElementById("check_oo").checked) {
          $('#table_souvenir').show();
          td_oo_Angkot(id_angkot);
        }      
        if (document.getElementById("check_tw").checked) {
          $('#table_tourism').show();
          td_tw_angkot(id_angkot);
        }        
        if (document.getElementById("check_h").checked) {
          $('#table_hotel').show();
          td_hotel_angkot(id_angkot);
        }        
        if (document.getElementById("check_r").checked) {
          $('#table_restaurant').show();
          td_restaurant_angkot(id_angkot);
        }        

        if (!document.getElementById("check_i").checked && !document.getElementById("check_k").checked && !document.getElementById("check_m").checked && !document.getElementById("check_oo").checked && !document.getElementById("check_tw").checked && !document.getElementById("check_h").checked && !document.getElementById("check_r").checked) {          
          document.getElementById('modal_title').innerHTML="Info";
          document.getElementById('modal_body').innerHTML="Pilih salah satu objek terlebih dahulu";
          $('#myModal').modal('show'); 
        } else {
          $('#view_table_sekitar').show();           
        }

      }

      function td_hotel_angkot(id_angkot){ // HOTEL SEKITAR ANGKOT
        $('#table_kanan_hotel').empty();
        $('#table_kanan_hotel').append("<tr><th class='centered'>Hotel Name</th><th class='centered'>Action</th></tr>");  
        $.ajax({url: server+'/_angkot_hotel.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var name = row.name;
            var lat=row.lat;
            var lng = row.lng;
            var lng2 = row.lng2;
            var lat2=row.lat2;
            console.log(id);
            console.log(name);

            //POSISI MAP
            centerBaru = new google.maps.LatLng(lat2, lng2);
            map.setCenter(centerBaru);
            map.setZoom(16);  
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_hotel.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            $('#table_kanan_hotel').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px' onclick='modal_hotel(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lng2+"\",\""+lat+"\",\""+lng+"\",\""+id_angkot+"\",\""+id+"\")'>Route</a></td></tr>");
          }//end for
        }});//end ajax  
      }

      function modal_hotel(id){ // DATA HOTEL

        //DATA HOTEL
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_hotel_1.php?cari='+id);
        $.ajax({url: server+'_data_hotel_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var address = row.address;
            var cp = row.cp;
            var ktp = row.ktp;
            var marriage_book = row.marriage_book;
            var mushalla = row.mushalla;
            var type_hotel = row.type_hotel;
            var lat=row.lat;
            var lng = row.lng;

            if (mushalla == 1) {
              mushalla= "Ada";
            } else {
              mushalla= "Tidak Ada";
            }
            console.log(name);
            var syarat = "-";
            if (marriage_book == 1 && ktp == 1) {
              syarat= "Marriage Book & KTP";
            } else if (marriage_book == 1) {
              syarat= "Marriage Book";
            } else if (ktp == 1) {
              syarat= "KTP";
            }
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><h4>"+type_hotel+"</h4><br><div style='margin-left:20px'>Address: "+address+"<br>Cp: "+cp+"<br>Mushalla: "+mushalla+"<br>Requirement: "+syarat+"</div>";
          }//end for

          //FASILITAS HOTEL
          var isi="<br><b style='margin-left:20px'>Fasility</b> <br><ol>";
          for (var i in rows.fasilitas){ 
            var row = rows.fasilitas[i];
            var id = row.id;
            var name = row.name;
            console.log(name);
            isi = isi+"<li>"+name+"</li>";
          }//end for
          isi = isi + "</ol>";
          $('#mg_body').append(isi);

          //KAMAR HOTEL
          var isi="<b style='margin-left:20px'>Room</b> <br><ol>";
          for (var i in rows.kamar){ 
            var row = rows.kamar[i];
            var id = row.id;
            var name = row.name;
            var price = row.price;
            console.log(name);
            isi = isi+"<li>"+name+" - "+price+"</li>";
          }//end for
          isi = isi + "</ol>";
          $('#mg_body').append(isi);

          $('#modal_gallery').modal('show');
        }});//end ajax  
 
      }

      function td_industri_angkot(id_angkot){ // INDUSTRI SEKITAR ANGKOT
        $('#table_kanan_industry').empty();
        $('#table_kanan_industry').append("<tr><th class='centered'>Industry Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'_angkot_small_industry.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var name = row.name;
            var lat=row.lat;
            var lon = row.lng;
            var lat2=row.lat2;
            var lon2 = row.lng2;
            var description = row.description;
            console.log(name);

            //POSISI MAP
            centerBaru = new google.maps.LatLng(lat2, lon2);
            map.setCenter(centerBaru);
            map.setZoom(16);  
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_industri.png',
              animation: google.maps.Animation.DROP,
              map: map
              });

            markersDua.push(marker);
            map.setCenter(centerBaru);
            $('#table_kanan_industry').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px' onclick='modal_small_industry(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lon2+"\",\""+lat+"\",\""+lon+"\",\""+id_angkot+"\",\""+id+"\")'>Route</a></td></tr>");
          }//end for
        }});//end ajax  
      }

      function modal_small_industry(id){  // DATA INDUSTRY

        //DATA SMALL INDUSTRY
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_small_industry_1.php?cari='+id);
        $.ajax({url: server+'_data_small_industry_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var owner = row.owner;
            var address = row.address;
            var cp = row.cp;
            var employee = row.employee;
            var type_industry = row.type_industry;
            var lat=row.lat;
            var lng = row.lng;
            console.log(name);
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><h4>"+type_industry+"</h4><br><div style='margin-left:20px'>Address: "+address+"<br>Cp: "+cp+"<br>Employee: "+employee+"<br>Industry Type: "+type_industry+"</div>";
          }//end for

          $('#modal_gallery').modal('show');
        }});//end ajax  

      }

      function td_kuliner_angkot(id_angkot){ //KULINER SEKITAR ANGKOT
        $('#table_kanan_culinary').empty();
        $('#table_kanan_culinary').append("<tr><th class='centered'>Culinary Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'/_angkot_culinary_place.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var name = row.name;
            var lat=row.lat;
            var lon = row.lng;
            var lat2=row.lat2;
            var lon2 = row.lng2;
            var description = row.description;
            console.log(name);

            //POSISI MAP
            centerBaru = new google.maps.LatLng(lat2, lon2);
            map.setCenter(centerBaru);
            map.setZoom(16);  
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_kuliner.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
            markersDua.push(marker);
            map.setCenter(centerBaru);

            $('#table_kanan_culinary').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px'  onclick='modal_kuliner(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lon2+"\",\""+lat+"\",\""+lon+"\",\""+id_angkot+"\",\""+id+"\")'>Route</a></td></tr>");
            }//end for
          }});//end ajax  
        }

      function modal_kuliner(id){ //DATA KULINER

        //DATA KULINER
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_culinary_place_1.php?cari='+id);
        $.ajax({url: server+'_data_culinary_place_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var cp = row.cp;
            var address = row.address;
            var capacity = row.capacity;
            var open = row.open;
            var close = row.close;
            var employee = row.employee;
            var lat=row.lat;
            var lng = row.lng;
            console.log(name);
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><br><div style='margin-left:20px'>Address: "+address+"<br>Cp: "+cp+"<br>Capacity: "+capacity+"<br>Open: "+open+"<br>Close: "+close+"<br>Employee: "+employee+"</div>";
          }//end for

          $('#modal_gallery').modal('show');
        }});//end ajax  

      }

      function td_masjid_angkot(id_angkot){ // MASJID SEKITAR ANGKOT
        $('#table_kanan_worship').empty();
        $('#table_kanan_worship').append("<tr><th class='centered'>Worship Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'/_angkot_worship_place.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var lat=row.lat;
              var lon = row.lng;
              var lat2=row.lat2;
              var lon2 = row.lng2;
              var description = row.description;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat2, lon2);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_masjid.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_worship').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px'  onclick='modal_masjid(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lon2+"\",\""+lat+"\",\""+lon+"\",\""+id_angkot+"\",\""+id+"\")'>Route</a></td></tr>");
            }//end for
          }});//end ajax  
      }

      function modal_masjid(id){  //DATA MASJID

        //DATA MASJID
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_worship_place_1.php?cari='+id);
        $.ajax({url: server+'_data_worship_place_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var address = row.address;
            var land_size = row.land_size;
            var park_area_size = row.park_area_size;
            var building_size = row.building_size;
            var capacity = row.capacity;
            var est = row.est;
            var last_renovation = row.last_renovation;
            var jamaah = row.jamaah;
            var imam = row.imam;
            var teenager = row.teenager;
            var category = row.category;
            var lat=row.lat;
            var lng = row.lng;
            console.log(name);
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><br><div style='margin-left:20px'>Address: "+address+"<br>Land Size: "+land_size+"<br>Park Area: "+park_area_size+"<br>Building Size: "+building_size+"<br>Capacity: "+capacity+"<br>Est: "+est+"<br>Renovation: "+last_renovation+"<br>Jamaah: "+jamaah+"<br>Imam: "+imam+"<br>Teenager: "+teenager+"<br>Category: "+category+"</div>";
          }//end for

          $('#modal_gallery').modal('show');
        }});//end ajax  

      }

      function td_oo_Angkot(id_angkot){ // OLEH-OLEH SEKITAR ANGKOT
        $('#table_kanan_souvenir').empty();
        $('#table_kanan_souvenir').append("<tr><th class='centered'>Souvenir Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'/_angkot_souvenir.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var description = row.description;
              var lat=row.lat;
              var lon = row.lng;
              var lat2=row.lat2;
              var lon2 = row.lng2;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat2, lon2);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_oo.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_souvenir').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px'  onclick='modal_oo(\""+id+"\") '></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lon2+"\",\""+lat+"\",\""+lon+"\",\""+id_angkot+"\",\""+id+"\")'>Lihat</a></td></tr>");
            }//end for
          }});//end ajax  
      }

      function modal_oo(id){  //DATA SOUVENIR

        //DATA SOUVENIR
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_souvenir_1.php?cari='+id);
        $.ajax({url: server+'_data_souvenir_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var owner = row.owner;
            var cp = row.cp;
            var address = row.address;
            var employee = row.employee;
            var type_souvenir = row.type_souvenir;
            var lat=row.lat;
            var lng = row.lng;
            console.log(name);
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><br><div style='margin-left:20px'>Address: "+address+"<br>Cp: "+cp+"<br>Owner: "+owner+"<br>Employee: "+employee+"<br>Type: "+type_souvenir+"</div>";
          }//end for

          $('#modal_gallery').modal('show');
        }});//end ajax  
      }

      function td_tw_angkot(id_angkot){ // TOURISM SEKITAR ANGKOT
        $('#table_kanan_tourism').empty();
        $('#table_kanan_tourism').append("<tr><th class='centered'>Tourism Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'/_angkot_tourism.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              
              var lat = row.lat;
              var lon = row.lng;
              var lat2 = row.lat2;
              var lon2 = row.lng2;
              var description = row.description;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat2, lon2);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_tw.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_tourism').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px'  onclick='modal_tw(\""+id+"\") '></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lon2+"\",\""+lat+"\",\""+lon+"\",\""+id_angkot+"\",\""+id+"\")'>Route</a></td></tr>");
            }//end for
        }});//end ajax  
      }

      function modal_tw(id){  // DATA TOURISM

        //DATA TOURISM
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_tourism_1.php?cari='+id);
        $.ajax({url: server+'_data_tourism_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var address = row.address;
            var open = row.open;
            var close = row.close;
            var ticket = row.ticket;
            var tourism_type = row.tourism_type;
            var lat=row.latitude;
            var lng = row.longitude;
            console.log(name);
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><h4>"+tourism_type+"</h4><br><div style='margin-left:20px'>Address: "+address+"<br>Open: "+open+"<br>Close: "+close+"<br>Ticket: "+ticket+"</div>";
          }//end for

          //FASILITAS HOTEL
          var isi="<br><b style='margin-left:20px'>Fasility</b> <br><ol>";
          for (var i in rows.fasilitas){ 
            var row = rows.fasilitas[i];
            var id = row.id;
            var name = row.name;
            console.log(name);
            isi = isi+"<li>"+name+"</li>";
          }//end for
          isi = isi + "</ol>";
          $('#mg_body').append(isi);

          $('#modal_gallery').modal('show');

        }});//end ajax  
      }

      function td_restaurant_angkot(id_angkot){   // RESTAURANT SEKITAR ANGKOT

      // TEMPAT WISATA SEKITAR ANGKOT
        $('#table_kanan_restaurant').empty();
        $('#table_kanan_restaurant').append("<tr><th class='centered'>Restaurant Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'_angkot_restaurant.php?id_angkot='+id_angkot, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              
              var lat = row.lat;
              var lon = row.lng;
              var lat2 = row.lat2;
              var lon2 = row.lng2;
              var description = row.description;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat2, lon2);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,             
                icon:'icon/marker_kuliner.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_restaurant').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-default fa fa-info' style='margin-right:10px' onclick='modal_restaurant(\""+id+"\") '></a><a role='button' class='btn btn-default fa fa-picture-o' style='margin-right:10px' onclick='galeri(\""+id+"\")'></a><a role='button' class='btn btn-default fa fa-bus' onclick='route_angkot(\""+lat2+"\",\""+lon2+"\",\""+lat+"\",\""+lon+"\",\""+id_angkot+"\",\""+id+"\")'>Route</a></td></tr>");
            }//end for
        }});//end ajax  
      }

      function modal_restaurant(id){    // DATA RESTAURANT

        //DATA TOURISM
        document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_restaurant_1.php?cari='+id);
        $.ajax({url: server+'_data_restaurant_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var name = row.name;
            var cp = row.cp;
            var address = row.address;
            var open = row.open;
            var close = row.close;
            var capacity = row.capacity;
            var employee = row.employee;
            var mushalla = row.mushalla;
            var park_area = row.park_area;
            var bathroom = row.bathroom;
            var type_restaurant = row.type_restaurant;
            var lat=row.latitude;
            var lng = row.longitude;

            if (mushalla == 1) {
              mushalla = "Ada";
            }else{
              mushalla = "Tidak ada"
            }
            if (park_area == 1) {
              park_area = "Ada";
            }else{
              park_area = "Tidak ada"
            }
            if (bathroom == 1) {
              bathroom = "Ada";
            }else{
              bathroom = "Tidak ada"
            }

            console.log(name);
            document.getElementById('mg_body').innerHTML="<h2>"+name+"</h2><h4>"+type_restaurant+"</h4><br><div style='margin-left:20px'>Address: "+address+"<br>Open: "+open+"<br>Close: "+close+"<br>Capacity: "+capacity+"<br>Employee: "+employee+"<br>Mushalla: "+mushalla+"<br>Park Area: "+park_area+"<br>Bathroom: "+bathroom+"</div>";
          }//end for

          $('#modal_gallery').modal('show');
        }});//end ajax  
      }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      RADIUS - OBJEK SEKITAR - SEEKBAR
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */
 
        function aktifkanRadius(){
          var pos = new google.maps.LatLng(rad_lat, rad_lng);          
          map.setCenter(pos);
          map.setZoom(16);  

          if(directionsDisplay){
              clearroute();  
              hapusInfo();
          }
          hapusRadius();
          hapusMarkerObject();

          //Radius
          var inputradius=document.getElementById("inputradius2").value;
          rad = parseFloat(inputradius*100);
          console.log(inputradius);
          console.log(rad);
          var circle = new google.maps.Circle({
            center: pos,
            radius: rad,      
            map: map,
            strokeColor: "blue",
            strokeOpacity: 0.5,
            strokeWeight: 1,
            fillColor: "blue",
            fillOpacity: 0.35
          });        
          circles.push(circle);     

          //TAMPILAN
          $('#table_kanan_hotel').empty();
          $('#table_kanan_tourism').empty();
          $('#table_kanan_worship').empty();
          $('#table_kanan_souvenir').empty();
          $('#table_kanan_culinary').empty();
          $('#table_kanan_industry').empty();
          $('#table_kanan_restaurant').empty();
          $('#table_kanan_angkot').empty();

          $('#table_hotel').hide();
          $('#table_tourism').hide();
          $('#table_worship').hide();
          $('#table_souvenir').hide();
          $('#table_culinary').hide();
          $('#table_industry').hide();
          $('#table_restaurant').hide();
          $('#table_angkot').hide();

          if (document.getElementById("check_i").checked) {
            industri_sekitar(rad_lat,rad_lng,rad);
            $('#table_industry').show();
          }        

          if (document.getElementById("check_k").checked) {
            kuliner_sekitar(rad_lat,rad_lng,rad);
            $('#table_culinary').show();
          }      

          if (document.getElementById("check_m").checked) {
            masjid_sekitar(rad_lat,rad_lng,rad);
            $('#table_worship').show();
          }        

          if (document.getElementById("check_oo").checked) {
            oleholeh_sekitar(rad_lat,rad_lng,rad);
            $('#table_souvenir').show();
          }        

          if (document.getElementById("check_tw").checked) {
            tw_sekitar(rad_lat,rad_lng,rad);
            $('#table_tourism').show();
          }        

          if (document.getElementById("check_h").checked) {
            h_sekitar(rad_lat,rad_lng,rad);
            $('#table_hotel').show();
          }        

          if (document.getElementById("check_r").checked) {
            restaurant_sekitar(rad_lat,rad_lng,rad);
            $('#table_restaurant').show();
          }        

          if (!document.getElementById("check_i").checked && !document.getElementById("check_k").checked && !document.getElementById("check_m").checked && !document.getElementById("check_oo").checked && !document.getElementById("check_tw").checked && !document.getElementById("check_h").checked && !document.getElementById("check_r").checked ) {          
            document.getElementById('modal_title').innerHTML="Info";
            document.getElementById('modal_body').innerHTML="Pilih salah satu objek terlebih dahulu";
            $('#myModal').modal('show'); 
          } else {
          $('#view_table_sekitar').show();          
          }
        }
      
      function route_sekitar(lat1,lng1,lat,lng) {

          if (lat1 == 0 || lat == 0 || lng1 == 0 || lng == 0) {          
            document.getElementById('modal_title').innerHTML="Info";
            document.getElementById('modal_body').innerHTML="Terjadi kesalahan, terdapat posisi yang belum ditentukan.<br>Muat ulang data untuk menjalankan fungsi ini";
            $('#myModal').modal('show'); 
            return;
          }

          var start = new google.maps.LatLng(lat1, lng1);
          var end = new google.maps.LatLng(lat, lng);

          if(directionsDisplay){
              clearroute();  
              hapusInfo();
          }

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
              strokeColor: "darkorange"
            }
          });

          directionsDisplay.setMap(map);
          rute.push(directionsDisplay);          
      }

      function tampil_sekitar(latitude,longitude,namaa,tipe){
        hapus_Semua();
        rad_lat = latitude;
        rad_lng = longitude;

        //Hilangkan Button Sekitar
        $('#view_sekitar').empty();
        document.getElementById("inputradius").style.display = "inline";

        // POSISI MARKER
        centerBaru = new google.maps.LatLng(latitude, longitude);
        if (tipe==1) {
          var marker = new google.maps.Marker({map: map, position: centerBaru, 
            icon:'icon/marker_tw.png',
            animation: google.maps.Animation.DROP,
            clickable: true});
        }else{
          var marker = new google.maps.Marker({map: map, position: centerBaru, 
            icon:'icon/marker_hotel.png',
            animation: google.maps.Animation.DROP,
            clickable: true});          
        }

        //INFO WINDOW
        marker.info = new google.maps.InfoWindow({
          content: "<bold>"+namaa+"",
          pixelOffset: new google.maps.Size(0, -1)
            });
          marker.info.open(map, marker);

        $("#view_object_sekitar").show();

        $("#view_industri").hide();
        $("#view_kuliner").hide();
        $("#view_masjid").hide();
        $("#view_oo").hide();
        $("#view_tw").hide();

        $("#view_kanan_data").hide();
        $("#view_galery").hide();                         
      }

      function industri_sekitar(latitude,longitude,rad){ // INDUSTRI SEKITAR
        $('#table_kanan_industry').empty();
        $('#table_kanan_industry').append("<tr><th class='centered'>Industry Name</th><th class='centered'>Action</th></tr>");
        console.log(server+'_sekitar_small_industry.php?lat='+latitude+'&lng='+longitude+'&rad='+rad);
        $.ajax({url: server+'_sekitar_small_industry.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var name = row.name;
            var jarak = row.jarak;
            var lat=row.lat;
            var lon = row.lng;
            console.log(name);

            //POSISI MAP
            centerBaru = new google.maps.LatLng(lat, lon);
            map.setCenter(centerBaru);
            map.setZoom(16);  
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_industri.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
            markersDua.push(marker);
            map.setCenter(centerBaru);
            $('#table_kanan_industry').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_small_industry(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
          }//end for
        }});//end ajax  
      }

      function kuliner_sekitar(latitude,longitude,rad){ //KULINER SEKITAR ANGKOT

          $('#table_kanan_culinary').empty();
          $('#table_kanan_culinary').append("<tr><th class='centered'>Culinary Name</th><th class='centered'>Action</th></tr>");
          $.ajax({url: server+'_sekitar_culinary_place.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var jarak = row.jarak;
              var lat=row.lat;
              var lon = row.lng;
              console.log(name);

              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat, lon);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_kuliner.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_culinary').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_kuliner(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
            }//end for
          }});//end ajax  
        }


      function masjid_sekitar(latitude,longitude,rad){ // MASJID SEKITAR ANGKOT

        $('#table_kanan_worship').empty();
        $('#table_kanan_worship').append("<tr><th class='centered'>Worship Name</th><th class='centered'>Action</th></tr>");
        $.ajax({url: server+'_sekitar_worship_place.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows){ 
            var row = rows[i];
            var id = row.id;
            var name = row.name;
            var jarak = row.jarak;
            var lat=row.lat;
            var lon = row.lng;
            
            //POSISI MAP
            centerBaru = new google.maps.LatLng(lat, lon);
            map.setCenter(centerBaru);
            map.setZoom(16);  
            var marker = new google.maps.Marker({
              position: centerBaru,              
              icon:'icon/marker_masjid.png',
              animation: google.maps.Animation.DROP,
              map: map
              });
            markersDua.push(marker);
            map.setCenter(centerBaru);

            $('#table_kanan_worship').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_masjid(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
          }//end for
        }});//end ajax  
      }


      function oleholeh_sekitar(latitude,longitude,rad){ // OLEH-OLEH SEKITAR ANGKOT

          $('#table_kanan_souvenir').empty();
          $('#table_kanan_souvenir').append("<tr><th class='centered'>Souvenir Name</th><th class='centered'>Action</th></tr>");
          $.ajax({url: server+'_sekitar_souvenir.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var jarak = row.jarak;
              var lat=row.lat;
              var lon = row.lng;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat, lon);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_oo.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_souvenir').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_oo(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
            }//end for
          }});//end ajax  
        }

      function tw_sekitar(latitude,longitude,rad){ // TEMPAT WISATA SEKITAR ANGKOT

          $('#table_kanan_tourism').empty();
          $('#table_kanan_tourism').append("<tr><th class='centered'>Tourism Name</th><th class='centered'>Action</th></tr>");
          $.ajax({url: server+'_sekitar_tourism.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var jarak = row.jarak;
              var lat = row.lat;
              var lon = row.lng;

              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat, lon);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_tw.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_tourism').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_tw(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
            }//end for
          }});//end ajax  

        }


      function h_sekitar(latitude,longitude,rad){ // TEMPAT WISATA SEKITAR ANGKOT

        $('#table_kanan_hotel').empty();
        $('#table_kanan_hotel').append("<tr><th class='centered'>Hotel Name</th><th class='centered'>Action</th></tr>"); 
          console.log(server+'_sekitar_hotel.php?lat='+latitude+'&lng='+longitude+'&rad='+rad);
          $.ajax({url: server+'_sekitar_hotel.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
              var row = rows[i];
              var id          = row.id;
              var name       = row.name;
              var jarak  = row.jarak;
              var lat    = row.lat; 
              var lon   = row.lng;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat, lon);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_hotel.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

            $('#table_kanan_hotel').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_hotel(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
            }//end for
          }});//end ajax  
        }

      function restaurant_sekitar(latitude,longitude,rad){ // TEMPAT WISATA SEKITAR ANGKOT

          $('#table_kanan_restaurant').empty();
          $('#table_kanan_restaurant').append("<tr><th class='centered'>Restaurant Name</th><th class='centered'>Action</th></tr>");
          console.log(server+'_sekitar_restaurant.php?lat='+latitude+'&lng='+longitude+'&rad='+rad);
          $.ajax({url: server+'_sekitar_restaurant.php?lat='+latitude+'&lng='+longitude+'&rad='+rad, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
              var row = rows[i];
              var id          = row.id;
              var name       = row.name;
              var jarak  = row.jarak;
              var lat    = row.lat; 
              var lon   = row.lng;
              
              //POSISI MAP
              centerBaru = new google.maps.LatLng(lat, lon);
              map.setCenter(centerBaru);
              map.setZoom(16);  
              var marker = new google.maps.Marker({
                position: centerBaru,              
                icon:'icon/marker_kuliner.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker);
              map.setCenter(centerBaru);

              $('#table_kanan_restaurant').append("<tr><td>"+name+"</td><td><a role='button' style='margin:5px' class='btn btn-default' onclick='route_sekitar(\""+latitude+"\",\""+longitude+"\",\""+lat+"\",\""+lon+"\")'>Route</a><a role='button' style='margin:5px' class='btn btn-default' onclick='modal_restaurant(\""+id+"\")'>Info</a><a role='button' style='margin:5px' class='btn btn-default' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a><a role='button' class='btn btn-default' style='margin:5px' onclick='galeri(\""+id+"\")'>Gallery</a><a role='button' class='btn btn-default' style='margin:5px' onclick='angkot_sekitar_lagi(\""+id+"\")'>Angkot</a></td></tr>");
            }//end for
          }});//end ajax  
        }

      function angkot_sekitar(id){ // Menu Angkot - List Angkot

        $('#table_hotel').hide();
        $('#table_tourism').hide();
        $('#table_worship').hide();
        $('#table_souvenir').hide();
        $('#table_culinary').hide();
        $('#table_industry').hide();
        $('#table_restaurant').hide();
          
        $('#view_table_sekitar').show();  
        $('#table_kanan_angkot').show();
        $('#table_kanan_angkot').empty();
        $('#table_kanan_angkot').append("<tr><th class='centered'>Destination</th><th class='centered'>Action</th></tr>");
        console.log(server+'_detail_hotel.php?id='+id);
        $.ajax({ 
        url: server+'_detail_hotel.php?id='+id, data: "", dataType: 'json', success: function(rows) 
        { 
            for (var i in rows){ 
              var row = rows[i];
              var ids = row.id;
              var destination = row.destination;
              var color = row.color;
              var lat = row.lat;
              var lng = row.lng;
              var lat2 = row.lat2;
              var lng2 = row.lng2;
              console.log(id);
              route_angkot_1(id,color);
              $('#table_kanan_angkot').append("<tr><td>"+destination+"</td><td><a role='button' class='btn btn-default' onclick='modal_angkot(\""+ids+"\")'>Info</a><a style='margin-left:10px' role='button' class='btn btn-default fa fa-bus' onclick='clearangkot();route_angkot(\""+lat2+"\",\""+lng2+"\",\""+lat+"\",\""+lng+"\",\""+ids+"\",\""+id+"\")'>Route</a></td></tr>");         
            }               
//            route_angkot(lat1,lng1,lat,lng,id_angkot,id
        }});      
      }

      function modal_angkot(id){
          document.getElementById('mg_title').innerHTML="Info";
        console.log(server+'_data_angkot_1.php?cari='+id);
        $.ajax({url: server+'_data_angkot_1.php?cari='+id, data: "", dataType: 'json', success: function(rows){ 
          for (var i in rows.data){ 
            var row = rows.data[i];
            var id = row.id;
            var destination = row.destination;
            var track = row.track;
            var cost = row.cost;
            var number = row.number;
            var color = row.color;
            console.log(destination);
            document.getElementById('mg_body').innerHTML="<h2>"+destination+"</h2><br><div style='margin-left:20px'>Track: "+track+"<br>Cost: "+cost+"<br>number: "+number+"<br>Color: "+color+"</div>";
          }//end for

          $('#modal_gallery').modal('show'); 
        }});//end ajax  
      }

      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      REKOMENDASI
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

        function listRekom(){
          $('#hotel_rekom').empty();
          $.ajax({ 
          url: server+'/_data_tourism.php', data: "", dataType: 'json', success: function(rows) 
            { 
              for (var i in rows) 
                { 
                  var row = rows[i];
                  var gid = row.id;
                  var name = row.name;
                  var longitude = row.lng;
                  var latitude = row.lat;

                  var ids= "cb_"+gid;
                  var id = ids.replace(/\s+/, "") ;
                  console.log(id);

                  //Penambahan Untuk CheckBox di Rekomendasi Hotel
                  $('div#hotel_rekom').append('<div class="checkbox"><label> <input  type="checkbox" id="'+id+'" value="'+latitude+','+longitude+'" >'+ name +'<br></label></div>');
                    jumlah_tw++;
                }    
            } 
          });            
        }

      function rekom_hotel(){

        console.log("mulai");
        hapus_Semua();
        $('#view_rekom_table').empty();

        //PEMBUATAN PARAMETER
        var text = '?';
        var j=0;
        for (var i = 1; i <= jumlah_tw; i++) {
          if (i<10) {
            var id = "tw00"+i;
          } else {
            var id = "tw0"+i;              
          }
          var cari = "#cb_"+id;
          console.log(cari);
          console.log(id);
          var tes = $('div#hotel_rekom').find(cari);
          console.log(tes);
          if (tes.is(':checked')) {
            console.log("jalannnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnnn");
            console.log(tes.val());
            if (j==0) {
              text = text + 'nilai'+j+'='+tes.val();
            } else {
              text = text + '&nilai'+j+'='+tes.val();                
            }
            j++;
          } else {
            console.log("tidakkkkkkkkkkkkkkkkkkkkkkkk");
          }        
        };//end for

        if (j == 0) {          
          document.getElementById('modal_title').innerHTML="Info";
          document.getElementById('modal_body').innerHTML="Silahkan pilih tempat wisata terlebih dahulu";
          $('#myModal').modal('show'); 
          return;
        }
        $("#loader").show();
        $("#loader_text").show();

        text = text + '&total=' +j;
        console.log(text);
        console.log(server+'/_rekom2.php'+text);
        if (j==0) {
          alert("Make a choice of tourist attractions first");
        } else {
          $.ajax({url: server+'_rekom2.php'+text, data: "", dataType: 'json', success: function(rows){ 
            for (var i in rows){ 
                var row      = rows[i];
                var id = row.id_hotel;
                var name = row.name;
                var address = row.address;
                var cp = row.cp;
                var ktp = row.ktp;
                var marriage_book = row.marriage_book;
                var mushalla = row.mushalla;
                var star = row.star;
                var type_hotel = row.type_hotel;

                var jarak    = row.jarak;
                var lat      = row.lat;
                var lon      = row.lng;
                var total_industri  =row.total_industri;
                var total_kuliner   = row.total_kuliner;
                var total_masjid    = row.total_masjid;
                var total_oleh      = row.total_oleh;
                var total_tw        = row.total_tw;
                var total_angkot    = row.total_angkot;
                var total_objek     = row.total_objek;
                console.log(id);

                //POSISI MAP
                centerBaru = new google.maps.LatLng(lat, lon);
                map.setCenter(centerBaru);
                map.setZoom(16);  
                var marker = new google.maps.Marker({
                  position: centerBaru,              
                  icon:'icon/marker_hotel.png',
                  animation: google.maps.Animation.DROP,
                  map: map
                  });
                markersDua.push(marker);
                map.setCenter(centerBaru);

                var syarat="-";
                if (ktp == 1 && marriage_book == 1) {
                  syarat = "KTP & Buku Nikah";
                }
                else if (ktp == 1) {
                  syarat = "KTP";
                } else if (marriage_book == 1) {
                  syarat = "Buku Nikah";
                }

                var mushalla_stat = "-";
                if (mushalla == 1) {
                  mushalla_stat = "Ada Mushalla"
                };

                $('#view_rekom_table').append("<tr><td style='text-align:left'><b style='font-size:20px'>"+name+"</b><br>Address: "+address+"<br>Cp: "+cp+"<br>Syarat Menginap: "+syarat+"<br>Mushalla: "+mushalla_stat+"<br>Tipe Hotel: "+type_hotel+"</td><td><a role='button' class='btn btn-success' onclick='set_center(\""+lat+"\",\""+lon+"\",\""+name+"\")'>Position</a></td></tr>");
              }//end for
            //loader                 
            $("#loader").hide();
            $("#loader_text").hide();                     
          }});//end ajax    

          $("#view_rekom").show();
        }//end else 
      }    

      
      /* **********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      SEKITAR ANGKOT DARI TABLE DETAIL 
      PENCARIAN DENGAN ID OBJEK
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      ***********************************************************************************************************************************************************
      *********************************************************************************************************************************************************** */

      function angkot_sekitar_lagi(id){ // Menu Angkot - List Angkot
        $('#view_table_sekitar').show();  
        $('#table_angkot').show();
        $('#table_kanan_angkot').show();
        $('#table_kanan_angkot').empty();
        $('#table_kanan_angkot').append("<tr><th class='centered'>Destination</th><th class='centered'>Action</th></tr>");
        var url;
        if (id.includes("H")) {
          url = "_detail_hotel.php";
        } else if (id.includes("tw")) {
          url = "_detail_angkot.php";
        } else if (id.includes("SO")) {
          url = "_detail_souvenir.php";
        } else if (id.includes("RM")) {
          url = "_detail_culinary_place.php";
        } else if (id.includes("M")) {
          url = "_detail_worship_place.php";
        } else if (id.includes("IK")) {
          url = "_detail_industry.php";
        } else if (id.includes("R")) {
          url = "_detail_restaurant.php";
        }
        console.log(server+url+'?id='+id);
        $.ajax({ 
        url: server+url+'?id='+id, data: "", dataType: 'json', success: function(rows) 
        { 
            for (var i in rows){ 
              var row = rows[i];
              var ids = row.id;
              var destination = row.destination;
              var color = row.color;
              var lat = row.lat;
              var lng = row.lng;
              var lat2 = row.lat2;
              var lng2 = row.lng2;
              console.log(id);
              route_angkot_1(id,color);
              $('#table_kanan_angkot').append("<tr><td>"+destination+"</td><td><a role='button' class='btn btn-default' onclick='modal_angkot(\""+ids+"\")'>Info</a><a style='margin-left:10px' role='button' class='btn btn-default fa fa-bus' onclick='clearangkot();route_angkot(\""+lat2+"\",\""+lng2+"\",\""+lat+"\",\""+lng+"\",\""+ids+"\",\""+id+"\")'>Route</a></td></tr>");         
            }               
        }});      
      }


    function klikInfoWindow(id)
    {
        google.maps.event.addListener(marker, "click", function(){
            data_hotel_1_info(id);
      });
        console.log("berhasil");
    }