function add(){
  $('#l_form').append('<input type="text" class="form-control" name="fasilitas[]" value="" style="margin-bottom:3px;" required>');
}
function rem(){
  var x = document.getElementById("l_form");
  var y = x.getElementsByClassName("form-control");
  var last_y = y[y.length - 1];
  if (y.length>1){
    last_y.remove();
  }
}

