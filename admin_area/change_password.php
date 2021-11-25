<?php

session_start();

include("includes/db.php");

if(isset($_SESSION['admin_email'])){

echo "<script>window.open('index.php','_self')</script>";

}

if(!isset($_GET['change_password'])){

echo " <script> window.open('login.php','_self'); </script> ";
	
}else{
	
$hash_password = mysqli_real_escape_string($con, $_GET['change_password']);

$select_admin = "select * from admins where admin_pass='$hash_password'";

$run_admin = mysqli_query($con,$select_admin);

$count_admin = mysqli_num_rows($run_admin);

if($count_admin == 0){
	
echo " <script> window.open('login.php','_self'); </script> ";

}
	
}

?>
<!DOCTYPE HTML>
<html>

<head>

<title>Acceso Administradores</title>

<link rel="stylesheet" href="css/bootstrap.min.css" >

<link rel="stylesheet" href="css/login.css" >

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

<div class="container" >

<div class="alert alert-info">

<strong>Insinuación:</strong> 

La contraseña debe tener al menos doce caracteres. Para hacerlo más fuerte, use letras mayúsculas y minúsculas, números y símbolos como! "? $% ^ &).

</div>

<form class="form-login" action="" method="post" >

<h2 class="form-login-heading" style="margin-top:0px;"> Cambiar Contraseña </h2>

<input type="password" class="form-control" name="admin_pass" placeholder="Nueva contraseña" required>

<input type="password" class="form-control" name="confirm_admin_pass" placeholder="Confirmar nueva contraseña" required>

<button class="btn btn-lg btn-primary btn-block" type="submit" name="reset_password">

Cambiar

</button>

</form>

</div>

</body>

</html>

<?php

if(isset($_POST['reset_password'])){
	
$hash_password = mysqli_real_escape_string($con, $_GET['change_password']);

$admin_pass = mysqli_real_escape_string($con,$_POST['admin_pass']);

$confirm_admin_pass = mysqli_real_escape_string($con,$_POST['confirm_admin_pass']);

if($admin_pass != $confirm_admin_pass){

echo "

<script>

alert('Su nueva contraseña no coincide. Vuelva a intentarlo.');
 
</script>

";

}else{

$encrypted_password = password_hash($confirm_admin_pass, PASSWORD_DEFAULT);

$upadte_admin_password = "update admins set admin_pass='$encrypted_password' where admin_pass='$hash_password'"; 

$run_admin_password = mysqli_query($con,$upadte_admin_password);

if($run_admin_password){
	
echo "

<script>

alert('Su contraseña de administrador se ha cambiado correctamente.');

window.open('login.php','_self');

</script>

";

}

}

}

?>