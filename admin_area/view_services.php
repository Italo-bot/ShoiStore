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

<i class="fa fa-dashboard" ></i> Dashboard / Ver Servicios

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Ver Servicios 

</h3>

</div>

<div class="panel-body">

<?php

$get_services = "select * from services";

$run_services = mysqli_query($con,$get_services);

while($row_services = mysqli_fetch_array($run_services)){

$service_id = $row_services['service_id'];

$service_title = $row_services['service_title'];

$service_image = $row_services['service_image'];

$service_desc = substr($row_services['service_desc'],0,400);

$service_button = $row_services['service_button'];

$service_url = $row_services['service_url'];


?>

<div class="col-lg-4 col-md-4">

<div class="panel panel-primary">

<div class="panel-heading">

<h3 class="panel-title" align="center">

<?php echo $service_title; ?>

</h3>

</div>

<div class="panel-body">

<img src="services_images/<?php echo $service_image; ?>" class="img-responsive">

<br>

<p><?php echo $service_desc; ?></p>

</div>

<div class="panel-footer">

<a href="index.php?delete_service=<?php echo $service_id; ?>" class="pull-left">

<i class="fa fa-trash-o"></i> Borrar

</a>

<a href="index.php?edit_service=<?php echo $service_id; ?>" class="pull-right">

<i class="fa fa-pencil"></i> Editar

</a>

<div class="clearfix"> </div>

</div>

</div>
</div>

<?php } ?>

</div>

</div>

</div>

</div>




<?php } ?>