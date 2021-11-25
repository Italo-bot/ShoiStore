<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<link rel="stylesheet" href="css/chosen.min.css">

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Agregar País

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Agregar País

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> País </label>

<div class="col-md-7">

<input type="text" name="country_name" class="form-control" >

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Agregar">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<script src="js/jquery.min.js"></script>

<script src="js/chosen.jquery.min.js"></script>

<script>

var config = {
  '.chosen-select': {}
}

for (var selector in config) {
  $(selector).chosen(config[selector]);
}

</script>

<?php

if(isset($_POST['submit'])){

$country_name = mysqli_real_escape_string($con,$_POST['country_name']);

$insert_country = "insert into countries (country_name) values ('$country_name')";

$run_country = mysqli_query($con,$insert_country);

if($run_country){

echo "<script>alert('Se ha insertado su nuevo país.')</script>";

echo "<script>window.open('index.php?view_countries','_self')</script>";

}

}

?>

<?php } ?>