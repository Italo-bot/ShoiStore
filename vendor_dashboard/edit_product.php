<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

if(isset($_GET['edit_product'])){

$edit_id = $_GET['edit_product'];

$select_product = "select * from products where product_id='$edit_id' and vendor_id='$customer_id'";

$run_product = mysqli_query($con,$select_product);

$row_product = mysqli_fetch_array($run_product);

$p_id = $row_product['product_id'];

$p_title = $row_product['product_title'];

$p_cat = $row_product['p_cat_id'];

$cat = $row_product['cat_id'];

$m_id = $row_product['manufacturer_id'];

$p_image1 = $row_product['product_img1'];

$p_image2 = $row_product['product_img2'];

$p_image3 = $row_product['product_img3'];

$new_p_image1 = $row_product['product_img1'];

$new_p_image2 = $row_product['product_img2'];

$new_p_image3 = $row_product['product_img3'];

$p_price = $row_product['product_price'];

$p_desc = $row_product['product_desc'];

$p_keywords = $row_product['product_keywords'];

$psp_price = $row_product['product_psp_price'];

$p_label = $row_product['product_label'];

$p_url = $row_product['product_url'];

$p_features = $row_product['product_features'];

$p_video = $row_product['product_video'];

$p_type = $row_product['product_type'];

$p_weight = $row_product['product_weight'];

$p_seo_desc = $row_product['product_seo_desc'];

$product_vendor_status = $row_product['product_vendor_status'];

}

$get_manufacturer = "select * from manufacturers where manufacturer_id='$m_id'";

$run_manufacturer = mysqli_query($con,$get_manufacturer);

$row_manfacturer = mysqli_fetch_array($run_manufacturer);

$manufacturer_id = $row_manfacturer['manufacturer_id'];

$manufacturer_title = $row_manfacturer['manufacturer_title'];

$get_p_cat = "select * from product_categories where p_cat_id='$p_cat'";

$run_p_cat = mysqli_query($con,$get_p_cat);

$row_p_cat = mysqli_fetch_array($run_p_cat);

$p_cat_title = $row_p_cat['p_cat_title'];

$get_cat = "select * from categories where cat_id='$cat'";

$run_cat = mysqli_query($con,$get_cat);

$row_cat = mysqli_fetch_array($run_cat);

$cat_title = $row_cat['cat_title'];

$select_products_stock = "select * from products_stock where product_id='$p_id'";

$run_products_stock = mysqli_query($con,$select_products_stock);

$count_product_stock = mysqli_num_rows($run_products_stock);

if($count_product_stock == 0){
	
$enable_stock = "no";

$stock_status = "";

$stock_quantity = 0;

$allow_backorders = "";	

}else{

$row_products_stock = mysqli_fetch_array($run_products_stock);

$enable_stock = $row_products_stock['enable_stock'];

$stock_status = $row_products_stock['stock_status'];

$stock_quantity = $row_products_stock['stock_quantity'];

$allow_backorders = $row_products_stock['allow_backorders'];

}

$select_general_settings = "select * from general_settings";

$run_general_settings = mysqli_query($con,$select_general_settings);

$row_general_settings = mysqli_fetch_array($run_general_settings);

$edited_product_status = $row_general_settings["edited_product_status"];

if($edited_product_status == "yes"){

$product_vendor_status = "pending";	

}

?>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>tinymce.init({ selector:'#product_desc,#product_features' });</script>

<h3> Editar Producto </h3>

<form id="edit_product_form" method="post" enctype="multipart/form-data">

<div class="row">

<div class="col-md-9">

<div class="form-group">

<label class="control-label"> Nombre Producto </label>

<input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>">

</div>

<div class="form-group" >

<label> Descripción SEO de producto </label>

<textarea name="product_seo_desc" class="form-control" maxlength="230" placeholder="La mayoría de los motores de búsqueda utilizan un máximo de 230 caracteres para la descripción "><?php echo $p_seo_desc; ?></textarea>

</div>

<div class="form-group">

<label> URL Producto </label>

<input type="text" name="product_url" class="form-control" required value="<?php echo $p_url; ?>">

<br>

<p style="font-size:15px; font-weight:bold;">
Ejemplo de URL del producto: camiseta azul marino
</p>

</div>


<div class="form-group" >

<label> Fichas de producto </label>

<ul class="nav nav-tabs">

<li class="active">

<a data-toggle="tab" href="#description"> Descripción de producto </a>

</li>

<li>

<a data-toggle="tab" href="#features"> Características del producto </a>

</li>

<li>

<a data-toggle="tab" href="#video"> Sonidos y Vídeos </a>

</li>

</ul>

<div class="tab-content">

<div id="description" class="tab-pane fade in active">

<br>

