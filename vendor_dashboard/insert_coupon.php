

<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

?>


<div class="row">

<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Agregar Cupón

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group" >

<label class="col-md-3 control-label"> Nombre Cupón </label>

<div class="col-md-6">

<input type="text" name="coupon_title" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Precio Cupón </label>

<div class="col-md-6">

<input type="text" name="coupon_price" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Código Cupón </label>

<div class="col-md-6">

<input type="text" name="coupon_code" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> Limite Cupón </label>

<div class="col-md-6">

<input type="number" name="coupon_limit" value="1" class="form-control">

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label">Seleccionar cupón para producto o paquete</label>

<div class="col-md-6">

<select name="product_id" class="form-control">

<optgroup label="Select Product">

<?php

$select_products = "select * from products where vendor_id='$customer_id' and product_vendor_status='active' and status='product'";

$run_products = mysqli_query($con,$select_products);

while($row_products = mysqli_fetch_array($run_products)){

$product_id = $row_products["product_id"];

$product_title = $row_products["product_title"];

echo "<option value='$product_id'>$product_title</option>";
	
}

?>

</optgroup>

<optgroup label="Seleccionar Paquete">

<?php

$select_bundles = "select * from products where vendor_id='$customer_id' and product_vendor_status='active' and status='bundle'";

$run_bundles = mysqli_query($con,$select_bundles);

while($row_bundles = mysqli_fetch_array($run_bundles)){

$product_id = $row_bundles["product_id"];

$product_title = $row_bundles["product_title"];

echo "<option value='$product_id'>$product_title</option>";
	
}

?>
</optgroup>

</select>

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" class=" btn btn-primary form-control" value=" Agregar Cupón ">

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

$select_coupons = "select * from coupons where product_id='$product_id' or coupon_code='$coupon_code'";

$run_coupons = mysqli_query($con,$select_coupons);

$check_coupons = mysqli_num_rows($run_coupons);

if($check_coupons == 1){

echo "
<script>
alert('Código de cupón o producto ya agregado, Elija otro código de cupón o producto');
</script>
";

}else{

$insert_coupon = "insert into coupons (vendor_id,product_id,coupon_title,coupon_price,coupon_code,coupon_limit,coupon_used) values ('$customer_id','$product_id','$coupon_title','$coupon_price','$coupon_code','$coupon_limit','$coupon_used')";

$run_coupon = mysqli_query($con,$insert_coupon);

if($run_coupon){

echo "

<script>

alert('El nuevo cupón se ha insertado correctamente.');

window.open('index.php?coupons','_self');

</script>

";

}

}

}

?>