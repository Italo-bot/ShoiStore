<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

?>

<link rel="stylesheet" href="styles/chosen.min.css" >

<script src="js/chosen.jquery.min.js"></script>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Agregar zona de envío

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Zona Nombre </label>

<div class="col-md-7">

<input type="text" name="zone_name" class="form-control" >

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Regiones </label>

<div class="col-md-7">

<select name="zone_countries[]" class="form-control chosen-select" data-placeholder="Seleccionar Región" multiple>

<?php

$select_countries = "select * from countries";

$run_countries = mysqli_query($con, $select_countries);

while($row_countries = mysqli_fetch_array($run_countries)){
	
$country_id = $row_countries['country_id'];

$country_name = $row_countries['country_name'];

echo "<option value='$country_id'> $country_name </option>";
	
}

?>

</select>

<script>

$('.chosen-select').chosen();

</script>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Código Postal</label>

<div class="col-md-7">

<textarea name="zone_post_codes"  class="form-control" rows="5" placeholder="Lista 1 código postal por línea" ></textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-7">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Agregar Zona de envío" >

</div>

</div>

</form>

</div>

</div>

</div>

</div>


<?php

if(isset($_POST['submit'])){

$zone_name = mysqli_real_escape_string($con, $_POST['zone_name']);

$get_zone_order = "select max(zone_order) AS zone_order from zones where vendor_id='$customer_id'";

$run_zone_order = mysqli_query($con, $get_zone_order);

$row_zone_order = mysqli_fetch_array($run_zone_order);

$zone_order = $row_zone_order['zone_order'] + 1;

$zone_countries = $_POST['zone_countries'];

$insert_zone = "insert into zones (vendor_id,zone_name,zone_order) values ('$customer_id','$zone_name','$zone_order')";

$run_zone = mysqli_query($con, $insert_zone);

$insert_zone_id = mysqli_insert_id($con);

if($run_zone){

foreach($zone_countries as $country_id){
	
$country_id = mysqli_real_escape_string($con, $country_id);

$insert_zone_location = "insert into zones_locations (zone_id,location_code,location_type) values ('$insert_zone_id','$country_id','country')";

$run_zone_location = mysqli_query($con, $insert_zone_location);
	
}

if(!empty($_POST['zone_post_codes'])){
	
if(strpos($_POST['zone_post_codes'], "\n")){
	
$post_codes = explode("\n", $_POST['zone_post_codes']);
	
}else{
	
$post_codes = array($_POST['zone_post_codes']);
	
}

foreach($post_codes as $post_code){
	
$location_code = mysqli_real_escape_string($con, trim($post_code));

$insert_zone_location = "insert into zones_locations (zone_id,location_code,location_type) values ('$insert_zone_id','$location_code','postcode') ";

$run_zone_location = mysqli_query($con, $insert_zone_location);

	
}
	
}

echo "

<script>

alert('La nueva zona de envío se agregó correctamente.');

window.open('index.php?shipping_zones','_self');

</script>

";
	
}
	
}

?>

