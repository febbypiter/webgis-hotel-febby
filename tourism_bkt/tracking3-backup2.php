<?php

	include('../connect.php');
    $lat1   = $_GET['lat1'];
    $lng1   = $_GET['lng1'];
    $lat2   = $_GET['lat2'];
    $lng2   = $_GET['lng2'];
    $rad    = 200;
    $ketemu = false;

    //OUTPUT
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
    $querysearch="SELECT id, geom, st_distance_sphere(ST_GeomFromText('POINT(".$lng1." ".$lat1.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng1." ".$lat1.")',-1), geom) <= ".$rad.""; 
	$hasil=mysqli_query($conn,$querysearch);

    //HIMPUN DATA ANGKOT YANG DEKAT DENGAN POSISI AWAL
    $geom_awal=array();     //BEDA
    $angkot_awal=array(); 
    $i=0;
    while(($baris = mysqli_fetch_array($hasil)) && $ketemu == false){
        $id_angkot=$baris['id'];
        $geom=$baris['geom'];

        $angkot_awal[$i]=$id_angkot;
        $geom_awal[$i]=$geom;
        $i++;
    }
    //echo "<br><br><br>";
    //echo json_encode ($dataarray);


    //TUJUAN
    $querysearch="SELECT id, geom, st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) as jarak FROM angkot where st_distance_sphere(ST_GeomFromText('POINT(".$lng2." ".$lat2.")',-1), geom) <= ".$rad.""; 
    $hasil=mysqli_query($conn,$querysearch);

    $geom_tujuan=array();
    $angkot_tujuan=array(); 
    $i=0;
    while(($baris = mysqli_fetch_array($hasil)) && $ketemu == false){
        $id_angkot=$baris['id'];
        $geom=$baris['geom'];

        $angkot_tujuan[$i]=$id_angkot;
        $geom_tujuan[$i]=$geom;
        $i++;
    }

    //OPSI 1 - 1 ANGKOT LANGSUNG SAMPAI
    //MEMBANDINGKAN ANGKOT AWAL YANG SAMA DENGAN ANGKOT TUJUAN
    $output=array();
    $z=0;
    for ($x=0; $x < count($angkot_awal); $x++) { 
        for ($i=0; $i < count($angkot_tujuan); $i++) { 
            if ($angkot_awal[$x] == $angkot_tujuan[$i]) {
                $output[$z][0] = $angkot_awal[$x];
                $ketemu = true;
                //echo "<script language='javascript'>alert('Opsi satu jalan');</script>";           
                break;
            }
        } //end for
        if($ketemu==true){
            break;
        }

    } //end for

    //OPSI 2 - 2 ANGKOT BERPOTONGAN LANGSUNG SAMPAI
    //MEMBANDINGKAN BERPOTONGAN
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE TUJUAN
    //LALU HASILNYA DICARI YANG TERADAPAT PADA ANGKOT AWAL
    if($ketemu==false){    
        unset($output);
        $output=array();
        $x=0;
        for ($i=0; $i < count($angkot_awal); $i++) { 

            $geom = $geom_awal[$i];
            $querysearch="SELECT id FROM angkot where ST_Crosses ('".$geom."' , geom)"; 
            $hasil=mysqli_query($conn,$querysearch);
            
            $output[$x][0]=$angkot_awal[$i];
            while($baris = mysqli_fetch_array($hasil)){
                $id_angkot=$baris['id'];
                for ($y=0; $y < count($angkot_tujuan); $y++){ 
                    if($angkot_tujuan[$y]==$id_angkot){
                        $output[$x][1]=$id_angkot;
                        //echo "<script language='javascript'>alert('Opsi dua jalan');</script>";   
                        $ketemu = true;
                    }
                }//end for
            }//end while

            if ($ketemu == true) {
                break;
            }
        } //end for

    }

    //OPSI 3 - 2 ANGKOT TIDAK BERPOTONGAN LANGSUNG SAMPAI
    //MEMBANDINGKAN RADIUS
    if($ketemu==false){     
        unset($output); 
        $output=array();
        $x=0;
        for ($i=0; $i < count($angkot_awal); $i++) { 

            $geom = $geom_awal[$i];
            $querysearch="SELECT id, geom, st_distance_sphere('".$geom."', geom) as jarak FROM angkot where st_distance_sphere('".$geom."', geom) <= ".$rad.""; 

            $hasil=mysqli_query($conn,$querysearch);
            
            $output[$x][0]=$angkot_awal[$i];
            while($baris = mysqli_fetch_array($hasil)){
                $id_angkot=$baris['id'];
                for ($y=0; $y < count($angkot_tujuan); $y++){ 
                    if($angkot_tujuan[$y]==$id_angkot){
                        $output[$x][1]=$id_angkot;

                        //echo "<script language='javascript'>alert('Opsi tiga jalan');</script>";   
                        $ketemu = true;
                    }
                }//end for
            }//end while

            if ($ketemu == true) {
                break;
            }
        } //end for
        
    }

    //OPSI 4 - 3 ANGKOT BERPOTONGAN LANGSUNG SAMPAI
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE AWAL
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE TUJUAN
    //MEMBANDINGKAN HASIL BERPOTONGAN DIATAS, DAN AMBIL YANG SAMA
    if($ketemu==false){      
        unset($output);
        $output=array();
        $x=0;

        //ANGKOT AWAL
        for ($i=0; $i < count($angkot_awal); $i++) { 
            $angkot_tengah_awal=array();

            // 1 ANGKOT AWAL
            $output[$x][0]=$angkot_awal[$i];

            //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN AWAL
            $geom = $geom_awal[$i];
            $querysearch="SELECT id FROM angkot where ST_Crosses ('".$geom."' , geom)"; 
            $hasil=mysqli_query($conn,$querysearch);
            $a=0;            
            while($baris = mysqli_fetch_array($hasil)){
                $id_angkot=$baris['id'];
                $angkot_tengah_awal[$a]=$id_angkot;
                $a++;
            }//end while

            //ANGKOT TUJUAN
            for ($q=0; ($q < count($angkot_tujuan) && $ketemu == false ); $q++) { 
                $angkot_tengah_tujuan=array();

                // 1 ANGKOT TUJUAN
                $output[$x][2]=$angkot_tujuan[$q];

                //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN TUJUAN
                $geom2 = $geom_tujuan[$q];
                $querysearch2="SELECT id FROM angkot where ST_Crosses ('".$geom2."' , geom)"; 
                $hasil2=mysqli_query($conn,$querysearch2);
                $w=0;            
                while($baris2 = mysqli_fetch_array($hasil2)){
                    $id_angkot2=$baris2['id'];
                    $angkot_tengah_tujuan[$w]=$id_angkot2;
                    $w++;
                }//end while                

                //BANDINGKAN ANGKOT TENGAH
                for ($e=0; ($e < count($angkot_tengah_awal) && $ketemu == false ); $e++) { 
                    for ($r=0; ($r < count($angkot_tengah_tujuan) && $ketemu == false ); $r++) { 
                        if($angkot_tengah_awal[$e] == $angkot_tengah_tujuan[$r]){
                            $output[$x][1]=$angkot_tengah_awal[$e];
                            //echo "<script language='javascript'>alert('Opsi empat jalan');</script>";   
                            $ketemu = true;
                        }//end if
                    }//end for
                }//end for

            }//end for


            if ($ketemu == true) {
                break;
            }//end if
        }//end for

    }

    //OPSI 5 - 1 dan 2 ANGKOT BERPOTONGAN LANGSUNG SAMPAI
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE AWAL
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE TUJUAN
    //MEMBANDINGKAN HASIL BERPOTONGAN DIATAS, DAN AMBIL YANG SAMA
    if($ketemu==false){      
        unset($output);
        $output=array();
        $x=0;

        //ANGKOT AWAL
        for ($i=0; $i < count($angkot_awal); $i++) { 
            $angkot_tengah_awal=array();

            // 1 ANGKOT AWAL
            $output[$x][0]=$angkot_awal[$i];

            //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN AWAL
            $geom = $geom_awal[$i];
//            $querysearch="SELECT id FROM angkot where ST_Crosses ('".$geom."' , geom)"; 
            $querysearch="SELECT id, geom, st_distance_sphere('".$geom."', geom) as jarak FROM angkot where st_distance_sphere('".$geom."', geom) <= ".$rad.""; 
            $hasil=mysqli_query($conn,$querysearch);
            $a=0;            
            while($baris = mysqli_fetch_array($hasil)){
                $id_angkot=$baris['id'];
                $angkot_tengah_awal[$a]=$id_angkot;
                $a++;
            }//end while

            //ANGKOT TUJUAN
            for ($q=0; ($q < count($angkot_tujuan) && $ketemu == false ); $q++) { 
                $angkot_tengah_tujuan=array();

                // 1 ANGKOT TUJUAN
                $output[$x][2]=$angkot_tujuan[$q];

                //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN TUJUAN
                $geom2 = $geom_tujuan[$q];
                $querysearch2="SELECT id FROM angkot where ST_Crosses ('".$geom2."' , geom)"; 
                $hasil2=mysqli_query($conn,$querysearch2);
                $w=0;            
                while($baris2 = mysqli_fetch_array($hasil2)){
                    $id_angkot2=$baris2['id'];
                    $angkot_tengah_tujuan[$w]=$id_angkot2;
                    $w++;
                }//end while                

                //BANDINGKAN ANGKOT TENGAH
                for ($e=0; $e < count($angkot_tengah_awal); $e++) { 
                    for ($r=0; $r < count($angkot_tengah_tujuan); $r++) { 
                        if($angkot_tengah_awal[$e] == $angkot_tengah_tujuan[$r]){
                            $output[$x][1]=$angkot_tengah_awal[$e];
                            //echo "<script language='javascript'>alert('Opsi lima jalan');</script>";   
                            $ketemu = true;
                        }//end if
                    }//end for
                }//end for

            }//end for


            if ($ketemu == true) {
                break;
            }//end if
        }//end for

    }



    //OPSI 6 - 2 ANGKOT BERPOTONGAN dan 1 LANGSUNG SAMPAI
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE AWAL
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE TUJUAN
    //MEMBANDINGKAN HASIL BERPOTONGAN DIATAS, DAN AMBIL YANG SAMA
    if($ketemu==false){      
        unset($output);
        $output=array();
        $x=0;

        //ANGKOT AWAL
        for ($i=0; $i < count($angkot_awal); $i++) { 
            $angkot_tengah_awal=array();

            // 1 ANGKOT AWAL
            $output[$x][0]=$angkot_awal[$i];

            //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN AWAL
            $geom = $geom_awal[$i];
            $querysearch="SELECT id FROM angkot where ST_Crosses ('".$geom."' , geom)"; 
            $hasil=mysqli_query($conn,$querysearch);
            $a=0;            
            while($baris = mysqli_fetch_array($hasil)){
                $id_angkot=$baris['id'];
                $angkot_tengah_awal[$a]=$id_angkot;
//                echo "$id_angkot";
                $a++;
            }//end while

            //ANGKOT TUJUAN
            for ($q=0; ($q < count($angkot_tujuan) && $ketemu == false ); $q++) { 
                $angkot_tengah_tujuan=array();

                // 1 ANGKOT TUJUAN
                $output[$x][2]=$angkot_tujuan[$q];

                //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN TUJUAN
                $geom2 = $geom_tujuan[$q];
                //$querysearch2="SELECT id FROM angkot where ST_Crosses ('".$geom2."' , geom)"; 
                $querysearch2="SELECT id, geom, st_distance_sphere('".$geom2."', geom) as jarak FROM angkot where st_distance_sphere('".$geom2."', geom) <= ".$rad."";
                $hasil2=mysqli_query($conn,$querysearch2);
                $w=0;            
                while($baris2 = mysqli_fetch_array($hasil2)){
                    $id_angkot2=$baris2['id'];
                    $angkot_tengah_tujuan[$w]=$id_angkot2;
//                    echo "$id_angkot2";
                    $w++;
                }//end while                

                //BANDINGKAN ANGKOT TENGAH
                for ($e=0; $e < count($angkot_tengah_awal); $e++) { 
                    for ($r=0; $r < count($angkot_tengah_tujuan); $r++) { 
                        if($angkot_tengah_awal[$e] == $angkot_tengah_tujuan[$r]){
                            $output[$x][1]=$angkot_tengah_awal[$e];
                            //echo "<script language='javascript'>alert('Opsi empat jalan');</script>";   
                            $ketemu = true;
                        }//end if
                    }//end for
                }//end for

            }//end for


            if ($ketemu == true) {
                break;
            }//end if
        }//end for

    }


    //OPSI 7 - 3 ANGKOT BERJARAK LANGSUNG SAMPAI
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE AWAL
    //MENCARI RUTE ANGKOT YANG BERPOTONGAN DENGAN RUTE TUJUAN
    //MEMBANDINGKAN HASIL BERPOTONGAN DIATAS, DAN AMBIL YANG SAMA
    if($ketemu==false){      
        unset($output);
        $output=array();
        $x=0;

        //ANGKOT AWAL
        for ($i=0; $i < count($angkot_awal); $i++) { 
            $angkot_tengah_awal=array();

            // 1 ANGKOT AWAL
            $output[$x][0]=$angkot_awal[$i];

            //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN AWAL
            $geom = $geom_awal[$i];
            //$querysearch="SELECT id FROM angkot where ST_Crosses ('".$geom."' , geom)"; 
            $querysearch="SELECT id, geom, st_distance_sphere('".$geom."', geom) as jarak FROM angkot where st_distance_sphere('".$geom."', geom) <= ".$rad."";
            $hasil=mysqli_query($conn,$querysearch);
            $a=0;            
            while($baris = mysqli_fetch_array($hasil)){
                $id_angkot=$baris['id'];
                $angkot_tengah_awal[$a]=$id_angkot;
//                echo "$id_angkot";
                $a++;
            }//end while

            //ANGKOT TUJUAN
            for ($q=0; ($q < count($angkot_tujuan) && $ketemu == false ); $q++) { 
                $angkot_tengah_tujuan=array();

                // 1 ANGKOT TUJUAN
                $output[$x][2]=$angkot_tujuan[$q];

                //HIMPUN ANGKOT TENGAH BERPOTONGAN DENGAN TUJUAN
                $geom2 = $geom_tujuan[$q];
                $querysearch2="SELECT id, geom, st_distance_sphere('".$geom2."', geom) as jarak FROM angkot where st_distance_sphere('".$geom2."', geom) <= ".$rad."";
                $hasil2=mysqli_query($conn,$querysearch2);
                $w=0;            
                while($baris2 = mysqli_fetch_array($hasil2)){
                    $id_angkot2=$baris2['id'];
                    $angkot_tengah_tujuan[$w]=$id_angkot2;
//                    echo "$id_angkot2";
                    $w++;
                }//end while                

                //BANDINGKAN ANGKOT TENGAH
                for ($e=0; $e < count($angkot_tengah_awal); $e++) { 
                    for ($r=0; $r < count($angkot_tengah_tujuan); $r++) { 
                        if($angkot_tengah_awal[$e] == $angkot_tengah_tujuan[$r]){
                            $output[$x][1]=$angkot_tengah_awal[$e];
                            //echo "<script language='javascript'>alert('Opsi empat jalan');</script>";   
                            $ketemu = true;
                        }//end if
                    }//end for
                }//end for

            }//end for


            if ($ketemu == true) {
                break;
            }//end if
        }//end for

    }



    if ($ketemu == false) { 
        unset($output);
    }//end if


    //OUTPUT RUTE
    $hasil = array();
    $rute=array();
    $pjg = count($output);
    //echo "<br><br> OUTPUT $pjg <br>";
    for ($i=0; $i < count($output); $i++) { 
        unset($rute);
        for ($a=0; $a < count($output[$i]); $a++) { 
            $rute[]=$output[$i][$a];
        }
        $hasil[]=array("rute_ke"=>$i+1,"data"=>$rute);
    }
    $arr=array("jumlah"=>$i, "data"=>$hasil);

    echo json_encode($arr);

?>