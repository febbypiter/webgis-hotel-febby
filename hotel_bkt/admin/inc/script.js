function add(){
  $('#l_form').append('<input type="text" class="form-control" name="fasilitas[]" value="" style="margin-bottom:3px;" required>');
}
function addroom(){
  $('#l_form').append('<tr class="xx"><td ><input type="text" class="form-control" name="room[]" value="" style="margin-bottom:3px;" required></td><td ><input type="text" class="form-control" name="roomprice[]" value="" style="margin-bottom:3px;" required></td></tr>');
}
function rem(){
  var x = document.getElementById("l_form");
  var y = x.getElementsByClassName("xx");
  var last_y = y[y.length - 1];
  if (y.length>1){
    last_y.remove();
  }
}

