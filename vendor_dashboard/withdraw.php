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

function echo_active_class($status){

if((!isset($_GET['status']) and $status == "pending") or (isset($_GET['status']) and $status == $_GET['status'])){

echo "active-link";

}
	
}

?>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Retirar solicitudes

</h3>

</div>

<div class="panel-body">

<p class="lead">

Estos son los métodos de retiro disponibles para usted. Actualice su información de pago a continuación para enviar solicitudes de retiro y obtener sus pagos en la tienda sin problemas.

</p>

<a href="index.php?withdraw&status=pending" class="link-separator <?php echo_active_class("pending"); ?>">

solicitudes pendientes

</a>

<a class="link-separator">|</a>

<a href="index.php?withdraw&status=approved" class="link-separator <?php echo_active_class("approved"); ?>">

Solicitudes aprobadas

</a>

<a class="link-separator">|</a>

<a href="index.php?withdraw&status=cancelled" class="link-separator <?php echo_active_class("cancelled"); ?>">

Solicitudes canceladas

</a>

<a href="index.php?withdraw_request" class="btn btn-success pull-right"> + Hacer una solicitud de retiro </a>

<br><br>


<div class="table-responsive">

<table class="table table-bordered table-hover table-striped" >

<thead>

<tr>

<th> Número: </th>

<th> Monto: </th>

<th> Método: </th>

<th> Fecha: </th>

<th> Estado: </th>

<?php if(!isset($_GET['status']) or $_GET['status'] == "pending"){ ?>

<th> Cancelar: </th>

<?php } ?>

</tr>

</thead>

<tbody>

<?php

if(!isset($_GET['status']) or $_GET['status'] == "pending"){

echo $select_vendor_withdraws = "select * from vendor_withdraws where vendor_id='$customer_id' and status='pending'";

}elseif(isset($_GET['status'])){
	
$status = $_GET['status'];

echo $select_vendor_withdraws = "select * from vendor_withdraws where vendor_id='$customer_id' and status='$status'";

}

$run_vendor_withdraws = mysqli_query($con,$select_vendor_withdraws);

$i = 0;

while($row_vendor_withdraws = mysqli_fetch_array($run_vendor_withdraws)){
	
$i++;

$withdraw_id = $row_vendor_withdraws['withdraw_id'];

$amount = $row_vendor_withdraws['amount'];

$method = $row_vendor_withdraws['method'];

$date = $row_vendor_withdraws['date'];

$status = $row_vendor_withdraws['status'];

?>

<tr>

<td> <?php echo $i; ?> </td>
  
<td> $<?php echo $amount; ?> </td>

<td> <?php echo ucwords($method); ?> </td>

<td> <?php echo $date; ?> </td>

<td> <?php echo ucwords($status); ?> </td>

<?php if(!isset($_GET['status']) or $_GET['status'] == "pending"){ ?>

<td> 

<a href="index.php?cancel_withdraw_request=<?php echo $withdraw_id; ?>">

<i class="fa fa-ban"></i> Cancelar

</a>

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

