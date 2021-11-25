<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

?>
<!DOCTYPE html>

<html>

<head>

<title>ShoiStore</title>

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

echo "Bienvenid@ " . $_SESSION['customer_email'] . "";

}


?>
</a>

<a href="#">
Precio Total: <span class="subtotal-cart-price"><?php total_price(); ?></span>, Cantidad de Items: <?php items(); ?>
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

echo "<a href='logouphp'> Cerrar Sesión </a>";

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

<li class="active" >
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

<div id="content" >

<div class="container-fluid">

<div class="col-md-12">

<ul class="breadcrumb" >

<li>
<a href="index.php">Home</a>
</li>

<li>Carro</li>

</ul>

<nav class="checkout-breadcrumbs text-center">

<a href="cart.php" class="active"> Carrito</a>

<i class="fa fa-chevron-right"></i>

<a href="checkout.php">Detalles de Pago</a>

<i class="fa fa-chevron-right"></i>

<a href="#"> Orden Completada </a>

</nav>

</div>

<div class="col-md-9" id="cart">

<div class="box">

<form action="cart.php" method="post" enctype="multipart-form-data" >

<h1> Carrito </h1>

<?php

$ip_add = getRealUserIp();

$select_cart = "select * from cart where ip_add='$ip_add'";

$run_cart = mysqli_query($con,$select_cart);

$count_cart = mysqli_num_rows($run_cart);

?>

<p class="text-muted" > Actualmente tienes <?php items(); ?> item(s) en tu Carrito. </p>

<div class="table-responsive" >
<table class="table" >

<thead>

<tr>

<th colspan="2">Producto</th>

<th>Cantidad</th>

<th>Precio Unidad</th>

<th colspan="1"> Borrar </th>

<th colspan="2"> Sub Total </th>

</tr>

</thead>

<tbody id="cart-products-tbody">

<?php

$total = 0;

$total_weight = array();

$physical_products = array();

$vendors_ids = array();

