<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$select_general_settings = "select * from general_settings";

$run_general_settings = mysqli_query($con,$select_general_settings);

$row_general_settings = mysqli_fetch_array($run_general_settings);

$product_vendor_status = $row_general_settings["new_product_status"];

?>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>tinymce.init({ selector:'#product_desc,#product_features' });</script>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Agregar Producto

</h3>

</div>

<div class="panel-body">

<form id="insert_product_form" method="post" enctype="multipart/form-data">

<div class="row">

<div class="col-md-9">

<div class="form-group" >

<label> Nombre Producto </label>

<input type="text" name="product_title" class="form-control" required >

</div>

<div class="form-group" >

<label> Producto Descripción (SEO) </label>

<textarea name="product_seo_desc" class="form-control" maxlength="230" placeholder="La mayoría de los motores de búsqueda utilizan un máximo de 230 caracteres para la descripción."></textarea>

</div>

<div class="form-group" >

<label> URL Producto </label>

<input type="text" name="product_url" class="form-control" required >

<br>

<p style="font-size:15px; font-weight:bold;">
Ejemplo de URL del producto: camiseta azul marino
</p>

</div>

<div class="form-group">

<label> Fichas de producto </label>

<ul class="nav nav-tabs">

<li class="active">

<a data-toggle="tab" href="#description"> Descripción de producto </a>

</li>

<li>

<a data-toggle="tab" href="#features"> Características de producto </a>

</li>

<li>

<a data-toggle="tab" href="#video"> Sonidos y Vídeos </a>

</li>

</ul>

<div class="tab-content">

<div id="description" class="tab-pane fade in active">

<br>
<textarea name="product_desc" class="form-control" rows="15" id="product_desc"></textarea>

</div>

<div id="features" class="tab-pane fade in">

<br>
<textarea name="product_features" class="form-control" rows="15" id="product_features"></textarea>

</div>

<div id="video" class="tab-pane fade in">

<br>
<textarea name="product_video" class="form-control" rows="15"></textarea>

</div>

</div>

</div>

<div class="form-group" id="product_weight">

<label> Peso Producto <small> (kg)</small> </label>

<input type="text" name="product_weight" class="form-control">

</div>

<div class="form-group" id="product_price">

<label> Precio producto </label>

<input type="text" name="product_price" class="form-control" required>

</div>

<div class="form-group" id="product_psp_price">

<label> Precio venta producto </label>

<input type="text" name="psp_price" class="form-control">

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label> Seleccionar Tipo de producto</label>

<select class="form-control" name="product_type">

<option value="physical_product"> Producto simple </option>

<option value="variable_product"> Producto avanzado </option>

</select>

</div>

<div class="form-group">

<label> Seleccionar Fabricante </label>

<select class="form-control" name="manufacturer">

<option> Seleccionar Fabricante </option>

<?php

$get_manufacturer = "select * from manufacturers";
$run_manufacturer = mysqli_query($con,$get_manufacturer);
while($row_manufacturer= mysqli_fetch_array($run_manufacturer)){
$manufacturer_id = $row_manufacturer['manufacturer_id'];
$manufacturer_title = $row_manufacturer['manufacturer_title'];

echo "<option value='$manufacturer_id'>
$manufacturer_title
</option>";

}

?>

</select>

</div>

<div class="form-group">

<label> Categoría de producto </label>

<select name="product_cat" class="form-control" >

<option> Seleccionar categoría producto </option>

<?php

$get_p_cats = "select * from product_categories";

$run_p_cats = mysqli_query($con,$get_p_cats);

while ($row_p_cats=mysqli_fetch_array($run_p_cats)) {

$p_cat_id = $row_p_cats['p_cat_id'];

$p_cat_title = $row_p_cats['p_cat_title'];

echo "<option value='$p_cat_id' >$p_cat_title</option>";

}

?>

</select>

</div>

<div class="form-group" >

<label> Categoría </label>

<select name="cat" class="form-control" >

<option> Seleccionar categoría </option>

<?php

$get_cat = "select * from categories";