<textarea name="product_desc" class="form-control" rows="15" id="product_desc"><?php echo $p_desc; ?></textarea>

</div>

<div id="features" class="tab-pane fade in">

<br>

<textarea name="product_features" class="form-control" rows="15" id="product_features"><?php echo $p_features; ?></textarea>

</div>

<div id="video" class="tab-pane fade in">

<br>

<textarea name="product_video" class="form-control" rows="15"><?php echo $p_video; ?></textarea>

</div>

</div>
</div>

<div class="form-group" id="product_weight">

<label> Peso de producto <small> (kg)</small> </label>

<input type="text" name="product_weight" class="form-control" value="<?php echo $p_weight; ?>">

</div>

<div class="form-group" id="product_price">

<label> Precio Producto </label>

<input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>" >

</div>

<div class="form-group" id="product_psp_price">

<label> Precio de venta del producto </label>

<input type="text" name="psp_price" class="form-control" required value="<?php echo $psp_price; ?>">

</div>

</div>

<div class="col-md-3">

<div class="form-group">

<label> Seleccione un tipo de producto </label>

<select class="form-control" name="product_type">

<?php if($p_type == "physical_product"){ ?>

<option value="physical_product" selected> Producto simple </option>

<option value="variable_product"> Producto avanzado</option>

<?php }elseif($p_type == "digital_product"){ ?>

<option value="physical_product"> Producto simple </option>

<option value="variable_product"> Producto avanzado </option>

<?php }elseif($p_type == "variable_product"){ ?>

<option value="physical_product"> Producto simple </option>

<option value="variable_product" selected> Producto avanzado </option>

<?php }else{ ?>

<option value="physical_product"> Producto simple </option>

<option value="variable_product"> Producto avanzado </option>

<?php } ?>

</select>

</div>

<div class="form-group">

<label> Selecionar Fabricante </label>

<select name="manufacturer" class="form-control">

<option value="<?php echo $manufacturer_id; ?>">
<?php echo $manufacturer_title; ?>
</option>

<?php

$get_manufacturer = "select * from manufacturers";

$run_manufacturer = mysqli_query($con,$get_manufacturer);

while($row_manfacturer = mysqli_fetch_array($run_manufacturer)){

$manufacturer_id = $row_manfacturer['manufacturer_id'];

$manufacturer_title = $row_manfacturer['manufacturer_title'];

echo "
<option value='$manufacturer_id'>
$manufacturer_title
</option>
";

}

?>

</select>

</div>

<div class="form-group" >

<label> Categoría Producto </label>

<select name="product_cat" class="form-control" >

<option value="<?php echo $p_cat; ?>" > <?php echo $p_cat_title; ?> </option>


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

<select name="cat" class="form-control">

<option value="<?php echo $cat; ?>" > <?php echo $cat_title; ?> </option>

<?php

$get_cat = "select * from categories ";

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

<label> Producto imagen 1 </label>

<input type="file" name="product_img1" class="form-control" >

<br>

<img src="../admin_area/product_images/<?php echo $p_image1; ?>" width="70" height="70">

</div>

<div class="form-group" >

<label> Producto imagen 2 </label>

<input type="file" name="product_img2" class="form-control" >

<br>

<?php if(empty($p_image2)){ ?>

<img src="../admin_area/product_images/no-image.jpg" width="70" height="70">

<?php }else{ ?>

<img src="../admin_area/product_images/<?php echo $p_image2; ?>" width="70" height="70">

<?php } ?>

</div>

<div class="form-group" >

<label> Producto imagen 3 </label>

<input type="file" name="product_img3" class="form-control" >

<br>

<?php if(empty($p_image3)){ ?>

<img src="../admin_area/product_images/no-image.jpg" width="70" height="70">

<?php }else{ ?>

<img src="../admin_area/product_images/<?php echo $p_image3; ?>" width="70" height="70">

<?php } ?>

</div>

<div class="form-group" >

<label> Keywords de producto </label>

<input type="text" name="product_keywords" class="form-control" value="<?php echo $p_keywords; ?>" >

</div>

<div class="form-group" >

<label> Etiqueta del producto </label>

<input type="text" name="product_label" class="form-control" value="<?php echo $p_label; ?>">

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

<?php if($stock_status == "instock"){ ?>

<option value="instock" selected>En Stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder">Para encargo</option>

<?php }elseif($stock_status == "outofstock"){ ?>

<option value="instock">En stock</option>

<option value="outofstock" selected>Agotado</option>

<option value="onbackorder">Para encargo</option>

<?php }elseif($stock_status == "onbackorder"){ ?>

<option value="instock">En stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder" selected>Para Encargo</option>

<?php }else{ ?>

<option value="instock">En stock</option>

<option value="outofstock">Agotado</option>

<option value="onbackorder">Para encargo</option>

<?php } ?>

