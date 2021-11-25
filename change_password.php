<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if(isset($_SESSION['customer_email'])){

echo " <script> window.open('checkout.php','_self'); </script> ";
	
}

if(!isset($_GET['change_password'])){

echo " <script> window.open('checkout.php','_self'); </script> ";
	
}else{
	
$hash_password = mysqli_real_escape_string($con, $_GET['change_password']);

$select_customer = "select * from customers where customer_pass='$hash_password'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_name = $row_customer['customer_name'];

$count_customer = mysqli_num_rows($run_customer);

if($count_customer == 0){
	
echo " <script> window.open('checkout.php','_self'); </script> ";

}
	
}

?>
<!DOCTYPE html>
<html>

<head>
<title>ShoiStore</title>

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

<div class="col-md-12" >

<ul class="breadcrumb" >

<li>
<a href="index.php">Home</a>
</li>

<li>Registrarse</li>

</ul>


</div>

<div class="col-md-12" >

<div class="box">

<div class="box-header">

<center>

<h3> Dear <?php echo $customer_name; ?> , Cambiar Contraseña </h3>

</center>

</div>

<div align="center">

<form action="" method="post">

<div class="form-group">

<input type="password" class="form-control" name="customer_pass" placeholder="Nueva Contraseña" required>

</div>

<div class="form-group">

<input type="password" class="form-control" name="confirm_customer_pass" placeholder="Confirma tu nueva Contraseña" required>

</div>

<div class="form-group">

<input type="submit" name="reset_password" class="btn btn-primary" value="Cambiar Contraseña">

</div>

</form>

</div>

</div>

</div>

</div>

</div>



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php

if(isset($_POST['reset_password'])){

$hash_password = mysqli_real_escape_string($con, $_GET['change_password']);

$customer_pass = mysqli_real_escape_string($con,$_POST['customer_pass']);

$confirm_customer_pass = mysqli_real_escape_string($con,$_POST['confirm_customer_pass']);

if($customer_pass != $confirm_customer_pass){

echo "

<script>

alert('Su nueva contraseña no coincide. Vuelva a intentarlo.');
 
</script>

";

}else{

$encrypted_password = password_hash($confirm_customer_pass, PASSWORD_DEFAULT);

$upadte_customer_password = "update customers set customer_pass='$encrypted_password' where customer_pass='$hash_password'"; 

$run_customer_password = mysqli_query($con,$upadte_customer_password);

if($run_customer_password){
	
echo "

<script>

alert('Su contraseña de cliente se ha cambiado correctamente.');

window.open('checkout.php','_self');

</script>

";

}

}

}

?>