while($row_cart = mysqli_fetch_array($run_cart)){

$cart_id = $row_cart['cart_id'];

$pro_id = $row_cart['p_id'];

$pro_qty = $row_cart['qty'];

$only_price = $row_cart['p_price'];

$product_weight = $row_cart['product_weight'];

$product_type = $row_cart['product_type'];

$get_products = "select * from products where product_id='$pro_id'";

$run_products = mysqli_query($con,$get_products);

while($row_products = mysqli_fetch_array($run_products)){

$vendor_id = $row_products['vendor_id'];

$product_url = $row_products['product_url'];

$product_title = $row_products['product_title'];

$product_img1 = $row_products['product_img1'];

if($product_type == "physical_product"){
	
if(!isset($physical_products[$vendor_id])){

$physical_products[$vendor_id] = array();
	
}

array_push($physical_products[$vendor_id], $pro_id);	

}

if(!empty($vendor_id)){
	
if(!in_array($vendor_id, $vendors_ids)){

array_push($vendors_ids, $vendor_id);

}

}

$sub_total = $only_price*$pro_qty;

$_SESSION['pro_qty'] = $pro_qty;

$total += $sub_total;

$sub_total_weight = $product_weight * $pro_qty;

@$total_weight[$vendor_id] += $sub_total_weight;

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

$select_cart_meta = "select * from cart_meta where ip_add='$ip_add' and cart_id='$cart_id' and product_id='$pro_id' and meta_key='variation_id'";

$run_cart_meta = mysqli_query($con,$select_cart_meta);

$count_cart_meta = mysqli_num_rows($run_cart_meta);

if($count_cart_meta == 0){

$select_product_stock = "select * from products_stock where product_id='$pro_id'";	
	
}else{
	
$row_cart_meta = mysqli_fetch_array($run_cart_meta);

$variation_id = str_replace("#","",$row_cart_meta["meta_value"]);

$select_product_stock = "select * from products_stock where product_id='$pro_id' and variation_id='$variation_id'";
	
}

$run_product_stock = mysqli_query($con, $select_product_stock);

$row_product_stock = mysqli_fetch_array($run_product_stock);

$enable_stock = $row_product_stock["enable_stock"];

$stock_status = $row_product_stock["stock_status"];

$stock_quantity = $row_product_stock["stock_quantity"];

$allow_backorders = $row_product_stock["allow_backorders"];

?>

<tr>

<td>

<img src="admin_area/product_images/<?php echo $product_img1; ?>">

</td>

<td width="350">

<a href="<?php echo $product_url; ?>" target="blank" class="bold"> <?php echo $product_title; ?> </a>

<p class="cart-product-meta"> 

<?php

$cart_meta = "";

$select_cart_meta = "select * from cart_meta where ip_add='$ip_add' and cart_id='$cart_id' and product_id='$pro_id' and not meta_key='variation_id'";

$run_cart_meta = mysqli_query($con,$select_cart_meta);

while($row_cart_meta = mysqli_fetch_array($run_cart_meta)){

$meta_key = ucwords($row_cart_meta["meta_key"]);

$meta_value = $row_cart_meta["meta_value"];

$cart_meta .= "$meta_key: <span class='text-muted'> $meta_value </span>, ";

}

echo rtrim($cart_meta,", ");

?>

</p>

<p style="margin-top:8px;"> <strong> Vendedor: </strong> <?php echo $vendor_name; ?> </p>

</td>

<td>

<?php if($enable_stock == "yes" and $allow_backorders == "no"){ ?>

<input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-cart_id="<?php echo $cart_id; ?>" data-product_id="<?php echo $pro_id; ?>" min="1" max="<?php echo $stock_quantity; ?>" class="quantity form-control">

<?php }elseif($enable_stock == "yes" and ($allow_backorders == "yes" or $allow_backorders == "notify")){ ?>

<input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-cart_id="<?php echo $cart_id; ?>" data-product_id="<?php echo $pro_id; ?>" min="1" class="quantity form-control">

<?php }elseif($enable_stock == "no"){ ?>

<input type="text" name="quantity" value="<?php echo $_SESSION['pro_qty']; ?>" data-cart_id="<?php echo $cart_id; ?>" data-product_id="<?php echo $pro_id; ?>" min="1" class="quantity form-control">

<?php } ?>

</td>

<td>

$<?php echo $only_price; ?>.00

</td>

<td>
<input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
</td>

<td>

$<?php echo $sub_total; ?>.00

</td>

</tr>

<?php } } ?>

</tbody>

<tfoot>

<tr>

<th colspan="5"> Total </th>

<th colspan="2"> <span class="subtotal-cart-price">$<?php echo $total; ?></span>.00 </th>

</tr>

</tfoot>

</table>

<div class="form-inline pull-right">

<div class="form-group">

<label>Cupón: </label>

<input type="text" name="code" class="form-control">

</div>

<input class="btn btn-primary" type="submit" name="apply_coupon" value="Aplicar" >

</div>

</div>


<div class="box-footer">

<div class="pull-left">

<a href="index.php" class="btn btn-default">

<i class="fa fa-chevron-left"></i> Continuar Comprando

</a>

</div>

<div class="pull-right">

<button class="btn btn-default" type="submit" name="update" value="Update Cart">

<i class="fa fa-refresh"></i> Actualizar

</button>

<a href="checkout.php" class="btn btn-primary">

Proceder a comprar <i class="fa fa-chevron-right"></i>

</a>

</div>

</div>

</form>

</div>

<?php

