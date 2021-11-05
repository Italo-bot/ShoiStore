
<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$select_payment_settings = "select * from payment_settings";

$run_payment_setttings = mysqli_query($con,$select_payment_settings);

$row_payment_settings = mysqli_fetch_array($run_payment_setttings);

$minimum_withdraw_limit = $row_payment_settings['minimum_withdraw_limit'];

$days_before_withdraw = $row_payment_settings['days_before_withdraw'];

?>


<div class="row"><!-- 2 row Starts --->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="alert alert-info">

<strong>

Saldo actual: $1,024.70 <br><br>

Monto mínimo de retiro: $<?php echo $minimum_withdraw_limit; ?> <br><br>

Retirar en: <?php echo $days_before_withdraw; ?> días

</strong>
  
</div>

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"> </i> Hacer una solicitud de retiro

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!--panel-body Starts -->

<form class="form-horizontal" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Cantidad de retiro: </label>

<div class="col-md-6">

<div class="input-group">

<span class="input-group-addon">$</span>

<input type="text" name="amount" class="form-control" required>

</div>

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Método de pago: </label>

<div class="col-md-6">

<select class="form-control" name="method"><!-- select payment method Starts -->

<option value="paypal"> Paypal </option>

<option value="skrill"> Skrill </option>

<option value="stripe"> Stripe </option>

<option value="bank-transfer"> Transferencia Bancaria </option>

</select><!-- select payment method Ends -->

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="submit" value="Enviar" class="btn btn-primary form-control">

</div>

</div><!-- form-group Ends -->

</form><!-- form-horizontal Ends -->

</div><!--panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends --->


<?php

if(isset($_POST['submit'])){

$amount = mysqli_real_escape_string($con, $_POST['amount']);

$method = mysqli_real_escape_string($con, $_POST['method']);

$date = date("F d, Y h:i");

$insert_vendor_withdraw = "insert into vendor_withdraws (vendor_id,amount,method,date,status) values ('$customer_id','$amount','$method','$date','pending')";

$run_vendor_withdraw = mysqli_query($con,$insert_vendor_withdraw);

if($run_vendor_withdraw){

echo "

<script>

alert('Nueva solicitud de retiro ha sido presentada con éxito y será revisada!.');

window.open('index.php?withdraw','_self');

</script>

";

}

}

?>