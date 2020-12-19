<?php if (isset($_GET['id'])){
	$id_hotel=$_GET['id'];
	//$id_culinary=$_GET['id_culinary'];
	//echo $id_room;
?>
<section id="container" >
<div class="col-sm-12">
<section class="panel">
                    <div class="panel-body">
                        <h2 style="text-transform:capitalize;">Room <?php echo $data1['name'] ?></h2>
                        <div class="box-body" >
        <table id="example3" class="table table-hover table-bordered table-striped">
                        <thead>
                        <tr>
                        <th>Room</th>
                        <th>Price</th>
                        <th>Action</th>

                        </tr>
                        </thead>
                        <tbody>

                        <?php
                       
                        $sql = mysqli_query($conn,"SELECT room.id, room.name, room.price FROM room left join detail_room on detail_room.id_room = room.id left join hotel on hotel.id = detail_room.id_hotel where hotel.id = '".$id_hotel."'");
                        while($data =  mysqli_fetch_array($sql)){
                        	$id_room = $data['id'];
                        $nama_room = $data['name'];
                        $price_room = $data['price'];
                        ?>
                        <tr>
                        <td><?php echo "$nama_room"; ?></td>
                        <td><?php echo "$price_room"; ?></td>
                        <td><div class="btn-group">
                        <a href="?page=updateroom&id=<?php echo $id_room; ?>" class="btn btn-sm btn-default" title='Update'><i class="fa fa-edit"></i>Update</a>
						
						<a href="act/delroom.php?id_room=<?php echo $id_room; ?>" class="btn btn-sm btn-default" title='Delete'><i class="fa fa-trash-o"></i></a>
						</div>
                        </td>
                        </tr>
                        <?php } ?>
                        </tbody>
                        </table> 
                        
           


        <form role="form" action="act/addroomhotel.php" method="post">
            <input type="text" class="form-control hidden" name="id_hotel" value="<?php echo $id_hotel ?>">
      <a class="btn btn-success btn-sm" onclick="addroom()"><i class="fa fa-plus"></i></a>
          <a class="btn btn-danger btn-sm" onclick="rem()"><i class="fa fa-times"></i></a>
          <button type="submit" class="btn btn-primary pull-right">Save <i class="fa fa-floppy-o"></i></button>
        <table class="table">
        <thead>
        <tr>
            <th><label>Room</label></th><th><label>Price</label></th>
        </tr>
        </thead>
        <tbody id="l_form" class="xx">
        <tr >
            <td><input type="text" class="form-control" name="room[]" value="" style="margin-bottom:3px;" autofocus required></td>
            <td><input type="text" class="form-control" name="roomprice[]" value="" style="margin-bottom:3px;" required></td>
        </tr>
       
        </tbody>
        </table>

        </form>
                  </div>
                    </div>
                </section>
</div>
</section>

<?php } ?>

<!-- </div>
</div>
</div> -->
