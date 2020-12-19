<?php
require '../connect.php';

    //DATA TEMPAT WISATA PILIHAN
    // $lat[0]="-0.301554107668303,100.364987942464";
    // $lat[1]="-0.3017996,100.3644174";

    $total=$_GET["total"];
    $lat = array();

    for ($i=0; $i < $total; $i++) { 
        $nilai = $_GET["nilai$i"];
        $lat[$i] = $nilai;

//        echo "nilai <br> ";
  //      echo $lat[$i];
    }

    $arr = array("data" => $lat);
    $x = json_encode($arr);    

    $array = json_decode($x, true);
    $i=0;$koor=array();
    while ($i < count($array['data'])) {
        $koor[$i] = $array['data'][$i];
        $i++;
    } 

    //HOTEL
    $o_hotel = array();
    $sql_hotel = mysqli_query($conn,"select id, name, ST_X(ST_Centroid(geom)) AS lng, ST_Y(ST_CENTROID(geom)) As lat from hotel");

    $jumlah_hotel=0;
    while($baris = mysqli_fetch_array($sql_hotel))
        {
            $id_hotel=$baris['id'];
            $latitude=$baris['lat'];
            $longitude=$baris['lng'];
            $nama=$baris['name'];

            $o_hotel[$jumlah_hotel][0]=$id_hotel;
            $o_hotel[$jumlah_hotel][1]=$latitude;
            $o_hotel[$jumlah_hotel][2]=$longitude;
            $o_hotel[$jumlah_hotel][3]=0;
            $o_hotel[$jumlah_hotel][11]=$nama;

            $jumlah_hotel++;
        }

    //BANDING OBJECT DENGAN HOTEL
    for ($i=0; $i < count($koor); $i++) { 

        //PISAHKAN LATITUDE DAN LONGITUDE
        $koordinat = explode(",", $koor[$i]);
        /*echo "<br> lat ";    
        echo $koordinat[0];
        echo "<br> lng ";    
        echo $koordinat[1];*/
        $a=0;$b=0;
        $output_hotel=array();
        $lat = $koordinat[0];
        $lon = $koordinat[1];

        while ($a < count($o_hotel)) {
            $lat2=$o_hotel[$a][1];
            $lon2=$o_hotel[$a][2];

            //HITUNG JARAK
            $theta = $lon - $lon2;
            $dist = sin(deg2rad($lat)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
            $dist = acos($dist);
            $dist = rad2deg($dist);
            $miles = $dist * 60 * 1.1515;
            //$unit = strtoupper($unit);
            $jarak = $miles * 1.609344;

            $o_hotel[$a][3] += $jarak;

            $a++;
        }//end while
    }

    //URUT ISI ARRAY HOTEL BERDASARKAN JARAK
    for ($c=0; $c < count($o_hotel) ;$c++) {
        for ($d=0;$d < count($o_hotel)-1;$d++) {
            if ($o_hotel[$d][3] > $o_hotel[$d+1][3]) {
                //PINDAH ID
                $temp = $o_hotel[$d][0];
                $o_hotel[$d][0] = $o_hotel[$d+1][0];
                $o_hotel[$d+1][0] = $temp;

                //PINDAH LAT
                $temp = $o_hotel[$d][1];
                $o_hotel[$d][1] = $o_hotel[$d+1][1];
                $o_hotel[$d+1][1] = $temp;

                //PINDAH LNG
                $temp = $o_hotel[$d][2];
                $o_hotel[$d][2] = $o_hotel[$d+1][2];
                $o_hotel[$d+1][2] = $temp;

                //PINDAH JARAK
                $temp = $o_hotel[$d][3];
                $o_hotel[$d][3] = $o_hotel[$d+1][3];
                $o_hotel[$d+1][3] = $temp;

                //PINDAH NAMA
                $temp = $o_hotel[$d][11];
                $o_hotel[$d][11] = $o_hotel[$d+1][11];
                $o_hotel[$d+1][11] = $temp;
            }
        }//end for
    }//end for

    //Ambil Output 5 Hotel dengan jarak terdekat
    $output_hotel=array();
    for ($i=0; $i < count($o_hotel); $i++) { 
        //0=id  1=jarak  2=lat   3=long
        $output_hotel[$i][0] = $o_hotel[$i][0];
        $output_hotel[$i][1] = $o_hotel[$i][3];
        $output_hotel[$i][2] = $o_hotel[$i][1];
        $output_hotel[$i][3] = $o_hotel[$i][2];
        $output_hotel[$i][11] = $o_hotel[$i][11];
    }

    //INDUSTRI
    //BANDING OBJECT DENGAN INDUSTRI
    for ($objek=0 ; $objek<count($o_hotel) ; $objek++) { 

        $lat_hotel = $output_hotel[$objek][2];     
        $long_hotel = $output_hotel[$objek][3];     

        $querysearch="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM small_industry where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 500 "; 
        $hasil=mysqli_query($conn,$querysearch);

        $querysearch2="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM small_industry where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 1000 "; 
        $hasil2=mysqli_query($conn,$querysearch2);

        //PANJANG BARIS
        $row = mysqli_num_rows($hasil);
        $row2 = mysqli_num_rows($hasil2);
        if ($row > 0) {
            $output_hotel[$objek][4] = $row*0.9;
        } elseif ($row2 > 0) {
            $output_hotel[$objek][4] = $row2*0.5;
        } else {
            $output_hotel[$objek][4] = 0.1;            
        }

    }

    //KULINER
    //BANDING HOTEL DENGAN KULINER
    for ($objek=0 ; $objek<count($o_hotel) ; $objek++) { 

        $lat_hotel = $output_hotel[$objek][2];     
        $long_hotel = $output_hotel[$objek][3];     

        $querysearch="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM culinary_place where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 500"; 
        $hasil=mysqli_query($conn,$querysearch);

        $querysearch2="SELECT id_kuliner, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM culinary_place where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 1000"; 
        $hasil2=mysqli_query($conn,$querysearch2);

        //PANJANG BARIS
        $row = mysqli_num_rows($hasil);
        $row2 = mysqli_num_rows($hasil2);
        if ($row > 0) {
            $output_hotel[$objek][5] = $row*0.9;
        } elseif ($row2 > 0) {
            $output_hotel[$objek][5] = $row2*0.5;
        } else {
            $output_hotel[$objek][5] = 0.1;            
        }

    }
        

    //MASJID
    //BANDING HOTEL DENGAN MASJID
    for ($objek=0 ; $objek<count($o_hotel) ; $objek++) { 

        $lat_hotel = $output_hotel[$objek][2];     
        $long_hotel = $output_hotel[$objek][3];     

        $querysearch="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM worship_place where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 500"; 
        $hasil=mysqli_query($conn,$querysearch);

        $querysearch2="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM worship_place where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 1000 "; 
        $hasil2=mysqli_query($conn,$querysearch2);

        //PANJANG BARIS
        $row = mysqli_num_rows($hasil);
        $row2 = mysqli_num_rows($hasil2);
        if ($row > 0) {
            $output_hotel[$objek][6] = $row*0.9;
        } elseif ($row2 > 0) {
            $output_hotel[$objek][6] = $row2*0.5;
        } else {
            $output_hotel[$objek][6] = 0.1;            
        }

    }


    //OLEH-OLEH
    //BANDING HOTEL DENGAN OLEH-OLEH
    for ($objek=0 ; $objek<count($o_hotel) ; $objek++) { 

        $lat_hotel = $output_hotel[$objek][2];     
        $long_hotel = $output_hotel[$objek][3];     

        $querysearch="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM souvenir where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 500 "; 
        $hasil=mysqli_query($conn,$querysearch);

        $querysearch2="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM souvenir where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 1000 "; 
        $hasil2=mysqli_query($conn,$querysearch2);

        //PANJANG BARIS
        $row = mysqli_num_rows($hasil);
        $row2 = mysqli_num_rows($hasil2);
        if ($row > 0) {
            $output_hotel[$objek][7] = $row*0.9;
        } elseif ($row2 > 0) {
            $output_hotel[$objek][7] = $row2*0.5;
        } else {
            $output_hotel[$objek][7] = 0.1;            
        }

    }

    //TEMPAT WISATA
    //BANDING HOTEL DENGAN TEMPAT WISATA
    for ($objek=0 ; $objek<count($o_hotel) ; $objek++) { 

        $lat_hotel = $output_hotel[$objek][2];     
        $long_hotel = $output_hotel[$objek][3];     

        $querysearch="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM _tourism where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 500"; 
        $hasil=mysqli_query($conn,$querysearch);

        $querysearch2="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM _tourism where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 1000"; 
        $hasil2=mysqli_query($conn,$querysearch2);

        //PANJANG BARIS
        $row = mysqli_num_rows($hasil);
        $row2 = mysqli_num_rows($hasil2);
        if ($row > 0) {
            $output_hotel[$objek][8] = $row*0.9;
        } elseif ($row2 > 0) {
            $output_hotel[$objek][8] = $row2*0.5;
        } else {
            $output_hotel[$objek][8] = 0.1;            
        }

    }

    //ANGKOT
    //BANDING HOTEL DENGAN ANGKOT
    for ($objek=0 ; $objek<count($o_hotel) ; $objek++) { 

        $lat_hotel = $output_hotel[$objek][2];     
        $long_hotel = $output_hotel[$objek][3];     

        $querysearch="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 500"; 
        $hasil=mysqli_query($conn,$querysearch);

        $querysearch2="SELECT id, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$long_hotel." ".$lat_hotel.")',-1), geom) <= 1000"; 
        $hasil2=mysqli_query($conn,$querysearch2);


        //PANJANG BARIS
        $row = mysqli_num_rows($hasil);
        $row2 = mysqli_num_rows($hasil2);
        if ($row > 0) {
            $output_hotel[$objek][9] = $row*0.9;
        } elseif ($row2 > 0) {
            $output_hotel[$objek][9] = $row2*0.5;
        } else {
            $output_hotel[$objek][9] = 0.1;            
        }

    }

