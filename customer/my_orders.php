
<?php

@session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}

?>

<center>

<h1>Mis Ordenes</h1>

<p class="lead"> Tus pedidos en un solo lugar.</p>

<p class="text-muted" >

Si tiene alguna pregunta, no dude en <a href="../contact.php" >contáctarnos,</a> nuestro centro de servicio al cliente está trabajando para usted 24 horas al día, 7 días a la semana.

</p>

</center>

<hr>

<div class="table-responsive">

<table class="table table-bordered table-hover">

<thead>

<tr>

<th> N° de pedido: </th>

<th> Número de factura </th>

<th> Fecha de pedido: </th>

<th> Estado del pedido: </th>

<th> Total del pedido </th>

<th> Acciones: </th>

</tr>

</thead>

<tbody>

<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$get_orders = "select * from orders where customer_id='$customer_id' order by 1 desc";

$run_orders = mysqli_query($con,$get_orders);

$i = 0;

while($row_orders = mysqli_fetch_array($run_orders)){

$order_id = $row_orders['order_id'];

$customer_id = $row_orders['customer_id'];

$invoice_no = $row_orders['invoice_no'];

$order_total = $row_orders['order_total'];

$order_date = $row_orders['order_date'];

$order_status = $row_orders['order_status'];

$i++;

?>

<tr>

<th><?php echo $i; ?></th>

<td>#<?php echo $invoice_no; ?></td>

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

$total += $product_qty;

}

if($total == 1){

echo $total . " artículo";

}else{

echo $total . " artículos";	
	
}

?>

</td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right">

<?php if($order_status == "pending"){ ?>

<li>

<a href="confirm.php?order_id=<?php echo $order_id; ?>" target="blank" class="bg-danger">

Confirmar si se pagó

</a>

</li>

<?php } ?>

<li><a href="view_order.php?order_id=<?php echo $order_id; ?>" target="blank">Ver</a></li>
	
</ul>
  
</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>
