<?php

session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}else {

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

echo "Bienvenid@ : " . $_SESSION['customer_email'] . "";

}


?>
</a>

<a href="#">
Precio Total: <?php total_price(); ?>, Cantidad de Items:<?php items(); ?>
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

<a href="../vendor_dashboard/index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='my_account.php?my_orders'>Mi Cuenta</a>";

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

echo "<a href='my_account.php?my_orders'>Mi Cuenta</a>";

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

<div id="content">

<div class="container-fluid">

<div class="col-md-12" >

<ul class="breadcrumb" >

<li><a href="index.php">Home</a></li>

<li>Mi Cuenta</li>

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

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-9" >

<div class="box">

<?php

if(isset($_GET[$customer_confirm_code])){

$update_customer = "update customers set customer_confirm_code='' where customer_confirm_code='$customer_confirm_code'";

$run_confirm = mysqli_query($con,$update_customer);

echo "<script>alert('Tu correo ha sido confirmado')</script>";

echo "<script>window.open('my_account.php?my_orders','_self')</script>";

}

if(isset($_GET['send_email'])){

$subject = "Email de Confirmación ShoiStore";

$from = "ShoiStore@gmail.com";

$message = "

<h2>
Email de Confirmación de ShoiStore $c_name
</h2>

<a href='localhost/shoistore/customer/my_account.php?$customer_confirm_code'>

Click Aquí para confirmar

</a>

";

$headers = "From: $from \r\n";

$headers .= "Content-type: text/html\r\n";

mail($c_email,$subject,$message,$headers);

echo "<script>alert('Su correo electrónico de confirmación le ha sido enviado, revise su bandeja de entrada')</script>";

echo "<script>window.open('my_account.php?my_orders','_self')</script>";

}



if(isset($_GET['my_orders'])){

include("my_orders.php");

}

if(isset($_GET['edit_account'])) {

include("edit_account.php");

}

if(isset($_GET['change_pass'])){

include("change_pass.php");

}

if(isset($_GET['delete_account'])){

include("delete_account.php");

}

if(isset($_GET['my_wishlist'])){

include("my_wishlist.php");

}

if(isset($_GET['delete_wishlist'])){

include("delete_wishlist.php");

}

if(isset($_GET['my_addresses'])){

include("my_addresses.php");

}

?>

</div>


</div>

</div>

</div>

<?php include("includes/footer.php"); ?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>
<?php } ?>