<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<h1 class="page-header">Dashboard</h1>

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->


<div class="row"><!-- 2 row Starts -->

<div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 Starts -->

<div class="panel panel-primary"><!-- panel panel-primary Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<div class="row"><!-- panel-heading row Starts -->

<div class="col-xs-3"><!-- col-xs-3 Starts -->

<i class="fa fa-tasks fa-5x"> </i>

</div><!-- col-xs-3 Ends -->

<div class="col-xs-9 text-right"><!-- col-xs-9 text-right Starts -->

<div class="huge"> <?php echo $count_products; ?> </div>

<div> <span class="badge">Pendiente</span> Productos/Paquetes </div>

</div><!-- col-xs-9 text-right Ends -->

</div><!-- panel-heading row Ends -->

</div><!-- panel-heading Ends -->

<a href="index.php?view_products">

<div class="panel-footer"><!-- panel-footer Starts -->

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div><!-- panel-footer Ends -->

</a>

</div><!-- panel panel-primary Ends -->

</div><!-- col-lg-3 col-md-6 Ends -->


<div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 Starts -->

<div class="panel panel-green"><!-- panel panel-green Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<div class="row"><!-- panel-heading row Starts -->

<div class="col-xs-3"><!-- col-xs-3 Starts -->

<i class="fa fa-comments fa-5x"> </i>

</div><!-- col-xs-3 Ends -->

<div class="col-xs-9 text-right"><!-- col-xs-9 text-right Starts -->

<div class="huge"> <?php echo $count_customers; ?> </div>

<div>Clientes</div>

</div><!-- col-xs-9 text-right Ends -->

</div><!-- panel-heading row Ends -->

</div><!-- panel-heading Ends -->

<a href="index.php?view_customers">

<div class="panel-footer"><!-- panel-footer Starts -->

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div><!-- panel-footer Ends -->

</a>

</div><!-- panel panel-green Ends -->

</div><!-- col-lg-3 col-md-6 Ends -->


<div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 Starts -->

<div class="panel panel-yellow"><!-- panel panel-yellow Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<div class="row"><!-- panel-heading row Starts -->

<div class="col-xs-3"><!-- col-xs-3 Starts -->

<i class="fa fa-shopping-cart fa-5x"> </i>

</div><!-- col-xs-3 Ends -->

<div class="col-xs-9 text-right"><!-- col-xs-9 text-right Starts -->

<div class="huge"> <?php echo $count_p_categories; ?> </div>

<div>Categorías de productos</div>

</div><!-- col-xs-9 text-right Ends -->

</div><!-- panel-heading row Ends -->

</div><!-- panel-heading Ends -->

<a href="index.php?view_p_cats">

<div class="panel-footer"><!-- panel-footer Starts -->

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div><!-- panel-footer Ends -->

</a>

</div><!-- panel panel-yellow Ends -->

</div><!-- col-lg-3 col-md-6 Ends -->


<div class="col-lg-3 col-md-6"><!-- col-lg-3 col-md-6 Starts -->

<div class="panel panel-red"><!-- panel panel-red Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<div class="row"><!-- panel-heading row Starts -->

<div class="col-xs-3"><!-- col-xs-3 Starts -->

<i class="fa fa-support fa-5x"> </i>

</div><!-- col-xs-3 Ends -->

<div class="col-xs-9 text-right"><!-- col-xs-9 text-right Starts -->

<div class="huge"> <?php echo $count_pending_orders; ?> </div>

<div>Ordenes</div>

</div><!-- col-xs-9 text-right Ends -->

</div><!-- panel-heading row Ends -->

</div><!-- panel-heading Ends -->

<a href="index.php?view_orders">

<div class="panel-footer"><!-- panel-footer Starts -->

<span class="pull-left"> Ver Detalles </span>

<span class="pull-right"> <i class="fa fa-arrow-circle-right"></i> </span>

<div class="clearfix"></div>

</div><!-- panel-footer Ends -->

</a>

</div><!-- panel panel-red Ends -->

</div><!-- col-lg-3 col-md-6 Ends -->


</div><!-- 2 row Ends -->

<div class="row" ><!-- 3 row Starts -->

<div class="col-lg-8" ><!-- col-lg-8 Starts -->

<div class="panel panel-primary" ><!-- panel panel-primary Starts -->

<div class="panel-heading" ><!-- panel-heading Starts -->

<h3 class="panel-title" ><!-- panel-title Starts -->

<i class="fa fa-money fa-fw" ></i> Nuevas Ordenes

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body" ><!-- panel-body Starts -->

<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>

<th> N° de pedido: </th>

<th> Email del cliente: </th>

<th> Número de factura: </th>

<th> Total: </th>

<th> Fecha: </th>

<th> Estado: </th>

</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

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

</tbody><!-- tbody Ends -->


</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->

<div class="text-right" ><!-- text-right Starts -->

<a href="index.php?view_orders" >

Ver todas las ordenes <i class="fa fa-arrow-circle-right" ></i>

</a>

</div><!-- text-right Ends -->


</div><!-- panel-body Ends -->

</div><!-- panel panel-primary Ends -->

</div><!-- col-lg-8 Ends -->

<div class="col-md-4"><!-- col-md-4 Starts -->

<div class="panel"><!-- panel Starts -->

<div class="panel-body"><!-- panel-body Starts -->

<div class="thumb-info mb-md"><!-- thumb-info mb-md Starts -->

<img src="admin_images/<?php echo $admin_image; ?>" class="rounded img-responsive">

<div class="thumb-info-title"><!-- thumb-info-title Starts -->

<span class="thumb-info-inner"> <?php echo $admin_name; ?> </span>

<span class="thumb-info-type"> <?php echo $admin_job; ?> </span>

</div><!-- thumb-info-title Ends -->

</div><!-- thumb-info mb-md Ends -->

<div class="mb-md"><!-- mb-md Starts -->

<div class="widget-content-expanded"><!-- widget-content-expanded Starts -->

<i class="fa fa-user"></i> <span>Email: </span> <?php echo $admin_email; ?>  <br>
<i class="fa fa-user"></i> <span>País: </span> <?php echo $admin_country; ?>   <br>
<i class="fa fa-user"></i> <span>Contacto: </span> <?php echo $admin_contact; ?>   <br>

</div><!-- widget-content-expanded Ends -->

<hr class="dotted short">

<h5 class="text-muted">Sobre</h5>

<p>
<?php echo $admin_about; ?>
</p>

</div><!-- mb-md Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel Ends -->

</div><!-- col-md-4 Ends -->

</div><!-- 3 row Ends -->

<?php } ?>