</select>

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> ¿Habilitar la gestión de existencias a nivel de producto? </label>

<div class="radio">

<label>

<input type="radio" name="enable_stock" value="yes" <?php if($enable_stock == "yes"){ echo "checked"; } ?> required> Si

</label>

<label>

<input type="radio" name="enable_stock" value="no" <?php if($enable_stock == "no"){ echo "checked"; } ?> required> No
  
</label>

</div>

</div>

</div>

</div>

<div class="row" id="stock-management-row">

<div class="col-sm-6">

<div class="form-group">

<label> Cantidad de Stock </label>

<input type="number" name="stock_quantity" value="<?php echo $stock_quantity; ?>" class="form-control" required>

</div>

</div>

<div class="col-sm-6">

<div class="form-group">

<label> ¿Permitir pedidos atrasados? </label>

<select class="form-control" name="allow_backorders" required>

<?php if($allow_backorders == "no"){ ?>

<option value="no" selected>No permitir</option>

<option value="notify">Permitir, pero notificar a la cliente</option>

<option value="yes">Permitir</option>

<?php }elseif($allow_backorders == "notify"){ ?>

<option value="no">No permitir</option>

<option value="notify" selected>Permitir, pero notificar a la cliente</option>

<option value="yes">Permitir</option>

<?php }elseif($allow_backorders == "yes"){ ?>

<option value="no">No permitir</option>

<option value="notify">Permitir, pero notificar a la cliente</option>

<option value="yes" selected>Permitir</option>

<?php }else{ ?>

<option value="no">No permitir</option>

<option value="notify">Permitir, pero notificar a la cliente</option>

<option value="yes">Permitir</option>

<?php } ?>

</select>

</div>

</div>

</div>

</div>

</div>

</div>


</form>


<div class="form-group" id="variable_product_options">

<label> Opciones de productos variables </label>

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

<label> Valor: </label>

<textarea name="attribute_values" class="form-control" placeholder="Ingrese algunos atributos por '|' separando valores." required></textarea>

</div>

</div>

</div>

<div class="form-group">

<input type="submit" value="Insertar atributo de producto" class="btn btn btn-primary">

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

$select_product_attributes = "select * from product_attributes where product_id='$p_id'";

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

<option value="add_variation"> Agregar nueva variación </option>

<option value="create_variations_from_attributes"> Crear nuevas variaciones a partir de todos los atributos </option>

<option value="delete_all_variations"> Eliminar todas las variaciones </option>

</select>
</div>

<div class="col-sm-1">
<button type="button" id="go_button" class="btn btn-success form-control"> Go </button>

</div>

</div>

<div class="product-variations-div">


</div>

<hr class="variation-hr">

<div class="form-group">

<input type="submit" value="Save Product Variations" class="btn btn btn-success">

</div>

</form>

<div class="ajax-response-div"></div>

</div>

</div>

</div>

</div>

</div>

<div class="form-group">

<input type="submit" name="update" value="Update Product" form="edit_product_form" class="btn btn-primary form-control">

</div>

<script>

$(document).ready(function(){
	
//Gestión de stock

<?php if($enable_stock == "no"){ ?>

$("#stock-management-row").hide();

<?php }elseif($enable_stock == "yes"){ ?>

$("#stock-status").hide();

<?php } ?>

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

//Gestión de stock
	
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

data: { random_id: <?php echo $p_id; ?> },

success:function(data){
	
$("table tbody").html(data);

$("table").removeClass("wait-loader");
	
}	

});
	
}

//Cargar atributos

//Agregar atributo producto

$("#insert_attribute_form").submit(function(event){
	
event.preventDefault();	

$("table").addClass("wait-loader");

$.ajax({
	
method: "POST",

url: "variable_product/insert_product_attribute.php",

data: $('#insert_attribute_form').serialize() + "&random_id=<?php echo $p_id; ?>",

success: function(){
	
$("#insert_attribute_form").find("input[type=text],textarea").val("");

load_product_attributes();
	
}

});

});

//Agregar atributo producto

//Editar atributo producto

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

//Editar atributo producto

//Actualizar atributo

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

var random_id = <?php echo $p_id; ?>;

$.ajax({
	
method: "POST",

url: "variable_product/update_product_attribute.php",

data: { random_id: random_id, attribute_id: attribute_id, attribute_name: attribute_name, attribute_values: attribute_values } 
      
});

});

//Actualizar atributo

//Borrar atributo
	
$(".delete-product-attribute").on('click', function(event){
	
event.preventDefault();

var attribute_id = $(this).data("attribute");

$("#tr-attribute-" + attribute_id).remove();	
	
var random_id = <?php echo $p_id; ?>;

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

data: { random_id: <?php echo $p_id; ?> },

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

data: { random_id: <?php echo $p_id; ?> },

success:function(data){
	
$(".product-variations-div").html(data);

$(".product-variations-div").removeClass("wait-loader");

}	

});
	
}

