<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
$select_payment_settings = "select * from payment_settings";

$run_payment_settings = mysqli_query($con,$select_payment_settings);

$row_payment_settings = mysqli_fetch_array($run_payment_settings);

$commission_percentage = $row_payment_settings["commission_percentage"];

$minimum_withdraw_limit = $row_payment_settings["minimum_withdraw_limit"];

$days_before_withdraw = $row_payment_settings["days_before_withdraw"];

$enable_paypal = $row_payment_settings['enable_paypal'];

$paypal_email = $row_payment_settings['paypal_email'];

$paypal_sandbox = $row_payment_settings['paypal_sandbox'];

$paypal_currency_code = $row_payment_settings['paypal_currency_code'];

$paypal_app_client_id = $row_payment_settings['paypal_app_client_id'];

$paypal_app_client_secret = $row_payment_settings['paypal_app_client_secret'];

$enable_stripe = $row_payment_settings['enable_stripe'];

$stripe_secret_key = $row_payment_settings['stripe_secret_key'];

$stripe_publishable_key = $row_payment_settings['stripe_publishable_key'];

$stripe_currency_code = $row_payment_settings['stripe_currency_code'];

?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Configuración de pago

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->

<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"></i> Actualizar configuración de pago

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<form class="form-horizontal payment-settings" method="post"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Porcentaje de comisión admin: </label>

<div class="col-md-7">

<input type="text" name="commission_percentage" class="form-control" value="<?php echo $commission_percentage; ?>" required>

<span id="helpBlock" class="help-block">

Porcentaje de comisión Cantidad que obtiene de las ventas de socios.

</span>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Límite mínimo de retiro : </label>

<div class="col-md-7">

<input type="text" name="minimum_withdraw_limit" class="form-control" value="<?php echo $minimum_withdraw_limit; ?>" required>

<span id="helpBlock" class="help-block">

Saldo mínimo requerido para realizar una solicitud de retiro. Valor 0 para no establecer límites mínimos.

</span>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Días antes disponible para retiro: </label>

<div class="col-md-7">

<input type="text" name="days_before_withdraw" class="form-control" value="<?php echo $days_before_withdraw; ?>" required>

<span id="helpBlock" class="help-block">

Días, (hacer que el pedido del proveedor esté vencido para retirar su comisión) <br>

NÚMERO DE DÍAS ANTES de que la comisión del proveedor de los pedidos pueda estar disponible para su retiro

</span>

</div>

</div><!-- form-group Ends -->

<hr>
<h3>PayPal</h3>
<hr>

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Habilitar Paypal : </label>

<div class="col-md-7">

<select name="enable_paypal" class="form-control">

<option value="1" <?php if($enable_paypal == 1){ echo "selected"; } ?>> Si </option>

<option value="0" <?php if($enable_paypal == 0){ echo "selected"; } ?>> No </option>

</select>

<span id="helpBlock" class="help-block">

Permitir a los usuarios pagar con PayPal

</span>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Paypal Email : </label>

<div class="col-md-7">

<input type="text" name="paypal_email" class="form-control" value="<?php echo $paypal_email; ?>">

<span id="helpBlock" class="help-block">

Ingrese el Email comercial de Paypal para recibir pagos de Paypal y enviar ganancias a los proveedores Cuentas de Paypal.

</span>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Paypal Sandbox : </label>

<div class="col-md-7">

<label class="control-label">

<input type="radio" name="paypal_sandbox" value="1" <?php if($paypal_sandbox == 1){ echo "checked"; } ?> required> Encendido 

</label>

<label class="control-label">

<input type="radio" name="paypal_sandbox" value="0" <?php if($paypal_sandbox == 0){ echo "checked"; } ?> required> Apagado 

</label>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!--- form-group Starts --->

<label class="col-md-3 control-label"> Paypal Código de moneda : </label>

<div class="col-md-7">

<input type="text" name="paypal_currency_code" class="form-control" value="<?php echo $paypal_currency_code; ?>">

<span id="helpBlock" class="help-block">

Moneda utlizada para pagos PayPal <a href="https://developer.paypal.com/docs/classic/api/currency_codes/" target="_blank">Haga click aquí para obtener los códigos de moneda de Paypal.</a>

</span>

</div>

</div><!--- form-group Ends --->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Paypal Pagar : </label>

<div class="col-md-7">

<div class="form-group"><!-- form-group Starts -->

