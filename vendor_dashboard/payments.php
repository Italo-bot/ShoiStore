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

$select_vendor_account = "select * from vendor_accounts where vendor_id='$customer_id'";

$run_vendor_account = mysqli_query($con, $select_vendor_account);

$row_vendor_account = mysqli_fetch_array($run_vendor_account);

$current_balance = $row_vendor_account['current_balance'];

$pending_clearance = $row_vendor_account['pending_clearance'];

$withdrawals = $row_vendor_account['withdrawals'];

$month_earnings = $row_vendor_account['month_earnings'];

$select_store_settings = "select * from store_settings where vendor_id='$customer_id'";

$run_store_settings = mysqli_query($con,$select_store_settings);

$row_store_settings = mysqli_fetch_array($run_store_settings);

$paypal_email = $row_store_settings["paypal_email"];

?>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Informe de pagos

</h3>

</div>
<div class="panel-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped" >

<tbody class="text-center">

<tr>

<td>

<h4 style="margin-top:0px;"> Saldo actual </h4>

<h3> $<?php echo $current_balance; ?> </h3> 

</td>

<td>

<h4 style="margin-top:0px;"> Pendiente de liquidación </h4>

<h3> $<?php echo $pending_clearance; ?> </h3> 

</td>

<td>

<h4 style="margin-top:0px;"> Retiros </h4>

<h3> $<?php echo $withdrawals; ?> </h3> 

</td>

</tr>

<tr>

<td>

<h4 style="margin-top:0px;"> Ganado este mes </h4>

<h3> $<?php echo $month_earnings; ?> </h3> 

</td>

<td>

<h4 style="margin-top:0px;"> Monto mínimo de retiro </h4>

<h3> $<?php echo $minimum_withdraw_limit; ?> </h3> 

</td>

<td>

<h4 style="margin-top:0px;"> Retirar en </h4>

<h3> <?php echo $days_before_withdraw; ?> Días </h3> 

</td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php if($current_balance >= $minimum_withdraw_limit){ ?>

<button class="btn btn-success" data-toggle="modal" data-target="#paypal_withdraw_modal"> 

Retraerse a <i class="fa fa-paypal"></i> Cuenta de Paypal

</button>

<?php }else{ ?>

<button class="btn btn-success" onclick="return alert('You Must Have Minimum $<?php echo $minimum_withdraw_limit; ?> Saldo disponible para retirar comisiones a su cuenta Paypal.');"> 

Retraerse a <i class="fa fa-paypal"></i> Cuenta de Paypal

</button>

<?php } ?>

<br><br>

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Pagos

</h3>

</div>

<div class="panel-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped" >

<thead>

<tr>

<th> Número: </th>

<th> Factura de pedido: </th>

<th> Importe de la comisión: </th>

<th> Importe de envío: </th>

<th> Importe total: </th>

<th> Estado: </th>

</tr>

</thead>

<tbody>

<?php

$i = 0;

$select_vendor_commissions = "select * from vendor_commissions where vendor_id='$vendor_id' order by 1 desc";

$run_vendor_commissions = mysqli_query($con,$select_vendor_commissions);

while($row_vendor_commissions = mysqli_fetch_array($run_vendor_commissions)){
	
$i++;

$commission_id = $row_vendor_commissions['commission_id'];

$order_id = $row_vendor_commissions['order_id'];

$commission_paid_date = $row_vendor_commissions['commission_paid_date'];

$commission_status = $row_vendor_commissions['commission_status'];

$select_vendor_order = "select * from vendor_orders where id='$order_id' and vendor_id='$vendor_id'";

$run_vendor_order = mysqli_query($con,$select_vendor_order);

$row_vendor_order = mysqli_fetch_array($run_vendor_order);

$invoice_no = $row_vendor_order['invoice_no'];

$net_amount = $row_vendor_order['net_amount'];

$shipping_cost = $row_vendor_order['shipping_cost'];

$total_amount = $net_amount + $shipping_cost;

?>

<tr>

<td> <?php echo $i; ?> </td>
  
<td> 

<a href="index.php?view_order_id=<?php echo $order_id; ?>"> #<?php echo $invoice_no; ?> </a>

</td>

<td> $<?php echo $net_amount; ?> </td>

<td> $<?php echo $shipping_cost; ?> </td>

<td> $<?php echo $total_amount; ?> </td>

<?php if($commission_status == "pending"){ ?>

<td class="text-danger">

<strong> Comisión pendiente de liquidación </strong>

</td>

<?php }else{ ?>

<td class="text-success">

<strong> Comisión <?php echo ucwords($commission_status); ?> </strong>

</td>

<?php } ?>

</tr>

<?php } ?>

</tbody>

</table>

</div>


</div>

</div>

</div>

</div>


<div id="paypal_withdraw_modal" class="modal fade">

<div class="modal-dialog">

<div class="modal-content">

<div class="modal-header">

<button type="button" class="close" data-dismiss="modal">

<span>&times;</span>

</button>

<h4 class="modal-title"> Retirar comisiones a cuenta Paypal </h4>

</div>

<div class="modal-body">

<center>
<?php if(empty($paypal_email)){ ?>

<p class="lead">

Para retirar comisiones a su cuenta de PayPal, agregue el Email de su cuenta de PayPal en

<a href="index.php?store_settings">
Configuración de tienda
</a>

</p>

<?php }else{ ?>

<p class="lead">

Sus comisiones se enviarán al siguiente correo electrónico de la cuenta de PayPal:

<br> <strong> <?php echo $paypal_email; ?> </strong>

</p>

<form class="form-horizontal" action="paypal_payouts.php" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Monto del retiro: </label>

<div class="col-md-7">

<div class="input-group">

<span class="input-group-addon">$</span>

<input type="text" name="amount" class="form-control" min="<?php echo $minimum_withdraw_limit; ?>" max="<?php echo $current_balance; ?>" placeholder="<?php echo $minimum_withdraw_limit; ?> Minimo" required>

</div>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-7">

<input type="submit" name="withdraw" value="Withdraw" class="btn btn-primary form-control">

</div>

</div>

</form>

<?php } ?>

</center>

</div>

<div class="modal-footer">

<button class="btn btn-default" data-dismiss="modal">
Close
</button>

</div>

</div>

</div>

</div>
