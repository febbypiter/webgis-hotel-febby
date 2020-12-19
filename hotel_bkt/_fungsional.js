function _fs1(){
        hapus_menu();
        hapus_Semua();

        var y = [];
        for(i=0;i<$("input[name=fas]:checked").length;i++){
          y.push($("input[name=fas]:checked")[i].value);
        }
        var z = document.getElementById('fs1_type').value;
        var min = document.getElementById('fs1_hmin').value;
        var max = document.getElementById('fs1_hmax').value;
        if (y.length==0 || z=="" || min=="" ||max=="") {
        alert('Silahkan isi form terlebih dahulu');
         return '';
        }
        document.getElementById('judul_table').innerHTML="Fungsional Baru";

        if ((y =="")&&(z == "")&&(min == ""||max == "")) {          
          document.getElementById('modal_title').innerHTML="Info";
          document.getElementById('modal_body').innerHTML="Silahkan isi form terlebih dahulu";
          $('#myModal').modal('show'); 
          return;
        } else {
          $("#view_kanan_table").show();
          $('#kanan_table').empty();            
        }

        $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered' colspan='3'>Action</th></tr>");
        console.log(server+'_fs1.php?min='+min+'&max='+max+'&fas='+y+'&tipe='+z);
        $.ajax({url: server+'_fs1.php?min='+min+'&max='+max+'&fas='+y+'&tipe='+z, data: "", dataType: 'json', success: function(rows){ 
          if(rows == null)
          {
            alert('Data Did Not Exist !');
          }
            for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var lng = row.lng;
              var lat = row.lat;
              $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-success fa fa-info' onclick='data_hotel_1_info(\""+id+"\")'></a></td><td><a role='button' class='btn btn-success fa fa-taxi' title='Angkot' onclick='angkot_sekitar(\""+id+"\")'></a></td></tr>");  
              console.log(name);
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
              klikInfoWindow(id,marker);
            }//end for               
        }});//end ajax 
}

function _fs2(){
        hapus_menu();
        hapus_Semua();

        var y = [];
        for(i=0;i<$("input[name=fs2_fas]:checked").length;i++){
          y.push($("input[name=fs2_fas]:checked")[i].value);
        }
        var z = document.getElementById('fs2_type').value;
        var x = document.getElementById('fs2_category').value;
        document.getElementById('judul_table').innerHTML="Fungsional Baru";
        if (y.length==0 || z=="" || x=="") {
        alert('Silahkan isi form terlebih dahulu');
         return '';
        }

        if ((y =="")&&(z == "")&&(x == "")) {          
          document.getElementById('modal_title').innerHTML="Info";
          document.getElementById('modal_body').innerHTML="Silahkan isi form terlebih dahulu";
          $('#myModal').modal('show'); 
          return;
        } else {
          $("#view_kanan_table").show();
          $('#kanan_table').empty();            
        }

        $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered' colspan='3'>Action</th></tr>");
        console.log(server+'_fs2.php?category='+x+'&fas='+y+'&tipe='+z);
        $.ajax({url: server+'_fs2.php?category='+x+'&fas='+y+'&tipe='+z, data: "", dataType: 'json', success: function(rows){ 
          if(rows == null)
          {
            alert('Data Did Not Exist !');
          }
            for (var i in rows){ 
              var row = rows[i];
              var id = row.id;
              var name = row.name;
              var lng = row.lng;
              var lat = row.lat;
              var id2 = row.id2;
              var name2 = row.name2;
              var lng2 = row.lng2;
              var lat2 = row.lat2;
              $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-success fa fa-info' onclick='data_hotel_1_info(\""+id+"\")'></a></td><td><a role='button' class='btn btn-success fa fa-taxi' title='Angkot' onclick='angkot_sekitar(\""+id+"\")'></a></td></tr>");  
              console.log(name);
              //MARKER hotel
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
              klikInfoWindow(id,marker);
              // Mesjid
              centerMe = new google.maps.LatLng(lat2, lng2);
              // map.setCenter(centerMe);
              map.setZoom(16);  
              var marker2 = new google.maps.Marker({
                position: centerMe,              
                icon:'icon/marker_masjid.png',
                animation: google.maps.Animation.DROP,
                map: map
                });
              markersDua.push(marker2);
              klikInfoWindowMes(id2,marker2);
            }//end for               
        }});//end ajax 
}

