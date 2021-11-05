<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$select_vendor_payment_settings = "select * from vendor_payment_settings where vendor_id='$customer_id'";

$run_vendor_payment_settings = mysqli_query($con,$select_vendor_payment_settings);

$row_vendor_payment_settings = mysqli_fetch_array($run_vendor_payment_settings);

$paypal_email = $row_vendor_payment_settings["paypal_email"];

?>

<div class="row" ><!-- 2 row Starts -->

<div class="col-lg-12" ><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"></i> Configuración de pago

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<p class="lead">

Estos son los métodos de retiro disponibles para usted. Actualice su información de pago a continuación para enviar solicitudes de retiro y obtener sus pagos en la tienda sin problemas.

</p>

<form class="form-horizontal store-settings-form" method="post"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> PayPal Email </label>

<div class="col-md-6">

<input type="email" name="paypal_email" class="form-control" value="<?php echo $paypal_email; ?>" required>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Skrill Email </label>

<div class="col-md-6">

<input type="email" name="skrill_email" class="form-control" value="<?php echo $skrill_email; ?>" required>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Transferencia bancaria </label>

<div class="col-md-6"><!-- col-md-6 Starts -->

<div class="form-group"><!-- form-group Starts -->

<label> El nombre de su cuenta bancaria: </label>

<input type="text" name="bank_account_name" class="form-control" value="<?php echo $bank_account_name; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Su número de cuenta bancaria: </label>

<input type="text" name="bank_account_number" class="form-control" value="<?php echo $bank_account_number; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Nombre de banco: </label>

<input type="text" name="bank_name" class="form-control" value="<?php echo $bank_name; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Dirección de su banco: </label>

<input type="text" name="bank_address" class="form-control" value="<?php echo $bank_address; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Número de ruta: </label>

<input type="text" name="routing_number" class="form-control" value="<?php echo $routing_number; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Número IBAN: </label>

<input type="text" name="iban_number" class="form-control" value="<?php echo $iban_number; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Código SWIFT: </label>

<input type="text" name="swift_code" class="form-control" value="<?php echo $swift_code; ?>" required>

</div><!-- form-group Ends -->

</div><!-- col-md-6 Ends -->

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="submit" value="Guardar configuraciones" class="btn btn-success form-control">

</div>

</div><!-- form-group Ends -->

</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->


<?php

if(isset($_POST['submit'])){
	
$paypal_email = mysqli_real_escape_string($con, $_POST['paypal_email']);

$update_vendor_payment_settings = "update vendor_payment_settings set paypal_email='$paypal_email' where vendor_id='$customer_id'";

$run_vendor_payment_settings = mysqli_query($con,$update_vendor_payment_settings);

if($run_vendor_payment_settings){

echo "

<script>

alert('Su configuración de pago se ha guardado correctamente.');

window.open('index.php?payment_settings','_self');

</script>

";

}

}

?>


