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

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Ver Zonas

</h3>

</div>

<div class="panel-body">

<p class="lead">

Zonas de envío

<a href="index.php?insert_shipping_zone" class="btn btn-default">

Agregar zona de envío

</a>

</p>

Una zona de envío es una región geográfica donde se ofrece un determinado conjunto de tipos de envío. El sistema relacionará a un cliente con una sola zona utilizando su dirección de envío y le presentará los tipos de envío dentro de esa zona. 

<br><br>

<div class="table-responsive">

<table class="table table-hover table-bordered table-striped"> 

<thead>

<tr>

<th> Orden de zona: </th>

<th> Nombre de zona: </th>

<th> Regiones de la zona: </th>

<th> Acciones: </th>

</tr>

</thead>

<tbody>

<?php

$get_zones = "select * from zones where vendor_id='$customer_id' order by zone_order";

$run_zones = mysqli_query($con, $get_zones);

while($row_zones = mysqli_fetch_array($run_zones)){

$zone_id = $row_zones['zone_id'];

$zone_name = $row_zones['zone_name'];

$zone_order = $row_zones['zone_order'];


?>

<tr id="<?php echo $zone_id; ?>">

<td> <?php echo $zone_order; ?> </td>

<td> <?php echo $zone_name; ?> </td>

<td>

<?php

$result = "";

$select_zones_locations = "select * from zones_locations where zone_id='$zone_id'";

$run_zones_locations = mysqli_query($con,$select_zones_locations);

while($row_zones_locations = mysqli_fetch_array($run_zones_locations)){

$location_code = $row_zones_locations['location_code'];

$location_type = $row_zones_locations['location_type'];

if($location_type == "country"){
	
$get_country = "select * from countries where country_id='$location_code'";

$run_country = mysqli_query($con, $get_country);

$row_country = mysqli_fetch_array($run_country);

$country_name = $row_country['country_name'];

$result .= "$country_name, ";
	
	
}elseif($location_type == "postcode"){

$result .= "$location_code, ";
	
}
	
}

echo rtrim($result, ", ");

?>

</td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right">

<li>

<a href="index.php?edit_shipping_zone=<?php echo $zone_id; ?>">

<i class="fa fa-pencil"></i> Editar

</a>

</li>

<li>

<a href="index.php?delete_shipping_zone=<?php echo $zone_id; ?>">

<i class="fa fa-trash"></i> Borrar

</a>

</li>

</ul>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>


<script>

$(document).ready(function(){
	
$(document).on("mouseenter", "tr td:first-child", function(){
	
$(this).css("cursor","move");

$("tbody").sortable({
	
helper: fixWidthHelper,

placeholder: "placeholder-highlight",

containment: "tbody",

update: function(){

var zones_ids = new Array();

$("tbody tr").each(function(){
	
zone_id = $(this).attr("id");

zones_ids.push(zone_id);	
	
});

$.ajax({
	
url: "update_zone_order.php",

method: "POST",

data: { zones_ids: zones_ids }
	
});
	
}

	
}).disableSelection();
	
function fixWidthHelper(e, ui) {
    ui.children().each(function() {
        $(this).width($(this).width());
    });
    return ui;
}	
	
	
});
	
});

</script>

