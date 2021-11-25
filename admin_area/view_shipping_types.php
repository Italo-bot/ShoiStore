<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}else{

?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Ver Tipos de envió

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Ver tipos de envío

</h3>

</div>

<div class="panel-body">

<div class="table-responsive">

<p class="lead">Tipo de envíos locales</p>

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

$get_shipping_type = "select * from shipping_type where type_local='yes' order by type_order";

$run_shipping_type = mysqli_query($con,$get_shipping_type);

while($row_shipping_type = mysqli_fetch_array($run_shipping_type)){

$type_id = $row_shipping_type['type_id'];

$type_name = $row_shipping_type['type_name'];

$type_order = $row_shipping_type['type_order'];

$type_local = $row_shipping_type['type_local'];

$type_default = $row_shipping_type['type_default'];

?>

<tr id="<?php echo $type_id; ?>">

<td><?php echo $type_order; ?></td>

<td><?php echo $type_name; ?></td>

<td>

<select class="form-control">

<option class="hidden"> Editar tarifas de envío </option>

<?php

$get_zones = "select * from zones order by zone_order";

$run_zones = mysqli_query($con,$get_zones);

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

<td><?php echo ucfirst($type_default); ?></td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

<li>
<a href="index.php?edit_shipping_type=<?php echo $type_id; ?>">

<i class="fa fa-pencil"> </i> Editar

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

<p class="lead">Tipos de envío internacional</p>

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

$get_zones = "select * from shipping_type where type_local='no' order by type_order";

$run_zones = mysqli_query($con,$get_zones);

while($row_zones = mysqli_fetch_array($run_zones)){

$type_id = $row_zones['type_id'];

$type_name = $row_zones['type_name'];

$type_order = $row_zones['type_order'];

$type_local = $row_zones['type_local'];

$type_default = $row_zones['type_default'];

?>

<tr id="<?php echo $type_id; ?>">

<td><?php echo $type_order; ?></td>

<td><?php echo $type_name; ?></td>

<td>

<select class="form-control">

<option class="hidden">Editar tarifas de envío</option>

<?php

$get_countries = "select * from countries";

$run_countries = mysqli_query($con,$get_countries);

while($row_countries = mysqli_fetch_array($run_countries)) {

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

<td><?php echo ucfirst($type_default); ?></td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle"id="dropdownMenu1" data-toggle="dropdown">
<span class="caret"></span>
</button>

<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenu1">

<li>
<a href="index.php?edit_shipping_type=<?php echo $type_id; ?>">

<i class="fa fa-pencil"> </i> Editar

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
url:"update_type_order.php",
method:"POST",
data:{type_local: "yes", types_ids: types_ids}
});

}
   
}).disableSelection();

function fixWidthHelper(e, ui){
	
ui.children().each(function(){
	
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
url:"update_type_order.php",
method:"POST",
data:{type_local: "no", types_ids: types_ids}
});

}
   
}).disableSelection();

function fixWidthHelper(e, ui){
	
ui.children().each(function(){
	
$(this).width($(this).width());

});

return ui;

}

});
 
$("select").change(function(){
	
var option = $(this).find('option:selected');

var url = option.data("url");

window.open(url);
  
});

});

</script>

<?php } ?>