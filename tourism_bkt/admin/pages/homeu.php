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
                        <thead><th><h3><b>Tourism List</b></h3></th><th><h3><b>Action</b></h3></th></thead>
                        <tbody  style='vertical-align:top;'>
                        <?php 
                        $query = "SELECT tourism.id, tourism.name, tourism.address, tourism.open, tourism.close, tourism.ticket, tourism_type.name as tourism_type, st_x(st_centroid(tourism.geom)) as lon, st_y(st_centroid(tourism.geom)) as lat from tourism left join tourism_type on tourism_type.id=tourism.id_type join admin on admin.username = tourism.username where tourism.username ='$username'";
                        $hasil=mysqli_query($conn,$query);
                        while($data = mysqli_fetch_array($hasil)){
                          $id = $data['id'];
                          $nama = $data['name'];
                         
                        
                          
                         ?>
                          <tr><td><h4><?php echo $nama ?></h4></td><td><a href="?page=tourism_detail&id=<?php echo $id ?>"><i class="fa fa-eye" style="color: black;"></i></a></td></tr>
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