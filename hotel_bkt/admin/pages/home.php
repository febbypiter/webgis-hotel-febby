<?php 

$username = $_SESSION['username'];
 ?>
<div class="col-sm-12">  <!-- menampilkan list mosque-->
    <section class="panel">
        <div class="panel-body">
            <a href="?page=hotel_add" title="Add Hotel" class="btn btn-compose"><i class="fa fa-plus"></i>Add Hotel</a>
            <div class="box-body">
                <div class="form-group">
                    <form method="post" action="pages/hotel_detail.php">
                        <input type="text" name="username" class="hidden">
                    
                    <table id="example2" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Option</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php                       
                            $sql = mysqli_query($conn,"SELECT * FROM hotel order by id ASC");
                            while($data =  mysqli_fetch_array($sql)){
                            $id = $data['id'];
                            $nama = $data['name'];
                            $alamat = $data['address'];
                        ?>
                            <tr>
                                <td><?php echo "$id"; ?></td>
                                <td><?php echo "$nama"; ?></td>
                                <td><?php echo "$alamat"; ?></td>
                                <td>
                                    <div class="btn-group">
                						<a href="?page=hotel_detail&id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Detail'><i class="fa fa-list"></i> Detail</a>
                						<a href="act/hotel_delete.php?id=<?php echo $id; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                                    </div>
                                </td>
                            </tr>
                        <?php } ?>
                        </tbody>    
                    </table> 
                    </form>
                </div>                   
            </div>
        </div>
    </section>
</div>