//Cargar variables

//Tabla variables

$("a[href='#product_variations']").click(function(){
	
$(".product-variations-div").addClass("wait-loader");
	
load_variations_default_form_values();

load_product_variations();

});

//Tabla variables

//Guardar variables

function save_update_product_variations(){

var form = document.getElementById("product-variations-form");

var form_data = new FormData(form);

form_data.append("random_id", <?php echo $p_id; ?>);

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

//Boton de acción

$("#go_button").click(function(){
	
var action_select = $("#action_select").val();

if(action_select == "add_variation"){
	
$(".product-variations-div").addClass("wait-loader");

save_update_product_variations();

$(".product-variations-div").addClass("wait-loader");
	
$.ajax({
	
method: "POST",

url: "variable_product/insert_product_variation.php",

data: { random_id: <?php echo $p_id; ?> },

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

data: { random_id: <?php echo $p_id; ?> },

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

data: { random_id: <?php echo $p_id; ?> },

success: function(){
	
load_product_variations();

load_variations_default_form_values();
	
}

});
	
}

}

});

//Boton de acción



$("#product-variations-form").submit(function(event){

event.preventDefault();

$(".product-variations-div").addClass("wait-loader");

save_update_product_variations();

load_variations_default_form_values();
	
});


 
});

</script>

</body>

</html>

<?php

if(isset($_POST['update'])){

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

if(empty($product_img1)){

$product_img1 = $new_p_image1;

}else{

if(!in_array($product_img1_extension,$allowed)){
 
echo "<script>alert('La extensión de archivo de la imagen 1 de su producto no es compatible.')</script>";

$product_img1 = "";

}else{

move_uploaded_file($temp_name1,"../admin_area/product_images/$product_img1");

}
	
}


if(empty($product_img2)){

$product_img2 = $new_p_image2;

}else{

if(!in_array($product_img2_extension,$allowed)){
 
echo "<script>alert('La extensión de archivo de la imagen 2 de su producto no es compatible.')</script>";

$product_img2 = "";

}else{

move_uploaded_file($temp_name2,"../admin_area/product_images/$product_img2");

}
	
}

if(empty($product_img3)){

$product_img3 = $new_p_image3;

}else{

if(!in_array($product_img3_extension,$allowed)){
 
echo "<script>alert('La extensión de archivo de la imagen 3 de su producto no es compatible.')</script>";

$product_img3 = "";

}else{

move_uploaded_file($temp_name3,"../admin_area/product_images/$product_img3");

}
	
}

$update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',manufacturer_id='$manufacturer_id',date=NOW(),product_title='$product_title',product_seo_desc='$product_seo_desc',product_url='$product_url',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',product_price='$product_price',product_psp_price='$psp_price',product_desc='$product_desc',product_features='$product_features',product_video='$product_video',product_keywords='$product_keywords',product_label='$product_label',product_type='$product_type',product_weight='$product_weight',product_vendor_status='$product_vendor_status' where product_id='$p_id' and vendor_id='$customer_id'";

$run_product = mysqli_query($con,$update_product);

if($run_product){
	
if($product_type != "variable_product"){
	
if($enable_stock == "yes" and $stock_quantity > 0){

$stock_status = "instock";
	
}elseif($enable_stock == "yes" and $allow_backorders == "no" and $stock_quantity < 1){

$stock_status = "outofstock";
	
}elseif($enable_stock == "yes" and ($allow_backorders == "yes" or $allow_backorders == "notify") and $stock_quantity < 1){

$stock_status = "onbackorder";
	
}
	
$select_product_stock = "select * from products_stock where product_id='$p_id'";

$run_product_stock = mysqli_query($con, $select_product_stock);

$count_product_stock = mysqli_num_rows($run_product_stock);

if($count_product_stock == 1){
	
$update_product_stock = "update products_stock set enable_stock='$enable_stock',stock_status='$stock_status',stock_quantity='$stock_quantity',allow_backorders='$allow_backorders' where product_id='$p_id'";
	
$run_update_product_stock = mysqli_query($con,$update_product_stock);

}else{

$insert_product_stock = "insert into products_stock (product_id,enable_stock,stock_status,stock_quantity,allow_backorders) values ('$p_id','$enable_stock','$stock_status','$stock_quantity','$allow_backorders')";
	
$run_insert_product_stock = mysqli_query($con,$insert_product_stock);	
	
}

}

echo "

<script>

alert(' Su producto se ha actualizado correctamente.');

window.open('index.php?products','_self');

</script>

";

}

}

?>
