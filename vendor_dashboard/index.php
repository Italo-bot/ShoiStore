<?php

session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}else{

include("includes/db.php");

include("functions/functions.php");

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_role = $row_customer['customer_role'];

if($customer_role == "customer"){
	
echo "<script> window.open('../customer/my_account.php?my_orders','_self'); </script>";

}

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

<script src="js/jquery.min.js"> </script>

<script src="js/jquery-ui.min.js"></script>

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
<?php 

if(isset($_SESSION['customer_email'])){
	
$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_role = $row_customer['customer_role'];

if($customer_role == "customer"){ 

?>

<li>

<a href="../shop.php"> Tienda </a>

</li>

<?php }elseif($customer_role == "vendor"){ ?>

<li>

<a href="index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='../customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>
</li>

<li>
<a href="../cart.php">
Ir al Carrito
</a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php'> Acceder </a>";

}else {

echo "<a href='../customer/logout.php'> Cerrar Sesión </a>";

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

<a class="navbar-brand home" href="../index.php" >

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
<a href="../index.php"> Home </a>
</li>

<li>
<a href="../shop.php"> Tienda </a>
</li>

<li class="active">
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='../customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>
</li>

<li>
<a href="../cart.php"> Carrito </a>
</li>

<li>
<a href="../about.php"> ¿Quiénes Somos? </a>
</li>

<li>

<a href="../services.php"> Servicios </a>

</li>

<li>
<a href="../contact.php"> Contáctanos </a>
</li>

</ul>

</div>

<a class="btn btn-primary navbar-btn right" href="../cart.php">

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

<div id="content" class="container-fluid">

<div class="row">

<div class="col-md-12" >

<ul class="breadcrumb" >

<li><a href="index.php">Home</a></li>

<li> Vendedor Dashboard </li>

</ul>

</div>

<div class="col-md-12">

<?php

$c_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$c_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_confirm_code = $row_customer['customer_confirm_code'];

$c_name = $row_customer['customer_name'];

if(!empty($customer_confirm_code)){

?>

<div class="alert alert-danger">

<strong> Advertencia! </strong> Confirme su Email y si no ha recibido su Email de confirmación

<a href="my_account.php?send_email" class="alert-link"> 

Enviar Email de nuevo

</a>

</div>

<?php } ?>

</div>

<div class="col-md-3">

<?php include("includes/vendor_sidebar.php"); ?>

</div>

<div class="col-md-9" >

<div class="box">

<?php

if(!empty($customer_confirm_code)){

echo "<h3 class='text-center'> Confirme su correo electrónico para acceder al Dashboard de Vendedor.</h3>";

}else{
	
if(empty($_GET)){

include("dashboard.php");

}

if(isset($_GET['products'])){

include("products.php");

}

if(isset($_GET['insert_product'])){

include("insert_product.php");

}

if(isset($_GET['edit_product'])){

include("edit_product.php");

}

if(isset($_GET['delete_product'])){

include("delete_product.php");

}

if(isset($_GET['pause_product'])){

include("pause_product.php");

}

if(isset($_GET['activate_product'])){

include("activate_product.php");

}

if(isset($_GET['bundles'])){

include("bundles.php");

}

if(isset($_GET['insert_bundle'])){

include("insert_bundle.php");

}

if(isset($_GET['edit_bundle'])){

include("edit_bundle.php");

}

if(isset($_GET['orders'])){

include("orders.php");

}

if(isset($_GET['view_order_id'])){

include("view_order_id.php");

}

if(isset($_GET['coupons'])){

include("coupons.php");

}

if(isset($_GET['insert_coupon'])){

include("insert_coupon.php");

}

if(isset($_GET['edit_coupon'])){

include("edit_coupon.php");

}

if(isset($_GET['delete_coupon'])){

include("delete_coupon.php");

}

if(isset($_GET['reviews'])){

include("reviews.php");

}

if(isset($_GET['change_review_status'])){

include("change_review_status.php");

}

if(isset($_GET['payments'])){

include("payments.php");

}

if(isset($_GET['withdraw'])){

include("withdraw.php");

}

if(isset($_GET['withdraw_request'])){

include("withdraw_request.php");

}

if(isset($_GET['cancel_withdraw_request'])){

include("cancel_withdraw_request.php");

}

if(isset($_GET['store_settings'])){

include("store_settings.php");

}

if(isset($_GET['payment_settings'])){

include("useless-delete-payment_settings.php");

}

if(isset($_GET['shipping_zones'])){

include("shipping_zones.php");

}

if(isset($_GET['insert_shipping_zone'])){

include("insert_shipping_zone.php");

}

if(isset($_GET['edit_shipping_zone'])){

include("edit_shipping_zone.php");

}

if(isset($_GET['delete_shipping_zone'])){

include("delete_shipping_zone.php");

}

if(isset($_GET['shipping_types'])){

include("shipping_types.php");

}

if(isset($_GET['insert_shipping_type'])){

include("insert_shipping_type.php");

}

if(isset($_GET['edit_shipping_type'])){

include("edit_shipping_type.php");

}

if(isset($_GET['delete_shipping_type'])){

include("delete_shipping_type.php");

}

if(isset($_GET['edit_shipping_rates'])){

include("edit_shipping_rates.php");

}

if(isset($_GET['seo_settings'])){

include("seo_settings.php");

}

if(isset($_GET['delete_note'])){

include("delete_note.php");

}

}

?>


</div>

</div>

</div>

</div>

<?php

include("includes/footer.php");

?>

<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php } ?>