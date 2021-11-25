<?php

session_start();

include("includes/db.php");

if(isset($_SESSION['admin_email'])){

echo "<script>window.open('index.php','_self')</script>";

}

?>
<!DOCTYPE HTML>
<html>

<head>

<title>ShoiStore (Admin)</title>

<link rel="stylesheet" href="css/bootstrap.min.css" >

<link rel="stylesheet" href="css/login.css" >

</head>

<body>

<div class="container" >
<form class="form-login" action="" method="post" >

<h2 class="form-login-heading" >Acceso Administradores</h2>

<input type="text" class="form-control" name="admin_email" placeholder="Email" required >

<input type="password" class="form-control" name="admin_pass" placeholder="Contraseña" required >

<button class="btn btn-lg btn-primary btn-block" type="submit" name="admin_login" >

Iniciar sesión

</button>

<h4 class="forgot-password">

<a href="forgot_password.php"> ¿Perdiste tu contraseña? Has olvidado tu contraseña</a>

</h4>

</form>

</div>

</body>

</html>

<?php

if(isset($_POST['admin_login'])){

$admin_email = mysqli_real_escape_string($con,$_POST['admin_email']);

$admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);

$decrypt_get_admin = "select * from admins where admin_email='$admin_email'";

$decrypt_run_admin = mysqli_query($con,$decrypt_get_admin);

$row_decrypt_admin = mysqli_fetch_array($decrypt_run_admin);

$hash_password = $row_decrypt_admin["admin_pass"];

$decryt_password = password_verify($admin_pass, $hash_password);

if($decryt_password == 0){
	
echo "<script>alert('El Email o la contraseña son incorrectos, inténtelo de nuevo')</script>";

}else{

$get_admin = "select * from admins where admin_email='$admin_email' AND admin_pass='$hash_password'";

$run_admin = mysqli_query($con,$get_admin);

if($run_admin){

$_SESSION['admin_email']=$admin_email;

$_SESSION['loggedin_time'] = time();

echo "<script>alert('Ha iniciado sesión en el panel de administración')</script>";

echo "<script>window.open('index.php?dashboard','_self')</script>";

}

}

}

?>