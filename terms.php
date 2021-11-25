<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

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

<li>
<a href="customer_register.php">
Registrarse
</a>
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

</ul>>
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

<li class="active">
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

<li> <a href="index.php">Home</a> </li>

<li>Términos y Condiciones</li>

</ul>

</div>

<div class="col-md-3">

<div class="box">

<ul class="nav nav-pills nav-stacked">

<?php

$get_terms = "select * from terms LIMIT 0,1";

$run_terms = mysqli_query($con,$get_terms);

while($row_terms = mysqli_fetch_array($run_terms)){ 

$term_title = $row_terms['term_title'];

$term_link = $row_terms['term_link'];

?>

<li class="active">

<a data-toggle="pill" href="#<?php echo $term_link; ?>">

<?php echo $term_title; ?>

</a>

</li>

<?php } ?>

<?php

$count_terms = "select * from terms";

$run_count = mysqli_query($con,$count_terms);

$count = mysqli_num_rows($run_count);

$get_terms = "select * from terms LIMIT 1,$count";

$run_terms = mysqli_query($con,$get_terms);

while($row_terms = mysqli_fetch_array($run_terms)){

$term_title = $row_terms['term_title'];

$term_link = $row_terms['term_link'];

?>

<li>

<a data-toggle="pill" href="#<?php echo $term_link; ?>">

<?php echo $term_title; ?>

</a>

</li>

<?php } ?>

</ul>

</div>

</div>

<div class="col-md-9">

<div class="box">

<div class="tab-content" >

<?php

$get_terms = "select * from terms LIMIT 0,1";

$run_terms = mysqli_query($con,$get_terms);

while($row_terms = mysqli_fetch_array($run_terms)){

$term_title = $row_terms['term_title'];

$term_desc = $row_terms['term_desc'];

$term_link = $row_terms['term_link'];

?>

<div id="<?php echo $term_link; ?>" class="tab-pane fade in active" >

<h1> <?php echo $term_title; ?>  </h1>

<p> <?php echo $term_desc; ?> </p>

</div>

<?php } ?>

<?php

$count_terms = "select * from terms";

$run_count = mysqli_query($con,$count_terms);

$count = mysqli_num_rows($run_count);

$get_terms = "select * from terms LIMIT 1,$count";

$run_terms = mysqli_query($con,$get_terms);

while($row_terms = mysqli_fetch_array($run_terms)){

$term_title = $row_terms['term_title'];

$term_desc = $row_terms['term_desc'];

$term_link = $row_terms['term_link'];

?>

<div id="<?php echo $term_link; ?>" class="tab-pane fade in">

<h1><?php echo $term_title; ?></h1>

<p><?php echo $term_desc; ?></p>

</div>

<?php } ?>

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