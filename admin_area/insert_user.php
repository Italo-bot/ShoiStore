<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
?>

<div class="row" >

<div class="col-lg-12" >

<ol class="breadcrumb" >

<li class="active" >

<i class="fa fa-dashboard" ></i> Dashboard / Agregar Admin

</li>

</ol>

</div>

</div>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default" >

<div class="panel-heading" >

<h3 class="panel-title" >

<i class="fa fa-money fa-fw" ></i> Agregar Admin

</h3>


</div>


<div class="panel-body">

<form class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label">Nombre: </label>

<div class="col-md-6">

<input type="text" name="admin_name" class="form-control" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Usuario Email: </label>

<div class="col-md-6">

<input type="text" name="admin_email" class="form-control" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Usuario contraseña: </label>

<div class="col-md-6">

<input type="password" name="admin_pass" class="form-control" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Nombre de usuario: </label>

<div class="col-md-6">

<input type="password" name="admin_username" class="form-control" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">País de usuario: </label>

<div class="col-md-6">

<input type="text" name="admin_country" class="form-control" required>

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label">Trabajo de usuario: </label>

<div class="col-md-6">

<input type="text" name="admin_job" class="form-control" required>

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label">Contacto de usuario: </label>

<div class="col-md-6">

<input type="text" name="admin_contact" class="form-control" required>

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label">Sobre el Usuario: </label>

<div class="col-md-6">

<textarea name="admin_about" class="form-control" rows="3"> </textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Imagen: </label>

<div class="col-md-6">

<input type="file" name="admin_image" class="form-control" required>

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="submit" value="Agregar" class="btn btn-primary form-control">

</div>

</div>


</form>

</div>

</div>

</div>


</div>

<?php

if(isset($_POST['submit'])){

$admin_name = $_POST['admin_name'];

$admin_email = $_POST['admin_email'];

$admin_pass = $_POST['admin_pass'];

$encrypted_password = password_hash($admin_pass, PASSWORD_DEFAULT);

$admin_username = $_POST['admin_username'];

$admin_country = $_POST['admin_country'];

$admin_job = $_POST['admin_job'];

$admin_contact = $_POST['admin_contact'];

$admin_about = $_POST['admin_about'];

$admin_image = $_FILES['admin_image']['name'];

$temp_admin_image = $_FILES['admin_image']['tmp_name'];

move_uploaded_file($temp_admin_image,"admin_images/$admin_image");

$select_admin_username = "select * from admins where admin_username='$admin_username'";

$run_admin_username = mysqli_query($con,$select_admin_username);

$count_admin_username = mysqli_num_rows($run_admin_username);

if($count_admin_username == 1){

echo "<script> alert(' Su nombre de usuario ingresado ya está registrado, pruebe con otro.'); </script>";

exit();

}else{

$select_customer_username = "select * from customers where customer_username='$admin_username'";

$run_customer_username = mysqli_query($con,$select_customer_username);

$count_customer_username = mysqli_num_rows($run_customer_username);

if($count_customer_username == 1){
	
echo "<script> alert('Su nombre de usuario ingresado ya está registrado, pruebe con otro.'); </script>";

exit();

}

}

$insert_admin = "insert into admins (admin_name,admin_email,admin_pass,admin_username,admin_image,admin_contact,admin_country,admin_job,admin_about) values ('$admin_name','$admin_email','$encrypted_password','$admin_username','$admin_image','$admin_contact','$admin_country','$admin_job','$admin_about')";

$run_admin = mysqli_query($con,$insert_admin);

$insert_admin_id = mysqli_insert_id($con); 

if($run_admin){
	
$insert_store_settings = "insert into store_settings (vendor_id) values ('admin_$insert_admin_id')";

$run_store_settings = mysqli_query($con,$insert_store_settings);

echo "<script>alert('El usuario ha sido insertado con éxito')</script>";

echo "<script>window.open('index.php?view_users','_self')</script>";

}


}


?>



<?php }  ?>