$run_cat = mysqli_query($con,$get_cat);

while ($row_cat=mysqli_fetch_array($run_cat)) {

$cat_id = $row_cat['cat_id'];

$cat_title = $row_cat['cat_title'];

echo "<option value='$cat_id'>$cat_title</option>";

}

?>

</select>

</div>

<div class="form-group" >

<label> Producto Imagen 1 </label>

<input type="file" name="product_img1" class="form-control" required >

</div>

<div class="form-group" >

<label> Producto Imagen 2 </label>

<input type="file" name="product_img2" class="form-control">

</div>

<div class="form-group" >

<label> Producto Imagen 3 </label>

<input type="file" name="product_img3" class="form-control">

</div>

<div class="form-group" >

<label> Producto Keywords </label>

<input type="text" name="product_keywords" class="form-control">

</div>

<div class="form-group" >

<label> Etiquetas de producto </label>

<input type="text" name="product_label" class="form-control">

</div>

</div>

</div>

<div class="form-group" id="product-stock-management">

<label> Gestión de stock de inventario de productos </label>

<div class="panel panel-default">

<div class="panel-heading">

<strong> Inventario - Opciones de stock</strong>

</div>

<div class="panel-body">

<div class="row">

<div class="col-sm-6" id="stock-status">

<div class="form-group">

<label> Estado de Stock </label>

<select class="form-control" name="stock_status" required>

<option value="instock">En stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder">Para encargo</option>

</select>

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> Habilitar gestión de stock</label>

<div class="radio">

<label>
  <input type="radio" name="enable_stock" value="yes" required> Si
</label>

<label>
  <input type="radio" name="enable_stock" value="no" checked required> No
</label>

</div>

</div>

</div>

</div>

<div class="row" id="stock-management-row">

<div class="col-sm-6">

<div class="form-group">

<label> Cantidad de Stock </label>

<input type="number" name="stock_quantity" value="0" class="form-control" required>

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> ¿Permitir pedidos por encargo? </label>

<select class="form-control" name="allow_backorders" required>

<option value="no">No permitir</option>

<option value="notify">Permitir, pero notificar al cliente</option>

<option value="yes">Permitir</option>

</select>

</div>

</div>

</div>

</div>

</div>

</div>


</form>

<div class="form-group" id="variable_product_options">

<label> Opciones de variables para producto </label>

<div class="panel panel-default">

<div class="panel-heading">

<ul class="nav nav-tabs">

<li class="active">

<a data-toggle="tab" href="#product_attributes"> Atributos del producto </a>

</li>

<li>

<a data-toggle="tab" href="#product_variations"> Variaciones de producto </a>

</li>

</ul>

</div>

<div class="panel-body">

<div class="tab-content">

<div id="product_attributes" class="tab-pane fade in active">

<form id="insert_attribute_form" method="post">

<div class="row">

<div class="col-sm-4">

<div class="form-group">

<label> Nombre: </label>

<input type="text" name="attribute_name" class="form-control" required>

</div>

</div>

<div class="col-sm-8">

<div class="form-group">

<label> Valores: </label>

<textarea name="attribute_values" class="form-control" placeholder="Ingrese algunos atributos por '|' separando valores." required></textarea>

</div>

</div>

</div>

<div class="form-group">

<input type="submit" value="Agregar atributo a producto" class="btn btn btn-primary">

</div>

</form>

<table class="table table-hover table-bordered table-striped">

<thead>

<tr>

<th> Nombre de atributo: </th>
<th> Valor (es) de atributo: </th>
<th> Acciones: </th>

</tr>

</thead>

<tbody>

<?php

$random_id = 152;

$select_product_attributes = "select * from product_attributes where product_id='$random_id'";

$run_product_attributes = mysqli_query($con,$select_product_attributes);