//total jumlah objek;
for($a=0;$a<count($o_hotel);$a++){
    $output_hotel[$a][10] = $output_hotel[$a][4]+$output_hotel[$a][5]+$output_hotel[$a][6]+$output_hotel[$a][7]+$output_hotel[$a][8]+$output_hotel[$a][9];

}

    //URUT BERDASARKAN JUMLAH OBJEK
    for ($c=0; $c < count($o_hotel) ; $c++) {
        for ($d=0;$d < count($o_hotel)-1; $d++) {
            if ($output_hotel[$d][10] < $output_hotel[$d+1][10]) {

                //PINDAH ID
                $temp = $output_hotel[$d][0];
                $output_hotel[$d][0] = $output_hotel[$d+1][0];
                $output_hotel[$d+1][0] = $temp;

                //PINDAH JARAK
                $temp = $output_hotel[$d][1];
                $output_hotel[$d][1] = $output_hotel[$d+1][1];
                $output_hotel[$d+1][1] = $temp;

                //PINDAH LAT
                $temp = $output_hotel[$d][2];
                $output_hotel[$d][2] = $output_hotel[$d+1][2];
                $output_hotel[$d+1][2] = $temp;

                //PINDAH LONG
                $temp = $output_hotel[$d][3];
                $output_hotel[$d][3] = $output_hotel[$d+1][3];
                $output_hotel[$d+1][3] = $temp;

                //PINDAH INDUSTRI
                $temp = $output_hotel[$d][4];
                $output_hotel[$d][4] = $output_hotel[$d+1][4];
                $output_hotel[$d+1][4] = $temp;

                //PINDAH KULINER
                $temp = $output_hotel[$d][5];
                $output_hotel[$d][5] = $output_hotel[$d+1][5];
                $output_hotel[$d+1][5] = $temp;

                //PINDAH MASJID
                $temp = $output_hotel[$d][6];
                $output_hotel[$d][6] = $output_hotel[$d+1][6];
                $output_hotel[$d+1][6] = $temp;

                //PINDAH OLEH-OLEH
                $temp = $output_hotel[$d][7];
                $output_hotel[$d][7] = $output_hotel[$d+1][7];
                $output_hotel[$d+1][7] = $temp;

                //PINDAH TEMPAT WISATA
                $temp = $output_hotel[$d][8];
                $output_hotel[$d][8] = $output_hotel[$d+1][8];
                $output_hotel[$d+1][8] = $temp;

                //PINDAH ANGKOT
                $temp = $output_hotel[$d][9];
                $output_hotel[$d][9] = $output_hotel[$d+1][9];
                $output_hotel[$d+1][9] = $temp;

                //PINDAH TOTAL OBJEK SEKITAR
                $temp = $output_hotel[$d][10];
                $output_hotel[$d][10] = $output_hotel[$d+1][10];
                $output_hotel[$d+1][10] = $temp;

                //PINDAH NAMA HOTEL
                $temp = $output_hotel[$d][11];
                $output_hotel[$d][11] = $output_hotel[$d+1][11];
                $output_hotel[$d+1][11] = $temp;
            }
        }//end for
    }//end for

