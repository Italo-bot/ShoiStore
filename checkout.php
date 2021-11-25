<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

define("customer_login", TRUE);

define("review_order", TRUE);

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

<script src="js/jquery.min.js"></script>

<script src="https://checkout.stripe.com/checkout.js"></script>

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
Precio Total: <?php total_price(); ?>, Cantidad de Items: <?php items(); ?>
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


<div id="content" >
<div class="container" >

<div class="col-md-12">

<?php if(!isset($_SESSION['customer_email'])){ ?>

<ul class="breadcrumb">

<li><a href="index.php">Home</a></li>

<li>Acceso</li>

</ul>

<?php }else{ ?>

<ul class="breadcrumb">

<li><a href="index.php">Home</a></li>

<li>Detalles de Pago</li>

</ul>

<nav class="checkout-breadcrumbs text-center">

<a href="cart.php">Carrito</a>

<i class="fa fa-chevron-right"></i>

<a href="checkout.php" class="active">Detalles de Pago</a>

<i class="fa fa-chevron-right"></i>

<a href="#"> Orden Completada </a>

</nav>
	
<?php } ?>

</div>

<div class="col-md-12" >

<?php

if(!isset($_SESSION['customer_email'])){

include("customer/customer_login.php");

}else{

include("review_order.php");

}

?>

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>

</html>