while($row_product_attributes = mysqli_fetch_array($run_product_attributes)){
	
$attribute_id = $row_product_attributes["attribute_id"];

$attribute_name = $row_product_attributes["attribute_name"];

$attribute_values = $row_product_attributes["attribute_values"];

?>

<tr id="tr-attribute-<?php echo $attribute_id; ?>">

<td> 

<div class="edit" data-attribute="<?php echo $attribute_id; ?>"><?php echo $attribute_name; ?></div>

<input type="text" id="attribute-name" class="input-edit form-control" data-attribute="<?php echo $attribute_id; ?>" value="<?php echo $attribute_name; ?>">

</td>

<td>

<div class="edit" data-attribute="<?php echo $attribute_id; ?>"><?php echo $attribute_values; ?></div>

<input type="text" id="attribute-values" class="input-edit form-control" data-attribute="<?php echo $attribute_id; ?>" value="<?php echo $attribute_values; ?>">

</td>

<td>

<div class="btn-group">

<a href="#" class="edit-product-attribute btn btn-primary btn-sm" data-attribute="<?php echo $attribute_id; ?>">

<i class="fa fa-pencil"></i> Editar

</a>

<a href="#" class="save-product-attribute btn btn-success btn-sm" data-attribute="<?php echo $attribute_id; ?>">

<i class="fa fa-floppy-o"></i> Guardar

</a>

<a href="#" class="delete-product-attribute btn btn-danger btn-sm" data-attribute="<?php echo $attribute_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

</a>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<div id="product_variations" class="tab-pane fade in">

<form id="product-variations-form" method="post" enctype="multipart/form-data">

<div class="form-group row">

<label class="col-sm-3 control-label"> Valores predeterminados:</label>

<div class="col-sm-9">

<div class="row" id="default_form_values">


</div>

<span class="help-block">

Estos son los atributos del producto que serán preseleccionados en la interfaz.

</span>

</div>

</div>

<hr class="variation-hr">

<div class="form-group row">

<label class="col-sm-1 control-label"> Acciones: </label>

<div class="col-sm-10">

<select class="form-control" id="action_select">

<option value="add_variation"> Agregar variación </option>

<option value="create_variations_from_attributes"> Crear nuevas variaciones a partir de todos los atributos</option>

<option value="delete_all_variations"> Eliminar todas las variaciones </option>

</select>

</div>

<div class="col-sm-1">

<button type="button" id="go_button" class="btn btn-success form-control"> aceptar </button>

</div>

</div>

<div class="product-variations-div">


</div>

<hr class="variation-hr">

<div class="form-group">

<input type="submit" value="Guardar variaciones" class="btn btn btn-success">

</div>

</form>

<div class="ajax-response-div"></div>

</div>

</div>

</div>

</div>

</div>

<div class="form-group">

<input type="submit" name="submit" value="Agregar producto" form="insert_product_form" class="btn btn-primary form-control">

</div>

</div>

</div>

</div>

</div> 

<script>

$(document).ready(function(){

//Gestión de Stock

$("#stock-management-row").hide();

$("input[name='enable_stock']").click(function(){
	
var radio_value = $(this).val();

if(radio_value == "yes"){

$("#stock-status").hide();

$("#stock-management-row").show();
	
}else if(radio_value == "no"){
	
$("#stock-status").show();

$("#stock-management-row").hide();
	
}
	
});

//Gestión de Stock

//Cambiar tipo producto

function change_product_type(){

var product_type = $("select[name='product_type']").val();

if(product_type == "physical_product"){
	
$("#product_weight").show();

$("#product_price").show();

$("#product_psp_price").show();

$('#product_weight input,#product_price input,#product_psp_price input').prop("disabled", false);

$("#product-stock-management").show();

$('#product-stock-management input,#product-stock-management select').prop("disabled", false);

$("#variable_product_options").hide();
	
}else if(product_type == "digital_product"){

$("#product_weight").hide();

$("#product_price").show();

$("#product_psp_price").show();

$('#product_weight input,#product_price input,#product_psp_price input').prop("disabled", false);

$("#product-stock-management").show();

$('#product-stock-management input,#product-stock-management select').prop("disabled", false);

$("#variable_product_options").hide();
	
}else if(product_type == "variable_product"){

$("#product_weight").hide();

$("#product_price").hide();

$("#product_psp_price").hide();

$('#product_weight input,#product_price input,#product_psp_price input').prop("disabled", true);

$("#product-stock-management").hide();

$('#product-stock-management input,#product-stock-management select').prop("disabled", true);

$("#variable_product_options").show();
	
}
	
}

//Cambiar tipo producto

change_product_type();
 
$("select[name='product_type']").change(function(){
	
change_product_type();
  
});

//Cargar atributos

function load_product_attributes(){

$.ajax({
	
method: "POST",

url: "variable_product/load_product_attributes.php",

data: { random_id: <?php echo $random_id; ?> },

success:function(data){
	
$("table tbody").html(data);

$("table").removeClass("wait-loader");
	
}	

});
	
}

//Cargar atributos

//Agregar nuevo atributo

$("#insert_attribute_form").submit(function(event){
	
event.preventDefault();	

$("table").addClass("wait-loader");

$.ajax({
	
method: "POST",

url: "variable_product/insert_product_attribute.php",

data: $('#insert_attribute_form').serialize() + "&random_id=<?php echo $random_id; ?>",

success: function(){
	
$("#insert_attribute_form").find("input[type=text],textarea").val("");

load_product_attributes();
	
}

});

});

//Agregar nuevo atributo

//Editar atributo

$(".input-edit").hide();

$(".save-product-attribute").hide();

$(".edit-product-attribute").on('click', function(event){
	
event.preventDefault();

var attribute_id = $(this).data("attribute");
	
$(".edit").show();
	
$(".input-edit").hide();

$(".edit[data-attribute='" + attribute_id +"']").hide();

$(".input-edit[data-attribute='" + attribute_id +"']").show().focus();

$(".edit-product-attribute[data-attribute='" + attribute_id +"']").hide();

$(".save-product-attribute[data-attribute='" + attribute_id +"']").show();
	
});

//Editar atributo

//Guardar atributo

$(".save-product-attribute").on('click', function(event){
	
event.preventDefault();

var attribute_id = $(this).data("attribute");

$(".edit[data-attribute='" + attribute_id +"']").show();

$(".input-edit[data-attribute='" + attribute_id +"']").hide();

$(".edit-product-attribute[data-attribute='" + attribute_id +"']").show();

$(".save-product-attribute[data-attribute='" + attribute_id +"']").hide();
	
var attribute_name = $("#attribute-name[data-attribute='" + attribute_id +"']").val();

var attribute_values = $("#attribute-values[data-attribute='" + attribute_id +"']").val();

$("#attribute-name[data-attribute='" + attribute_id +"']").prev(".edit").text(attribute_name);

$("#attribute-values[data-attribute='" + attribute_id +"']").prev(".edit").text(attribute_values);

var random_id = <?php echo $random_id; ?>;

$.ajax({
	
method: "POST",

url: "variable_product/update_product_attribute.php",

data: { random_id: random_id, attribute_id: attribute_id, attribute_name: attribute_name, attribute_values: attribute_values } 
      
});

});

//Guardar atributo

//Borrar atributo
	
$(".delete-product-attribute").on('click', function(event){
	
event.preventDefault();

var attribute_id = $(this).data("attribute");

$("#tr-attribute-" + attribute_id).remove();	
	
var random_id = <?php echo $random_id; ?>;

$.ajax({
	
method: "POST",

url: "variable_product/delete_product_attribute.php",

data: { random_id: random_id, attribute_id: attribute_id }
      
});

});

//Borrar atributo

//Atributos default

function load_variations_default_form_values(){

$.ajax({
	
method: "POST",

url: "variable_product/load_default_form_values.php",

data: { random_id: <?php echo $random_id; ?> },

success:function(data){
	
$("#default_form_values").html(data);

}	

});
	
}

//Atributos default

//Cargar variables

function load_product_variations(){

$.ajax({
	
method: "POST",

url: "variable_product/load_product_variations.php",

data: { random_id: <?php echo $random_id; ?> },

success:function(data){
	
$(".product-variations-div").html(data);

$(".product-variations-div").removeClass("wait-loader");

}	

});
	
}

//Cargar variables

//Tabla atributos

$("a[href='#product_variations']").click(function(){
	
$(".product-variations-div").addClass("wait-loader");
	
load_variations_default_form_values();

load_product_variations();

});

//Tabla atributos

//Guardar variables

function save_update_product_variations(){

var form = document.getElementById("product-variations-form");

var form_data = new FormData(form);

form_data.append("random_id", <?php echo $random_id; ?>);

$.ajax({
	
method: "POST",

url: "variable_product/update_all_variations.php",

data:form_data,

contentType: false,

cache: false,

processData:false,

success: function(data){
	
$(".ajax-response-div").html(data);
	
$(".product-variations-div").removeClass("wait-loader");
	
}

});

	
}

//Guardar variables

//Botón de acción

$("#go_button").click(function(){
	
var action_select = $("#action_select").val();

if(action_select == "add_variation"){
	
$(".product-variations-div").addClass("wait-loader");

save_update_product_variations();

$(".product-variations-div").addClass("wait-loader");
	
$.ajax({
	
method: "POST",

url: "variable_product/insert_product_variation.php",

data: { random_id: <?php echo $random_id; ?> },

success: function(){
	
load_product_variations();
	
}

});
	
}else if(action_select == "create_variations_from_attributes"){
	
var confirm_action = confirm("¿Está seguro de que desea vincular todas las variaciones? Esto creará una nueva variación para todas y cada una de las posibles combinaciones de atributos de variación (máximo 50 por ejecución).");

if(confirm_action == true){

$(".product-variations-div").addClass("wait-loader");

save_update_product_variations();

$(".product-variations-div").addClass("wait-loader");
		
$.ajax({
	
method: "POST",

url: "variable_product/create_variations_from_attributes.php",

data: { random_id: <?php echo $random_id; ?> },

success: function(data){
	
$(".ajax-response-div").html(data);
	
load_product_variations();

load_variations_default_form_values();
	
}

});

}
	
}else if(action_select == "delete_all_variations"){
	
var confirm_action = confirm("¿Está seguro de que desea eliminar todas las variaciones? Esto no se puede deshacer.");

if(confirm_action == true){
	
$(".product-variations-div").addClass("wait-loader");

$.ajax({
	
method: "POST",

url: "variable_product/delete_all_variations.php",

data: { random_id: <?php echo $random_id; ?> },

success: function(){
	
load_product_variations();

load_variations_default_form_values();
	
}

});
	
}

}

});

//Botón de acción

$("#product-variations-form").submit(function(event){

event.preventDefault();

$(".product-variations-div").addClass("wait-loader");

save_update_product_variations();

load_variations_default_form_values();
	
});

});

</script>

<?php

if(isset($_POST['submit'])){

$product_title = mysqli_real_escape_string($con, $_POST['product_title']);

$product_seo_desc = mysqli_real_escape_string($con, $_POST['product_seo_desc']);

$product_url = mysqli_real_escape_string($con, $_POST['product_url']);

$product_cat = mysqli_real_escape_string($con, $_POST['product_cat']);

$cat = mysqli_real_escape_string($con, $_POST['cat']);

$manufacturer_id = mysqli_real_escape_string($con, $_POST['manufacturer']);

$product_price = mysqli_real_escape_string($con, $_POST['product_price']);

$product_desc = mysqli_real_escape_string($con, $_POST['product_desc']);

$product_keywords = mysqli_real_escape_string($con, $_POST['product_keywords']);

$psp_price = mysqli_real_escape_string($con, $_POST['psp_price']);

$product_label = mysqli_real_escape_string($con, $_POST['product_label']);

$product_type = mysqli_real_escape_string($con, $_POST['product_type']);

$product_features = mysqli_real_escape_string($con, $_POST['product_features']);

$product_video = mysqli_real_escape_string($con, $_POST['product_video']);

$product_weight = mysqli_real_escape_string($con, $_POST['product_weight']);

$stock_status = mysqli_real_escape_string($con, $_POST['stock_status']);

$enable_stock = mysqli_real_escape_string($con, $_POST['enable_stock']);

$stock_quantity = mysqli_real_escape_string($con, $_POST['stock_quantity']);

$allow_backorders = mysqli_real_escape_string($con, $_POST['allow_backorders']);

$status = "product";

$product_img1 = $_FILES['product_img1']['name'];
$product_img2 = $_FILES['product_img2']['name'];
$product_img3 = $_FILES['product_img3']['name'];

$temp_name1 = $_FILES['product_img1']['tmp_name'];
$temp_name2 = $_FILES['product_img2']['tmp_name'];
$temp_name3 = $_FILES['product_img3']['tmp_name'];

$allowed = array('jpeg','jpg','gif','png');

$product_img1_extension = pathinfo($product_img1, PATHINFO_EXTENSION);

$product_img2_extension = pathinfo($product_img2, PATHINFO_EXTENSION);

$product_img3_extension = pathinfo($product_img3, PATHINFO_EXTENSION);

if(!in_array($product_img1_extension,$allowed)){
 
echo "<script> alert('La extensión de archivo de la imagen 1 de su producto no es compatible.'); </script>";

$product_img1 = "";

}else{

move_uploaded_file($temp_name1,"../admin_area/product_images/$product_img1");

}

if(!empty($product_img2)){

if(!in_array($product_img2_extension,$allowed)){
 
echo "<script> alert('La extensión de archivo de la imagen 2 de su producto no es compatible.'); </script>";

$product_img2 = "";

}else{

move_uploaded_file($temp_name2,"../admin_area/product_images/$product_img2");

}

}

if(!empty($product_img3)){

if(!in_array($product_img3_extension,$allowed)){
 
echo "<script> alert('La extensión de archivo de la imagen 2 de su producto no es compatible.'); </script>";

$product_img3 = "";

}else{

move_uploaded_file($temp_name3,"../admin_area/product_images/$product_img3");

}

}

$insert_product = "insert into products (vendor_id,p_cat_id,cat_id,manufacturer_id,date,product_title,product_seo_desc,product_url,product_img1,product_img2,product_img3,product_price,product_psp_price,product_desc,product_features,product_video,product_keywords,product_label,product_type,product_weight,product_vendor_status,status) values ('$customer_id','$product_cat','$cat','$manufacturer_id',NOW(),'$product_title','$product_seo_desc','$product_url','$product_img1','$product_img2','$product_img3','$product_price','$psp_price','$product_desc','$product_features','$product_video','$product_keywords','$product_label','$product_type','$product_weight','$product_vendor_status','$status')";

$run_product = mysqli_query($con,$insert_product);

$product_id = mysqli_insert_id($con); 

if($run_product){
	
if($product_type != "variable_product"){
	
if($enable_stock == "yes" and $stock_quantity > 0){

$stock_status = "instock";
	
}elseif($enable_stock == "yes" and $allow_backorders == "no" and $stock_quantity < 1){

$stock_status = "outofstock";
	
}elseif($enable_stock == "yes" and ($allow_backorders == "yes" or $allow_backorders == "notify") and $stock_quantity < 1){

$stock_status = "onbackorder";
	
}
	
$insert_product_stock = "insert into products_stock (product_id,enable_stock,stock_status,stock_quantity,allow_backorders) values ('$product_id','$enable_stock','$stock_status','$stock_quantity','$allow_backorders')";
	
$run_insert_product_stock = mysqli_query($con,$insert_product_stock);

}

$update_product_stock = "update products_stock set product_id='$product_id' where product_id='$random_id'";
	
$run_update_product_stock = mysqli_query($con,$update_product_stock);

$update_product_attributes = "update product_attributes set product_id='$product_id' where product_id='$random_id'";

$run_product_attributes = mysqli_query($con, $update_product_attributes);

$update_product_variations = "update product_variations set product_id='$product_id' where product_id='$random_id'";

$run_product_variations = mysqli_query($con, $update_product_variations);

echo "

<script>

alert(' Su producto se ha insertado correctamente.');

window.open('index.php?products','_self');

</script>

";

}

}

?>