/*
echo "<br> OUPUT URUT <br>";
//cek keluaran;
for($a=0;$a<5;$a++){
    0 ID            6. Masjid
    1 Jarak         7. Oleh-Oleh
    2 lat           8. Tempat Wisata
    3 lng           9. Angkot
    4 Industri      10. Total
    5 Kuliner
    echo "<br> id ";
    echo $output_hotel[$a][0];
    echo "<br> jarak ";
    echo $output_hotel[$a][1];
    echo "<br> lat ";
    echo $output_hotel[$a][2];
    echo "<br> long ";
    echo $output_hotel[$a][3];
    echo "<br> Total Industri ";
    echo $output_hotel[$a][4];
    echo "<br> Total Kuliner ";
    echo $output_hotel[$a][5];
    echo "<br> Total Masjid ";
    echo $output_hotel[$a][6];
    echo "<br> Total Oleh-Oleh ";
    echo $output_hotel[$a][7];
    echo "<br> Total Tempat wisata ";
    echo $output_hotel[$a][8];
    echo "<br> Total Angkot ";
    echo $output_hotel[$a][9];
    echo "<br> Total Objek Sekitar";
    echo $output_hotel[$a][10];
    echo "<br>";
    echo "<br>";
}
*/

//    for ($a=0; $a < count($o_hotel) ; $a++) { 
    for ($a=0; $a < 5 ; $a++) { 

        $id_hotel = $output_hotel[$a][0];
        $sql_hotel = mysqli_query($conn,"select hotel.id, hotel.name, hotel.address, hotel.cp, hotel.ktp, hotel.marriage_book, hotel.mushalla, hotel.star, hotel_type.name as type_hotel ST_X(ST_Centroid(hotel.geom)) AS lng, ST_Y(ST_CENTROID(hotel.geom)) As lat from hotel left join hotel_type on hotel_type.id=hotel.id WHERE id = '$id_hotel'");
        while($baris = mysqli_fetch_array($sql_hotel))
            {
                $dataarray[]=array('id_hotel'=>$output_hotel[$a][0],'jarak'=>$output_hotel[$a][1],'lat'=>$output_hotel[$a][2],'lng'=>$output_hotel[$a][3], 'total_industri'=>$output_hotel[$a][4],'total_kuliner'=>$output_hotel[$a][5],'total_masjid'=>$output_hotel[$a][6],'total_oleh'=>$output_hotel[$a][7],'total_tw'=>$output_hotel[$a][8],'total_angkot'=>$output_hotel[$a][9],'total_objek'=>$output_hotel[$a][10],'name'=>$output_hotel[$a][11],'address'=>$baris['address'],'cp'=>$baris['cp'],'ktp'=>$baris['ktp'],'marriage_book'=>$baris['marriage_book'],'mushalla'=>$baris['mushalla'],'star'=>$baris['star'],'type_hotel'=>$baris['type_hotel']);
            }


    }

    if ($total == 0) {
        echo "null";        
    }else{
        echo json_encode ($dataarray);        
    }



?>