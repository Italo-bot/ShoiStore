<?php

if(!isset($_SESSION['customer_email'])){

echo "<script> window.open('../checkout.php','_self'); </script>";

}

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$select_store_settings = "select * from store_settings where vendor_id='$customer_id'";

$run_store_settings = mysqli_query($con,$select_store_settings);

$row_store_settings = mysqli_fetch_array($run_store_settings);

$seo_title = $row_store_settings["seo_title"];

$meta_author = $row_store_settings["meta_author"];

$meta_description = $row_store_settings["meta_description"];

$meta_keywords = $row_store_settings["meta_keywords"];

?>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Tienda Configuración (SEO)

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre SEO : </label>

<div class="col-md-6">

<input type="text" name="seo_title" class="form-control" value="<?php echo $seo_title; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Autor : </label>

<div class="col-md-6">

<input type="text" name="meta_author" class="form-control" value="<?php echo $meta_author; ?>" required>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Descripción : </label>

<div class="col-md-6">

<input type="text" name="meta_description" class="form-control" value="<?php echo $meta_description; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Keywords : </label>

<div class="col-md-6">

<input type="text" name="meta_keywords" class="form-control" value="<?php echo $meta_keywords; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="submit" value="Guardar Configuraciones" class="btn btn-success form-control">

</div>

</div>

</form>

</div>

</div>

</div>

</div>
<?php

if(isset($_POST['submit'])){
	
$seo_title = mysqli_real_escape_string($con, $_POST['seo_title']);

$meta_author = mysqli_real_escape_string($con, $_POST['meta_author']);

$meta_description = mysqli_real_escape_string($con, $_POST['meta_description']);

$meta_keywords = mysqli_real_escape_string($con, $_POST['meta_keywords']);

$update_store_settings = "update store_settings set seo_title='$seo_title',meta_author='$meta_author',meta_description='$meta_description',meta_keywords='$meta_keywords' where vendor_id='$customer_id'";

$run_store_settings = mysqli_query($con,$update_store_settings);

if($run_store_settings){

echo "

<script>

alert('La configuración de SEO de tu tienda se ha guardado correctamente.');

window.open('index.php?seo_settings','_self');

</script>

";

}

}

?>






