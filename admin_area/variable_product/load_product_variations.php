<?php

session_start();

include("../includes/db.php");

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('../login.php','_self')</script>";

}

if(!isset($_SERVER['HTTP_REFERER'])){
	
echo "<script> window.open('../index.php?dashboard','_self'); </script>";
	
}

if(isset($_SERVER['HTTP_REFERER'])){
	
$random_id = mysqli_real_escape_string($con, $_POST['random_id']);
	
$http_referer = substr($_SERVER['HTTP_REFERER'], strpos($_SERVER['HTTP_REFERER'], "?") + 1);

if($http_referer == "insert_product" or $http_referer == "edit_product=$random_id" or $http_referer == "insert_bundle" or $http_referer == "edit_bundle=$random_id"){
	
?>

<?php

$select_product_variations = "select * from product_variations where product_id='$random_id' and not product_type='default_attributes_variation' order by 1 DESC";

$run_product_variations = mysqli_query($con,$select_product_variations);

$count_product_variations = mysqli_num_rows($run_product_variations);

if($count_product_variations != 0){
	
while($row_product_variations = mysqli_fetch_array($run_product_variations)){
	
$variation_id = $row_product_variations["variation_id"];

$product_img1 = $row_product_variations["product_img1"];

$product_price = $row_product_variations["product_price"];

$product_psp_price = $row_product_variations["product_psp_price"];

$product_weight = $row_product_variations["product_weight"];

$product_type = $row_product_variations["product_type"];

$select_product_stock = "select * from products_stock where product_id='$random_id' and variation_id='$variation_id'";

$run_product_stock = mysqli_query($con, $select_product_stock);

$count_product_stock = mysqli_num_rows($run_product_stock);

if($count_product_stock == 0){

$enable_stock = "no";

$stock_status = "";

$stock_quantity = 0;

$allow_backorders = "";	

}else{

$row_product_stock = mysqli_fetch_array($run_product_stock);

$enable_stock = $row_product_stock["enable_stock"];

$stock_status = $row_product_stock["stock_status"];

$stock_quantity = $row_product_stock["stock_quantity"];

$allow_backorders = $row_product_stock["allow_backorders"];

}
	
?>

<div class="single-variation-row" id="variation_<?php echo $variation_id; ?>">

<hr class="variation-hr">

<strong> #<?php echo $variation_id; ?> </strong>

<div class="variation-attributes">

<?php

$select_product_attributes = "select * from product_attributes where product_id='$random_id'";

$run_product_attributes = mysqli_query($con,$select_product_attributes);

while($row_product_attributes = mysqli_fetch_array($run_product_attributes)){
	
$attribute_id = $row_product_attributes["attribute_id"];

$attribute_name = $row_product_attributes["attribute_name"];

$attribute_values = explode("|", $row_product_attributes["attribute_values"]);

$meta_key = str_replace(' ', '_', strtolower($row_product_attributes["attribute_name"]));

?>

<select class="form-control" name="variations[<?php echo $variation_id; ?>][attributes][<?php echo $meta_key; ?>]">

<option value=""> Selecciona una <?php echo $attribute_name; ?> </option>

<?php

foreach($attribute_values as $attribute_value){
		
$select_variations_meta = "select * from variations_meta where variation_id='$variation_id' and meta_key='$meta_key'";

$run_variations_meta = mysqli_query($con,$select_variations_meta);

$row_variations_meta = mysqli_fetch_array($run_variations_meta);

$meta_value = $row_variations_meta["meta_value"];

if($attribute_value == $meta_value){
	
echo "<option selected>$attribute_value</option>";

}else{

echo "<option>$attribute_value</option>";

}
	
}

?>

</select>

<?php } ?>

</div>

<div class="variation-actions">

<button class="btn btn-default btn-sm" title="Expand Variation" data-toggle="collapse" href="#variation_collapse_<?php echo $variation_id; ?>">

<i class="fa fa-arrow-down"></i>

</button>

<a href="#" class="btn btn-sm btn-danger delete-product-variation" data-variation="<?php echo $variation_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

</a>

</div>
<div class="variation-row-expand collapse" id="variation_collapse_<?php echo $variation_id; ?>" data-variation="<?php echo $variation_id; ?>"><!-- variation-row-expand Starts -->

<div class="row">

<div class="col-md-6">

<div class="form-group">

<label> Precio producto </label>

<input type="text" name="variations[<?php echo $variation_id; ?>][product_price]" class="form-control" required value="<?php echo $product_price; ?>" >

</div>

<div class="form-group">

<label> Producto precio venta </label>

<input type="text" name="variations[<?php echo $variation_id; ?>][product_psp_price]" class="form-control" value="<?php echo $product_psp_price; ?>">

</div>

<div class="form-group" id="stock-status-<?php echo $variation_id; ?>">

<label> Estado de Stock </label>

<select class="form-control" name="variations[<?php echo $variation_id; ?>][stock_status]" required><!-- select manufacturer Starts -->

<?php if($stock_status == "instock"){ ?>

<option value="instock" selected>En stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder">Para Encargo</option>

<?php }elseif($stock_status == "outofstock"){ ?>

<option value="instock">En stock</option>

<option value="outofstock" selected>Agotado</option>

<option value="onbackorder">Para Encargo</option>

<?php }elseif($stock_status == "onbackorder"){ ?>

<option value="instock">En stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder" selected>Para Encargo</option>

<?php }else{ ?>

<option value="instock">En stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder">Para Encargo</option>

<?php } ?>

</select>

</div>

<div id="stock-management-row-<?php echo $variation_id; ?>">
<div class="form-group">

<label> Cantidad de Stock </label>

<input type="number" name="variations[<?php echo $variation_id; ?>][stock_quantity]" value="<?php echo $stock_quantity; ?>" class="form-control" required>

</div>

<div class="form-group">

<label> Permitir Encargos? </label>

<select class="form-control" name="variations[<?php echo $variation_id; ?>][allow_backorders]" required>

<?php if($allow_backorders == "no"){ ?>

<option value="no" selected>No permitir</option>

<option value="notify">Permitir, pero notificar al cliente</option>

<option value="yes">Permitir</option>

<?php }elseif($allow_backorders == "notify"){ ?>

<option value="no">No permitir</option>

<option value="notify" selected>Permitir, pero notificar al cliente</option>

<option value="yes">Permitir</option>

<?php }elseif($allow_backorders == "yes"){ ?>

<option value="no">No permitir</option>

<option value="notify">Permitir, pero notificar al cliente</option>

<option value="yes" selected>Permitir</option>

<?php }else{ ?>

<option value="no">No permitir</option>

<option value="notify">Permitir, pero notificar al cliente</option>

<option value="yes">Permitir</option>

<?php } ?>

</select>

</div>

</div>

</div>

<div class="col-md-6">

<div class="form-group">

<label> Seleccione un tipo de producto </label>

<select class="form-control" name="variations[<?php echo $variation_id; ?>][product_type]">

<?php if($product_type == "physical_product"){ ?>

<option value="physical_product" selected> Producto ropa </option>

<option value="physical_product"> Producto ropa </option>

<?php }else{ ?>

<option value="physical_product"> Producto ropa </option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label> Peso Producto <small> (kg)</small> </label>

<input type="text" name="variations[<?php echo $variation_id; ?>][product_weight]" class="form-control" value="<?php echo $product_weight; ?>">

</div>

<div class="form-group">

<label> ¿Habilitar la gestión de existencias a nivel de variación? </label>

<div class="radio">

<label>

<input type="radio" name="variations[<?php echo $variation_id; ?>][enable_stock]" class="variations-enable-stock" data-variation="<?php echo $variation_id; ?>" value="yes" <?php if($enable_stock == "yes"){ echo "checked"; } ?> required> Si

</label>

<label>

<input type="radio" name="variations[<?php echo $variation_id; ?>][enable_stock]" class="variations-enable-stock" data-variation="<?php echo $variation_id; ?>" value="no" <?php if($enable_stock == "no"){ echo "checked"; } ?> required> No
  
</label>

</div>

</div>

</div>

</div>

</div>

<script>

$(document).ready(function(){

<?php if($enable_stock == "no"){ ?>

$("#stock-management-row-<?php echo $variation_id; ?>").hide();

<?php }elseif($enable_stock == "yes"){ ?>

$("#stock-status-<?php echo $variation_id; ?>").hide();

<?php } ?>

});

</script>

</div>

<?php 

}

} 

} 

} 
 
?>