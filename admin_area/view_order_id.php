<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
if(isset($_GET['view_order_id'])){

$order_id = $_GET['view_order_id'];

$get_order = "select * from orders where order_id='$order_id'";

$run_order = mysqli_query($con,$get_order);

$fetch_order = mysqli_fetch_array($run_order);

$order_id = $fetch_order['order_id'];

$customer_id = $fetch_order['customer_id'];

$invoice_no = $fetch_order['invoice_no'];

$shipping_type = $fetch_order['shipping_type'];

$shipping_cost = $fetch_order['shipping_cost'];

$payment_method = $fetch_order['payment_method'];

$order_date = $fetch_order['order_date'];

$order_total = $fetch_order['order_total'];

$order_note = $fetch_order['order_note'];

$order_status = $fetch_order['order_status'];

$get_customer = "select * from customers where customer_id='$customer_id'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_name = $row_customer['customer_name'];

$customer_email = $row_customer['customer_email'];
	
$customer_contact = $row_customer['customer_contact'];	

$get_orders_addresses = "select * from orders_addresses where order_id='$order_id'";

$run_orders_addresses = mysqli_query($con,$get_orders_addresses);

$row_addresses = mysqli_fetch_array($run_orders_addresses);

$billing_first_name = $row_addresses["billing_first_name"];

$billing_last_name = $row_addresses["billing_last_name"];

$billing_address_1 = $row_addresses["billing_address_1"];

$billing_address_2 = $row_addresses["billing_address_2"];

$billing_city = $row_addresses["billing_city"];

$billing_postcode = $row_addresses["billing_postcode"];

$billing_country = $row_addresses["billing_country"];

$billing_state = $row_addresses["billing_state"];

$is_shipping_address = $row_addresses["is_shipping_address"];

$shipping_first_name = $row_addresses["shipping_first_name"];

$shipping_last_name = $row_addresses["shipping_last_name"];

$shipping_address_1 = $row_addresses["shipping_address_1"];

$shipping_address_2 = $row_addresses["shipping_address_2"];

$shipping_city = $row_addresses["shipping_city"];

$shipping_postcode = $row_addresses["shipping_postcode"];

$shipping_country = $row_addresses["shipping_country"];

$shipping_state = $row_addresses["shipping_state"];

if(!isset($_GET['sub_order_id'])){

$select_vendor_orders = "select * from vendor_orders where order_id='$order_id'";

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

$count_vendor_orders = mysqli_num_rows($run_vendor_orders);

if($count_vendor_orders == 1){

$select_vendor_order = "select * from vendor_orders where order_id='$order_id'";

$run_vendor_order = mysqli_query($con,$select_vendor_order);

$row_vendor_order = mysqli_fetch_array($run_vendor_order);

$sub_order_id = $row_vendor_order['id'];

$vendor_id = $row_vendor_order['vendor_id'];

$shipping_cost = $row_vendor_order['shipping_cost'];

$net_amount = $row_vendor_order['net_amount'];

$commission_amount = $net_amount + $shipping_cost;

}

}else{

$sub_order_id = $_GET['sub_order_id'];

$select_vendor_order = "select * from vendor_orders where id='$sub_order_id' and order_id='$order_id'";

$run_vendor_order = mysqli_query($con,$select_vendor_order);

$row_vendor_order = mysqli_fetch_array($run_vendor_order);

$vendor_id = $row_vendor_order['vendor_id'];

$invoice_no = $row_vendor_order['invoice_no'];

$shipping_type = $row_vendor_order['shipping_type'];

$shipping_cost = $row_vendor_order['shipping_cost'];

$order_total = $row_vendor_order['order_total'];

$net_amount = $row_vendor_order['net_amount'];

$order_status = $row_vendor_order['order_status'];

$commission_amount = $net_amount + $shipping_cost;

}

function select_order_status($function_order_status){
	
global $order_status;

if($function_order_status == $order_status){

echo "selected";

}

}

$select_payment_settings = "select * from payment_settings";

$run_payment_setttings = mysqli_query($con,$select_payment_settings);

$row_payment_settings = mysqli_fetch_array($run_payment_setttings);

$days_before_withdraw = $row_payment_settings['days_before_withdraw'];

date_default_timezone_set("UTC");

$commission_paid_date = date("F d, Y h:i:s", strtotime(" + $days_before_withdraw days"));

}

