<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
$country_id = $_GET["edit_country"];	

$get_country = "select * from countries where country_id='$country_id'";

$run_country = mysqli_query($con,$get_country);

$row_country = mysqli_fetch_array($run_country);

$country_name = $row_country['country_name'];

?>

<link rel="stylesheet" href="css/chosen.min.css">

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar País

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Editar País

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> País </label>

<div class="col-md-7">

<input type="text" name="country_name" class="form-control" value="<?php echo $country_name; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Actualizar">

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

$update_country = "update countries set country_name='$country_name' where country_id='$country_id'";

$run_update_country = mysqli_query($con,$update_country);

if($run_update_country){

echo "<script>alert('Su país se ha actualizado correctamente.')</script>";

echo "<script>window.open('index.php?view_countries','_self')</script>";

}

}

?>

<?php } ?>