<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
$stock_status = "";

$filter_where = "";

$filter_url = "";
	
if(isset($_REQUEST["product_type"]) and isset($_REQUEST["stock_status"]) and isset($_REQUEST["vendor_id"])){
		
$product_type = mysqli_real_escape_string($con, $_REQUEST["product_type"]);

$vendor_id = mysqli_real_escape_string($con, $_REQUEST["vendor_id"]);

$stock_status = mysqli_real_escape_string($con, $_REQUEST["stock_status"]);

if(!empty($product_type)){

$filter_where .= "and product_type='$product_type' ";

}

if(!empty($vendor_id)){
	
$filter_where .= "and vendor_id='$vendor_id' ";

}

$filter_url = "&product_type=$product_type&stock_status=$stock_status&vendor_id=$vendor_id";

}
	
function get_products_status_count($product_vendor_status){
	
global $con;

global $stock_status;

global $filter_where;

$products_count_where = $filter_where;

if($product_vendor_status != "all"){
		
$products_count_where .= " and product_vendor_status='$product_vendor_status'";

}
	
if(empty($stock_status)){
	
$select_products = "select * from products where status='bundle' $products_count_where";

}else{
	
$select_products = "
select * from products JOIN products_stock ON 

products_stock.stock_id = (select stock_id from products_stock where product_id=products.product_id ORDER BY stock_id DESC LIMIT 1) and products_stock.stock_status='$stock_status'

where status='bundle' $products_count_where

";
	
}

$run_products = mysqli_query($con,$select_products);

echo $count_products = mysqli_num_rows($run_products);
	
}

function echo_active_class($product_status){

if((!isset($_REQUEST['product_status']) and $product_status == "all") or (isset($_REQUEST['product_status']) and $product_status == $_REQUEST['product_status'])){

echo "active-link";

}
	
}

function select_product_type($product_type){
	
if($product_type == @$_REQUEST["product_type"]){

echo "selected";

}

}

function select_stock_status($stock_status){
	
if($stock_status == @$_REQUEST["stock_status"]){

echo "selected";

}

}

?>


<div class="row">

<div class="col-lg-12" >

<ol class="breadcrumb" >

<li class="active" >

<i class="fa fa-dashboard"></i> Dashboard / Ver paquetes

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-body">

<h3 style="margin-top:0px;"> Filtro paquetes </h3>

<form method="post" action="index.php?view_bundles=1">

<div class="row">

<div class="col-md-3 col-sm-6">
<div class="form-group">

<label> Filtrar por tipo de paquete : </label>

<select name="product_type" class="form-control">

<option value=""> Seleccione un tipo de paquete </option>

<option value="physical_product" <?php select_product_type("physical_product"); ?>> Paquete simple </option>

<option value="variable_product" <?php select_product_type("variable_product"); ?>> Paquete avanzado </option>

</select>

</div>

</div>

<div class="col-md-3 col-sm-6">

<div class="form-group">
<label> Filtrar por fabricante: </label>

<select name="vendor_id" class="form-control">

<option value=""> Seleccione un producto de fabricante </option>

<?php

$select_products = "select distinct vendor_id from products where status='bundle' order by 1 desc";

$run_products = mysqli_query($con,$select_products);

while($row_products = mysqli_fetch_array($run_products)){

$vendor_id = $row_products['vendor_id'];

if(strpos($vendor_id, "admin_") !== false){
	
$admin_id = trim($vendor_id, "admin_");
	
$select_admin = "select * from admins where admin_id='$admin_id'";

$run_admin = mysqli_query($con,$select_admin);

$row_admin = mysqli_fetch_array($run_admin);

$vendor_name = $row_admin['admin_name'] . " (Admin)";
	
}else{

$select_customer = "select * from customers where customer_id='$vendor_id'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$vendor_name = $row_customer['customer_name'];

}

if(@$_REQUEST["vendor_id"] == $vendor_id){

echo "<option value='$vendor_id' selected> $vendor_name </option>";

}else{

echo "<option value='$vendor_id'> $vendor_name </option>";
	
}

}

?>

</select>

</div>

</div>

<div class="col-md-3 col-sm-6">

<div class="form-group">

<label> Filtrar por estado de stock: </label>

<select name="stock_status" class="form-control">

<option value=""> Seleccione un estado de stock </option>

<option value="instock" <?php select_stock_status("instock"); ?>>En stock</option>

<option value="outofstock" <?php select_stock_status("outofstock"); ?>>Agotado</option>

