<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
if(isset($_GET['edit_shipping_type'])){

$edit_type_id = $_GET['edit_shipping_type'];	
	
$get_zones = "select * from shipping_type where type_id='$edit_type_id'";

$run_zones = mysqli_query($con,$get_zones);

$row_zones = mysqli_fetch_array($run_zones);

$type_name = $row_zones['type_name'];

$type_local = $row_zones['type_local'];

$type_default = $row_zones['type_default'];	

}

?>

<link rel="stylesheet" href="css/chosen.min.css">

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar tipo de envío

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Editar tipo de envío

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-7">

<input type="text" name="type_name" class="form-control" value="<?php echo $type_name; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Predeterminado </label>

<div class="col-md-7">

<?php if($type_default == "yes"){ ?>

<label>
  <input type="radio" name="type_default" value="yes" checked> Si
</label>

<label>
  <input type="radio" name="type_default" value="no"> No
</label>

<?php }elseif($type_default == "no"){ ?>

<label>
  <input type="radio" name="type_default" value="yes"> Si
</label>

<label>
  <input type="radio" name="type_default" value="no" checked> No
</label>

<?php } ?>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="update" class="form-control btn btn-primary" value="Actualizar">

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

if(isset($_POST['update'])){

$type_name = mysqli_real_escape_string($con,$_POST['type_name']);

$type_default = mysqli_real_escape_string($con,$_POST['type_default']);

if($type_default == "yes"){

$update_type_default = "update shipping_type set type_default='no' where type_local='$type_local'";

$run_type_default = mysqli_query($con,$update_type_default);
	
}

$update_shipping_type = "update shipping_type set type_name='$type_name',type_default='$type_default' where type_id='$edit_type_id'";

$run_shipping_type = mysqli_query($con,$update_shipping_type);

if($run_shipping_type){

echo "<script>alert('Su tipo de envío ha sido actualizado.')</script>";

echo "<script>window.open('index.php?view_shipping_types','_self')</script>";

}

}

?>

<?php } ?>