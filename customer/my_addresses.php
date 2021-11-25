<?php

@session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$get_customers_addresses = "select * from customers_addresses where customer_id='$customer_id'";

$run_customers_addresses = mysqli_query($con,$get_customers_addresses);

$row_addresses = mysqli_fetch_array($run_customers_addresses);

$billing_first_name = $row_addresses["billing_first_name"];

$billing_last_name = $row_addresses["billing_last_name"];

$billing_address_1 = $row_addresses["billing_address_1"];

$billing_address_2 = $row_addresses["billing_address_2"];

$billing_city = $row_addresses["billing_city"];

$billing_postcode = $row_addresses["billing_postcode"];

$billing_country = $row_addresses["billing_country"];

$billing_state = $row_addresses["billing_state"];

$shipping_first_name = $row_addresses["shipping_first_name"];

$shipping_last_name = $row_addresses["shipping_last_name"];

$shipping_address_1 = $row_addresses["shipping_address_1"];

$shipping_address_2 = $row_addresses["shipping_address_2"];

$shipping_city = $row_addresses["shipping_city"];

$shipping_postcode = $row_addresses["shipping_postcode"];

$shipping_country = $row_addresses["shipping_country"];

$shipping_state = $row_addresses["shipping_state"];

?>

<h2> Dirección de Envío 1 </h2>

<form method="post" enctype="multipart/form-data">

<div class="row">
<div class="col-sm-6">

<div class="form-group">

<label> Nombre : </label>

<input type="text" name="billing_first_name" class="form-control" required value="<?php echo $billing_first_name; ?>">

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> Apellido : </label>

<input type="text" name="billing_last_name" class="form-control" required value="<?php echo $billing_last_name; ?>">

</div>

</div>

</div>

<div class="form-group" >

<label> País : </label>

<select name="billing_country" class="form-control">

<option value=""> Seleccionar País </option>

<?php

$get_countries = "select * from countries";

$run_countries = mysqli_query($con,$get_countries);

while($row_countries = mysqli_fetch_array($run_countries)){

$country_id = $row_countries['country_id'];

$country_name = $row_countries['country_name'];

?>

<option value="<?php echo $country_id; ?>"

<?php

if($billing_country == $country_id){ echo "selected"; }

?>> 

<?php echo $country_name; ?> 

</option>

<?php } ?>

</select>

</div>

<div class="form-group" >

<label> Dirección 1 : </label>

<input type="text" name="billing_address_1" class="form-control" required value="<?php echo $billing_address_1; ?>">

</div>

<div class="form-group" >

<label> Dirección 2 : </label>

<input type="text" name="billing_address_2" class="form-control" required value="<?php echo $billing_address_2; ?>">

</div>

<div class="row">

<div class="col-sm-6">

<div class="form-group">

<label> Región : </label>

<input type="text" name="billing_state" class="form-control" required value="<?php echo $billing_state; ?>">

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> Comuna : </label>

<input type="text" name="billing_city" class="form-control" required value="<?php echo $billing_city; ?>">

</div>

</div>

</div>

<div class="form-group">

<label> Postal : </label>

<input type="text" name="billing_postcode" class="form-control" required value="<?php echo $billing_postcode; ?>">

</div>

<div class="form-group">

<input type="submit" name="update_billing_address" value="Actualizar" class="form-control btn btn-success">

</div>

</form>

<h2> Dirección de envío 2 </h2>

<form method="post" enctype="multipart/form-data">

<div class="row">

<div class="col-sm-6">

<div class="form-group">

<label> Nombre : </label>

<input type="text" name="shipping_first_name" class="form-control" required value="<?php echo $shipping_first_name; ?>">

</div>

</div>

<div class="col-sm-6">

<div class="form-group" >

<label> Apellido : </label>

<input type="text" name="shipping_last_name" class="form-control" required value="<?php echo $shipping_last_name; ?>">

</div>

</div>

</div>