function _fr1(){
  hapus_menu();
  hapus_Semua();

  var y = [];
  for(i=0;i<$("input[name=fr1_fas]:checked").length;i++){
    y.push($("input[name=fr1_fas]:checked")[i].value);
  }
  var z = document.getElementById('fr1_destinasi').value;
  var min = document.getElementById('fr1_hmin').value;
  var max = document.getElementById('fr1_hmax').value;
  document.getElementById('judul_table').innerHTML="Fungsional Baru";

  if ((y =="")&&(z == "")&&(min == ""||max == "")) {          
    document.getElementById('modal_title').innerHTML="Info";
    document.getElementById('modal_body').innerHTML="Silahkan isi form terlebih dahulu";
    $('#myModal').modal('show'); 
    return;
  } else {
    $("#view_kanan_table").show();
    $('#kanan_table').empty();            
  }

  $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered' colspan='3'>Action</th></tr>");
  console.log(server+'_fr1.php?min='+min+'&max='+max+'&fas='+y+'&destinasi='+z);
  $.ajax({url: server+'_fr1.php?min='+min+'&max='+max+'&fas='+y+'&destinasi='+z, data: "", dataType: 'json', success: function(rows){ 
    if(rows == null)
    {
      alert('Data Did Not Exist !');
    }
      for (var i in rows){ 
        var row = rows[i];
        var id = row.id;
        var name = row.name;
        var lng = row.lng;
        var lat = row.lat;
        $('#kanan_table').append("<tr><td>"+name+"</td><td><a role='button' class='btn btn-success fa fa-info' onclick='data_hotel_1_info(\""+id+"\")'></a></td><td><a role='button' class='btn btn-success fa fa-taxi' title='Angkot' onclick='angkot_sekitar(\""+id+"\")'></a></td></tr>");  
        console.log(name);
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
        klikInfoWindow(id,marker);
      }//end for               
  }});//end ajax 
}

function listGallery(){
  hapus_menu();
  $('#view_kanan_table').show();
  document.getElementById('judul_table').innerHTML="List Galley";

  $('#kanan_table').empty();
  $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered' colspan='3'>Action</th></tr>");
  // console.log(server+'_data_hotel.php');
  $.ajax({ 
  url: server+'_gallery.php', data: "", dataType: 'json', success: function(rows) 
  { 
    for (var i in rows){ 
      var row = rows[i];
      var id = row.id;
      var name = row.name;
      var latitude=row.lat;
      var longitude = row.lng;
      var img = row.img;
      console.log(id + latitude + longitude + img);
      $('#kanan_table').append("<tr><td><img style='max-height:100px;' src='../_foto/"+img+"'><br><center>"+name+"</center></td><td><a role='button' class='btn btn-success fa fa-info' title='info'  onclick='data_hotel_1_info(\""+id+"\")'></a></td><td><a role='button' class='btn btn-success fa fa-taxi' title='Angkot' onclick='angkot_sekitar(\""+id+"\")'></a></td></tr>");  

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

      klikInfoWindow(id,marker);
      }    
    } 
  });  
}

function galleryType(){
  hapus_menu();

  var x = document.getElementById('gal_ht').value;
  $('#view_kanan_table').show();
  document.getElementById('judul_table').innerHTML="List Gallery";

  $('#kanan_table').empty();
  $('#kanan_table').append("<tr><th class='centered'>Name</th><th class='centered' colspan='3'>Action</th></tr>");
  console.log(server+'_gallery.php?tipe='+x);
  $.ajax({ 
  url: server+'_gallery.php?tipe='+x, data: "", dataType: 'json', success: function(rows) 
  { 
    for (var i in rows){ 
      var row = rows[i];
      var id = row.id;
      var name = row.name;
      var latitude=row.lat;
      var longitude = row.lng;
      var img = row.img;
      // console.log(id + latitude + longitude + img);
      $('#kanan_table').append("<tr><td><img style='max-height:100px;' src='../_foto/"+img+"'><br><center>"+name+"</center></td><td><a role='button' class='btn btn-success fa fa-info' title='info'  onclick='data_hotel_1_info(\""+id+"\")'></a></td><td><a role='button' class='btn btn-success fa fa-taxi' title='Angkot' onclick='angkot_sekitar(\""+id+"\")'></a></td></tr>");  

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

      klikInfoWindow(id,marker);
      }    
    } 
  });  
}