?>

<div class="row"><!-- 1 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts -->

<li class="active lead" style="margin-bottom:0px;">

<i class="fa fa-money fa-fw"> </i> Estás viendo los detalles completos de este pedido <mark>#<?php echo $invoice_no; ?></mark> fue colocado en <mark><?php echo $order_date; ?></mark> y es actualmente <mark><?php 

if($order_status == "pending"){

echo ucwords($order_status . " Payment");

}else{

echo ucwords($order_status);
	
}

?></mark>.

</li>

</ol><!-- breadcrumb Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends -->

<div class="row"><!-- 1 row Starts -->

<div class="col-md-8"><!-- col-md-8 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

Orden #<?php echo $invoice_no; ?> Detalles

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<h3>Detalles de orden</h3>

<table class="table border-table"><!--- table border-table Starts --->

<thead>

<tr>

<th class="text-muted lead"><strong>Producto:</strong></th>

<th class="text-muted lead"><strong>Total:</strong></th>

</tr>

</thead>

<tbody>

<?php

$items_subtotal = 0;

$physical_products = array();

$select_cart = "select * from orders_items where order_id='$order_id'";

$run_cart = mysqli_query($con,$select_cart);

while($row_cart = mysqli_fetch_array($run_cart)){

$item_id = $row_cart['item_id'];

$product_id = $row_cart['product_id'];

$product_qty = $row_cart['qty'];

$product_price = $row_cart['price'];

$sub_total = $product_price*$product_qty;

if(!isset($_GET['sub_order_id'])){

$select_product = "select * from products where product_id='$product_id'";

}else{
	
$select_product = "select * from products where product_id='$product_id' and vendor_id='$vendor_id'";
	
}

$run_product = mysqli_query($con,$select_product);

$count_product = mysqli_num_rows($run_product);

if($count_product != 0){
	
$row_product = mysqli_fetch_array($run_product);

$vendor_id = $row_product['vendor_id'];

$product_title = $row_product["product_title"];

$product_type = $row_product["product_type"];

if(strpos($vendor_id, "admin_") !== false){
	
$admin_id = trim($vendor_id, "admin_");
	
$get_admin = "select * from admins where admin_id='$admin_id'";

$run_admin = mysqli_query($con,$get_admin);

$row_admin = mysqli_fetch_array($run_admin);

$vendor_name = $row_admin['admin_name'];
	
}else{

$get_customer = "select * from customers where customer_id='$vendor_id'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$vendor_name = $row_customer['customer_name'];

}

if($product_type == "physical_product"){

array_push($physical_products, $product_id);	

}elseif($product_type == "variable_product"){

$select_orders_items_meta = "select * from orders_items_meta where order_id='$order_id' and item_id='$item_id' and product_id='$product_id' and meta_key='variation_id'";

$run_orders_items_meta = mysqli_query($con,$select_orders_items_meta);

$row_orders_items_meta = mysqli_fetch_array($run_orders_items_meta);

$variation_id = str_replace("#","",$row_orders_items_meta["meta_value"]);

$select_product_variation = "select * from product_variations where product_id='$product_id' and variation_id='$variation_id'";

$run_product_variation = mysqli_query($con,$select_product_variation);

$row_product_variation = mysqli_fetch_array($run_product_variation);

$variation_product_type = $row_product_variation["product_type"];

if($variation_product_type == "physical_product"){

array_push($physical_products, $product_id);

}

}

$items_subtotal += $sub_total;

?>

<tr>

<td>

<a href="#" class="bold"> <?php echo $product_title; ?> </a>

<i class="fa fa-times" title="Product Qty"></i> <?php echo $product_qty; ?>

<p class="cart-product-meta"> 

<?php

$items_meta_result = "";

$select_orders_items_meta = "select * from orders_items_meta where order_id='$order_id' and item_id='$item_id' and product_id='$product_id' and meta_key!='variation_id'";

$run_orders_items_meta = mysqli_query($con,$select_orders_items_meta);

while($row_orders_items_meta = mysqli_fetch_array($run_orders_items_meta)){

$meta_key = str_replace('_', ' ', ucwords($row_orders_items_meta["meta_key"]));;

$meta_value = $row_orders_items_meta["meta_value"];

$items_meta_result .= "$meta_key: <span class='text-muted'>$meta_value</span>, ";

}

echo rtrim($items_meta_result, ", ");

?>

</p>

<p style="margin-top:6px; margin-bottom:-1px;"> 

<strong> Vendedor : </strong> <?php echo $vendor_name; ?> 

</p>


</td>

<th>$<?php echo $sub_total; ?></th>

</tr>

<?php } } ?>

