<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {




?>

<div class="row" >

<div class="col-lg-12">

<ol class="breadcrumb" >

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Agregar Caja

</li>

</ol>

</div>

</div>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default">

<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-money fa-fw"></i> Agregar Caja

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post" action="">

<div class="form-group">

<label class="col-md-3 control-label">Título : </label>

<div class="col-md-6">

<input type="text" name="box_title" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Descripción : </label>

<div class="col-md-6">

<textarea name="box_desc" class="form-control" rows="6" cols="19"> </textarea>

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

$box_title = $_POST['box_title'];

$box_desc = $_POST['box_desc'];

$insert_box = "insert into boxes_section (box_title,box_desc) values ('$box_title','$box_desc')";

$run_box = mysqli_query($con,$insert_box);

echo "<script>alert('Se ha insertado una nueva caja')</script>";

echo "<script>window.open('index.php?view_boxes','_self')</script>";

}


?>




<?php } ?>