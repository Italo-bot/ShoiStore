<?php

session_start();

include("includes/db.php");

include("functions/functions.php");

$vendor_username = $_GET["vendor_username"];

$select_customer = "select * from customers where customer_username='$vendor_username'";

$run_customer = mysqli_query($con,$select_customer);

$count_customer = mysqli_num_rows($run_customer);

if($count_customer != 0){

$row_customer = mysqli_fetch_array($run_customer);

$vendor_id = $row_customer['customer_id'];

$vendor_name = $row_customer['customer_name'];

$vendor_email = $row_customer['customer_email'];

$vendor_role = $row_customer['customer_role'];

if($vendor_role == "customer"){
	
echo "<script> window.open('../shop.php','_self'); </script>";

}

}else{

$select_admin = "select * from admins where admin_username='$vendor_username'";

$run_admin = mysqli_query($con,$select_admin);

$row_admin = mysqli_fetch_array($run_admin);

$vendor_id = "admin_" . $row_admin['admin_id'];
	
$vendor_name = $row_admin['admin_name'];
	
$vendor_email = $row_admin['admin_email'];	

}

$select_store_settings = "select * from store_settings where vendor_id='$vendor_id'";

$run_store_settings = mysqli_query($con,$select_store_settings);

$row_store_settings = mysqli_fetch_array($run_store_settings);

$store_cover_image = $row_store_settings["store_cover_image"];

$store_profile_image = $row_store_settings["store_profile_image"];

$store_name = $row_store_settings["store_name"];

$store_country = $row_store_settings["store_country"];

$store_address_1 = $row_store_settings["store_address_1"];

$store_address_2 = $row_store_settings["store_address_2"];

$store_state = $row_store_settings["store_state"];

$store_city = $row_store_settings["store_city"];

$store_postcode = $row_store_settings["store_postcode"];

$phone_no = $row_store_settings["phone_no"];

$store_email = $row_store_settings["store_email"];

$seo_title = $row_store_settings["seo_title"];

$meta_author = $row_store_settings["meta_author"];

$meta_description = $row_store_settings["meta_description"];

$meta_keywords = $row_store_settings["meta_keywords"];

if(empty($store_name)){

$store_name = $vendor_name;	

}

if(empty($seo_title)){

$seo_title = $vendor_name;	

}

if(empty($store_profile_image)){

$store_profile_image = "empty-image.png";
	
}

if(empty($store_cover_image)){

$store_cover_image = "empty-cover-image.jpg";

}

$products_ids = array();

$select_products = "select * from products where vendor_id='$vendor_id'";

$run_products = mysqli_query($db,$select_products);

while($row_products = mysqli_fetch_array($run_products)){
	
$product_id = $row_products["product_id"];

array_push($products_ids, $product_id);
	
}

$products_ids = implode(",", $products_ids);

$count_vendor_products_reviews = 0;

$vendor_rating = 0;

$star_vendor_rating = 0;

$vendor_reviews_rating = array();

if(!empty($products_ids)){

$select_vendor_products_reviews = "select * from reviews where product_id in ($products_ids) and NOT ( review_status='trash' or review_status='pending')";

$run_vendor_products_reviews = mysqli_query($con,$select_vendor_products_reviews);

$count_vendor_products_reviews = mysqli_num_rows($run_vendor_products_reviews);

if($count_vendor_products_reviews != 0){

while($row_vendor_products_reviews = mysqli_fetch_array($run_vendor_products_reviews)){
	
$product_review_rating = $row_vendor_products_reviews['review_rating'];

array_push($vendor_reviews_rating,$product_review_rating);
	
}

$total = array_sum($vendor_reviews_rating);

$vendor_rating = $total/count($vendor_reviews_rating);

$star_vendor_rating = substr($vendor_rating, 0, 1);

}

}

$include_page = "vendor_store"

?>
<!DOCTYPE html>

<html>

<head>

<title> <?php echo $seo_title; ?> </title>

<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<meta name="author" content="<?php echo $meta_author; ?>">

<meta name="description" content="<?php echo $meta_description; ?>">

<meta name="keywords" content="<?php echo $meta_keywords; ?>">

<link href="http://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100" rel="stylesheet" >

<link href="../styles/bootstrap.min.css" rel="stylesheet">

