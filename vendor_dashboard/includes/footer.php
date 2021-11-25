
<div id="footer">

<div class="container">

<div class="row" >

<div class="col-md-3 col-sm-6" >
<h4>Páginas</h4>

<ul>

<li><a href="cart.php">Carrito</a></li>

<li><a href="contact.php">Contáctanos</a></li>

<li><a href="shop.php">Tienda</a></li>

<li>

<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >Mi Cuenta</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>Mi Cuenta</a>";

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

<a href="index.php"> Vendedor Dashboard </a>

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

<a href="index.php"> Vendedor Dashboard </a>

</li>

<?php } } ?>

<li>

<?php

if(!isset($_SESSION['customer_email'])){

echo "<a href='checkout.php' >Acceder</a>";

}
else{

echo "<a href='customer/my_account.php?my_orders'>Mi Cuenta</a>";

}


?>

</li>

<li><a href="customer_register.php">Registrarse</a></li>

<li><a href="terms.php">Términos y Condicines </a></li>



</ul>

<hr class="hidden-md hidden-lg hidden-sm" >

</div>

<div class="col-md-3 col-sm-6">

<h4> Categorías de productos </h4>

<ul>

<?php

$get_p_cats = "select * from product_categories";

$run_p_cats = mysqli_query($con,$get_p_cats);

while($row_p_cats = mysqli_fetch_array($run_p_cats)){

$p_cat_id = $row_p_cats['p_cat_id'];

$p_cat_title = $row_p_cats['p_cat_title'];

echo "<li> <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a> </li>";

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

<a href="contact.php">Contáctanos</a>

<hr class="hidden-md hidden-lg">

</div>

<div class="col-md-3 col-sm-6">

</form>

<hr>

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

<p class="pull-left"> &copy; 2021 ShoiStore, Todos los derechos reservados</p>

</div>

<div class="col-md-6">


</div>

</div>

</div>