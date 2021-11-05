<?php

session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}else {

include("includes/db.php");

include("functions/functions.php");


if(!isset($_POST["product_id"])){

echo "<script> window.open('my_account.php?my_orders','_self'); </script>";
	
}

?>
<!DOCTYPE html>

<html>

<head>

<title>ShoiStore</title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet" >

<link href="styles/bootstrap.min.css" rel="stylesheet">

<link href="styles/style.css" rel="stylesheet">

<link href="../styles/star-rating.min.css" rel="stylesheet">

<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.js"></script>

<script src="../js/star-rating.min.js"></script>

</head>

<body>

<div id="top"><!-- top Starts -->

<div class="container"><!-- container Starts -->

<div class="col-md-6 offer"><!-- col-md-6 offer Starts -->

<a href="#" class="btn btn-success btn-sm" >
<?php

if(!isset($_SESSION['customer_email'])){

echo "Bienvenid@ Invitad@";


}else{

echo "Bienvenid@ : " . $_SESSION['customer_email'] . "";

}


?>
</a>

<a href="#">
Precio Total: <?php total_price(); ?>, Cantidad de Items:<?php items(); ?>
</a>

</div><!-- col-md-6 offer Ends -->

<div class="col-md-6"><!-- col-md-6 Starts -->
<ul class="menu"><!-- menu Starts -->

<li>
<a href="../customer_register.php">
Registrarse
</a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='my_account.php?my_orders'>Mi Cuenta</a>";

}


?>
</li>

<li>
<a href="../cart.php">
Ir al Carrito
</a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php'> Acceder </a>";

}else {

echo "<a href='logout.php'> Cerrar Sesión </a>";

}

?>
</li>

</ul><!-- menu Ends -->

</div><!-- col-md-6 Ends -->

</div><!-- container Ends -->
</div><!-- top Ends -->

<div class="navbar navbar-default" id="navbar"><!-- navbar navbar-default Starts -->
<div class="container" ><!-- container Starts -->

<div class="navbar-header"><!-- navbar-header Starts -->

<a class="navbar-brand home" href="../index.php" ><!--- navbar navbar-brand home Starts -->

<img src="images/ShoiStoree.png" alt="ShoiStore logo" class="hidden-xs" >
<img src="images/ShoiStoree.png" alt="ShoiStore logo" class="visible-xs" >

</a><!--- navbar navbar-brand home Ends -->

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation"  >

<span class="sr-only" >Navegación </span>

<i class="fa fa-align-justify"></i>

</button>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search" >

<span class="sr-only" >Buscar</span>

<i class="fa fa-search" ></i>

</button>


</div><!-- navbar-header Ends -->

<div class="navbar-collapse collapse" id="navigation" ><!-- navbar-collapse collapse Starts -->

<div class="padding-nav" ><!-- padding-nav Starts -->

<ul class="nav navbar-nav navbar-left"><!-- nav navbar-nav navbar-left Starts -->

<li>
<a href="../index.php"> Home </a>
</li>

<li>
<a href="../shop.php"> Tienda </a>
</li>

<li class="active">
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='my_account.php?my_orders'>Mi Cuenta</a>";

}


?>
</li>

<li>
<a href="../cart.php"> Carrito </a>
</li>

<li>
<a href="../about.php"> ¿Quiénes Somos? </a>
</li>

<li>

<a href="../services.php"> Servicios </a>

</li>

<li>
<a href="../contact.php"> Contáctanos </a>
</li>

</ul><!-- nav navbar-nav navbar-left Ends -->

</div><!-- padding-nav Ends -->

<a class="btn btn-primary navbar-btn right" href="../cart.php"><!-- btn btn-primary navbar-btn right Starts -->

<i class="fa fa-shopping-cart"></i>

<span> <?php items(); ?> Artículos </span>

</a><!-- btn btn-primary navbar-btn right Ends -->

<div class="navbar-collapse collapse right"><!-- navbar-collapse collapse right Starts -->

<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">

<span class="sr-only">Buscar</span>

<i class="fa fa-search"></i>

</button>

</div><!-- navbar-collapse collapse right Ends -->

<div class="collapse clearfix" id="search"><!-- collapse clearfix Starts -->

