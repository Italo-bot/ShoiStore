<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

function echo_active_class($order_status){

if((!isset($_GET['order_status']) and $order_status == "all") or (isset($_GET['order_status']) and $order_status == $_GET['order_status'])){

echo "active-link";

}
	
}

$select_vendor_orders = "select * from vendor_orders where vendor_id='$customer_id'";

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

$count_vendor_orders = mysqli_num_rows($run_vendor_orders);

function get_orders_status_count($order_status){
	
global $con;

global $customer_id;

$select_vendor_orders = "select * from vendor_orders where vendor_id='$customer_id' and order_status='$order_status'";

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

echo $count_vendor_orders = mysqli_num_rows($run_vendor_orders);
	
}

?>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Ver Ordenes

</h3>
</div>

<div class="panel-body">

<a href="index.php?orders&order_status=all" class="link-separator <?php echo_active_class("all"); ?>">

Todo (<?php echo $count_vendor_orders; ?>)

</a>

<a class="link-separator">|</a>

<a href="index.php?orders&order_status=pending" class="link-separator <?php echo_active_class("pending"); ?>">

Pendiente (<?php get_orders_status_count("pending"); ?>)

</a>

<a class="link-separator">|</a>

<a href="index.php?orders&order_status=on hold" class="link-separator <?php echo_active_class("on hold"); ?>">

En espera (<?php get_orders_status_count("on hold"); ?>)

</a>

<a class="link-separator">|</a>

<a href="index.php?orders&order_status=processing" class="link-separator <?php echo_active_class("processing"); ?>">

Procesando (<?php get_orders_status_count("processing"); ?>)

</a>

<a class="link-separator">|</a>

<a href="index.php?orders&order_status=completed" class="link-separator <?php echo_active_class("completed"); ?>">
 
Completado (<?php get_orders_status_count("completed"); ?>)

</a>

<a class="link-separator">|</a>

<a href="index.php?orders&order_status=cancelled" class="link-separator <?php echo_active_class("cancelled"); ?>">

Cancelado (<?php get_orders_status_count("cancelled"); ?>)

</a>

<a class="link-separator">|</a>

<a href="index.php?orders&order_status=refunded" class="link-separator <?php echo_active_class("refunded"); ?>">

Reintegrado (<?php get_orders_status_count("refunded"); ?>)

</a>

<br><br>

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead>

<tr>

<th> N° de pedido: </th>

<th> Número de factura: </th>

<th> Envío del pedido: </th>

<th> Fecha de pedido: </th>

<th> Estado del pedido: </th>

<th> Total del pedido </th>

<th> Acciones: </th>

</tr>

</thead>

<tbody>

<?php

if(!isset($_GET['order_status']) or $_GET['order_status'] == "all"){
	
$select_vendor_orders = "select * from vendor_orders where vendor_id='$customer_id' order by 1 desc";

}elseif(isset($_GET['order_status'])){
	
$order_status = $_GET['order_status'];

$select_vendor_orders = "select * from vendor_orders where vendor_id='$customer_id' and order_status='$order_status' order by 1 desc";

}

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

$i = 0;

while($row_vendor_orders = mysqli_fetch_array($run_vendor_orders)){

$sub_order_id = $row_vendor_orders['id'];

$order_id = $row_vendor_orders['order_id'];

$vendor_id = $row_vendor_orders['vendor_id'];

$invoice_no = $row_vendor_orders['invoice_no'];

$shipping_type = $row_vendor_orders['shipping_type'];

$shipping_cost = $row_vendor_orders['shipping_cost'];

$order_total = $row_vendor_orders['order_total'];

$order_status = $row_vendor_orders['order_status'];

$select_order = "select * from orders where order_id='$order_id'";

$run_order = mysqli_query($con,$select_order);

$row_order = mysqli_fetch_array($run_order);

$payment_method = $row_order['payment_method'];

$order_date = $row_order['order_date'];

$i++;

?>

<tr>

<th><?php echo $i; ?></th>

<td>#<?php echo $invoice_no; ?></td>

<th>

<?php if(!empty($shipping_type)){ ?>

<span class="text-muted"> <i class="fa fa-truck"></i> <?php echo $shipping_type; ?>: </span>

$<?php echo $shipping_cost; ?>

<?php }else{ ?>

Envío ----

<?php } ?>

</th>

<td><?php echo $order_date; ?></td>

<td>

<?php 

if($order_status == "pending"){

echo ucwords($order_status . " Payment");

}else{

echo ucwords($order_status);
	
}

?>

</td>

<td>

<strong>$<?php echo $order_total; ?></strong>

Por <?php

$total = 0;

$select_orders_items = "select * from orders_items where order_id='$order_id'";

$run_orders_items = mysqli_query($con,$select_orders_items);

while($row_orders_items = mysqli_fetch_array($run_orders_items)){

$product_id = $row_orders_items['product_id'];

$product_qty = $row_orders_items['qty'];

$select_product = "select * from products where product_id='$product_id' and vendor_id='$vendor_id'";

$run_product = mysqli_query($con,$select_product);

$count_product = mysqli_num_rows($run_product);

if($count_product != 0){

$total += $product_qty;

}

}

if($total == 1){

echo $total . " artículo";

}else{

echo $total . " artículos";	
	
}

?>

<br><span class="text-muted"> Via <?php echo ucwords($payment_method); ?> </span>

</td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right">

<li> <a href="index.php?view_order_id=<?php echo $sub_order_id; ?>"> Ver / Editar </a> </li>
	
</ul>
  
</div>

</td>

</tr>

<?php } ?>


</tbody>

</table>
</div>

</div>

</div>

</div>

</div>