
<?php

if(isset($include_page) and $include_page == "vendor_store"){
	
$store_back_url = "../";

}else{

$store_back_url = "";
	
}

?>

<div id="footer">

<div class="container">

<div class="row" >

<div class="col-md-3 col-sm-6" >
<h4>Secciones</h4>

<ul>

<li><a href="<?php echo $store_back_url; ?>cart.php">Carrito de Compras</a></li>

<li><a href="<?php echo $store_back_url; ?>contact.php">Contáctanos</a></li>

<li><a href="<?php echo $store_back_url; ?>shop.php">Tienda</a></li>

<li>

<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='$store_back_url" . "checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='$store_back_url" . "customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>

</li>

<?php 

if(isset($_SESSION['customer_email'])){
	
$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_role = $row_customer['customer_role'];

if($customer_role == "vendor"){ 

?>

<li>

<a href="<?php echo $store_back_url; ?>vendor_dashboard/index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

</ul>

<hr>

<h4>Sección Usuario</h4>

<ul>

<?php 

if(isset($_SESSION['customer_email'])){
	
$customer_email = $_SESSION['customer_email'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$row_customer = mysqli_fetch_array($run_customer);

$customer_role = $row_customer['customer_role'];

if($customer_role == "vendor"){ 

?>

<li>

<a href="<?php echo $store_back_url; ?>vendor_dashboard/index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

<li>

<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='$store_back_url" . "checkout.php' >Acceder</a>";

}
else{

echo "<a href='$store_back_url" . "customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>

</li>

<li><a href="<?php echo $store_back_url; ?>customer_register.php">Registrarse</a></li>

<li><a href="<?php echo $store_back_url; ?>terms.php">Términos y Condiciones </a></li>



</ul>

<hr class="hidden-md hidden-lg hidden-sm" >

</div>

<div class="col-md-3 col-sm-6">

<h4> Categorías de Productos </h4>

<ul>

<?php

$get_p_cats = "select * from product_categories";

$run_p_cats = mysqli_query($con,$get_p_cats);

while($row_p_cats = mysqli_fetch_array($run_p_cats)){

$p_cat_id = $row_p_cats['p_cat_id'];

$p_cat_title = $row_p_cats['p_cat_title'];

echo "<li> <a href='$store_back_url" . "shop.php?p_cat=$p_cat_id'> $p_cat_title </a> </li>";

}

?>

</ul>

<hr class="hidden-md hidden-lg">

</div>


<div class="col-md-3 col-sm-6">

<h4>Información</h4>

<p>
<strong>ShoiStore</strong>
<br>Santiago
<br>Chile
<br>9 4827 4857
<br>ShoiStore@gmail.com
<br>


</p>

<a href="<?php echo $store_back_url; ?>contact.php">Contáctanos</a>

<hr class="hidden-md hidden-lg">

</div>

<div class="col-md-3 col-sm-6">


<h4> Redes Sociales </h4>

<p class="social">

<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>

</p>

</div>

</div>

</div>
</div>
<div id="copyright">

<div class="container" >

<div class="col-md-6" >
<p class="pull-left"> &copy; 2021 ShoiStore, Todos los derechos reservados. </p>

</div>

</div>

</div>