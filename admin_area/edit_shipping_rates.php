<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else{
	
if(isset($_GET["edit_shipping_rates"])){
	
$type_id = $_GET["edit_shipping_rates"];	
	
$get_zones = "select * from shipping_type where type_id='$type_id'";

$run_zones = mysqli_query($con,$get_zones);

$row_zones = mysqli_fetch_array($run_zones);

$type_name = $row_zones['type_name'];

$type_local = $row_zones['type_local'];

if(isset($_GET["zone_id"])){

$zone_id = $_GET["zone_id"];

$get_zones = "select * from zones where zone_id='$zone_id'";

$run_zones = mysqli_query($con,$get_zones);

$row_zones = mysqli_fetch_array($run_zones);

$zone_name = $row_zones['zone_name'];	
	
}elseif(isset($_GET["country_id"])){
	
$country_id = $_GET["country_id"];	

$get_country = "select * from countries where country_id='$country_id'";

$run_country = mysqli_query($con,$get_country);

$row_country = mysqli_fetch_array($run_country);

$country_name = $row_country['country_name'];
	
}
	
}	

?>

<script src="js/jquery.min.js"></script>

<script src="js/jquery-ui.min.js"></script>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar tarifas de envio

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Editar tarifas de envío

</h3>

</div>

<div class="panel-body">

<?php if(isset($_GET["zone_id"])){ ?>

<h4> <strong> Editar tarifas de envío para : </strong> <?php echo $zone_name ?> : <?php echo $type_name ?> </h4>

<?php }elseif(isset($_GET["country_id"])){ ?>

<h4> <strong> Editar tarifas de envío para : </strong> <?php echo $country_name ?> : <?php echo $type_name ?> </h4>

<?php } ?>

<h3>Agregar tarifa de envío </h3>

<form action="" method="post">

<div class="row">

<div class="col-sm-4">

<div class="form-group">

<label> Peso hasta: </label>

<input type="text" name="shipping_weight" class="form-control" required>

</div>
</div>

<div class="col-sm-4">

<div class="form-group">

<label> Costo: </label>

<input type="text" name="shipping_cost" class="form-control" required>

</div>

</div>

</div>

<div class="form-group">

<input type="submit" name="submit" value="Agregar" class="btn btn btn-primary">

</div>

</form>

<table class="table table-hover table-bordered table-striped">

<thead>

<tr>

<th> Peso de: </th>
<th> Peso hasta: </th>
<th> Costo: </th>
<th> Eliminar: </th>

</tr>

</thead>

<tbody id="table-tbody">

<?php

if(isset($_GET["zone_id"])){ 

$get_shipping_rates = "
SELECT s.*,
IF (
(
SELECT COUNT(shipping_weight)
FROM shipping
WHERE shipping_type = s.shipping_type
AND shipping_zone = s.shipping_zone
AND shipping_weight < s.shipping_weight
ORDER BY shipping_weight DESC
LIMIT 0, 1
) > 0,
(
SELECT shipping_weight
FROM shipping
WHERE shipping_type = s.shipping_type
AND shipping_zone = s.shipping_zone
AND shipping_weight < s.shipping_weight
ORDER BY shipping_weight DESC
LIMIT 0, 1
) + 0.01,
0
) AS shipping_weight_from
FROM shipping s
WHERE s.shipping_type = $type_id
AND s.shipping_zone = $zone_id
ORDER BY s.shipping_weight ASC
";

}elseif(isset($_GET["country_id"])){

$get_shipping_rates = "
SELECT s.*,
IF (
(
SELECT COUNT(shipping_weight)
FROM shipping
WHERE shipping_type = s.shipping_type
AND shipping_country = s.shipping_country
AND shipping_weight < s.shipping_weight
ORDER BY shipping_weight DESC
LIMIT 0, 1
) > 0,
(
SELECT shipping_weight
FROM shipping
WHERE shipping_type = s.shipping_type
AND shipping_country = s.shipping_country
AND shipping_weight < s.shipping_weight
ORDER BY shipping_weight DESC
LIMIT 0, 1
) + 0.01,
0
) AS shipping_weight_from
FROM shipping s
WHERE s.shipping_type = $type_id
AND s.shipping_country = $country_id
ORDER BY s.shipping_weight ASC
";
	
}	

$run_shipping_rates = mysqli_query($con,$get_shipping_rates);

while($row_shipping_rates = mysqli_fetch_array($run_shipping_rates)){

$shipping_id = $row_shipping_rates['shipping_id'];

$shipping_type = $row_shipping_rates['shipping_type'];

$shipping_weight = $row_shipping_rates['shipping_weight'];

$shipping_weight_from = $row_shipping_rates['shipping_weight_from'];

$shipping_cost = $row_shipping_rates['shipping_cost'];

?>

<tr>

<td><?php echo $shipping_weight_from; ?> <small>Kg</small></td>

<td><?php echo $shipping_weight; ?> <small>Kg</small></td>

<td>$<?php echo $shipping_cost; ?></td>

<td>
<a href="#" id="delete_shipping_rate_<?php echo $shipping_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

</a>
</td>

<script>

$(document).ready(function(){
	
$("#delete_shipping_rate_<?php echo $shipping_id; ?>").click(function(){

$.ajax({
method: "POST",
url: "delete_shipping_rate.php",
data: { delete_id: <?php echo $shipping_id; ?>, type_id: <?php echo $type_id; ?> }       
});

});

});	

</script>	

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

<script>

$(document).ready(function(){
	
setInterval(function(){

$.ajax({
method: "GET",
url: "load_shipping_rates.php",
<?php if(isset($_GET["zone_id"])){ ?>
data: { type_id: <?php echo $type_id; ?>, zone_id: <?php echo $zone_id; ?> },
<?php }elseif(isset($_GET["country_id"])){ ?>
data: { type_id: <?php echo $type_id; ?>, country_id: <?php echo $country_id; ?> },
<?php } ?>
success:function(data){
	$("#table-tbody").html(data);
}	
});	
 
}, 1000);	
	
$('form').submit(function(e){
	
e.preventDefault();	

$.ajax({
method: "POST",
url: "insert_shipping_rate.php",
<?php if(isset($_GET["zone_id"])){ ?>
data:$('form').serialize()+"&type_id=<?php echo $type_id; ?>&zone_id=<?php echo $zone_id; ?>",
<?php }elseif(isset($_GET["country_id"])){ ?>
data:$('form').serialize()+"&type_id=<?php echo $type_id; ?>&country_id=<?php echo $country_id; ?>",
<?php } ?>
success:function(){
	$("form").find("input[type=text]").val("");
}
});

});

});

</script>

<?php } ?>