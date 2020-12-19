<?php
    //tidak pakai
    include('../connect.php');
    $lat1 = $_GET['lat1'];
    $lng1 = $_GET['lng1'];
    $lat2 = $_GET['lat2'];
    $lng2 = $_GET['lng2'];
    $rad=$_GET['rad'];

    //OUTPUT
    $angkot_output=array();
    /*
        - Himpun angkot sekitar lokasi awal
        - Himpun angkot sekitar lokasi tujuan
        - Himpun kondisi OR untuk query perbandingan
        - Membandingkan
            - Perulangan angkot awal
            - Perulangan angkot tujuan
            - Jika ID sama, langsung dicatat
            - Jika tidak ada yang sama satupun dibandingkan dengan angkot tujuan, dicari yang paling dekat
    */

    //AWAL
    $querysearch="SELECT id_angkot, geom, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$lng1." ".$lat1.")',-1), geom) as jarak FROM _angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng1." ".$lat1.")',-1), geom) <= ".$rad.""; 
    $hasil=mysqli_query($conn,$querysearch);

    //HIMPUN DATA ANGKOT YANG DEKAT DENGAN POSISI AWAL
    $geom_awal=array();
    $angkot_awal=array(); 
    $i=0;
    while($baris = mysqli_fetch_array($hasil)){
        $id_angkot=$baris['id_angkot'];
        $geom=$baris['geom'];
        $latitude=$baris['lat'];
        $longitude=$baris['lng'];
        // echo "$id_angkot ";
        $dataarray[]=array('id_angkot'=>$id_angkot,  "latitude"=>$latitude,"longitude"=>$longitude);

        $angkot_awal[$i]=$id_angkot;
        $geom_awal[$i]=$geom;
        //        echo "$angkot_awal[$i] <br>";
        //      echo "$geom_awal[$i] <br>";
        $i++;
    }
    //echo "<br><br><br>";
    //echo json_encode ($dataarray);


    //TUJUAN
    $querysearch="SELECT id_angkot, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) as jarak FROM _angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) <= ".$rad.""; 
    $hasil=mysqli_query($conn,$querysearch);

    $geom_tujuan=array();
    $angkot_tujuan=array(); 
    $i=0;
    while($baris = mysqli_fetch_array($hasil)){
        $id_angkot=$baris['id_angkot'];
        $latitude=$baris['lat'];
        $longitude=$baris['lng'];
        $dataarrays[]=array('id_angkot'=>$id_angkot,  "latitude"=>$latitude,"longitude"=>$longitude);
        //echo " s $id_angkot ";

        $angkot_tujuan[$i]=$id_angkot;
        $geom_tujuan[$i]=$geom;
        $i++;
    }
    //echo "<br><br><br>";
    //echo json_encode ($dataarrays);

    //HIMPUN KONDISI OR
    $or="";
    $pjg = count($angkot_tujuan);
    for ($i=0; $i < $pjg; $i++) { 
        if ($or == "") {
            $or = $or." id_angkot= '".$angkot_tujuan[$i]."'";             
        }else{
            $or = $or." OR id_angkot= '".$angkot_tujuan[$i]."'";             
        }
    }
    //echo "<br> $or <br>";

    //MEMBANDINGKAN
    $output=array();
    for ($x=0; $x < count($angkot_awal); $x++) { 
        for ($i=0; $i < count($angkot_tujuan); $i++) { 
            //ANGKOT AWAL LANGSUNG SAMPAI TUJUAN
            //echo "<br> awal $angkot_awal[$x] - $angkot_tujuan[$i] ";
            if ($angkot_awal[$x] == $angkot_tujuan[$i]) {
                $output[$x][0] = $angkot_awal[$x];
                //echo " jalan <br>";
                break;
            }
            $z=$i+1; 
            if ($z == count($angkot_tujuan)) {
                //echo " dakjalan <br>";
                    //HITUNG JARAK ANGKOT AWAL DAN ANGKOT TUJUAN
                    $angkot_awal[$x]; 
                    // Dibandingkan Satu" dengan angkot tujuan, cari yang paling dekat

                $querysearch="SELECT id_angkot, st_x(st_centroid(geom)) as lng, st_y(st_centroid(geom)) as lat, st_distance_sphere('".$geom_awal[$x]."', geom) as jarak FROM _angkot where ".$or."order by jarak LIMIT 1"; 
                $hasil=mysqli_query($conn,$querysearch);
                
                $output[$x][0]=$angkot_awal[$x];
                while($baris = mysqli_fetch_array($hasil)){
                    $id_angkot=$baris['id_angkot'];
                    $latitude=$baris['lat'];
                    $longitude=$baris['lng'];

                    $output[$x][1]=$id_angkot;
                    //echo "$id_angkot ";
                }

            }
        } //end for
    } //end for

    //OUTPUT RUTE
    $hasil = array();
    $rute=array();
    $pjg = count($output);
    //echo "<br><br> OUTPUT $pjg <br>";
    for ($i=0; $i < count($output); $i++) { 
        unset($rute);
        for ($a=0; $a < count($output[$i]); $a++) { 
            $rute[]=$output[$i][$a];
            //echo $output[$i][$a];
        }
        $hasil[]=array("rute_ke"=>$i+1,"data"=>$rute);
    }
    $arr=array("jumlah"=>$i, "data"=>$hasil);

    echo json_encode($arr);


?>