<tr>

<th class="text-muted">Subtotal:</th>

<th>$<?php echo $items_subtotal; ?></th>

</tr>

<?php if(count($physical_products) > 0 ){ ?>

<tr>

<th class="text-muted">Envío:</th>

<th>

<?php if(!empty($shipping_type)){ ?>

<span class="text-muted"> <i class="fa fa-truck"></i> <?php echo $shipping_type; ?>: </span> 

<?php } ?>

$<?php echo $shipping_cost; ?>

</th>

</tr>

<?php } ?>

<tr>

<th class="text-muted"> Método de pago: </th>

<th> <?php echo ucwords($payment_method); ?>  </th>

</tr>

<tr class="h4 bold">

<th class="text-muted">Total:</th>

<th>$<?php echo $order_total; ?></th>

</tr>

</tbody>
 
</table><!--- table border-table Ends --->

<?php 

if(!isset($_GET['sub_order_id'])){

if($count_vendor_orders > 1){ 

?>

<h3> Sub Ordenes </h3>

<div class="alert alert-info">

<strong>Nota:</strong> Este pedido tiene productos de varios proveedores. Así que dividimos este pedido en varios pedidos de proveedores. Cada pedido será manejado por su proveedor respectivo de forma independiente.
  
</div>

<table class="table border-table"><!--- table border-table Starts --->

<thead><!-- thead Starts -->

<tr>

<th> N° de pedido: </th>

<th> Número de factura </th>

<th> Fecha de pedido: </th>

<th> Estado del pedido: </th>

<th> Total del pedido </th>

<th></th>

</tr>

</thead><!-- thead Ends -->

<tbody><!--- tbody Starts --->

<?php

$select_vendor_orders = "select * from vendor_orders where order_id='$order_id'";

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

$i = 0;

while($row_vendor_orders = mysqli_fetch_array($run_vendor_orders)){

$sub_order_id = $row_vendor_orders['id'];

$vendor_id = $row_vendor_orders['vendor_id'];

$vendor_invoice_no = $row_vendor_orders['invoice_no'];

$vendor_order_total = $row_vendor_orders['order_total'];

$vendor_order_status = $row_vendor_orders['order_status'];

$i++;

?>

<tr><!-- tr Starts -->

<th><?php echo $i; ?></th>

<td>#<?php echo $vendor_invoice_no; ?></td>

<td><?php echo $order_date; ?></td>

<td>

<?php 

if($vendor_order_status == "pending"){

echo ucwords($vendor_order_status . " Payment");

}else{

echo ucwords($vendor_order_status);
	
}

?>

</td>

<td>

<strong>$<?php echo $vendor_order_total; ?></strong>

for <?php

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

echo $total . " item";

}else{

echo $total . " items";	
	
}

?>

</td>

<td>

<a class="btn btn-success btn-sm" href="index.php?view_order_id=<?php echo $order_id; ?>&sub_order_id=<?php echo $sub_order_id; ?>"> 

Ver 

</a>

</td>

</tr><!-- tr Ends -->

<?php } ?>

</tbody><!--- tbody Ends --->

</table><!--- table border-table Ends --->

<?php }} ?>

