<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('checkout.php','_self'); </script>";

}

if(!isset($_GET['order_id'])){

echo "<script> window.open('checkout.php','_self'); </script>";

}

?>

<!DOCTYPE html>
<html>

<head>

<title>ShoiStore </title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet" >

<link href="styles/bootstrap.min.css" rel="stylesheet">

<link href="styles/style.css" rel="stylesheet">

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

<div id="top">

<div class="container">

<div class="col-md-6 offer">
<a href="#" class="btn btn-success btn-sm" >

<?php

if(!isset($_SESSION['customer_email'])){

echo "Bienvenid@ Invitad@";


}else{

echo "Bienvenid@ : " . $_SESSION['customer_email'] . "";

}


?>

</a>

<a href="#">
Precio Total: <?php total_price(); ?>, Cantidad de Items <?php items(); ?>
</a>

</div>

<div class="col-md-6">
<ul class="menu">

<?php if(!isset($_SESSION['customer_email'])){ ?>

<li>

<a href="customer_register.php"> Registrarse </a>

</li>

<?php 

}else{

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_role = $row_customer['customer_role'];

if($customer_role == "customer"){ 

?>

<li>

<a href="shop.php"> Tienda </a>

</li>

<?php }elseif($customer_role == "vendor"){ ?>

<li>

<a href="vendor_dashboard/index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>
</li>

<li>
<a href="cart.php">
Ir al Carrito
</a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php'> Acceder </a>";

}else {

echo "<a href='logout.php'> Cerrar Sesión </a>";

}

?>
</li>

</ul>

</div>

</div>
</div>

<div class="navbar navbar-default" id="navbar">
<div class="container" >

<div class="navbar-header">

<a class="navbar-brand home" href="index.php" >

<img src="images/ShoiStoree.png" alt="ShoiStore logo" class="hidden-xs" >
<img src="images/ShoiStoree.png" alt="ShoiStore logo" class="visible-xs" >

</a>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation"  >

<span class="sr-only" >Navegación </span>

<i class="fa fa-align-justify"></i>

</button>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search" >

<span class="sr-only" >Buscar</span>

<i class="fa fa-search" ></i>

</button>


</div>

<div class="navbar-collapse collapse" id="navigation" >

<div class="padding-nav" >
<ul class="nav navbar-nav navbar-left">

<li>
<a href="index.php"> Home </a>
</li>

<li>
<a href="shop.php"> Tienda </a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>
</li>

<li>
<a href="cart.php"> Carrito </a>
</li>

<li>
<a href="about.php"> ¿Quiénes Somos? </a>
</li>

<li>

<a href="services.php"> Servicios </a>

</li>

<li>
<a href="contact.php"> Contáctanos </a>
</li>

</ul>

</div>

<a class="btn btn-primary navbar-btn right" href="cart.php">

<i class="fa fa-shopping-cart"></i>

<span> <?php items(); ?> Artículos </span>

</a>

<div class="navbar-collapse collapse right">

<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">

<span class="sr-only">Buscar</span>

<i class="fa fa-search"></i>

</button>

</div>

<div class="collapse clearfix" id="search">

<form class="navbar-form" method="get" action="results.php">

<div class="input-group">

<input class="form-control" type="text" placeholder="Buscar" name="user_query" required>

<span class="input-group-btn">

<button type="submit" value="Search" name="search" class="btn btn-primary">

<i class="fa fa-search"></i>

</button>

</span>

</div>

</form>

</div>

</div>

</div>
</div>

<div id="content">

<div class="container">

<div class="col-md-12">

<ul class="breadcrumb">

<li><a href="index.php">Home</a></li>

<li>Orden Completada</li>

</ul>

<nav class="checkout-breadcrumbs text-center">

<a href="cart.php">Carrito</a>

<i class="fa fa-chevron-right"></i>

<a href="checkout.php">Detalles de Pago</a>

<i class="fa fa-chevron-right"></i>

<a href="#" class="active">Orden Completada</a>

</nav>

</div>

<div class="col-md-8">

<?php 

if(isset($_GET['order_id'])){
	
$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];
	
$customer_contact = $row_customer['customer_contact'];	

$order_id = $_GET['order_id'];

$get_order = "select * from orders where order_id='$order_id' and customer_id='$customer_id'";

$run_order = mysqli_query($con,$get_order);

$fetch_order = mysqli_fetch_array($run_order);

$order_id = $fetch_order['order_id'];

$invoice_no = $fetch_order['invoice_no'];

$shipping_type = $fetch_order['shipping_type'];

$shipping_cost = $fetch_order['shipping_cost'];

$payment_method = $fetch_order['payment_method'];

$order_date = $fetch_order['order_date'];

$order_total = $fetch_order['order_total'];

$order_note = $fetch_order['order_note'];

$order_status = $fetch_order['order_status'];

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

$select_vendor_orders = "select * from vendor_orders where order_id='$order_id'";

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

$count_vendor_orders = mysqli_num_rows($run_vendor_orders);

}

