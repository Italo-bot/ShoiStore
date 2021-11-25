<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Agregar Relación

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i  class="fa fa-money fa-fw"></i> Agregar Relación

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre  </label>

<div class="col-md-6">

<input type="text" name="rel_title" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccionar producto  </label>

<div class="col-md-6">

<select name="product_id" class="form-control">

<option> Seleccionar producto </option>

<?php

$get_p = "select * from products where status='product'";

$run_p = mysqli_query($con,$get_p);

while($row_p = mysqli_fetch_array($run_p)){

$p_id = $row_p['product_id'];

$p_title = $row_p['product_title'];

echo "<option value='$p_id'> $p_title </option>";

}

?>

</select>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccionar paquete  </label>

<div class="col-md-6">

<select name="bundle_id" class="form-control">

<option> Seleccionar paquete </option>

<?php

$get_p = "select * from products where status='bundle'";

$run_p = mysqli_query($con,$get_p);

while($row_p = mysqli_fetch_array($run_p)){

$p_id = $row_p['product_id'];

$p_title = $row_p['product_title'];

echo "<option value='$p_id'> $p_title </option>";

}

?>

</select>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" class="btn btn-primary form-control" value="Agregar">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['submit'])){

$rel_title = $_POST['rel_title'];

$product_id = $_POST['product_id'];

$bundle_id = $_POST['bundle_id'];

$insert_rel = "insert into bundle_product_relation (rel_title,product_id,bundle_id) values ('$rel_title','$product_id','$bundle_id')";

$run_rel = mysqli_query($con,$insert_rel);

if($run_rel){

echo "<script>alert('Se ha insertado una nueva relación')</script>";

echo "<script>window.open('index.php?view_rel','_self')</script>";

}

}

?>


<?php } ?>