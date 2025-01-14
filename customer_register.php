<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

if(isset($_SESSION['customer_email'])){

echo "<script> window.open('index.php','_self'); </script>";	

}

$select_general_settings = "select * from general_settings";

$run_general_settings = mysqli_query($con,$select_general_settings);

$row_general_settings = mysqli_fetch_array($run_general_settings);

$enable_vendor = $row_general_settings["enable_vendor"];

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

<script src='https://www.google.com/recaptcha/api.js'></script>

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

<div class="box" >

<div class="box-header" >

<center>

<h2> Registrar Nuevo Usuario </h2>

</center>

</div>

<form action="customer_register.php" method="post" enctype="multipart/form-data" >

<div class="form-group" >

<label>Nombre</label>

<input type="text" class="form-control" name="c_name" value="<?php echo @$_POST["c_name"]; ?>" required>

</div>

<div class="form-group">

<label> Email</label>

<input type="email" class="form-control" name="c_email" value="<?php echo @$_POST["c_email"]; ?>" required>

</div>

<div class="form-group">

<label> Contraseña </label>

<div class="input-group">

<span class="input-group-addon">

<i class="fa fa-check tick1"> </i>

<i class="fa fa-times cross1"> </i>

</span>

<input type="password" class="form-control" id="pass" name="c_pass"  required>

<span class="input-group-addon">

<div id="meter_wrapper">

<span id="pass_type"> </span>

<div id="meter"> </div>

</div>

</span>

</div>

</div>

<div class="form-group">

<label> Nombre de Usuario </label>

<input type="text" class="form-control" name="c_username" value="<?php echo @$_POST["c_username"]; ?>" required>

</div>

<div class="form-group">

<label> Confirmar Contraseña </label>

<div class="input-group">

<span class="input-group-addon">

<i class="fa fa-check tick2"> </i>

<i class="fa fa-times cross2"> </i>

</span>

<input type="password" class="form-control confirm" id="con_pass" required>

</div>

</div>

<div class="form-group">

<label> Contacto </label>

<input type="text" class="form-control" name="c_contact" value="<?php echo @$_POST["c_contact"]; ?>" required>

</div>

<div class="form-group">

<label> Imagen de Perfil </label>

<input type="file" class="form-control" name="c_image" value="<?php echo @$_POST["c_image"]; ?>" required>

</div>

<?php if($enable_vendor == "yes"){ ?>

<div class="form-group">

<label> Rol </label>

<br>

<input type="radio" name="c_role" value="customer" required> Cliente

<input type="radio" name="c_role" value="vendor" required> Vendedor

</div>

<?php }elseif($enable_vendor == "no"){ ?>

<input type="hidden" name="c_role" value="customer">

<?php } ?>

<div class="text-center">

<button type="submit" name="register" class="btn btn-primary">

<i class="fa fa-user-md"></i> Registrarse

</button>

</div>

</form>

</div>

</div>

</div>
</div>

<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){

$('.tick1').hide();
$('.cross1').hide();

$('.tick2').hide();
$('.cross2').hide();


$('.confirm').focusout(function(){

var password = $('#pass').val();

var confirmPassword = $('#con_pass').val();

if(password == confirmPassword){

$('.tick1').show();
$('.cross1').hide();

$('.tick2').show();
$('.cross2').hide();



}
else{

$('.tick1').hide();
$('.cross1').show();

$('.tick2').hide();
$('.cross2').show();


}


});


});

</script>

<script>

$(document).ready(function(){

$("#pass").keyup(function(){

check_pass();

});

});

function check_pass() {
 var val=document.getElementById("pass").value;
 var meter=document.getElementById("meter");
 var no=0;
 if(val!="")
 {

if(val.length<=6)no=1;

  if(val.length>6 && (val.match(/[a-z]/) || val.match(/\d+/) || val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)))no=2;

  if(val.length>6 && ((val.match(/[a-z]/) && val.match(/\d+/)) || (val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/)) || (val.match(/[a-z]/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))))no=3;

  if(val.length>6 && val.match(/[a-z]/) && val.match(/\d+/) && val.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/))no=4;

  if(no==1)
  {
   $("#meter").animate({width:'50px'},300);
   meter.style.backgroundColor="red";
   document.getElementById("pass_type").innerHTML="Muy Débil";
  }

  if(no==2)
  {
   $("#meter").animate({width:'100px'},300);
   meter.style.backgroundColor="#F5BCA9";
   document.getElementById("pass_type").innerHTML="Débil";
  }

  if(no==3)
  {
   $("#meter").animate({width:'150px'},300);
   meter.style.backgroundColor="#FF8000";
   document.getElementById("pass_type").innerHTML="Fuerte";
  }

  if(no==4)
  {
   $("#meter").animate({width:'200px'},300);
   meter.style.backgroundColor="#00FF40";
   document.getElementById("pass_type").innerHTML="Muy Fuerte";
  }
 }

 else
 {
  meter.style.backgroundColor="";
  document.getElementById("pass_type").innerHTML="";
 }
}

