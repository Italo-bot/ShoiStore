<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
$edit_zone_id = $_GET["edit_shipping_zone"];	

$get_zones = "select * from zones where zone_id='$edit_zone_id'";

$run_zones = mysqli_query($con,$get_zones);

$row_zones = mysqli_fetch_array($run_zones);

$zone_name = $row_zones['zone_name'];

?>

<link rel="stylesheet" href="css/chosen.min.css">

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar zona de envío

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Editar zona de envío

</h3>
</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> nombre de zona </label>

<div class="col-md-7">

<input type="text" name="zone_name" class="form-control" value="<?php echo $zone_name; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Regiones </label>

<div class="col-md-7">

<select data-placeholder="Select Zone Regions" name="zone_countries[]" class="form-control chosen-select" multiple>

<?php

$get_zones_locations = "select * from zones_locations where zone_id='$edit_zone_id' and location_type='country'";

$run_zones_locations = mysqli_query($con,$get_zones_locations);

while($row_zones_locations = mysqli_fetch_array($run_zones_locations)){
	
$location_code = $row_zones_locations["location_code"];	

$location_type = $row_zones_locations["location_type"];	

$get_country = "select * from countries where country_id='$location_code'";

$run_country = mysqli_query($con,$get_country);

$row_country = mysqli_fetch_array($run_country);

$country_name = $row_country['country_name'];

echo "<option value='$location_code' selected>$country_name</option>";
	
}	

$get_countries = "select * from countries";

$run_countries = mysqli_query($con,$get_countries);

while($row_countries = mysqli_fetch_array($run_countries)) {

$country_id = $row_countries['country_id'];

$country_name = $row_countries['country_name'];

echo "<option value='$country_id'>$country_name</option>";

}

?>

</select>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Código Postal </label>

<div class="col-md-7">

<textarea name="zone_post_codes" class="form-control" placeholder="Lista 1 código postal por línea" rows="5">
<?php

$result = "";

$get_zones_locations = "select * from zones_locations where zone_id='$edit_zone_id' and location_type='postcode'";

$run_zones_locations = mysqli_query($con,$get_zones_locations);

while($row_zones_locations = mysqli_fetch_array($run_zones_locations)){
	
$location_code = $row_zones_locations["location_code"];	

$result .= "$location_code\n"; 

}	

echo rtrim($result,"\n");

?>
</textarea>

<p class="help-block">También se admiten códigos postales que contienen comodines (p. Ej., CB23 *) y rangos completamente numéricos (p. Ej., 90210 ... 99000).</p>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="update" class="form-control btn btn-primary" value="Actualizar" >

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

$(".chosen-select").chosen();

</script>

<?php

if(isset($_POST['update'])){

$zone_name = mysqli_real_escape_string($con,$_POST['zone_name']);

$zone_countries =  $_POST['zone_countries'];

$insert_zone = "update zones set zone_name='$zone_name' where zone_id='$edit_zone_id'";

$run_zone = mysqli_query($con,$insert_zone);

$delete_zones_locations = "delete from zones_locations where zone_id='$edit_zone_id'";

$run_zones_locations = mysqli_query($con,$delete_zones_locations);

foreach($zone_countries as $country){
	
$country_code = mysqli_real_escape_string($con,$country);	

$insert_zone_location = "insert into zones_locations (zone_id,location_code,location_type) values ('$edit_zone_id','$country','country')";
	
$run_zone_location = mysqli_query($con,$insert_zone_location);
        
}

if(!empty($_POST['zone_post_codes'])){

if(strpos($_POST['zone_post_codes'], "\n")){
	
$post_codes = explode("\n", $_POST['zone_post_codes']);

}else{ 

$post_codes = array($_POST['zone_post_codes']); 

}

foreach($post_codes as $post_code){
	
  $location_code = mysqli_real_escape_string($con,trim($post_code));	
	
  $insert_zone_location = "insert into zones_locations (zone_id,location_code,location_type) values ('$edit_zone_id','$location_code','postcode')";
	
  $run_zone_location = mysqli_query($con,$insert_zone_location);

}

}

if($run_zone){

echo "<script>alert('Su única zona de envío ha sido actualizada.')</script>";

echo "<script>window.open('index.php?view_shipping_zones','_self')</script>";

}

}

?>

<?php } ?>