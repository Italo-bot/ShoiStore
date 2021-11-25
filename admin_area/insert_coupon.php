<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else{
	
$admin_email = $_SESSION['admin_email'];

$select_admin = "select * from admins where admin_email='$admin_email'";

$run_admin = mysqli_query($con,$select_admin);

$row_admin = mysqli_fetch_array($run_admin);

$admin_id = $row_admin['admin_id'];


?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"> </i> Dashboard / Agregar Cupón

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Agregar Cupón

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post" action="">

<div class="form-group" >

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-6">

<input type="text" name="coupon_title" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Precio </label>

<div class="col-md-6">

<input type="text" name="coupon_price" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Código </label>

<div class="col-md-6">

<input type="text" name="coupon_code" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Límite </label>

<div class="col-md-6">

<input type="number" name="coupon_limit" value="1" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label">Seleccionar cupón para producto o paquete</label>

<div class="col-md-6">

<select name="product_id" class="form-control">

<option> Seleccionar producto de cupón  </option>

<?php

$get_p = "select * from products where status='product'";

$run_p = mysqli_query($con,$get_p);

while($row_p = mysqli_fetch_array($run_p)){

$p_id = $row_p['product_id'];

$p_title = $row_p['product_title'];

echo "<option value='$p_id'> $p_title </option>";

}

?>

<option></option>

<option>Seleccionar cupón para paquete</option>

<option></option>

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

<div class="form-group" >

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" class=" btn btn-primary form-control" value=" Agregar ">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['submit'])){

$coupon_title = $_POST['coupon_title'];

$coupon_price = $_POST['coupon_price'];

$coupon_code = $_POST['coupon_code'];

$coupon_limit = $_POST['coupon_limit'];

$product_id = $_POST['product_id'];

$coupon_used = 0;

$get_coupons = "select * from coupons where product_id='$product_id' or coupon_code='$coupon_code'";

$run_coupons = mysqli_query($con,$get_coupons);

$check_coupons = mysqli_num_rows($run_coupons);

if($check_coupons == 1){

echo "<script>alert('Código de cupón o producto ya agregado Elija otro código de cupón o producto')</script>";

}else{

$insert_coupon = "insert into coupons (vendor_id,product_id,coupon_title,coupon_price,coupon_code,coupon_limit,coupon_used) values ('admin_$admin_id','$product_id','$coupon_title','$coupon_price','$coupon_code','$coupon_limit','$coupon_used')";

$run_coupon = mysqli_query($con,$insert_coupon);

if($run_coupon){

echo "<script> alert('Se ha insertado un nuevo cupón'); </script>";

echo "<script> window.open('index.php?view_coupons','_self'); </script>";

}


}


}

?>

<?php } ?>