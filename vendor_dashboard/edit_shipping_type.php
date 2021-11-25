<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

if(isset($_GET['edit_shipping_type'])){

$edit_type_id = $_GET['edit_shipping_type'];

$get_shipping_type = "select * from shipping_type where type_id='$edit_type_id' and vendor_id='$customer_id'";

$run_shipping_type = mysqli_query($con, $get_shipping_type);

$row_shipping_type = mysqli_fetch_array($run_shipping_type);

$type_name = $row_shipping_type['type_name'];

$type_default = $row_shipping_type['type_default'];

$type_local = $row_shipping_type['type_local'];
	
	
}

?>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Editar tipo de envío

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-7">

<input type="text" name="type_name" class="form-control" value="<?php echo $type_name; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Predeterminado </label>

<div class="col-md-7">

<label>

<input type="radio" name="type_default" value="yes" required 

<?php if($type_default == "yes"){ echo "checked"; } ?>

> Si

</label>

<label>

<input type="radio" name="type_default" value="no" required

<?php if($type_default == "no"){ echo "checked"; } ?>

> No

</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="update" value="Actualizar tipo de envío" class="form-control btn btn-success">

</div>

</div>

</form>

</div>
</div>

</div>

</div>


<?php

if(isset($_POST['update'])){
	
$type_name = mysqli_real_escape_string($con, $_POST['type_name']);

$type_default = mysqli_real_escape_string($con, $_POST['type_default']);

if($type_default == "yes"){
	
$update_type_deafult = "update shipping_type set type_default='no' where vendor_id='$customer_id' and type_local='$type_local'";

$run_update_type_deafult = mysqli_query($con, $update_type_deafult);
	
}

$update_shipping_type = "update shipping_type set type_name='$type_name',type_default='$type_default' where type_id='$edit_type_id' and vendor_id='$customer_id'";

$run_update_shipping_type = mysqli_query($con, $update_shipping_type);

if($run_update_shipping_type){
	
echo "

<script>

alert('Su tipo de envío se ha actualizado correctamente.');

window.open('index.php?shipping_types', '_self');

</script>

";
	
}
	
}


?>


