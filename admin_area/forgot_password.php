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

<title>Acceso Administradores</title>

<link rel="stylesheet" href="css/bootstrap.min.css" >

<link rel="stylesheet" href="css/login.css" >

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

<div class="container" ><!-- container Starts -->

<div class="alert alert-info">

<strong>Info!</strong> Por favor, introduzca su Email. Recibirá un enlace para crear una nueva contraseña por Email.
  
</div>

<form class="form-login" action="" method="post" ><!-- form-login Starts -->

<h2 class="form-login-heading"> Has olvidado tu contraseña </h2>

<input type="text" class="form-control" name="admin_email" placeholder="Email" required>

<button class="btn btn-lg btn-primary btn-block" type="submit" name="forgot_password">

Enviar

</button>

<h4 class="forgot-password">

<a href="login.php"> <i class="fa fa-arrow-left"></i> Volver al Login </a>

</h4>

</form><!-- form-login Ends -->

</div><!-- container Ends -->

</body>

</html>

<?php

if(isset($_POST['forgot_password'])){

$admin_email = mysqli_real_escape_string($con,$_POST['admin_email']);

$select_admin = "select * from admins where admin_email='$admin_email'";

$run_admin = mysqli_query($con,$select_admin);

$count_admin = mysqli_num_rows($run_admin);

if($count_admin == 0){
	
echo "<script> alert('Lo sentimos, no tenemos su dirección de correo electrónico en el registro de administradores.'); </script>";

}else{
	
$row_admin = mysqli_fetch_array($run_admin);

$admin_name = $row_admin["admin_name"];

$hash_password = $row_admin["admin_pass"];
	
$message = "

<img src='http://localhost/shoistore/images/email-logo.png' width='100'>

<h3> Alguien ha solicitado un restablecimiento de contraseña para la siguiente cuenta de administrador:</h3>

<h3> Site Url : www.ShoiStore.com </h3>

<h3> Email : $admin_email  </h3>

<h3> Nombre : $admin_name </h3>

<h3> Si esto fue un error, simplemente ignore este correo electrónico y no sucederá nada.</h3>

<h3>

<a href='http://localhost/shoistore/admin_area/change_password.php?change_password=$hash_password'>
 
Para restablecer / cambiar su contraseña, haga clic aquí
 
</a>

</h3>

";

$from = "ShoiStore@gmail.com"; 

$subject = "!Importante ShoiStore Restablecer su contraseña de administrador";

$headers = "From: $from\r\n";

$headers .= "Content-type: text/html\r\n";

mail($admin_email,$subject,$message,$headers);

echo "

<script>

alert('Su enlace de restablecimiento / cambio de contraseña ha sido enviado a su Email, por favor revise su bandeja de entrada.');

window.open('login.php', '_self');

</script>

";
	
}


}

?>