<h3>Cliente Detalles</h3>

<table class="table border-table"><!--- table border-table Starts --->

<tbody>

<tr>
<th class="text-muted">Nombre:</th>
<th><?php echo $customer_name; ?></th>
</tr>

<tr>
<th class="text-muted">Email:</th>
<th><?php echo $customer_email; ?></th>
</tr>

<tr>
<th class="text-muted">Teléfono:</th>
<th><?php echo $customer_contact; ?></th>
</tr>

<?php if(!empty($order_note)){ ?>

<tr>

<th class="text-muted" width="100"> Nota de pedido proporcionada por el cliente: </th>

<td><?php echo $order_note; ?></td>

</tr>

<?php } ?>

</tbody>
 
</table> 

<div class="row"><!-- 2 row Starts -->

<?php if($is_shipping_address == "yes"){ ?>

<div class="col-sm-12">

<div class="alert alert-info">

  <strong>Info!</strong> Tenga en cuenta que los detalles de facturación y envío son los mismos.
  
</div>

</div>

<?php } ?>

<div class="col-sm-6">

<h4>Detalles de facturación</h4>

<address class="text-muted" style="font-size:15px;">
<?php echo $billing_first_name . " "; echo $billing_last_name; ?><br>
<?php echo $billing_address_1; ?><br>
<?php echo $billing_address_2; ?><br>
<?php echo $billing_city; ?><br>
<?php echo $billing_state; ?><br>
<?php echo $billing_postcode; ?><br>
<?php 

$get_country = "select * from countries where country_id='$billing_country'";

$run_country = mysqli_query($con,$get_country);

$row_country = mysqli_fetch_array($run_country);

echo $country_name = $row_country['country_name'];

?><br>
</address>

</div>

<?php if($is_shipping_address == "no"){ ?>

<div class="col-sm-6">

<h4>Detalles de envío</h4>

<address class="text-muted" style="font-size:15px;">
<?php echo $shipping_first_name . " "; echo $shipping_last_name; ?><br>
<?php echo $shipping_address_1; ?><br>
<?php echo $shipping_address_2; ?><br>
<?php echo $shipping_city; ?><br>
<?php echo $shipping_state; ?><br>
<?php echo $shipping_postcode; ?><br>
<?php 

$get_country = "select * from countries where country_id='$shipping_country'";

$run_country = mysqli_query($con,$get_country);

$row_country = mysqli_fetch_array($run_country);

echo $country_name = $row_country['country_name'];

?><br>
</address>

</div>

<?php } ?>


</div><!-- 2 row Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-md-8 Ends -->

<div class="col-md-4"><!-- col-md-3 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

Acciones de Orden

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<h4 class="text-success">

Estado actual: 

<mark><?php 

if($order_status == "pending"){

echo ucwords($order_status . " Payment");

}else{

echo ucwords($order_status);
	
}

?></mark>

</h4>

<form action="" method="post">

<div class="form-group"><!-- form-group Starts -->

<label> Cambiar el estado de la orden  </label>

<select name="order_status" class="form-control">

<option value="pending" <?php select_order_status("pending"); ?>> Pago pendiente </option>

<option value="processing" <?php select_order_status("processing"); ?>> Procesando </option>

<option value="on hold" <?php select_order_status("on hold"); ?>> En espera </option>

<option value="cancelled" <?php select_order_status("cancelled"); ?>> Cancelado </option>

<option value="refunded" <?php select_order_status("refunded"); ?>> Reintegrado </option>

<option value="completed" <?php select_order_status("completed"); ?>> Completado </option>

</select>

</div><!-- form-group Ends -->

<form action="" method="post">

<div class="form-group"><!-- form-group Starts -->

<input type="submit" name="update_status" value="Actualizar" class="form-control btn btn-primary">

</div><!-- form-group Ends -->

</form>

<?php