<form class="navbar-form" method="get" action="results.php"><!-- navbar-form Starts -->

<div class="input-group"><!-- input-group Starts -->

<input class="form-control" type="text" placeholder="Buscar" name="user_query" required>

<span class="input-group-btn"><!-- input-group-btn Starts -->

<button type="submit" value="Search" name="search" class="btn btn-primary">

<i class="fa fa-search"></i>

</button>

</span><!-- input-group-btn Ends -->

</div><!-- input-group Ends -->

</form><!-- navbar-form Ends -->

</div><!-- collapse clearfix Ends -->

</div><!-- navbar-collapse collapse Ends -->

</div><!-- container Ends -->

</div><!-- navbar navbar-default Ends -->

<div id="content"><!-- content Starts -->

<div class="container-fluid"><!-- container-fluid Starts -->

<div class="col-md-12" ><!--- col-md-12 Starts -->

<ul class="breadcrumb" ><!-- breadcrumb Starts -->

<li><a href="index.php">Home</a></li>

<li>Mi Cuenta</li>

</ul><!-- breadcrumb Ends -->

</div><!--- col-md-12 Ends -->

<div class="col-md-12"><!-- col-md-12 Starts -->

<?php

$c_email = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$c_email'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_confirm_code = $row_customer['customer_confirm_code'];

$c_name = $row_customer['customer_name'];

if(!empty($customer_confirm_code)){

?>

<div class="alert alert-danger"><!-- alert alert-danger Starts -->

<strong> Advertencia! </strong> Confirme su Email y si no ha recibido su Email de confirmación

<a href="my_account.php?send_email" class="alert-link"> 

Enviar Email de nuevo

</a>

</div><!-- alert alert-danger Ends -->

<?php } ?>

</div><!-- col-md-12 Ends -->

<div class="col-md-3"><!-- col-md-3 Starts -->

<?php include("includes/sidebar.php"); ?>

</div><!-- col-md-3 Ends -->

<div class="col-md-9"><!--- col-md-9 Starts -->

<div class="box"><!-- box Starts -->

<?php

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_id = $row_customer['customer_id'];

$product_id = mysqli_real_escape_string($con, $_POST["product_id"]);

$referral = mysqli_real_escape_string($con, $_POST["referral"]);

if( !isset($_POST["order_id"]) ){
	
$select_product = "select * from products where product_id='$product_id'";

$run_product = mysqli_query($con,$select_product);

$row_product = mysqli_fetch_array($run_product);

$vendor_id = $row_product["vendor_id"];

$select_orders = "select * from orders where customer_id='$customer_id'";

$run_orders = mysqli_query($con,$select_orders);

while($row_orders = mysqli_fetch_array($run_orders)){

$order_id = $row_orders['order_id'];

$select_vendor_order = "select * from vendor_orders where order_id='$order_id' and vendor_id='$vendor_id' and (order_status='processing' or order_status='completed')";

$run_vendor_order = mysqli_query($con,$select_vendor_order);

$count_vendor_order = mysqli_num_rows($run_vendor_order);

if($count_vendor_order != 0){

$select_order_item = "select * from orders_items where order_id='$order_id' and product_id='$product_id'";

$run_order_item = mysqli_query($con,$select_order_item);

$count_order_item = mysqli_num_rows($run_order_item);

if($count_order_item != 0){

$row_order_item = mysqli_fetch_array($run_order_item);

$item_id = $row_order_item["item_id"];

$product_purchased = "yes";

break;
	
}else{

$product_purchased = "no";
	
}

}else{

$product_purchased = "no";
	
}

}

}else{
	
$order_id = mysqli_real_escape_string($con, $_POST["order_id"]);

if(!isset($_POST['sub_order_id'])){

echo $select_order = "select * from orders where customer_id='$customer_id' and order_id='$order_id' and (order_status='processing' or order_status='completed')";

}else{

$sub_order_id = mysqli_real_escape_string($con, $_POST["sub_order_id"]);

echo $select_order = "select * from vendor_orders where id='$sub_order_id' and order_id='$order_id' and (order_status='processing' or order_status='completed')";

}

$run_order = mysqli_query($con,$select_order);

$count_order = mysqli_num_rows($run_order);

if($count_order != 0){
	
$select_order_item = "select * from orders_items where order_id='$order_id' and product_id='$product_id'";

$run_order_item = mysqli_query($con,$select_order_item);

$count_order_item = mysqli_num_rows($run_order_item);

if($count_order_item != 0){
	
$row_order_item = mysqli_fetch_array($run_order_item);

$item_id = $row_order_item["item_id"];

$product_purchased = "yes";

}else{

$product_purchased = "no";

}

}else{

$product_purchased = "no";	

}
	
}