if(isset($_POST['apply_coupon'])){

$code = $_POST['code'];

if($code == ""){


}
else{

$get_coupons = "select * from coupons where coupon_code='$code'";

$run_coupons = mysqli_query($con,$get_coupons);

$check_coupons = mysqli_num_rows($run_coupons);

if($check_coupons == 1){

$row_coupons = mysqli_fetch_array($run_coupons);

$coupon_pro = $row_coupons['product_id'];

$coupon_price = $row_coupons['coupon_price'];

$coupon_limit = $row_coupons['coupon_limit'];

$coupon_used = $row_coupons['coupon_used'];


if($coupon_limit == $coupon_used){

echo "<script>alert('Cupón caducado')</script>";

}
else{

$get_cart = "select * from cart where p_id='$coupon_pro' AND ip_add='$ip_add'";

$run_cart = mysqli_query($con,$get_cart);

$check_cart = mysqli_num_rows($run_cart);


if($check_cart == 1){

$add_used = "update coupons set coupon_used=coupon_used+1 where coupon_code='$code'";

$run_used = mysqli_query($con,$add_used);

$update_cart = "update cart set p_price='$coupon_price' where p_id='$coupon_pro' AND ip_add='$ip_add'";

$run_update = mysqli_query($con,$update_cart);

echo "<script>alert('Cupón Aplicado!')</script>";

echo "<script>window.open('cart.php','_self')</script>";

}
else{

echo "<script>alert('Producto no esta en el carrito')</script>";

}

}

}
else{

echo "<script> alert('Cupón Inválido') </script>";

}

}

}

?>

<?php

function update_cart(){

global $con;

if(isset($_POST['update'])){

foreach($_POST['remove'] as $remove_id){
	
$ip_add = getRealUserIp();

$delete_product = "delete from cart where ip_add='$ip_add' and p_id='$remove_id'";

$run_delete = mysqli_query($con,$delete_product);

if($run_delete){

$delete_cart_meta = "delete from cart_meta where ip_add='$ip_add' and product_id='$remove_id'";

$run_delete_cart_meta = mysqli_query($con,$delete_cart_meta);

if($run_delete_cart_meta){

echo "<script> window.open('cart.php','_self'); </script>";

}

}

}

}

}

echo @$up_cart = update_cart();

?>

<div id="row same-height-row">

<div class="col-md-3 col-sm-6">

<div class="box same-height headline">

<h3 class="text-center"> Otros Productos </h3>

</div>

</div>

<?php

$get_products = "select * from products order by rand() LIMIT 0,3";

$run_products = mysqli_query($con,$get_products);

while($row_products=mysqli_fetch_array($run_products)){

$pro_id = $row_products['product_id'];

$pro_title = $row_products['product_title'];

$pro_price = $row_products['product_price'];

$pro_img1 = $row_products['product_img1'];

$pro_label = $row_products['product_label'];

$manufacturer_id = $row_products['manufacturer_id'];

$get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";

$run_manufacturer = mysqli_query($db,$get_manufacturer);

$row_manufacturer = mysqli_fetch_array($run_manufacturer);

$manufacturer_name = $row_manufacturer['manufacturer_title'];

$pro_psp_price = $row_products['product_psp_price'];

$pro_url = $row_products['product_url'];

$product_type = $row_products['product_type'];

if($product_type != "variable_product"){
	
if($pro_label == "Sale" or $pro_label == "Gift"){

$product_price = "<del> $$pro_price </del>";

$product_psp_price = "| $$pro_psp_price";

}
else{

$product_psp_price = "";

$product_price = "$$pro_price";

}

}else{

$select_min_product_price = "select min(product_price) as product_price from product_variations where product_id='$pro_id' and product_price!='0'";

$run_min_product_price = mysqli_query($db,$select_min_product_price);

$row_min_product_price = mysqli_fetch_array($run_min_product_price);

$minimum_product_price = $row_min_product_price["product_price"];

$select_max_product_price = "select max(product_price) as product_price from product_variations where product_id='$pro_id'";

$run_max_product_price = mysqli_query($db,$select_max_product_price);

$row_max_product_price = mysqli_fetch_array($run_max_product_price);

$maximum_product_price = $row_max_product_price["product_price"];

$product_price = "$$minimum_product_price - $$maximum_product_price";

$product_psp_price = "";
	
}

if($pro_label == ""){

$product_label = "";

}
else{

$product_label = "

<a class='label sale' href='#' style='color:black;'>

<div class='thelabel'>$pro_label</div>

<div class='label-background'> </div>

</a>

";

}


echo "

<div class='col-md-3 col-sm-6 center-responsive' >

<div class='product' >

<a href='$pro_url' >

<img src='admin_area/product_images/$pro_img1' class='product-img'>

</a>

<div class='text' >

<center>

<p class='btn btn-primary'> $manufacturer_name </p>

</center>

<hr>

<h3 class='product-title'><a href='$pro_url' >$pro_title</a></h3>

<p class='price' > $product_price $product_psp_price </p>

<p class='buttons' >

<a href='$pro_url' class='btn btn-default' >Detalles</a>

<a href='$pro_url' class='btn btn-primary'>

<i class='fa fa-shopping-cart'></i> Agregar a Carrito
</a>


</p>

</div>

$product_label


</div>

</div>

";

}

