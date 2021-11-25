<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<div class="row">

<div class="col-lg-12">

<h1 class="page-header">Dashboard</h1>

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-3 col-md-6">

<div class="panel panel-primary">

<div class="panel-heading">

<div class="row">

<div class="col-xs-3">

<i class="fa fa-tasks fa-5x"> </i>

</div>

<div class="col-xs-9 text-right">

<div class="huge"> <?php echo $count_products; ?> </div>

<div> <span class="badge">Pendiente</span> Productos/Paquetes </div>

</div>

</div>

</div>

<a href="index.php?view_products">

<div class="panel-footer">

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div>

</a>

</div>
</div>


<div class="col-lg-3 col-md-6">

<div class="panel panel-green">
<div class="panel-heading">

<div class="row">

<div class="col-xs-3">

<i class="fa fa-comments fa-5x"> </i>

</div>

<div class="col-xs-9 text-right">

<div class="huge"> <?php echo $count_customers; ?> </div>

<div>Clientes</div>

</div>

</div>

</div>

<a href="index.php?view_customers">

<div class="panel-footer">

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div>

</a>

</div>

</div>


<div class="col-lg-3 col-md-6">

<div class="panel panel-yellow">

<div class="panel-heading">

<div class="row">

<div class="col-xs-3">

<i class="fa fa-shopping-cart fa-5x"> </i>

</div>

<div class="col-xs-9 text-right">

<div class="huge"> <?php echo $count_p_categories; ?> </div>

<div>Categorías de productos</div>

</div>

</div>

</div>

<a href="index.php?view_p_cats">

<div class="panel-footer">

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div>

</a>

</div>

</div>

<div class="col-lg-3 col-md-6">

<div class="panel panel-red">

<div class="panel-heading">

<div class="row">

<div class="col-xs-3">

<i class="fa fa-support fa-5x"> </i>

</div>

<div class="col-xs-9 text-right">

<div class="huge"> <?php echo $count_pending_orders; ?> </div>

<div>Ordenes</div>

</div>

</div>

</div>

<a href="index.php?view_orders">

<div class="panel-footer">

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div>

</a>

</div>

</div>


</div>

<div class="row" >

<div class="col-lg-8" >

<div class="panel panel-primary" >

<div class="panel-heading" >

<h3 class="panel-title" >

<i class="fa fa-money fa-fw" ></i> Nuevas Ordenes

</h3>

</div>

<div class="panel-body" >

<div class="table-responsive" >

<table class="table table-bordered table-hover table-striped" >

<thead>

<tr>

<th> N° de pedido: </th>

<th> Email del cliente: </th>

<th> Número de factura: </th>

<th> Total: </th>

<th> Fecha: </th>

<th> Estado: </th>

</tr>

</thead>

<tbody>

<?php

$i = 0;

$get_order = "select * from orders order by 1 DESC LIMIT 0,5";

$run_order = mysqli_query($con,$get_order);

while($row_order=mysqli_fetch_array($run_order)){

$order_id = $row_order['order_id'];

$c_id = $row_order['customer_id'];

$invoice_no = $row_order['invoice_no'];

$order_total = $row_order['order_total'];

$order_date = $row_order['order_date'];

$order_status = $row_order['order_status'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td>
<?php

$get_customer = "select * from customers where customer_id='$c_id'";
$run_customer = mysqli_query($con,$get_customer);
$row_customer = mysqli_fetch_array($run_customer);
$customer_email = $row_customer['customer_email'];
echo $customer_email;
?>
</td>

<td>#<?php echo $invoice_no; ?></td>

<td>$<?php echo $order_total; ?></td>

<td><?php echo $order_date; ?></td>

<td>
<?php
if($order_status=='pendiente'){

echo $order_status='pendiente';

}
else {

echo $order_status='Completada';

}

?>
</td>

</tr>

<?php } ?>

</tbody>


</table>

</div>

<div class="text-right" >

<a href="index.php?view_orders" >

Ver todas las ordenes <i class="fa fa-arrow-circle-right" ></i>

</a>

</div>


</div>

</div>

</div>

<div class="col-md-4">

<div class="panel">

<div class="panel-body">

<div class="thumb-info mb-md">

<img src="admin_images/<?php echo $admin_image; ?>" class="rounded img-responsive">

<div class="thumb-info-title">

<span class="thumb-info-inner"> <?php echo $admin_name; ?> </span>

<span class="thumb-info-type"> <?php echo $admin_job; ?> </span>

</div>
</div>

<div class="mb-md">

<div class="widget-content-expanded">

<i class="fa fa-user"></i> <span>Email: </span> <?php echo $admin_email; ?>  <br>
<i class="fa fa-user"></i> <span>País: </span> <?php echo $admin_country; ?>   <br>
<i class="fa fa-user"></i> <span>Contacto: </span> <?php echo $admin_contact; ?>   <br>

</div>

<hr class="dotted short">

<h5 class="text-muted">Sobre</h5>

<p>
<?php echo $admin_about; ?>
</p>

</div>

</div>

</div>

</div>

</div>

<?php } ?>