<div class="form-group" >

<label> País : </label>

<select name="shipping_country" class="form-control">

<option value=""> Seleccionar País </option>

<?php

$get_countries = "select * from countries";

$run_countries = mysqli_query($con,$get_countries);

while($row_countries = mysqli_fetch_array($run_countries)) {

$country_id = $row_countries['country_id'];

$country_name = $row_countries['country_name'];

?>

<option value="<?php echo $country_id; ?>"

<?php

if($shipping_country == $country_id){ echo "selected"; }

?>> 

<?php echo $country_name; ?> 

</option>

<?php } ?>

</select>

</div>

<div class="form-group" >

<label> Dirección 1 : </label>

<input type="text" name="shipping_address_1" class="form-control" required value="<?php echo $shipping_address_1; ?>">

</div>

<div class="form-group" >

<label> Dirección 2 : </label>

<input type="text" name="shipping_address_2" class="form-control" required value="<?php echo $shipping_address_2; ?>">

</div>

<div class="row">

<div class="col-sm-6">

<div class="form-group" >

<label> Región : </label>

<input type="text" name="shipping_state" class="form-control" required value="<?php echo $shipping_state; ?>">

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> Comuna : </label>

<input type="text" name="shipping_city" class="form-control" required value="<?php echo $shipping_city; ?>">

</div>

</div>

</div>

<div class="form-group">

<label> Postal: </label>

<input type="text" name="shipping_postcode" class="form-control" required value="<?php echo $shipping_postcode; ?>">

</div>

<div class="form-group">

<input type="submit" name="update_shipping_address" value="Actualizar" class="form-control btn btn-success">

</div>

</form>

<script>

$(".chosen-select").chosen({});

</script>

<?php

if(isset($_POST["update_billing_address"])){

$billing_first_name = $_POST["billing_first_name"];

$billing_last_name = $_POST["billing_last_name"];

$billing_address_1 = $_POST["billing_address_1"];

$billing_address_2 = $_POST["billing_address_2"];

$billing_city = $_POST["billing_city"];

$billing_postcode = $_POST["billing_postcode"];

$billing_country = $_POST["billing_country"];

$billing_state = $_POST["billing_state"];

$update_billing_address = "update customers_addresses set billing_first_name='$billing_first_name',billing_last_name='$billing_last_name',billing_address_1='$billing_address_1',billing_address_2='$billing_address_2',billing_city='$billing_city',billing_postcode='$billing_postcode',billing_country='$billing_country',billing_state='$billing_state' where customer_id='$customer_id'";

$run_billing_address = mysqli_query($con,$update_billing_address);

echo "<script>alert('Se ha actualizado la dirección de facturación de su cuenta.')</script>";

echo "<script>window.open('my_account.php?my_addresses','_self')</script>";

}

if(isset($_POST["update_shipping_address"])){

$shipping_first_name = $_POST["shipping_first_name"];

$shipping_last_name = $_POST["shipping_last_name"];

$shipping_address_1 = $_POST["shipping_address_1"];

$shipping_address_2 = $_POST["shipping_address_2"];

$shipping_city = $_POST["shipping_city"];

$shipping_postcode = $_POST["shipping_postcode"];

$shipping_country = $_POST["shipping_country"];

$shipping_state = $_POST["shipping_state"];

$update_shipping_address = "update customers_addresses set shipping_first_name='$shipping_first_name',shipping_last_name='$shipping_last_name',shipping_address_1='$shipping_address_1',shipping_address_2='$shipping_address_2',shipping_city='$shipping_city',shipping_postcode='$shipping_postcode',shipping_country='$shipping_country',shipping_state='$shipping_state' where customer_id='$customer_id'";

$run_shipping_address = mysqli_query($con,$update_shipping_address);

echo "<script>alert('La dirección de envío de su cuenta se ha actualizado.')</script>";

echo "<script>window.open('my_account.php?my_addresses','_self')</script>";

}

?>