?>

</div>

</div>

<div class="col-md-3">

<div class="box" id="order-summary">

<div class="box-header">

<h3>Resumen Orden</h3>

</div>

<p class="text-muted">
Los costos de envío y adicionales se calculan en función de los valores que ingresó.
</p>

<div class="table-responsive">

<table class="table">

<tbody id="cart-summary-tbody">

<tr>

<td> Subtotal: </td>

<th> $<?php echo $total; ?>.00 </th>

</tr>

<?php if(count($physical_products) > 0 ){ ?>

<tr>

<th colspan="2">

<p class="shipping-header text-muted"> Peso Total: <?php echo array_sum($total_weight); ?> Kg </p>

<p class="shipping-header text-muted"> <i class="fa fa-truck"></i> Envío: </p>

<ul class="shipping-ul-list list-unstyled">

<?php

if(isset($_SESSION['customer_email'])){

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$get_customers_addresses = "select * from customers_addresses where customer_id='$customer_id'";

$run_customers_addresses = mysqli_query($con,$get_customers_addresses);

$row_addresses = mysqli_fetch_array($run_customers_addresses);

$billing_country = $row_addresses["billing_country"];

$billing_postcode = $row_addresses["billing_postcode"];

$shipping_country = $row_addresses["shipping_country"];

$shipping_postcode = $row_addresses["shipping_postcode"];

foreach($vendors_ids as $vendor_id){
	
if( isset($physical_products[$vendor_id]) ){
	
$shipping_zone_id = "";
	
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

?>

<div class="shipping-vendor-header"> <?php echo $vendor_name; ?> Envío: </div>

<?php

if(@$_SESSION["is_shipping_address"] == "yes"){

if(empty($billing_country) and empty($billing_postcode)){

echo "

<li> 

<p> 

No hay envíos disponibles. Por favor revise su dirección, o contáctenos si necesita ayuda.

</p> 

</li>

";

}

$select_zones = "select * from zones where vendor_id='$vendor_id' order by zone_order DESC";

$run_zones = mysqli_query($con,$select_zones);

while($row_zones = mysqli_fetch_array($run_zones)){

$zone_id = $row_zones['zone_id'];

$select_zone_locations = "select DISTINCT zone_id from zones_locations where zone_id='$zone_id' and (location_code='$billing_country' and location_type='country')";

$run_zones_locations = mysqli_query($con,$select_zone_locations);
 
$count_zones_locations = mysqli_num_rows($run_zones_locations);

if($count_zones_locations != "0"){
	
$row_zones_locations = mysqli_fetch_array($run_zones_locations);

$zone_id = $row_zones_locations["zone_id"];	

$select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";

$run_zone_shipping = mysqli_query($con,$select_zone_shipping);

$count_zone_shipping = mysqli_num_rows($run_zone_shipping);

if($count_zone_shipping != "0"){

$select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id' and location_type='postcode'";

$run_zones_postcodes = mysqli_query($con,$select_zone_postcodes);

$count_zones_postcodes = mysqli_num_rows($run_zones_postcodes);

if($count_zones_postcodes != "0"){

while($row_zones_postcodes = mysqli_fetch_array($run_zones_postcodes)){

$location_code = $row_zones_postcodes["location_code"];

if($location_code == $billing_postcode){

$shipping_zone_id = $zone_id;
	
}

}

}else{

$shipping_zone_id = $zone_id;
	
}

}

}

}
	
}elseif(@$_SESSION["is_shipping_address"] == "no"){
	
if(empty($shipping_country) and empty($shipping_postcode)){

echo "

<li> 

<p> No hay envíos disponibles. Por favor revise su dirección, o contáctenos si necesita ayuda.</p> 

</li>

";

}

$select_zones = "select * from zones where vendor_id='$vendor_id' order by zone_order DESC";

$run_zones = mysqli_query($con,$select_zones);

while($row_zones = mysqli_fetch_array($run_zones)){

$zone_id = $row_zones['zone_id'];

$select_zone_locations = "select DISTINCT zone_id from zones_locations where zone_id='$zone_id' and (location_code='$shipping_country' and location_type='country')";

$run_zones_locations = mysqli_query($con,$select_zone_locations);
 
$count_zones_locations = mysqli_num_rows($run_zones_locations);

if($count_zones_locations != "0"){
	
$row_zones_locations = mysqli_fetch_array($run_zones_locations);

$zone_id = $row_zones_locations["zone_id"];	

$select_zone_shipping = "select * from shipping where shipping_zone='$zone_id'";

$run_zone_shipping = mysqli_query($con,$select_zone_shipping);

$count_zone_shipping = mysqli_num_rows($run_zone_shipping);

if($count_zone_shipping != "0"){

$select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id' and location_type='postcode'";

$run_zones_postcodes = mysqli_query($con,$select_zone_postcodes);

$count_zones_postcodes = mysqli_num_rows($run_zones_postcodes);

if($count_zones_postcodes != "0"){

while($row_zones_postcodes = mysqli_fetch_array($run_zones_postcodes)){

$location_code = $row_zones_postcodes["location_code"];

if($location_code == $shipping_postcode){

$shipping_zone_id = $zone_id;
	
}

}

}else{

$shipping_zone_id = $zone_id;
	
}

}

}

}	

}else{

if(empty($billing_country) and empty($billing_postcode)){

echo "

<li> 

<p> No hay envíos disponibles. Por favor revise su dirección, o contáctenos si necesita ayuda. </p> 

</li>

";

}

$select_zones = "select * from zones where vendor_id='$vendor_id' order by zone_order DESC";

$run_zones = mysqli_query($con,$select_zones);

while($row_zones = mysqli_fetch_array($run_zones)){

$zone_id = $row_zones['zone_id'];

$select_zone_locations = "select DISTINCT zone_id from zones_locations where zone_id='$zone_id' and (location_code='$billing_country' and location_type='country')";

$run_zones_locations = mysqli_query($con,$select_zone_locations);
 
$count_zones_locations = mysqli_num_rows($run_zones_locations);

if($count_zones_locations != "0"){
	
$row_zones_locations = mysqli_fetch_array($run_zones_locations);

$zone_id = $row_zones_locations["zone_id"];	

$select_zone_postcodes = "select * from zones_locations where zone_id='$zone_id' and location_type='postcode'";

$run_zones_postcodes = mysqli_query($con,$select_zone_postcodes);

$count_zones_postcodes = mysqli_num_rows($run_zones_postcodes);

if($count_zones_postcodes != "0"){

while($row_zones_postcodes = mysqli_fetch_array($run_zones_postcodes)){

$location_code = $row_zones_postcodes["location_code"];

if($location_code == $billing_postcode){

$shipping_zone_id = $zone_id;
	
}

}

}else{

$shipping_zone_id = $zone_id;
	
}

}

}

}

$shipping_weight = $total_weight[$vendor_id];

if(!empty($shipping_zone_id)){
	
$select_shipping = "
SELECT *,
IF (
$shipping_weight > (
SELECT MAX(shipping_weight)
FROM shipping
WHERE shipping_type = type_id
AND shipping_zone = '$shipping_zone_id'
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_zone = '$shipping_zone_id'
ORDER BY shipping_weight DESC
LIMIT 0, 1
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_zone = '$shipping_zone_id'
AND shipping_weight >= '$shipping_weight'
ORDER BY shipping_weight ASC
LIMIT 0, 1
)
) AS shipping_cost
FROM shipping_type
WHERE type_local = 'yes'
and vendor_id='$vendor_id'
ORDER BY type_order ASC
";

$run_shipping = mysqli_query($con,$select_shipping);

$i = 0;

while($row_shipping = mysqli_fetch_array($run_shipping)){
	
$i++;
	
$type_id = $row_shipping["type_id"];

$type_name = $row_shipping["type_name"];

$type_default = $row_shipping["type_default"];

$shipping_cost = $row_shipping["shipping_cost"];

if(!empty($shipping_cost)){
	
?>	

<li>

<input type="radio" name="[<?php echo $vendor_id; ?>][shipping_type]" value="<?php echo $type_id; ?>" class="shipping_type" data-shipping_cost="<?php echo $shipping_cost; ?>"

<?php  
	
if($type_default == "yes"){

$_SESSION["shipping_type_$vendor_id"] = $type_id;

$_SESSION["shipping_cost_$vendor_id"] = $shipping_cost;

echo "checked";

}elseif($i == 1){
	
$_SESSION["shipping_type_$vendor_id"] = $type_id;

$_SESSION["shipping_cost_$vendor_id"] = $shipping_cost;

echo "checked";
	
}

?>>

<span class="shipping-type-name"> 

<?php echo $type_name; ?>: <span class="text-muted"> $<?php echo $shipping_cost; ?> </span> 

</span>

</li>

<?php

}

}

}else{
	
if(!empty($billing_country) or !empty($shipping_country)){
	
if(@$_SESSION["is_shipping_address"] == "yes"){
	
$select_country_shipping = "select * from shipping where shipping_country='$billing_country'";

}elseif(@$_SESSION["is_shipping_address"] == "no"){
	
$select_country_shipping = "select * from shipping where shipping_country='$shipping_country'";
	
}else{

$select_country_shipping = "select * from shipping where shipping_country='$billing_country'";

}

$run_country_shipping = mysqli_query($con,$select_country_shipping);

$count_country_shipping = mysqli_num_rows($run_country_shipping);

if($count_country_shipping == "0"){

echo "

<li> 

<p> No hay tipos de envío que coincidan o estén disponibles para su dirección, contáctenos si necesita ayuda. </p> 

</li>

";

}else{
	
if(@$_SESSION["is_shipping_address"] == "yes"){

$select_shipping = "
SELECT *,
IF (
$shipping_weight > (
SELECT MAX(shipping_weight)
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$billing_country'
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$billing_country'
ORDER BY shipping_weight DESC
LIMIT 0, 1
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$billing_country'
AND shipping_weight >= '$shipping_weight'
ORDER BY shipping_weight ASC
LIMIT 0, 1
)
) AS shipping_cost
FROM shipping_type
WHERE type_local = 'no'
and vendor_id='$vendor_id'
ORDER BY type_order ASC
";

}elseif(@$_SESSION["is_shipping_address"] == "no"){
				
$select_shipping = "
SELECT *,
IF (
$shipping_weight > (
SELECT MAX(shipping_weight)
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$shipping_country'
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$shipping_country'
ORDER BY shipping_weight DESC
LIMIT 0, 1
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$shipping_country'
AND shipping_weight >= '$shipping_weight'
ORDER BY shipping_weight ASC
LIMIT 0, 1
)
) AS shipping_cost
FROM shipping_type
WHERE type_local = 'no'
and vendor_id='$vendor_id'
ORDER BY type_order ASC
";

}else{

$select_shipping = "
SELECT *,
IF (
$shipping_weight > (
SELECT MAX(shipping_weight)
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$billing_country'
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$billing_country'
ORDER BY shipping_weight DESC
LIMIT 0, 1
),
(
SELECT shipping_cost
FROM shipping
WHERE shipping_type = type_id
AND shipping_country = '$billing_country'
AND shipping_weight >= '$shipping_weight'
ORDER BY shipping_weight ASC
LIMIT 0, 1
)
) AS shipping_cost
FROM shipping_type
WHERE type_local = 'no'
and vendor_id='$vendor_id'
ORDER BY type_order ASC
";
	
}

$run_shipping = mysqli_query($con,$select_shipping);

$i = 0;

while($row_shipping = mysqli_fetch_array($run_shipping)){
	
$i++;
	
$type_id = $row_shipping["type_id"];

$type_name = $row_shipping["type_name"];

$type_default = $row_shipping["type_default"];

$shipping_cost = $row_shipping["shipping_cost"];

if(!empty($shipping_cost)){
	
?>	

<li>

<input type="radio" name="[<?php echo $vendor_id; ?>][shipping_type]" value="<?php echo $type_id; ?>" class="shipping_type" data-shipping_cost="<?php echo $shipping_cost; ?>"

<?php  
	
if($type_default == "yes"){

$_SESSION["shipping_type_$vendor_id"] = $type_id;

$_SESSION["shipping_cost_$vendor_id"] = $shipping_cost;

echo "checked";

}elseif($i == 1){
	
$_SESSION["shipping_type_$vendor_id"] = $type_id;

$_SESSION["shipping_cost_$vendor_id"] = $shipping_cost;

echo "checked";
	
}

?>>

<span class="shipping-type-name"> 

<?php echo $type_name; ?>: <span class="text-muted"> $<?php echo $shipping_cost; ?> </span> 

</span>

</li>

<?php

}

}

}
	
}

}

?>


<?php

}

}

}else{

echo "

<li> 

<p> No hay tipos de envío disponibles. Inicie sesión para ver los tipos de envío disponibles o contáctenos si necesita ayuda. </p> 

</li>

";
	
}

?>

</ul>

</th>

</tr>

<?php 

$total_shipping_cost = 0;

if(count($physical_products) > 0 ){
	
foreach($vendors_ids as $vendor_id){
	
if(isset($physical_products[$vendor_id])){
	
if(isset($_SESSION["shipping_cost_$vendor_id"])){
	
$total_shipping_cost += $_SESSION["shipping_cost_$vendor_id"];
	
}

}

}

}

$total_cart_price = $total + $total_shipping_cost;

} 

