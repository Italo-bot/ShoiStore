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

<i class="fa fa-money fa-fw"></i> Ver tipos de envío

</h3>

</div>

<div class="panel-body">

<p class="lead"> 

Envío de tipos locales

<a href="index.php?insert_shipping_type" class="btn btn-default">

Agregar tipo de envío

</a>

</p>

<table class="table table-hover table-bordered table-striped local-types">

<thead>

<tr>

<th> Orden de tipo: </th>

<th> Nombre de tipo: </th>

<th> Tipos de tipos: </th>

<th> Tipo predeterminado: </th>

<th> Acciones: </th>

</tr>

</thead>

<tbody>

<?php

$select_shipping_types = "select * from shipping_type where type_local='yes' and vendor_id='$customer_id' order by type_order";

$run_shipping_types = mysqli_query($con, $select_shipping_types);

while($row_shipping_types = mysqli_fetch_array($run_shipping_types)){
	
$type_id = $row_shipping_types['type_id'];

$type_name = $row_shipping_types['type_name'];

$type_default = $row_shipping_types['type_default'];

$type_order = $row_shipping_types['type_order'];


?>

<tr id="<?php echo $type_id; ?>">

<td> <?php echo $type_order; ?> </td>

<td> <?php echo $type_name; ?> </td>

<td> 

<select class="form-control">

<option class="hidden"> Editar tarifas de envío </option>

<?php

$get_zones = "select * from zones where vendor_id='$customer_id' order by zone_order";

$run_zones = mysqli_query($con, $get_zones);

while($row_zones = mysqli_fetch_array($run_zones)){
	
$zone_id = $row_zones['zone_id'];

$zone_name = $row_zones['zone_name'];

echo "

<option data-url='index.php?edit_shipping_rates=$type_id&zone_id=$zone_id'>

$zone_name

</option>

";
	
}

?>

</select>

</td>

<td> <?php echo ucfirst($type_default); ?> </td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right">

<li>

<a href="index.php?edit_shipping_type=<?php echo $type_id; ?>">

<i class="fa fa-pencil"></i> Editar

</a>

</li>

<li>

<a href="index.php?delete_shipping_type=<?php echo $type_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

</a>

</li>

</ul>

</div>
</td>

</tr>

<?php } ?>

</tbody>

</table>

<p class="lead"> 

Tipos de envío internacional

<a href="index.php?insert_shipping_type" class="btn btn-default">

Agregar tipo de envío

</a>

</p>

<table class="table table-hover table-bordered table-striped international-types">

<thead>

<tr>

<th> Orden de tipo: </th>

<th> Nombre de tipo: </th>

<th> Tipos de tipos: </th>

<th> Tipo predeterminado: </th>

<th> Acciones: </th>

</tr>

</thead>

<tbody>

<?php

$select_shipping_types = "select * from shipping_type where type_local='no' and vendor_id='$customer_id' order by type_order";

$run_shipping_types = mysqli_query($con, $select_shipping_types);

while($row_shipping_types = mysqli_fetch_array($run_shipping_types)){
	
$type_id = $row_shipping_types['type_id'];

$type_name = $row_shipping_types['type_name'];

$type_default = $row_shipping_types['type_default'];

$type_order = $row_shipping_types['type_order'];


?>

<tr id="<?php echo $type_id; ?>">

<td> <?php echo $type_order; ?> </td>

<td> <?php echo $type_name; ?> </td>

<td> 

<select class="form-control">

<option class="hidden"> Editar tarifas de envío </option>

<?php

$select_countries = "select * from countries";

$run_countries = mysqli_query($con, $select_countries);

while($row_countries = mysqli_fetch_array($run_countries)){
	
$country_id = $row_countries['country_id'];

$country_name = $row_countries['country_name'];

echo "

<option data-url='index.php?edit_shipping_rates=$type_id&country_id=$country_id'>

$country_name

</option>

";
	
}


?>

</select>

</td>

<td> <?php echo ucfirst($type_default); ?> </td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right">

<li>

<a href="index.php?edit_shipping_type=<?php echo $type_id; ?>">

<i class="fa fa-pencil"></i> Editar

</a>

</li>

<li>

<a href="index.php?delete_shipping_type=<?php echo $type_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

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


<script>

$(document).ready(function(){
	
$(document).on("mouseenter", ".local-types tr td:first-child", function(){
	
$(this).css("cursor", "move");
	
$(".local-types tbody").sortable({
	
helper: fixWidthHelper,

placeholder: "placeholder-highlight",

containment: ".local-types tbody",

update: function(){
	
var types_ids = new Array();

$(".local-types tbody tr").each(function(){
	
type_id = $(this).attr("id");

types_ids.push(type_id);
	
});

$.ajax({
	
url: "update_type_order.php",

method: "POST",

data: {types_ids: types_ids, type_local: "yes"}
	
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

$(document).on("mouseenter", ".international-types tr td:first-child", function(){
	
$(this).css("cursor", "move");
	
$(".international-types tbody").sortable({
	
helper: fixWidthHelper,

placeholder: "placeholder-highlight",

containment: ".international-types tbody",

update: function(){
	
var types_ids = new Array();

$(".international-types tbody tr").each(function(){
	
type_id = $(this).attr("id");

types_ids.push(type_id);
	
});

$.ajax({
	
url: "update_type_order.php",

method: "POST",

data: {types_ids: types_ids, type_local: "no"}
	
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

$("select").change(function(){
	
var option = $(this).find("option:selected");

var url = option.data("url");

window.open(url);
	
});
	
});

</script>