?>

<div class="box">

<h3>Detalles de Orden</h3>

<table class="table border-table">

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

$sub_total = $product_price * $product_qty;

$get_products = "select * from products where product_id='$product_id'";

$run_products = mysqli_query($con,$get_products);

$row_products = mysqli_fetch_array($run_products);

$vendor_id = $row_products['vendor_id'];

$product_title = $row_products['product_title'];

$product_type = $row_products['product_type'];

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

$meta_key = str_replace('_', ' ', ucwords($row_orders_items_meta["meta_key"]));

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

<th> $<?php echo $sub_total; ?> </th>

</tr>

<?php } ?>

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

<tr class="h4 bold">

<td>Total:</td>

<td>$<?php echo $order_total; ?></td>

</tr>

</tbody>
 
</table>

<?php if($count_vendor_orders > 1){ ?>

<h3> Sub Ordenes </h3>

<div class="alert alert-info">

<strong>Nota:</strong> Este pedido tiene productos de varios proveedores. Se dividirá este pedido en varios pedidos de proveedores. Cada pedido será manejado por su proveedor respectivo de forma independiente.
  
</div>

<table class="table border-table">

<thead>

<tr>

<th>N° de Pedido:</th>

<th>N° de Factura:</th>

<th>Fecha de Pedido:</th>

<th>Estado de Orden:</th>

<th>Orden Total:</th>

<th></th>

</tr>

</thead>

<tbody>

<?php

$select_vendor_orders = "select * from vendor_orders where order_id='$order_id'";

$run_vendor_orders = mysqli_query($con,$select_vendor_orders);

$i = 0;

while($row_vendor_orders = mysqli_fetch_array($run_vendor_orders)){

$sub_order_id = $row_vendor_orders['id'];

$vendor_id = $row_vendor_orders['vendor_id'];

$invoice_no = $row_vendor_orders['invoice_no'];

$order_total = $row_vendor_orders['order_total'];

$order_status = $row_vendor_orders['order_status'];

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

<a class="btn btn-success btn-sm" href="customer/view_order.php?order_id=<?php echo $order_id; ?>&sub_order_id=<?php echo $sub_order_id; ?>" target="blank"> 

Ver Orden 

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

<?php } ?>

<h3>Detalles del cliente</h3>

<table class="table border-table">

<tbody>

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

<th class="text-muted" width="100">Notas de Pedido:</th>

<td><?php echo $order_note; ?></td>

</tr>

<?php } ?>

</tbody>
 
</table> 

<div class="row">

<div class="col-sm-6">

<h4>Billing Details</h4>

<address class="text-muted" style="font-size:15px;">
<?php echo $billing_first_name . " " . $billing_last_name; ?><br>
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

<h4>Detalles de Pedido</h4>

<address class="text-muted" style="font-size:15px;">
<?php echo $shipping_first_name . " " . $shipping_last_name; ?><br>
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

</div>

</div>

</div>

<div class="col-md-4">

<div class="box">

<h4 class="text-success">Gracias. Tu orden ha sido recibida.</h4>

<ul class="order-received-list">

<li>Factura / Número de pedido: <strong>#<?php echo $invoice_no; ?></strong></li>

<li>Fecha: <strong><?php echo $order_date; ?></strong></li>

<li>Método de Pago: <strong><?php echo ucwords($payment_method); ?></strong></li>

<li>Total: <strong>$<?php echo $order_total; ?></strong></li>

<li><strong><a class="text-muted" href="customer/my_account.php?my_orders"> Haga clic aquí para ir a mi cuenta </a></strong></li>

</ul>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>

</html>