if(isset($_POST["update_status"])){
	
$order_status = $_POST["order_status"];

if( !isset($_GET['sub_order_id']) ){

$update_order_status = "update orders set order_status='$order_status' where order_id='$order_id'";

}else{

$update_order_status = "update vendor_orders set order_status='$order_status' where order_id='$order_id' and vendor_id='$vendor_id'";
	
}

$run_update_order_status = mysqli_query($con,$update_order_status);

if(!isset($_GET['sub_order_id'])){

if($count_vendor_orders == 1){

$update_vendor_order_status = "update vendor_orders set order_status='$order_status' where id='$sub_order_id' and order_id='$order_id'";

$run_update_vendor_order_status = mysqli_query($con,$update_vendor_order_status);	

}

}

if( isset($_GET['sub_order_id']) or (!isset($_GET['sub_order_id']) and $count_vendor_orders == 1) ){

if($order_status == "completed"){

$select_vendor_commission = "select * from vendor_commissions where vendor_id='$vendor_id' and order_id='$sub_order_id'";

$run_vendor_commission = mysqli_query($con,$select_vendor_commission);

$count_vendor_commission = mysqli_num_rows($run_vendor_commission);

if($count_vendor_commission == 0){
	
$update_pending_clearance = "update vendor_accounts set pending_clearance=pending_clearance+$commission_amount,month_earnings=month_earnings+$commission_amount where vendor_id='$vendor_id'";
	
$run_pending_clearance = mysqli_query($con,$update_pending_clearance);

$insert_vendor_commission = "insert into vendor_commissions (vendor_id,order_id,commission_paid_date,commission_status) values ('$vendor_id','$sub_order_id','$commission_paid_date','pending')";

$run_vendor_commission = mysqli_query($con,$insert_vendor_commission);

if($run_vendor_commission){

echo "<script> alert('!La comisión de proveedor importante de este pedido se ha ingresado correctamente.'); </script>";
	
}
	
}

}elseif($order_status != "completed"){

$update_pending_clearance = "update vendor_accounts set pending_clearance=pending_clearance-$commission_amount,month_earnings=month_earnings-$commission_amount where vendor_id='$vendor_id'";
	
$run_pending_clearnace = mysqli_query($con,$update_pending_clearance);

$delete_vendor_commission = "delete from vendor_commissions where vendor_id='$vendor_id' and order_id='$sub_order_id' and commission_status='pending'";

$run_vendor_commission = mysqli_query($con,$delete_vendor_commission);

if($run_vendor_commission){

echo "<script> alert('!La comisión de proveedor importante de este pedido se ha eliminado correctamente.'); </script>";
	
}
	
}

}

if($run_update_order_status){

echo "<script> alert('El estado de su pedido se ha actualizado correctamente.'); </script>";

if(!isset($_GET['sub_order_id'])){

echo "<script>window.open('index.php?view_order_id=$order_id','_self')</script>";	

}else{

echo "<script>window.open('index.php?view_order_id=$order_id&sub_order_id=$sub_order_id','_self')</script>";	
	
}

}
	
}

?>

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

Notas Orden

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<?php

if(!isset($_GET['sub_order_id'])){
	
if($count_vendor_orders == 1){

$select_orders_notes = "select * from orders_notes where order_id='$order_id' or sub_order_id='$sub_order_id'";

}else{

$select_orders_notes = "select * from orders_notes where order_id='$order_id' and sub_order_id=''";
	
}

}else{
	
$select_orders_notes = "select * from orders_notes where order_id='$order_id' or sub_order_id='$sub_order_id'";

}

$run_orders_notes = mysqli_query($con,$select_orders_notes);

