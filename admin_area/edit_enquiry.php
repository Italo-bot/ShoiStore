<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<?php

if(isset($_GET['edit_enquiry'])){

$edit_id = $_GET['edit_enquiry'];

$get_enquiry_type = "select * from enquiry_types where enquiry_id='$edit_id'";

$run_enquiry_type = mysqli_query($con,$get_enquiry_type);

$row_enquiry_type = mysqli_fetch_array($run_enquiry_type);

$enquiry_id = $row_enquiry_type['enquiry_id'];

$enquiry_title = $row_enquiry_type['enquiry_title'];

}


?>

<div class="row" >

<div class="col-lg-12" >

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard" ></i> Dashboard / Editar Tipo de consulta


</li>

</ol>

</div> 

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Editar Tipo de consulta

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" >

<div class="form-group">

<label class="col-md-3 control-label"> Consulta </label>

<div class="col-md-6">

<input type="text" name="enquiry_title" class="form-control" value="<?php echo $enquiry_title; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">  </label>

<div class="col-md-6">

<input type="submit" name="update" class="btn btn-primary form-control" value="Actualizar">

</div>

</div>


</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['update'])){

$enquiry_title = $_POST['enquiry_title'];

$update_enquiry = "update enquiry_types set enquiry_title='$enquiry_title' where enquiry_id='$enquiry_id'";

$run_enquiry = mysqli_query($con,$update_enquiry);

if($run_enquiry){

echo "<script>alert('Se ha actualizado un tipo de consulta')</script>";

echo "<script>window.open('index.php?view_enquiry','_self')</script>";

}

}


?>


<?php } ?>