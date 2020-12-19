<div class="col-sm-12">  <!-- menampilkan fasilitas-->
    <section class="panel">
        <div class="panel-body">
           <!--  <?php 
            $sql = mysqli_query($conn,"SELECT * FROM admin where username='$username'");
            $data = mysqli_fetch_array($sql); 

                if($data['role']=='P') { ?>
                    <a href="?page=user_add" class="btn btn-compose" title="Add Facility"><i class="fa fa-plus"></i>List </a>
                <?php 
                }     

            ?> -->
            <a href="?page=user_add" class="btn btn-compose" title="Add User"><i class="fa fa-plus"></i>Add User</a>
            <div class="box-body">
                <div class="form-group">
                    <table id="example3" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Username</th>
                                <th>Name</th>
                                <th>No Hp</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            $sql = mysqli_query($conn,"SELECT name , hp, username from admin");
                            while($data =  mysqli_fetch_array($sql)){
                            //$id = $data['id'];
                            $username = $data['username'];
                            $nama = $data['name'];
                            $cp = $data['hp'];
                        ?>
                            <tr>
                                <td><?php echo "$username"; ?></td>
                                <td><?php echo "$nama"; ?></td>
                                <td><?php echo "$cp"; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="?page=user_update&username=<?php echo $username; ?>" class="btn btn-sm btn-default" title='Update'><i class="fa fa-edit"></i>Update</a>
                            			<a href="act/delete_user.php?id=<?php echo $username; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
                        			</div>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table> 
                </div>                   
            </div>
        </div>
    </section>
</div>