<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row" >

<div class="col-lg-12" >

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Agregar tipo de consulta

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Agregar tipo de consulta

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" >

<div class="form-group">

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-6">

<input type="text" name="enquiry_title" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">  </label>

<div class="col-md-6">

<input type="submit" name="submit" class="btn btn-primary form-control" value="Agregar">

</div>

</div>


</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['submit'])){

$enquiry_title = $_POST['enquiry_title'];

$insert_enquiry =  "insert into enquiry_types (enquiry_title) values ('$enquiry_title')";

$run_enquiry = mysqli_query($con,$insert_enquiry);

if($run_enquiry){

echo "<script> alert('Se ha insertado un nuevo tipo de consulta') </script>";
echo "<script>window.open('index.php?view_enquiry','_self')</script>";

}



}


?>


<?php } ?>