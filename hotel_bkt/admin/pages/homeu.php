<?php 
include ('../../connect.php');
//session_start();
$id = $_GET["id"];
$id_hotel = $_SESSION['id'];
$username = $_SESSION['username'];

?>
<div class="col-lg-12 main-chart" > 
           <div class="col-sm-12">
             
                  <section class="panel">                   

                    <div class="panel-body">
                      <table class="table">
                        <thead><th><h3><b>Hotel List</b></h3></th><th><h3><b>Action</b></h3></th></thead>
                        <tbody  style='vertical-align:top;'>
                        <?php 
                        $query = "SELECT hotel.id, hotel.name, hotel.address, hotel.cp, hotel.ktp, hotel.marriage_book, hotel.mushalla, hotel.star, hotel_type.name as type_hotel, st_x(st_centroid(hotel.geom)) as lon,st_y(st_centroid(hotel.geom)) as lat, admin.username, admin.name as nama_admin  from hotel left join hotel_type on hotel_type.id=hotel.id_type join admin on admin.username = hotel.username where hotel.username='$username'";
                        $hasil=mysqli_query($conn,$query);
                        while($data = mysqli_fetch_array($hasil)){
                          $id = $data['id'];
                          $nama = $data['name'];
                         
                        
                          
                         ?>
                          <tr><td><h4><?php echo $nama ?></h4></td><td><a href="?page=hotel_detail&id=<?php echo $id ?>"><i class="fa fa-eye" style="color: black;"></i></a></td></tr>
                        <?php } ?>                          
                        </tbody>          
                      </table>
                      
                    </div>
                  </section>
            
              </div>

             
                  
                </div>
                
              </div>
          
            </div>
          </div> 