<link href="../styles/style.css" rel="stylesheet">

<link href="../font-awesome/css/font-awesome.min.css" rel="stylesheet">

</head>

<body>

<div id="top">

<div class="container">

<div class="col-md-6 offer">

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
Precio Total: <?php total_price(); ?>, Cantidad de Items <?php items(); ?>
</a>

</div>

<div class="col-md-6">
<ul class="menu">

<?php if(!isset($_SESSION['customer_email'])){ ?>

<li>

<a href="../customer_register.php"> Registrarse </a>

</li>

<?php 

}else{

$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_role = $row_customer['customer_role'];

if($customer_role == "customer"){ 

?>

<li>

<a href="../shop.php"> Tienda </a>

</li>

<?php }elseif($customer_role == "vendor"){ ?>

<li>

<a href="../vendor_dashboard/index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='../customer/my_account.php?my_orders'>Mi Cuenta</a>";

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

echo "<a href='../checkout.php'> Acceso </a>";

}else {

echo "<a href='../logout.php'> Cerrar Sesión </a>";

}

?>
</li>

</ul>

</div>

</div>
</div>

<div class="navbar navbar-default" id="navbar">
<div class="container" >

<div class="navbar-header">

<a class="navbar-brand home" href="../index.php" >

<img src="../images/ShoiStoree.png" alt="ShoiStore logo" class="hidden-xs" >
<img src="../images/ShoiStoree.png" alt="ShoiStore logo" class="visible-xs" >

</a>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation"  >

<span class="sr-only" >Navegación </span>

<i class="fa fa-align-justify"></i>

</button>

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search" >

<span class="sr-only" >Buscar</span>

<i class="fa fa-search" ></i>

</button>

</div>

<div class="navbar-collapse collapse" id="navigation" >

<div class="padding-nav" >

<ul class="nav navbar-nav navbar-left">

<li>
<a href="../index.php"> Home </a>
</li>

<li class="active" >
<a href="../shop.php"> Tienda </a>
</li>

<li>
<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='../checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='../customer/my_account.php?my_orders'>Mi Cuenta</a>";

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

</ul>

</div>

<a class="btn btn-primary navbar-btn right" href="cart.php">

<i class="fa fa-shopping-cart"></i>

<span> <?php items(); ?> Artículos </span>

</a>

<div class="navbar-collapse collapse right">

<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">

<span class="sr-only">Buscar</span>

<i class="fa fa-search"></i>

</button>

</div>

<div class="collapse clearfix" id="search">

<form class="navbar-form" method="get" action="results.php">

<div class="input-group">

<input class="form-control" type="text" placeholder="Search" name="user_query" required>

<span class="input-group-btn">

<button type="submit" value="Search" name="search" class="btn btn-primary">

<i class="fa fa-search"></i>

</button>

</span>

</div>

</form>

</div>

</div>

</div>

</div>

<div id="content" >

<div class="container" >

<div class="col-md-12" >

<ul class="breadcrumb" >

<li>
<a href="index.php">Home</a>
</li>

<li> Tienda de Vendedores </li>

<li> <?php echo $vendor_username; ?> </li>

</ul>

</div>

<div class="col-md-3">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-9">

<div class="vendor-profile-box" style="background-image:url(../images/<?php echo $store_cover_image; ?>); background-size:cover;">

<div class="row">

<div class="vendor-profile-frame col-md-6">

<img src="../images/<?php echo $store_profile_image; ?>">

<h2> <?php echo $store_name; ?> </h2>

<?php if(!empty($store_address_1) and !empty($store_address_2)){ ?>

<p>

<i class="fa fa-map-marker"></i>

<?php echo $store_address_1; ?>,

<?php echo $store_address_2; ?>,<br>

<?php echo $store_city; ?>,

<?php echo $store_state; ?>,

<?php echo $store_postcode; ?>

<?php 

$select_country = "select * from countries where country_id='$store_country'";

$run_country = mysqli_query($con,$select_country);

$row_country = mysqli_fetch_array($run_country);

echo $country_name = $row_country["country_name"];

?>

</p>

<?php } ?>

<?php if(!empty($phone_no)){ ?>

<p>

<i class="fa fa-mobile"></i>

<a href="tel:<?php echo $phone_no; ?>"> <?php echo $phone_no; ?> </a>

</p>

<?php } ?>

<?php if($store_email == "yes"){ ?>

<p>

<i class="fa fa-envelope-o"></i> 
 
<a href="mailto:<?php echo $vendor_email; ?>"> <?php echo $vendor_email; ?> </a>

</p>

<?php } ?>

<p>

<i class="fa fa-star"></i> 

<?php printf("%.1f", $vendor_rating); ?> Calificación de <?php echo $count_vendor_products_reviews; ?> Reseñas 

</p>

</div>

</div>

</div>

<div class="row flex-wrap" id="Products">

<?php getProducts($vendor_id); ?>

</div>

<center>

<ul class="pagination" >

<?php getPaginator($vendor_id); ?>

</ul>

</center>

</div>

<div id="wait" style="position:absolute;top:40%;left:45%;padding:100px;padding-top:200px;">

</div>

</div>

</div>

<?php include("includes/footer.php"); ?>

<script src="../js/jquery.min.js"></script>

<script src="../js/bootstrap.min.js"></script>

<script>

$(document).ready(function(){

$('.nav-toggle').click(function(){

$(".panel-collapse,.collapse-data").slideToggle(700,function(){

if($(this).css('display')=='none'){

$(".hide-show").html('Show');

}
else{

$(".hide-show").html('Hide');

}

});

});

$(function(){

$.fn.extend({

filterTable: function(){

return this.each(function(){

$(this).on('keyup', function(){

var $this = $(this), 

search = $this.val().toLowerCase(), 

target = $this.attr('data-filters'), 

handle = $(target), 

rows = handle.find('li a');

if(search == '') {

rows.show(); 

} else {

rows.each(function(){

var $this = $(this);

$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();

});

}

});

});

}

});

$('[data-action="filter"][id="dev-table-filter"]').filterTable();

});

});
 
</script>

<script>

$(document).ready(function(){
 
  

  function getProducts(){
  
  

    var sPath = ''; 

var aInputs = $('li').find('.get_manufacturer');

var aKeys = Array();

var aValues = Array();

iKey = 0;

$.each(aInputs,function(key,oInput){

if(oInput.checked){

aKeys[iKey] =  oInput.value

};

iKey++;

});

if(aKeys.length>0){

var sPath = '';

for(var i = 0; i < aKeys.length; i++){

sPath = sPath + 'man[]=' + aKeys[i]+'&'; 

}

}

var aInputs = Array();

var aInputs = $('li').find('.get_p_cat');

var aKeys = Array();

var aValues = Array();

iKey = 0;

$.each(aInputs,function(key,oInput){

if(oInput.checked){

aKeys[iKey] =  oInput.value

};

iKey++;

});

if(aKeys.length>0){

for(var i = 0; i < aKeys.length; i++){

sPath = sPath + 'p_cat[]=' + aKeys[i]+'&';

}

}

var aInputs = Array();

var aInputs = $('li').find('.get_cat');

var aKeys  = Array();

var aValues = Array();

iKey = 0;

    $.each(aInputs,function(key,oInput){

    if(oInput.checked){

    aKeys[iKey] =  oInput.value

};

    iKey++;

});

if(aKeys.length>0){

    for(var i = 0; i < aKeys.length; i++){

    sPath = sPath + 'cat[]=' + aKeys[i]+'&';

}

}


$('#wait').html('<img src="../images/load.gif">'); 

$.ajax({

url:"../load.php", 
 
method:"POST",
 
data: sPath+'sAction=getProducts&vendor_id=<?php echo $vendor_id; ?>', 
 
success:function(data){
 
 $('#Products').html('');  
 
 $('#Products').html(data);
 
 $("#wait").empty(); 
 
}  

});  

    $.ajax({
url:"../load.php",  
method:"POST",  
data: sPath+'sAction=getPaginator&vendor_id=<?php echo $vendor_id; ?>',  
success:function(data){
$('.pagination').html('');  
$('.pagination').html(data);
}  

    });

   
   }

  

$('.get_manufacturer').click(function(){ 

getProducts(); 

});


  $('.get_p_cat').click(function(){ 

getProducts();

}); 

$('.get_cat').click(function(){ 

getProducts(); 

});
 
 
 }); 

</script>

</body>

</html>