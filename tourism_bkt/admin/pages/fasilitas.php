<div class="col-sm-12">  <!-- menampilkan fasilitas-->
    <section class="panel">
        <div class="panel-body">
            <a href="?page=fasilitas_add" class="btn btn-compose" title="Add Facility"><i class="fa fa-plus"></i>Facility</a>
            <div class="box-body">
                <div class="form-group">
                    <table id="example3" class="table table-hover table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Facility</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                        <?php
                            $sql = mysqli_query($conn,"SELECT * FROM facility_tourism order by id ASC");
                            while($data =  mysqli_fetch_array($sql)){
                            $id_fasilitas = $data['id'];
                            $nama_fasilitas = $data['name'];
                        ?>
                            <tr>
                                <td><?php echo "$id_fasilitas"; ?></td>
                                <td><?php echo "$nama_fasilitas"; ?></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="?page=fasilitas_update&id=<?php echo $id_fasilitas; ?>" class="btn btn-sm btn-default" title='Update'><i class="fa fa-edit"></i>Update</a>
                            			<a href="act/fasilitas_delete.php?id_fasilitas=<?php echo $id_fasilitas; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
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