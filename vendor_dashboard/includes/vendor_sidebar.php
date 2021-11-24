
<div class="panel panel-default sidebar-menu"><!-- panel panel-default sidebar-menu Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<?php

$customer_session = $_SESSION['customer_email'];

$get_customer = "select * from customers where customer_email='$customer_session'";

$run_customer = mysqli_query($con,$get_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_image = $row_customer['customer_image'];

$customer_name = $row_customer['customer_name'];

$customer_username = $row_customer['customer_username'];

if(isset($_SESSION['customer_email'])){

echo "

<center>

<img src='../customer/customer_images/$customer_image' class='img-responsive img-circle'>

</center>

<br>

<h3 align='center' class='panel-title'> Nombre : $customer_name </h3>

";

}

?>

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<ul class="nav nav-pills nav-stacked" id="dashboard-sidebar"><!-- nav nav-pills nav-stacked Starts -->

<li class="<?php if(empty($_GET)){ echo "active"; } ?>">

<a href="index.php"> <i class="fa fa-tachometer"> </i> Dashboard </a>

</li>

<li class="<?php if(preg_match("/product/", $_SERVER["QUERY_STRING"])){ echo "active"; } ?>">

<a href="index.php?products"> <i class="fa fa-briefcase"> </i> Productos </a>

</li>

<li class="<?php if(preg_match("/bundle/", $_SERVER["QUERY_STRING"])){ echo "active"; } ?>">

<a href="index.php?bundles"> <i class="fa fa-tasks"> </i> Paquetes </a>

</li>

<li class="<?php if(preg_match("/order/", $_SERVER["QUERY_STRING"])){ echo "active"; }  ?>">

<a href="index.php?orders"> <i class="fa fa-list"> </i> Ordenes </a>

</li>

<li class="<?php if(preg_match("/coupon/", $_SERVER["QUERY_STRING"])){ echo "active"; }  ?>">

<a href="index.php?coupons"> <i class="fa fa-gift"> </i> Cupones </a>

</li>

<li class="<?php if(isset($_GET['reviews'])){ echo "active"; } ?>">

<a href="index.php?reviews"> <i class="fa fa-comments-o"></i> Reseñas </a>

</li>

<li class="<?php if(isset($_GET['payments'])){ echo "active"; } ?>">

<a href="index.php?payments"> <i class="fa fa-credit-card"></i> Pagos </a>

</li>

<!-- <li class="<?php if(preg_match("/withdraw/", $_SERVER["QUERY_STRING"])){ echo "active"; } ?>"> -->

<!-- <a href="index.php?withdraw"> <i class="fa fa-upload"></i> (Useless-Delete) Withdraw </a> -->

<!-- </li> -->

<li>

<a href="#" id="settings-link"> 

<i class="fa fa-cog"></i> Configuraciones <i class="fa fa-angle-right pull-right"></i> 

</a>

</li>

</ul><!-- nav nav-pills nav-stacked Ends -->

<ul class="nav nav-pills nav-stacked" id="settings-sidebar"><!-- nav nav-pills nav-stacked Starts -->

<li>

<a href="#" id="dashboard-link"> 

<i class="fa fa-arrow-left"></i> Volver al Dashboard 

</a>

</li>

<li class="<?php if(isset($_GET['store_settings'])){ echo "active"; } ?>">

<a href="index.php?store_settings"> <i class="fa fa-university"></i> Configuraciones de Tienda </a>

</li>

<!-- <li class="<?php if(isset($_GET['payment_settings'])){ echo "active"; } ?>"> -->

<!-- <a href="index.php?payment_settings"> <i class="fa fa-credit-card"></i> (Useless-Delete) Payment Settings </a> -->

<!-- </li> -->

<li class="<?php if(preg_match("/shipping/", $_SERVER["QUERY_STRING"])){ echo "active"; } ?>"><!-- shipping_settings li Starts -->

<a href="#" class="shipping_settings" data-toggle="collapse" data-target="#shipping_settings"> 

<i class="fa fa-truck"></i> Configuración de envío  <span class="caret"></span>

</a>

<ul id="shipping_settings" class="nav nav-pills nav-stacked sidebar-dropdown <?php if(!preg_match("/shipping/", $_SERVER["QUERY_STRING"])){ echo "collapse"; } ?>">

<li>

<a href="index.php?shipping_zones"> Zonas de Envío </a>

</li>

<li>

<a href="index.php?shipping_types"> Tipos de envío </a>

</li>

</ul>

</li><!-- shipping_settings li Ends -->

<li class="<?php if(isset($_GET['seo_settings'])){ echo "active"; } ?>">

<a href="index.php?seo_settings"> <i class="fa fa-globe"></i> Configuración de tienda (SEO) </a>

</li>

</ul><!-- nav nav-pills nav-stacked Ends -->

<ul class="nav nav-pills nav-stacked"><!-- nav nav-pills nav-stacked Starts -->

<li>

<a href="../store/<?php echo $customer_username; ?>" class="pull-left"> <i class="fa fa-external-link"></i> Vista Tienda </a>

<a href="../logout.php" class="pull-right"> <i class="fa fa-sign-out"></i> Cerrar Sesión </a>

</li>

</ul><!-- nav nav-pills nav-stacked Ends -->

</div><!-- panel-body Ends -->

</div><!-- panel panel-default sidebar-menu Ends -->

<script>

$(document).ready(function(){

<?php if(preg_match("/settings/", $_SERVER["QUERY_STRING"]) or preg_match("/shipping/", $_SERVER["QUERY_STRING"])){ ?>

$("#dashboard-sidebar").hide(0);

<?php }else{ ?>

$("#settings-sidebar").hide(0);

<?php } ?>

$("#settings-link").click(function(){

event.preventDefault();
	
$("#dashboard-sidebar").hide(0);

$("#settings-sidebar").show(0);
	
});

$("#dashboard-link").click(function(){

event.preventDefault();
	
$("#settings-sidebar").hide(0);

$("#dashboard-sidebar").show(0);
	
});

$(".shipping_settings").click(function(){

event.preventDefault();
	
});

});

</script>