<option value="onbackorder" <?php select_stock_status("onbackorder"); ?>>Para Encargo</option>

</select>

</div>

</div>

<?php if(isset($_REQUEST["product_status"])){ ?>

<input type="hidden" name="product_status" value="<?php echo $_REQUEST["product_status"]; ?>">

<?php } ?>

<div class="col-md-3 col-sm-6">

<label></label>

<button type="submit" class="btn btn-success form-control"> Filtro paquetes </button>

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default" >

<div class="panel-heading" >

<h3 class="panel-title" >

<i class="fa fa-money fa-fw"></i> Ver Paquetes

</h3>


</div>

<div class="panel-body">

<a href="index.php?view_bundles=1&product_status=all<?php echo $filter_url; ?>" class="link-separator <?php echo_active_class("all"); ?> pull-left">

Todo (<?php get_products_status_count("all"); ?>)

</a>

<a class="link-separator pull-left">|</a>

<a href="index.php?view_bundles=1&product_status=active<?php echo $filter_url; ?>" class="link-separator <?php echo_active_class("active"); ?> pull-left">

Activos (<?php get_products_status_count("active"); ?>)

</a>

<a class="link-separator pull-left">|</a>

<a href="index.php?view_bundles=1&product_status=pending<?php echo $filter_url; ?>" class="link-separator <?php echo_active_class("pending"); ?> pull-left">

Aprobación pendiente (<?php get_products_status_count("pending"); ?>)

</a>

<a class="link-separator pull-left">|</a>

<a href="index.php?view_bundles=1&product_status=paused<?php echo $filter_url; ?>" class="link-separator <?php echo_active_class("paused"); ?> pull-left">

Pausados (<?php get_products_status_count("paused"); ?>)

</a>

<a class="link-separator pull-left">|</a>

<a href="index.php?view_bundles=1&product_status=trash<?php echo $filter_url; ?>" class="link-separator <?php echo_active_class("trash"); ?> pull-left">

Barusa (<?php get_products_status_count("trash"); ?>)

</a>

<br><br><br>

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped" >

<thead>

<tr>

<th colspan="2">Nombre paquete</th>

<th> Paquete de existencias </th>

<th> Precio del paquete </th>

<th> Paquete vendido </th>

<th> Agrupar palabras clave </th>

<th> Fecha del paquete </th>

<th> Agrupar acciones </th>

</tr>

</thead>

<tbody>

<?php

$per_page = 10;

if(!empty($_GET["view_bundles"])){

$page = $_GET["view_bundles"];
	
}else{

$page = 1;	
	
}
$start_from = ($page-1) * $per_page;

if((isset($_REQUEST["product_type"]) and isset($_REQUEST["stock_status"]) and isset($_REQUEST["vendor_id"])) or isset($_REQUEST["product_status"])){
	
if(isset($_REQUEST["product_status"])){
	
if($_REQUEST["product_status"] != "all"){
	
$product_vendor_status = $_REQUEST["product_status"];

$filter_where .= "and product_vendor_status='$product_vendor_status'";

}

}

if(empty($stock_status)){
	
$select_products = "select * from products where status='bundle' $filter_where order by 1 desc LIMIT $start_from,$per_page";

}else{

$select_products = "
select * from products JOIN products_stock ON products_stock.stock_id = (select stock_id from products_stock where product_id=products.product_id ORDER BY stock_id DESC LIMIT 1)
and products_stock.stock_status='$stock_status' 
where status='bundle' $filter_where order by 1 desc LIMIT $start_from,$per_page
";
	
}

}else{

$select_products = "select * from products where status='bundle' order by 1 desc LIMIT $start_from,$per_page";
	
}

$run_products = mysqli_query($con,$select_products);

$count_products = mysqli_num_rows($run_products);

if($count_products == 0){

?>

<tr>

<td colspan="8" class="text-center">

<h3> Lo sentimos, no hemos encontrado ningún paquete. </h3>

</td>

</tr>

<?php
	
}

function get_previous_value($key, $array = array()){

$array_keys = array_keys($array);

$found_index = array_search($key, $array_keys);

$previous_key = $array_keys[$found_index-1];

return $array[$previous_key];

}

$products_ids = array();

$i = 0;