</script>

</body>

</html>

<?php

if(isset($_POST['register'])){

$secret = "6Lc-WxYUAAAAAN5j2OdDsryWwGfREg5eeuZFpKMv";

$response = $_POST['g-recaptcha-response'];

$remoteip = $_SERVER['REMOTE_ADDR'];

$result = json_decode($url, TRUE);

$c_name = mysqli_real_escape_string($con, $_POST['c_name']);

$c_email = mysqli_real_escape_string($con, $_POST['c_email']);

$c_pass = mysqli_real_escape_string($con, $_POST['c_pass']);

$encrypted_password = password_hash($c_pass, PASSWORD_DEFAULT);

$c_username = mysqli_real_escape_string($con, $_POST['c_username']);

$c_contact = mysqli_real_escape_string($con, $_POST['c_contact']);

$c_role = mysqli_real_escape_string($con, $_POST['c_role']);

$c_image = $_FILES['c_image']['name'];

$c_image_tmp = $_FILES['c_image']['tmp_name'];

$c_ip = getRealUserIp();

if(!filter_var($c_email, FILTER_VALIDATE_EMAIL)){
	
echo "<script>alert('Su Email no es una dirección de correo electrónico válida.');</script>";
	
exit();

}

$allowed = array('jpeg','jpg','gif','png','tif','avi');

$file_extension = pathinfo($c_image, PATHINFO_EXTENSION);

if(!in_array($file_extension,$allowed)){
	 
echo "<script>alert('Su formato de archivo, extensión no es compatible.');</script>";

exit();

}else{

move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");

}

$get_email = "select * from customers where customer_email='$c_email'";

$run_email = mysqli_query($con,$get_email);

$check_email = mysqli_num_rows($run_email);

if($check_email == 1){

echo "<script>alert('Este correo electrónico ya está registrado, pruebe con otro')</script>";

exit();

}

$get_name = "select * from customers where customer_name='$c_name'";

$run_name = mysqli_query($con,$get_name);

$check_name = mysqli_num_rows($run_name);

if($check_name == 1){

echo "<script>alert('Este nombre ya está registrado, intente con otro')</script>";

exit();

}

$select_customer_username = "select * from customers where customer_username='$c_username'";

$run_customer_username = mysqli_query($con,$select_customer_username);

$count_customer_username = mysqli_num_rows($run_customer_username);

if($count_customer_username == 1){

echo "<script> alert('Su nombre de usuario ingresado ya está registrado, pruebe con otro.'); </script>";

exit();

}else{

$select_admin_username = "select * from admins where admin_username='$c_username'";

$run_admin_username = mysqli_query($con,$select_admin_username);

$count_admin_username = mysqli_num_rows($run_admin_username);

if($count_admin_username == 1){
	
echo "<script> alert(' Su nombre de usuario ingresado ya está registrado, pruebe con otro.'); </script>";

exit();

}

}

$customer_confirm_code = mt_rand();

$subject = "Mensaje de confirmación por Email";

$from = "ShoiStore@gmail.com";

$message = "

<h2>
Email de Confirmación para ShoiStore.com $c_name
</h2>

<a href='localhost/shoistore/customer/my_account.php?$customer_confirm_code'>

Click Aquí para confirmar Email

</a>

";

$headers = "From: $from \r\n";

$headers .= "Content-type: text/html\r\n";

mail($c_email,$subject,$message,$headers);

$insert_customer = "insert into customers (customer_name,customer_email,customer_pass,customer_username,customer_contact,customer_image,customer_ip,customer_confirm_code,customer_role) values ('$c_name','$c_email','$encrypted_password','$c_username','$c_contact','$c_image','$c_ip','$customer_confirm_code','$c_role')";

$run_customer = mysqli_query($con,$insert_customer);

$last_customer_id = mysqli_insert_id($con); 

$insert_customers_addresses = "insert into customers_addresses (customer_id) values ('$last_customer_id')";

$run_customers_addresses = mysqli_query($con,$insert_customers_addresses);

if($c_role == "vendor"){

$insert_store_settings = "insert into store_settings (vendor_id) values ('$last_customer_id')";

$run_store_settings = mysqli_query($con,$insert_store_settings);

$insert_vendor_account = "insert into vendor_accounts (vendor_id) values ('$last_customer_id')";		

$run_vendor_account = mysqli_query($con,$insert_vendor_account);
	
}

$sel_cart = "select * from cart where ip_add='$c_ip'";

$run_cart = mysqli_query($con,$sel_cart);

$check_cart = mysqli_num_rows($run_cart);

if($check_cart>0){
	
if($run_customer){

$_SESSION['customer_email']=$c_email;

echo "<script>alert('Te has registrado correctamente')</script>";

echo "<script>window.open('checkout.php','_self')</script>";

}

}else{

$_SESSION['customer_email']=$c_email;

echo "<script>alert('Te has registrado correctamente')</script>";

echo "<script>window.open('index.php','_self')</script>";

}


}

?>