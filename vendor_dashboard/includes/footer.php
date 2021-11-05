
<div id="footer"><!-- footer Starts -->

<div class="container"><!-- container Starts -->

<div class="row" ><!-- row Starts -->

<div class="col-md-3 col-sm-6" ><!-- col-md-3 col-sm-6 Starts -->

<h4>Páginas</h4>

<ul><!-- ul Starts -->

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

</ul><!-- ul Ends -->

<hr>

<h4>Sección Usuario</h4>

<ul><!-- ul Starts -->

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



</ul><!-- ul Ends -->

<hr class="hidden-md hidden-lg hidden-sm" >

</div><!-- col-md-3 col-sm-6 Ends -->

<div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->

<h4> Categorías de productos </h4>

<ul><!-- ul Starts -->

<?php

$get_p_cats = "select * from product_categories";

$run_p_cats = mysqli_query($con,$get_p_cats);

while($row_p_cats = mysqli_fetch_array($run_p_cats)){

$p_cat_id = $row_p_cats['p_cat_id'];

$p_cat_title = $row_p_cats['p_cat_title'];

echo "<li> <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a> </li>";

}

?>

</ul><!-- ul Ends -->

<hr class="hidden-md hidden-lg">

</div><!-- col-md-3 col-sm-6 Ends -->


<div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->

<h4>Información</h4>

<p><!-- p Starts -->
<strong>ShoiStore</strong>
<br>Santiago
<br>Chile
<br>9 4827 4857
<br>ShoiStore@gmail.com
<br>


</p><!-- p Ends -->

<a href="contact.php">Contáctanos</a>

<hr class="hidden-md hidden-lg">

</div><!-- col-md-3 col-sm-6 Ends -->

<div class="col-md-3 col-sm-6"><!-- col-md-3 col-sm-6 Starts -->

</form><!-- form Ends -->

<hr>

<h4> Redes Sociales </h4>

<p class="social"><!-- social Starts --->

<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>

</p><!-- social Ends --->

</div><!-- col-md-3 col-sm-6 Ends -->

</div><!-- row Ends -->

</div><!-- container Ends -->
</div><!-- footer Ends -->

<div id="copyright"><!-- copyright Starts -->

<div class="container" ><!-- container Starts -->

<div class="col-md-6" ><!-- col-md-6 Starts -->

<p class="pull-left"> &copy; 2021 ShoiStore</p>

</div><!-- col-md-6 Ends -->

<div class="col-md-6"><!-- col-md-6 Starts -->


</div><!-- col-md-6 Ends -->

</div><!-- container Ends -->

</div><!-- copyright Ends -->