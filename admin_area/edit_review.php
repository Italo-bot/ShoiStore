<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {
	
if(isset($_GET['edit_review'])){

$review_id = $_GET['edit_review'];

$select_review = "select * from reviews where review_id='$review_id'";

$run_review = mysqli_query($con,$select_review);

$row_review = mysqli_fetch_array($run_review);
	
$edit_product_id = $row_review['product_id'];

$edit_customer_id = $row_review['customer_id'];

$edit_review_title = $row_review['review_title'];

$edit_review_rating = $row_review['review_rating'];

$edit_review_content = $row_review['review_content'];

$select_variation_id_meta = "select * from reviews_meta where review_id='$review_id' and meta_key='variation_id'";

$run_variation_id_meta = mysqli_query($con,$select_variation_id_meta);

$row_variation_id_meta = mysqli_fetch_array($run_variation_id_meta);

$edit_variation_id = $row_variation_id_meta["meta_value"];

}

?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar Reseña

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i  class="fa fa-money fa-fw"></i> Editar Reseña

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Seleccionar Cliente: </label>

<div class="col-md-6">

<select name="customer_id" class="form-control" required>

<option value="" class="hidden"> Seleccionar Cliente </option>

<?php

$select_customers = "select * from customers";

$run_customers = mysqli_query($con,$select_customers);

while($row_customers = mysqli_fetch_array($run_customers)){

$customer_id = $row_customers['customer_id'];

$customer_name = $row_customers['customer_name'];

if($customer_id == $edit_customer_id){

echo "<option value='$customer_id' selected>$customer_name</option>";

}else{

echo "<option value='$customer_id'>$customer_name</option>";
	
}

}

?>

</select>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccione un producto / paquete: </label>

<div class="col-md-6">

<select name="product_id" class="form-control" required>

<optgroup label="Seleccionar producto">

<?php

$select_products = "select * from products where status='product'";

$run_products = mysqli_query($con,$select_products);

while($row_products = mysqli_fetch_array($run_products)){

$product_id = $row_products['product_id'];

$product_title = $row_products['product_title'];

if($product_id == $edit_product_id){

echo "<option value='$product_id' selected>$product_title</option>";	

}else{

echo "<option value='$product_id'>$product_title</option>";
	
}

}

?>

</optgroup>

<optgroup label="Select Bundle">

<?php

$select_bundles = "select * from products where status='bundle'";

$run_bundles = mysqli_query($con,$select_bundles);

while($row_bundles = mysqli_fetch_array($run_bundles)){

$product_id = $row_bundles['product_id'];

$product_title = $row_bundles['product_title'];

if($product_id == $edit_product_id){

echo "<option value='$product_id' selected>$product_title</option>";	

}else{

echo "<option value='$product_id'>$product_title</option>";
	
}

}

?>

</optgroup>

</select>

</div>

</div>

<div id="review-variations-div">

<?php 

if(!empty($edit_variation_id)){

$select_product = "select * from products where product_id='$edit_product_id'";

$run_product = mysqli_query($con,$select_product);

$row_product = mysqli_fetch_array($run_product);

$product_type = $row_product['product_type'];

if($product_type == "variable_product"){

?>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccionar variables </label>

<div class="col-md-6">

<select name="variation_id" class="form-control" required>

<option value=""> Selecciona una variable </option>

<?php

$select_product_variations = "select * from product_variations where product_id='$edit_product_id'";

$run_product_variations = mysqli_query($con,$select_product_variations);
	
while($row_product_variations = mysqli_fetch_array($run_product_variations)){
	
$variation_id = $row_product_variations["variation_id"];

if($variation_id == $edit_variation_id){

echo "<option value='$variation_id' selected>Variation #$variation_id</option>";	

}else{

echo "<option value='$variation_id'>Variation #$variation_id</option>";
	
}

}

?>

</select>

</div>

</div>

<?php 

}

}else{
	
?>

<input type="hidden" name="variation_id" value="">

<?php } ?>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Reseña:  </label>

<div class="col-md-6">

<input type="text" name="review_title" class="form-control" value="<?php echo $edit_review_title; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> puntos de reseña:  </label>

<div class="col-md-6">

<input type="hidden" id="rating" name="review_rating" class="rating-loading" value="<?php echo $edit_review_rating; ?>" data-size="sm" required>

<script>

$(document).ready(function(){
		
$("#rating").rating({

step: 1,

starCaptions: {1: 'lo odio', 2: 'malo', 3: 'bien', 4: 'Me gustó', 5: 'perfecto!'},

starCaptionClasses: {1: 'btn btn-danger', 2: 'btn btn-warning', 3: 'btn btn-info', 4: 'btn btn-primary', 5: 'btn btn-success'},

clearCaptionClass:"btn btn-default"

});
	
});

</script>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> contenido / comentario: </label>

<div class="col-md-6">

<textarea name="review_content" rows="5" class="form-control" required><?php echo $edit_review_content; ?></textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="update" value="Actualizar" class="btn btn-success form-control">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<script>

$(document).ready(function(){
	
$("select[name='product_id']").on("change", function(){
	
var product_id = $(this).val();

$.ajax({
	
method: "POST",

url: "load_review_variations.php",

data: { product_id: product_id},

success:function(data){
	
$("#review-variations-div").html(data);

}	 
      
});
	
});

});

</script>

<?php

if(isset($_POST['update'])){

$customer_id = mysqli_real_escape_string($con, $_POST["customer_id"]);

$product_id = mysqli_real_escape_string($con, $_POST["product_id"]);

$variation_id = mysqli_real_escape_string($con, $_POST["variation_id"]);

$review_title = mysqli_real_escape_string($con, $_POST["review_title"]);

$review_rating = mysqli_real_escape_string($con, $_POST["review_rating"]);

$review_content = mysqli_real_escape_string($con, $_POST["review_content"]);

$update_review = "update reviews set customer_id='$customer_id',product_id='$product_id',review_title='$review_title',review_rating='$review_rating',review_content='$review_content' where review_id='$review_id'";

$run_update_review = mysqli_query($con,$update_review);

if($run_update_review){
	
if(!empty($variation_id)){
	
if($variation_id != $edit_variation_id){
	
$delete_reviews_meta = "delete from reviews_meta where review_id='$review_id'";

$run_delete_reviews_meta = mysqli_query($con,$delete_reviews_meta);

if($run_delete_reviews_meta){
	
$insert_variation_id_meta = "insert into reviews_meta (review_id,meta_key,meta_value) values ('$review_id','variation_id','$variation_id')";

$run_variation_id_meta = mysqli_query($con,$insert_variation_id_meta);
	
$select_variations_meta = "select * from variations_meta where variation_id='$variation_id'";

$run_variations_meta = mysqli_query($con,$select_variations_meta);

while($row_variations_meta = mysqli_fetch_array($run_variations_meta)){

$meta_key = $row_variations_meta["meta_key"];

$meta_value = $row_variations_meta["meta_value"];

$insert_reviews_meta = "insert into reviews_meta (review_id,meta_key,meta_value) values ('$review_id','$meta_key','$meta_value')";

$run_reviews_meta = mysqli_query($con, $insert_reviews_meta);

}

}

}

}

echo "

<script>

alert('Su reseña se ha actualizado concienzudamente.');

window.open('index.php?view_reviews','_self');

</script>

";

}

}

?>


<?php } ?>