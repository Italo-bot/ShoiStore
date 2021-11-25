<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
$admin_email = $_SESSION['admin_email'];

$select_admin = "select * from admins where admin_email='$admin_email'";

$run_admin = mysqli_query($con,$select_admin);

$row_admin = mysqli_fetch_array($run_admin);

$admin_id = $row_admin['admin_id'];

?>

<link rel="stylesheet" href="css/chosen.min.css">

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Agregar tipo de envío

</li>

</ol>
</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Agregar tipo de envío

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-7">

<input type="text" name="type_name" class="form-control" >

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Tipo predeterminado </label>

<div class="col-md-7">

<label>
  <input type="radio" name="type_default" value="yes" required> si
</label>

<label>
  <input type="radio" name="type_default" value="no" required> No
</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Local </label>

<div class="col-md-7">

<label>
  <input type="radio" name="type_local" value="yes" required> Si
</label>

<label>
  <input type="radio" name="type_local" value="no" required> No
</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Agregar">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<script src="js/jquery.min.js"></script>

<script src="js/chosen.jquery.min.js"></script>

<script>

var config = {
  '.chosen-select': {}
}

for (var selector in config) {
  $(selector).chosen(config[selector]);
}

</script>

<?php

if(isset($_POST['submit'])){

$type_name = mysqli_real_escape_string($con,$_POST['type_name']);

$type_default = mysqli_real_escape_string($con,$_POST['type_default']);

$type_local = mysqli_real_escape_string($con,$_POST['type_local']);

if($type_default == "yes"){

$update_type_default = "update shipping_type set type_default='no' where type_local='$type_local'";

$run_type_default = mysqli_query($con,$update_type_default);
	
}

$insert_shipping_type = "insert into shipping_type (vendor_id,type_name,type_order,type_default,type_local) values ('admin_$admin_id','$type_name','5','$type_default','$type_local')";

$run_shipping_type = mysqli_query($con,$insert_shipping_type);

if($run_shipping_type){

echo "<script>alert('Se ha insertado un nuevo tipo de envío.')</script>";

echo "<script>window.open('index.php?view_shipping_types','_self')</script>";

}

}

?>

<?php } ?>