while($row_products = mysqli_fetch_array($run_products)){
	
$i++;

$pro_id = $row_products['product_id'];

$vendor_id = $row_products['vendor_id'];

$pro_title = $row_products['product_title'];

$pro_url = $row_products['product_url'];

$pro_image = $row_products['product_img1'];

$pro_price = $row_products['product_price'];

$pro_psp_price = $row_products['product_psp_price'];

$pro_keywords = $row_products['product_keywords'];

$pro_date = $row_products['date'];

$pro_type = $row_products['product_type'];

$pro_vendor_status = $row_products['product_vendor_status'];

if(strpos($vendor_id, "admin_") !== false){
	
$admin_id = trim($vendor_id, "admin_");
	
$select_admin = "select * from admins where admin_id='$admin_id'";

$run_admin = mysqli_query($con,$select_admin);

$row_admin = mysqli_fetch_array($run_admin);

$vendor_name = $row_admin['admin_name'];
	
}else{

$select_customer = "select * from customers where customer_id='$vendor_id'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$vendor_name = $row_customer['customer_name'];

}

$select_product_stock = "select * from products_stock where product_id='$pro_id'";

$run_product_stock = mysqli_query($con, $select_product_stock);

if($pro_type != "variable_product"){
	
$row_product_stock = mysqli_fetch_array($run_product_stock);

$product_stock_status = $row_product_stock["stock_status"];

$stock_quantity = $row_product_stock["stock_quantity"];

}else{
	
$instock = 0;

$outofstock = 0;

$onbackorder = 0;

while($row_product_stock = mysqli_fetch_array($run_product_stock)){

$product_stock_status = $row_product_stock["stock_status"];

if($product_stock_status == "instock"){
	
$instock += $row_product_stock["stock_quantity"];	 
	
}elseif($product_stock_status == "outofstock"){
	
$outofstock += $row_product_stock["stock_quantity"];	 
	
}elseif($product_stock_status == "onbackorder"){

$onbackorder += $row_product_stock["stock_quantity"];	
	
}

}

}

?>

<tr>

<td><img src="product_images/<?php echo $pro_image; ?>" width="60" height="60"></td>

<td class="bold">

<?php echo $pro_title; ?> <small> by <?php echo $vendor_name; ?> </small>

<br>

<small>

<?php if($pro_type == "physical_product"){ ?>

Producto fisico

<?php }elseif($pro_type == "digital_product"){ ?>

Producto digital

<?php }elseif($pro_type == "variable_product"){ ?>

producto variable

<?php } ?>

</small>

<?php if($pro_vendor_status == "active"){ ?>

<span class="label label-success"> <?php echo ucwords($pro_vendor_status); ?> </span>

<?php }elseif($pro_vendor_status == "pending"){ ?>

<span class="label label-info"> <?php echo ucwords($pro_vendor_status); ?> </span>

<?php }elseif($pro_vendor_status == "paused"){ ?>

<span class="label label-warning"> <?php echo ucwords($pro_vendor_status); ?> </span> 

<?php }elseif($pro_vendor_status == "trash"){ ?>

<span class="label label-danger"> Borrar </span> 

<?php } ?>

</td>

<td width="140" class="bold">

<?php if($pro_type != "variable_product"){ ?>

<?php if($product_stock_status == "instock"){ ?>

<span class="text-success">En Stock (<?php echo $stock_quantity; ?>)</span>

<?php }elseif($product_stock_status == "outofstock"){ ?>

<span class="text-danger">Agotado (<?php echo $stock_quantity; ?>)</span>

<?php }elseif($product_stock_status == "onbackorder"){ ?>

<span class="text-warning">Para Encargo (<?php echo $stock_quantity; ?>)</span>

<?php } ?>

<?php }else{ ?>

<span class="text-success">En Stock (<?php echo $instock; ?>)</span> <br>

<span class="text-danger">Agotado (<?php echo $outofstock; ?>)</span> <br>

<span class="text-warning">Para Encargo (<?php echo $onbackorder; ?>)</span>

<?php } ?>

</td>

<td>

<?php 

if($pro_type != "variable_product"){ 

if($pro_psp_price != 0){

echo "<del> $$pro_price </del><br>";

echo "<ins>$$pro_psp_price</ins>";

}
else{

echo "$$pro_price";

}

}else{ 

$select_min_product_price = "select min(product_price) as product_price from product_variations where product_id='$pro_id' and product_price!='0'";

$run_min_product_price = mysqli_query($con,$select_min_product_price);

$row_min_product_price = mysqli_fetch_array($run_min_product_price);

$minimum_product_price = $row_min_product_price["product_price"];

$select_max_product_price = "select max(product_price) as product_price from product_variations where product_id='$pro_id'";

$run_max_product_price = mysqli_query($con,$select_max_product_price);

$row_max_product_price = mysqli_fetch_array($run_max_product_price);

$maximum_product_price = $row_max_product_price["product_price"];

echo $product_price = "$$minimum_product_price <br>---<br> $$maximum_product_price";

} 

?> 

</td>

<td>
<?php

$order_sold = 0;

$get_sold = "select * from orders_items where product_id='$pro_id'";

$run_sold = mysqli_query($con,$get_sold);

while($row_sold = mysqli_fetch_array($run_sold)){
	
$qty = $row_sold["qty"];

$order_sold += $qty;

}

echo $order_sold;

?>
</td>

<td> <?php echo $pro_keywords; ?> </td>

<td><?php echo $pro_date; ?></td>

<td>

<div class="dropdown">

<button class="btn btn-success dropdown-toggle" data-toggle="dropdown">

<span class="caret"></span>

</button>

<ul class="dropdown-menu dropdown-menu-right">

<li>

<a href="../<?php echo $pro_url; ?>" target="_blank">

<i class="fa fa-eye"></i> Ver

</a>

</li>

<?php if($pro_vendor_status == "pending"){ ?>

<li>

<a href="index.php?approve_product=<?php echo $pro_id; ?>&bundles">

<i class="fa fa-pause-circle-o"></i> Aprobar producto

</a>

</li>

<?php }elseif($pro_vendor_status == "active"){ ?>

<li>

<a href="index.php?pause_product=<?php echo $pro_id; ?>&bundles">

<i class="fa fa-pause-circle-o"></i> Pausar

</a>

</li>

<?php }elseif($pro_vendor_status == "paused"){ ?>

<li>

<a href="index.php?activate_product=<?php echo $pro_id; ?>&bundles">

<i class="fa fa-toggle-on"></i> Activar

</a>

</li>

<?php }elseif($pro_vendor_status == "trash"){ ?>

<li>

<a href="index.php?restore_product=<?php echo $pro_id; ?>&bundles">

<i class="fa fa-eye"></i> Restaurar producto

</a>

</li>

<li>

<a href="index.php?delete_bundle=<?php echo $pro_id; ?>">

<i class="fa fa-trash-o"></i> Borrar permanentemente

</a>

</li>

<?php } ?>

<?php if($pro_vendor_status != "trash"){ ?>

<li>

<a href="index.php?edit_bundle=<?php echo $pro_id; ?>">

<i class="fa fa-pencil"></i> Editar

</a>

</li>

<li>

<a href="index.php?move_to_trash=<?php echo $pro_id; ?>&bundles">

<i class="fa fa-trash-o"></i> Basura

</a>

</li>

<?php } ?>
				
</ul>
  
</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<center>

<ul class="pagination">

<?php

if((isset($_REQUEST["product_type"]) and isset($_REQUEST["stock_status"]) and isset($_REQUEST["vendor_id"])) or isset($_REQUEST["product_status"])){

if(isset($_REQUEST["product_status"])){
	
if($_REQUEST["product_status"] != "all"){
	
$product_vendor_status = $_REQUEST["product_status"];

$filter_url .= "&product_status=$product_vendor_status";

}

}

if(empty($stock_status)){
	
$select_products = "select * from products where status='bundle' $filter_where";

}else{
	
$select_products = "
select * from products JOIN products_stock ON products_stock.stock_id = (select stock_id from products_stock where product_id=products.product_id ORDER BY stock_id DESC LIMIT 1)
and products_stock.stock_status='$stock_status' 
where status='bundle' $filter_where
";
	
}

}else{

$select_products = "select * from products where status='bundle'";
	
}

$run_products = mysqli_query($con, $select_products);

$count_products = mysqli_num_rows($run_products);

$total_pages = ceil($count_products / $per_page);

echo "

<li class='page-item'>

<a href='index.php?view_bundles=1$filter_url' class='page-link'>

First Page

</a>

</li>

";

for($i = max(1, $page - 3); $i <= min($page + 3, $total_pages); $i++){
	
if($i == $page){

$active = "active";
	
}else{

$active = "";	
	
}

echo "

<li class='page-item $active'>

<a href='index.php?view_bundles=$i$filter_url' class='page-link'>

$i

</a>

</li>

";	
	
}

echo "

<li class='page-item'>

<a href='index.php?view_bundles=$total_pages$filter_url' class='page-link'>

Last Page

</a>

</li>

";

?>

</ul>

</center>

</div>

</div>

</div>

</div>

<?php } ?>