while($row_orders_notes = mysqli_fetch_array($run_orders_notes)){

$note_id = $row_orders_notes['note_id'];

$item_id = $row_orders_notes['item_id'];

$note_sub_order_id = $row_orders_notes['sub_order_id'];

$note_content = $row_orders_notes['note_content'];

$note_date = $row_orders_notes['note_date'];

$select_order_items = "select * from orders_items where order_id='$order_id' and item_id='$item_id'";

$run_order_items = mysqli_query($con,$select_order_items);

$row_order_items = mysqli_fetch_array($run_order_items);
	
$product_id = $row_order_items["product_id"];

if(!isset($_GET['sub_order_id'])){
	
if($count_vendor_orders == 1){
	
$select_product = "select * from products where product_id='$product_id' and vendor_id='$vendor_id'";
	
}else{

$select_product = "select * from products where product_id='$product_id'";	

}

}else{
	
$select_product = "select * from products where product_id='$product_id' and vendor_id='$vendor_id'";
	
}

$run_product = mysqli_query($con,$select_product);

$count_product = mysqli_num_rows($run_product);

if(

(!empty($item_id) and $count_product != 0) or 

(!isset($_GET['sub_order_id']) and empty($item_id)) or 

(isset($_GET['sub_order_id']) and empty($item_id) and $note_sub_order_id == $sub_order_id)

){

$row_product = mysqli_fetch_array($run_product);

$product_title = $row_product['product_title'];

?>
 
<div class="order-note-well"><!-- order-note-well Starts -->

<div class="note-content"><!-- note-content Starts -->

<p>

<?php if($item_id != 0){ ?> 

<?php echo $product_title; ?> 

(

<?php

$items_meta_result = "";

$select_orders_items_meta = "select * from orders_items_meta where order_id='$order_id' and item_id='$item_id' and product_id='$product_id' and meta_key!='variation_id'";

$run_orders_items_meta = mysqli_query($con,$select_orders_items_meta);

while($row_orders_items_meta = mysqli_fetch_array($run_orders_items_meta)){

$meta_key = ucwords($row_orders_items_meta["meta_key"]);

$meta_value = $row_orders_items_meta["meta_value"];

$items_meta_result .= "$meta_key: <span class='text-muted'>$meta_value</span>, ";

}

echo rtrim($items_meta_result, ", ");

?>

)

<br>

<?php } ?> 

<?php echo $note_content; ?>

</p>

</div><!-- note-content Ends -->

<p class="note-meta">

añadido <?php echo $note_date; ?> 

<a href="index.php?delete_note=<?php echo $note_id; ?>&order_id=<?php echo $order_id; ?>"> 
Borrar nota
</a>

</p>

</div><!-- order-note-well Ends -->

<?php } } ?>

<hr class="order-note-hr">

<form action="" method="post">

<div class="form-group"><!-- form-group Starts -->

<label> Agregar nueva nota </label>

<textarea name="note_content" rows="3" placeholder="Notas privadas sobre su pedido, p. Ej. notas especiales para la entrega." class="form-control"></textarea>

</div><!-- form-group Ends -->

<form action="" method="post">

<div class="form-group"><!-- form-group Starts -->

<input type="submit" name="insert_note" value="Agregar" class="form-control btn btn-primary">

</div><!-- form-group Ends -->

</form>

<?php

if(isset($_POST["insert_note"])){
	
$note_content = $_POST["note_content"];

$note_date = date("F d, Y h:i");

if(!isset($_GET['sub_order_id'])){

$insert_order_note = "insert into orders_notes (order_id,item_id,note_content,note_date) values ('$order_id','0','$note_content','$note_date')";

}else{
	
$insert_order_note = "insert into orders_notes (order_id,item_id,sub_order_id,note_content,note_date) values ('$order_id','0','$sub_order_id','$note_content','$note_date')";

}

$run_order_note = mysqli_query($con, $insert_order_note);

if($run_order_note){

echo "<script>alert('Su nueva nota de pedido se ha insertado correctamente.')</script>";

if(!isset($_GET['sub_order_id'])){

echo "<script> window.open('index.php?view_order_id=$order_id','_self'); </script>";	

}else{

echo "
<script>
window.open('index.php?view_order_id=$order_id&sub_order_id=$sub_order_id','_self');
</script>
";	
	
}
	
}
	
}

?>

</div><!-- panel-body Ends -->

</div><!-- panel panel-default Ends -->

</div><!-- col-md-3 Ends -->

</div><!-- 1 row Ends -->

<?php } ?>