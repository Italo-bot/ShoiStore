<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

<div class="row" >

<div class="col-lg-12" >

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Agregar Servicio

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Agregar Servicio
</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre : </label>

<div class="col-md-6">

<input type="text" name="service_title" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Imagen : </label>

<div class="col-md-6">

<input type="file" name="service_image" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Descripción : </label>

<div class="col-md-6">

<textarea name="service_desc" class="form-control" rows="10" cols="19">

</textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Botón de servicio : </label>

<div class="col-md-6">

<input type="text" name="service_button" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> URL servicio : </label>

<div class="col-md-6">

<input type="url" name="service_url" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

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

$service_title = $_POST['service_title'];

$service_desc = $_POST['service_desc'];

$service_button = $_POST['service_button'];

$service_url = $_POST['service_url'];

$service_image = $_FILES['service_image']['name'];

$tmp_image = $_FILES['service_image']['tmp_name'];

$sel_services = "select * from services";

$run_services = mysqli_query($con,$sel_services);

$count = mysqli_num_rows($run_services);

if($count == 3){

echo "<script>alert('Ya ha insertado 3 columnas de servicios')</script>";

}
else{

move_uploaded_file($tmp_image,"services_images/$service_image");

$insert_service = "insert into services (service_title,service_image,service_desc,service_button,service_url) values ('$service_title','$service_image','$service_desc','$service_button','$service_url')";

$run_service = mysqli_query($con,$insert_service);

if($run_service){

echo "<script>alert('Se ha insertado una nueva columna de servicio')</script>";

echo "<script>window.open('index.php?view_services','_self')</script>";

}

}

}

?>

<?php } ?>