if($product_purchased == "no"){

?>

<h3> Para enviar una reseña </h3>

<p>

<strong>Para enviar una reseña,</strong> debe comprar el producto.<br>

<strong>Si tienes otra cuenta</strong> y ya lo usó para comprar el producto, puede iniciar sesión en esa cuenta para escribir una reseña.

</p>

<?php 

}elseif($product_purchased == "yes"){

if($referral == "product"){
	
$select_product = "select * from products where product_id='$product_id'";

$run_product = mysqli_query($con,$select_product);

$row_product = mysqli_fetch_array($run_product);

$product_url = $row_product['product_url'];
	
$return_url = "../$product_url";

}elseif($referral == "view_order"){

$return_url = "view_order.php?order_id=$order_id";
	
}

$select_product_reviews = "select * from reviews where customer_id='$customer_id' and product_id='$product_id'";

$run_product_reviews = mysqli_query($con,$select_product_reviews);

$count_product_reviews = mysqli_num_rows($run_product_reviews);

if($count_product_reviews != 0){

?>

<p class="lead text-center">

<strong>Sorry,</strong> Ya está escribiendo una reseña de este producto. <br><br>

<a href="<?php echo $return_url; ?>" class="btn btn-primary btn-lg"> Volver </a>

</p>

<?php }else{ ?>

<h3 style="margin-top:0px;"> Su revisión de este producto </h3>

<div class="row"><!-- row Starts -->

<?php

$select_product = "select * from products where product_id='$product_id'";

$run_product = mysqli_query($con,$select_product);

$row_product = mysqli_fetch_array($run_product);

$product_title = $row_product['product_title'];

$product_img1 = $row_product['product_img1'];

$product_price = $row_product["product_price"];

$product_psp_price = $row_product["product_psp_price"];

//$product_type = $row_product["product_type"];//

$vendor_id = $row_product['vendor_id'];

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

$product_reviews = array();

$select_product_reviews = "select * from reviews where product_id='$product_id'";

$run_product_reviews = mysqli_query($con,$select_product_reviews);

$count_product_reviews = mysqli_num_rows($run_product_reviews);

if($count_product_reviews != 0){

while($row_product_reviews = mysqli_fetch_array($run_product_reviews)){
	
$product_review_rating = $row_product_reviews['review_rating'];

array_push($product_reviews,$product_review_rating);
	
}

$total = array_sum($product_reviews);

$product_rating = $total/count($product_reviews);

}else{

$product_rating = 0;

}

?>

<div class="col-md-3"><!--- col-md-3 Starts -->

<img src="../admin_area/product_images/<?php echo $product_img1; ?>" class="img-responsive">

</div><!-- col-md-3 Ends -->

<div class="col-md-9"><!--- col-md-9 Starts -->

<h4> <?php echo $product_title; ?> </h4>

<p class="cart-product-meta"> 

<?php

$items_meta_result = "";

$select_orders_items_meta = "select * from orders_items_meta where order_id='$order_id' and item_id='$item_id' and product_id='$product_id' and meta_key!='variation_id'";

$run_orders_items_meta = mysqli_query($con,$select_orders_items_meta);

while($row_orders_items_meta = mysqli_fetch_array($run_orders_items_meta)){

$meta_key = str_replace('_', ' ', ucwords($row_orders_items_meta["meta_key"]));;

$meta_value = $row_orders_items_meta["meta_value"];

$items_meta_result .= "$meta_key: <span class='text-muted'>$meta_value </span>, ";

}

echo rtrim($items_meta_result, ", ");

?>

</p>

<div class="detail-product-info"><!--- detail-product-info Starts -->

<span class="text-muted"> Por </span>

<a href="#" class="text-muted"> <?php echo $vendor_name; ?> </a>

<?php for($product_i=0; $product_i<$product_rating; $product_i++){ ?>

<img class="rating" src="../images/star_full_small.png">

<?php } ?>

<?php for($product_i=$product_rating; $product_i<5; $product_i++){ ?>

<img class="rating" src="../images/star_blank_small.png">

<?php } ?>

<span class="text-muted">(<?php echo $count_product_reviews; ?> Reseñas) &nbsp;&nbsp; </span>

<hr>

</div><!--- detail-product-info Ends -->

<h4>Escribe tu reseña</h4>

<form method="post" action="write_review.php"><!--- form Starts -->

<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

<input type="hidden" name="referral" value="<?php echo $referral; ?>">

<input type="hidden" name="order_id" value="<?php echo $order_id; ?>">

<div class="form-group"><!-- form-group Starts -->

<label class="control-label"> Puntúalo: * </label>

<input type="hidden" name="review_rating" value="<?php echo @$_POST["review_rating"]; ?>" class="rating-loading" data-size="sm">

<script>

$(document).ready(function(){
		
$('.rating-loading').rating({

step: 1,

starCaptions: {1: 'lo odio', 2: 'No me gustó', 3: 'Está bien', 4: 'Me gustó', 5: 'Es perfecto!'},

starCaptionClasses: {1: 'btn btn-danger', 2: 'btn btn-warning', 3: 'btn btn-info', 4: 'btn btn-primary', 5: 'btn btn-success'},

clearCaptionClass:"btn btn-default"

});
	
});

</script>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="control-label"> Título de su reseña: * </label>

<input type="text" name="review_title" class="form-control" required>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="control-label"> Escribe tu reseña: * </label>

<textarea name="review_content" rows="3" class="form-control" required></textarea>

</div><!-- form-group Ends -->

<a href="<?php echo $return_url; ?>" class="btn btn-success pull-left" style="border-radius:0px;">Cancelar</a>

<input type="submit" name="submit_review" value="Subir" class="btn btn-success pull-right" style="border-radius:0px;">

</form><!--- form Ends -->

<?php

if(isset($_POST["submit_review"])){
	
$product_id = mysqli_real_escape_string($con, $_POST["product_id"]);

$review_rating = mysqli_real_escape_string($con, $_POST["review_rating"]);

$review_title = mysqli_real_escape_string($con, $_POST["review_title"]);

$review_content = mysqli_real_escape_string($con, $_POST["review_content"]);

$review_date = date("F d, Y");

$insert_review = "insert into reviews (product_id,customer_id,review_title,review_rating,review_content,review_date,review_status) values ('$product_id','$customer_id','$review_title','$review_rating','$review_content','$review_date','pending')";

$run_review = mysqli_query($con,$insert_review);

$insert_review_id = mysqli_insert_id($con);

if($run_review){
	
$select_orders_items_meta = "select * from orders_items_meta where order_id='$order_id' and item_id='$item_id' and product_id='$product_id'";

$run_orders_items_meta = mysqli_query($con,$select_orders_items_meta);

while($row_orders_items_meta = mysqli_fetch_array($run_orders_items_meta)){

$meta_key = ucwords($row_orders_items_meta["meta_key"]);

$meta_value = $row_orders_items_meta["meta_value"];

$insert_reviews_meta = "insert into reviews_meta (review_id,meta_key,meta_value) values ('$insert_review_id','$meta_key','$meta_value')";

$run_reviews_meta = mysqli_query($con, $insert_reviews_meta);

}

echo "

<script>

alert('Su reseña se ha enviado correctamente, su reseña se publicará en un plazo de 24 horas.');

window.open('$return_url','_self');

</script>

";

}

}

?>

</div><!-- col-md-9 Ends -->

</div><!-- row Ends -->

<?php 

} 

} 

?>

</div><!-- box Ends -->

</div><!-- col-md-9 Ends -->

</div><!-- container-fluid Ends -->

</div><!-- content Ends -->

<?php include("includes/footer.php"); ?>

<script src="js/bootstrap.min.js"></script>

</body>

</html>

<?php } ?>