<?php
    //tidak digunakan
	include('../connect.php');
    $lat1 = $_GET['lat1'];
    $lng1 = $_GET['lng1'];
    $lat2 = $_GET['lat2'];
    $lng2 = $_GET['lng2'];
    $rad=$_GET['rad'];

    //OUTPUT
    $angkot_output=array();
    /*
        angkot_output[$a][$b][$c]
        *0   0  0 id rute
         0  *1  0 = id_angkot awal - setelahnya   -> Increment disini untuk setiap angkot tambahan dengan $a tetap (0 = angkot awal)
         0   0  2 = o -> Jika rute belum selesai    1 -> Jika sampai tujuan
         0   0  1 = geom
        $c 1 = geom
    */

    //AWAL
    echo " <br> AWAL<br>";
	$querysearch="SELECT id_angkot, geom, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$lng1." ".$lat1.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng1." ".$lat1.")',-1), geom) <= ".$rad.""; 
	$hasil=mysqli_query($conn,$querysearch);

    //HIMPUN DATA ANGKOT YANG DEKAT DENGAN POSISI AWAL
    $angkot_awal=array(); $i=0;
    while($baris = mysqli_fetch_array($hasil)){
        $id_angkot=$baris['id_angkot'];
        $geom=$baris['geom'];
        $latitude=$baris['lat'];
        $longitude=$baris['lng'];

        //HIMPUN DATA ANGKOT AWAL KE OUTPUT ANGKOT
        $angkot_output[$i][0][0]=$id_angkot;
        $angkot_output[$i][0][1]=$geom;

        $angkot_awal[$i]=$id_angkot;

        echo " $id_angkot ";
        $i++;
    }
    echo "<br>";

    //MENCARI ANGKOT YANG LANGSUANG SAMPAI KE TUJUAN DARI POSISI AWAL
    $kon="";
    for ($i=0; $i < count($angkot_awal); $i++) { 

        $id_angkot=$angkot_output[$i][0][0];
        $kon = $kon."and id_angkot != '".$id_angkot."' ";

        $querysearch2="SELECT id_angkot, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) <= ".$rad." and id_angkot ='".$id_angkot."'"; 
        $hasil2=mysqli_query($conn,$querysearch2);

        while ($baris2 = mysqli_fetch_array($hasil2)) {
            $id_angkot=$baris2['id_angkot'];
            $latitude=$baris2['lat'];
            $longitude=$baris2['lng'];
            $dataarray[]=array('id_angkot'=>$id_angkot,  "latitude"=>$latitude,"longitude"=>$longitude);                

            $angkot_output[$i][0][2]=1;
            echo "ada $id_angkot";
            echo "<br>";
        }

    }
    $kon= "";
    echo "syarat $kon";
    echo json_encode ($dataarray);
    echo "<br><br><br><br><br>";





    //MENCARI ANGKOT DI SEKITAR ANGKOT AWAL
    for ($i=0; $i < count($angkot_output); $i++) { 

        if ($angkot_output[$i][0][2] == 1) {
            break;
        }

        $id = $angkot_output[$i][0][0];
        $geom = $angkot_output[$i][0][1];
        echo "mulai <br>";
        echo "<br> $id <br> ";
        $querysearch2="SELECT id_angkot, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere( '".$geom."' , geom) as jarak FROM angkot where st_distance_sphere('".$geom."', geom) <= ".$rad." ".$kon.""; 

        $hasil2=mysqli_query($conn,$querysearch2);
        $x=1;
        while ($baris2 = mysqli_fetch_array($hasil2)) {
            $id_angkot=$baris2['id_angkot'];
            echo " $id_angkot ";
            $geom=$baris2['geom'];

            $angkot_output[$i][$x][0]=$id_angkot;
            $angkot_output[$i][$x][1]=$geom;
            $x++;
        }

    }
    echo json_encode ($dataarray);




    //TUJUAN
    echo " <br><br> TUJUAN<br>";
    $querysearch="SELECT id_angkot, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) <= ".$rad.""; 
    $hasil=mysqli_query($conn,$querysearch);

    $angkot_tujuan=array();
    while($baris = mysqli_fetch_array($hasil)){
        echo " $id_angkot ";
        $id_angkot=$baris['id_angkot'];
        $latitude=$baris['lat'];
        $longitude=$baris['lng'];
        $dataarray[]=array('id_angkot'=>$id_angkot,  "latitude"=>$latitude,"longitude"=>$longitude);
    }
    echo json_encode ($dataarray);






?>