<label> Paypal App Cliente ID: </label>

<input type="text" name="paypal_app_client_id" class="form-control" value="<?php echo $paypal_app_client_id; ?>" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label> Paypal App Cliente Secreto: </label>

<input type="text" name="paypal_app_client_secret" class="form-control" value="<?php echo $paypal_app_client_secret; ?>" required>

</div><!-- form-group Ends -->

</div>

</div><!-- form-group Ends -->

<hr>
<h3>Stripe</h3>
<hr>

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Habilitar Stripe : </label>

<div class="col-md-7">

<select name="enable_stripe" class="form-control">

<option value="yes" <?php if($enable_stripe == "yes"){ echo "selected"; } ?>> Si </option>

<option value="no" <?php if($enable_stripe == "no"){ echo "selected"; } ?>> No </option>

</select>

<span id="helpBlock" class="help-block">

Permitir que los clientes paguen con Stripe

</span>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Stripe Key Secreta : </label>

<div class="col-md-7">

<input type="text" name="stripe_secret_key" class="form-control" value="<?php echo $stripe_secret_key; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Stripe Key publicable : </label>

<div class="col-md-7">

<input type="text" name="stripe_publishable_key" class="form-control" value="<?php echo $stripe_publishable_key; ?>">

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!--- form-group Starts --->

<label class="col-md-3 control-label"> Stripe Código de moneda : </label>

<div class="col-md-7">

<input type="text" name="stripe_currency_code" class="form-control" value="<?php echo $stripe_currency_code; ?>">

<span id="helpBlock" class="help-block">

Monedas utilizadas para pago con Stripe <a href="https://stripe.com/docs/currencies" target="_blank"> Click Aquí para obtener los códigos de moneda de Stripe </a> 

</span>

</div>

</div><!--- form-group Ends --->

<div class="form-group"><!--- form-group Starts --->

<label class="col-md-3 control-label"></label>

<div class="col-md-7">

<input type="submit" name="update_payment_settings" class="btn btn-primary form-control" value="Actualizar">

</div>

</div><!--- form-group Ends --->

</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 4 row Ends -->

<?php

if(isset($_POST['update_payment_settings'])){

$commission_percentage = mysqli_real_escape_string($con, $_POST['commission_percentage']);

$minimum_withdraw_limit = mysqli_real_escape_string($con, $_POST['minimum_withdraw_limit']);

$days_before_withdraw = mysqli_real_escape_string($con, $_POST['days_before_withdraw']);

$enable_paypal = mysqli_real_escape_string($con,$_POST['enable_paypal']);

$paypal_email = mysqli_real_escape_string($con,$_POST['paypal_email']);

$paypal_currency_code = mysqli_real_escape_string($con,$_POST['paypal_currency_code']);

$paypal_sandbox = mysqli_real_escape_string($con,$_POST['paypal_sandbox']);

$paypal_app_client_id = mysqli_real_escape_string($con,$_POST['paypal_app_client_id']);

$paypal_app_client_secret = mysqli_real_escape_string($con,$_POST['paypal_app_client_secret']);

$enable_stripe = mysqli_real_escape_string($con,$_POST['enable_stripe']);

$stripe_secret_key = mysqli_real_escape_string($con,$_POST['stripe_secret_key']);

$stripe_publishable_key = mysqli_real_escape_string($con,$_POST['stripe_publishable_key']);

$stripe_currency_code = mysqli_real_escape_string($con,$_POST['stripe_currency_code']);

$update_payment_settings = "update payment_settings set commission_percentage='$commission_percentage',minimum_withdraw_limit='$minimum_withdraw_limit',days_before_withdraw='$days_before_withdraw',enable_paypal='$enable_paypal',paypal_email='$paypal_email',paypal_currency_code='$paypal_currency_code',paypal_sandbox='$paypal_sandbox',paypal_app_client_id='$paypal_app_client_id',paypal_app_client_secret='$paypal_app_client_secret',enable_stripe='$enable_stripe',stripe_secret_key='$stripe_secret_key',stripe_publishable_key='$stripe_publishable_key',stripe_currency_code='$stripe_currency_code'";	
		
$run_stripe_settings = mysqli_query($con,$update_stripe_settings);
	
if($run_stripe_settings){
	
echo "

<script>

alert('La configuración de Stripe se ha actualizado correctamente.');

window.open('index.php?payment_settings','_self');

</script>

";
	
}
	
}

?>

<?php } ?>