?>

<tr>

<td>Comisión:</td>

<th>$0.00</th>

</tr>

<tr class="total">

<td>Total:</td>

<?php if(count($physical_products) > 0 ){ ?>

<th class="total-cart-price">$<?php echo $total_cart_price; ?>.00</th>

<?php }else{ ?>

<th class="total-cart-price">$<?php echo $total; ?>.00</th>

<?php } ?>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){

$(document).on('keyup', '.quantity', function(){
	
var value = parseInt($(this).val(), 10);

var max = parseInt($(this).attr("max"), 10);

var min = parseInt($(this).attr("min"), 10);

if(value > max){
	
value = max;

$(this).val(value);
	
}else if(value < min){
	
value = min;

$(this).val(value);

}

var quantity = $(this).val();

var cart_id = $(this).data("cart_id");

var product_id = $(this).data("product_id");

if ( $( "input[name=shipping_type]" ).length ) {
	
var shipping_type = $("input[name=shipping_type]:checked").val();

var shipping_cost = Number($("input[name=shipping_type]:checked").data("shipping_cost"));

var post_data = {cart_id:cart_id, product_id:product_id, quantity:quantity, shipping_type: shipping_type, shipping_cost: shipping_cost};

}else{

var post_data = {cart_id:cart_id, product_id:product_id, quantity:quantity};	
	
}

if(quantity != ''){
	
$("table").addClass("wait-loader");

$.ajax({

url:"change.php",

method:"POST",

data:post_data,

success:function(data){
	
$(".subtotal-cart-price").html(data);
	
$("#cart-products-tbody").load('cart_body.php');

$("#cart-summary-tbody").load('cart_summary_body.php');

$("table").removeClass("wait-loader");

}

});

}

});

<?php if(count($physical_products) > 0 ){ ?>
	
$(document).on("change", ".shipping_type", function(){
	
var total_shipping_cost = Number(0);
	
<?php 

foreach($vendors_ids as $vendor_id){
	
if(isset($physical_products[$vendor_id])){

?>
	
var shipping_cost = Number($("input[name='[<?php echo $vendor_id; ?>][shipping_type]']:checked").data("shipping_cost"));

total_shipping_cost += shipping_cost;

<?php } } ?>

var total = Number(<?php echo $total; ?>);

var total_cart_price = total + total_shipping_cost;

$(".total-cart-price").html("$" + total_cart_price + ".00");
	
});

<?php } ?>

});

</script>

</body>

</html>