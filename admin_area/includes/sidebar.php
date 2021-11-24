<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<nav class="navbar navbar-inverse navbar-fixed-top"><!-- navbar navbar-inverse navbar-fixed-top Starts -->

<div class="navbar-header" ><!-- navbar-header Starts -->

<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse" ><!-- navbar-ex1-collapse Starts -->


<span class="sr-only" >Navegación</span>

<span class="icon-bar" ></span>

<span class="icon-bar" ></span>

<span class="icon-bar" ></span>


</button><!-- navbar-ex1-collapse Ends -->

<a class="navbar-brand" href="index.php?dashboard" >Panel Administrador</a>


</div><!-- navbar-header Ends -->

<ul class="nav navbar-right top-nav" ><!-- nav navbar-right top-nav Starts -->

<li class="dropdown" ><!-- dropdown Starts -->

<a href="#" class="dropdown-toggle" data-toggle="dropdown" ><!-- dropdown-toggle Starts -->

<i class="fa fa-user" ></i>

<?php echo $admin_name; ?> <b class="caret" ></b>


</a><!-- dropdown-toggle Ends -->

<ul class="dropdown-menu" ><!-- dropdown-menu Starts -->

<li><!-- li Starts -->

<a href="index.php?user_profile=<?php echo $admin_id; ?>" >

<i class="fa fa-fw fa-user" ></i> Perfil


</a>

</li><!-- li Ends -->

<li><!-- li Starts -->

<a href="index.php?view_products" >

<i class="fa fa-fw fa-envelope" ></i> Productos 

<?php if($count_products != 0){ ?>

<span class="badge"><?php echo $count_products; ?></span>

<?php } ?>

</a>

</li><!-- li Ends -->

<li><!-- li Starts -->

<a href="index.php?view_customers" >

<i class="fa fa-fw fa-gear" ></i> Clientes

<span class="badge" ><?php echo $count_customers; ?></span>


</a>

</li><!-- li Ends -->

<li><!-- li Starts -->

<a href="index.php?view_p_cats" >

<i class="fa fa-fw fa-gear" ></i> Categorías de producto

<span class="badge" ><?php echo $count_p_categories; ?></span>


</a>

</li><!-- li Ends -->

<li class="divider"></li>

<li><!-- li Starts -->

<a href="logout.php">

<i class="fa fa-fw fa-power-off"> </i> Cerrar sesión

</a>

</li><!-- li Ends -->

</ul><!-- dropdown-menu Ends -->




</li><!-- dropdown Ends -->


</ul><!-- nav navbar-right top-nav Ends -->

<div class="collapse navbar-collapse navbar-ex1-collapse"><!-- collapse navbar-collapse navbar-ex1-collapse Starts -->

<ul class="nav navbar-nav side-nav"><!-- nav navbar-nav side-nav Starts -->

<li><!-- li Starts -->

<a href="index.php?dashboard">

<i class="fa fa-fw fa-dashboard"></i> Dashboard

</a>

</li><!-- li Ends -->

<li><!-- Settings li Starts -->

<a href="#" data-toggle="collapse" data-target="#settings">

<i class="fa fa-fw fa-cog"></i> Configuración

<i class="fa fa-fw fa-caret-down"></i>

</a>

<ul id="settings" class="collapse">

<li>

<a href="index.php?general_settings"> Configuración general </a>

</li>

<li>

<a href="index.php?payment_settings"> Configuración de pagos </a>

</li>

<li>

<a href="index.php?store_settings"> Configuración de tienda </a>

</li>

</ul>

</li><!-- Settings li Ends -->

<li><!-- li Starts -->

<a href="index.php?vendors_commissions">

<i class="fa fa-fw fa-usd"></i> Comisión de vendedores

<?php

$select_vendor_commission = "select * from vendor_commissions where commission_status='pending'";

$run_vendor_commission = mysqli_query($con,$select_vendor_commission);

$count_vendor_commission = mysqli_num_rows($run_vendor_commission);

if($count_vendor_commission != 0){

?>

<span class="badge"><?php echo $count_vendor_commission; ?></span>

<?php } ?>

</a>

</li><!-- li Ends -->

<li><!-- Products li Starts -->

<a href="#" data-toggle="collapse" data-target="#products">

<i class="fa fa-fw fa-table"></i> Productos

<?php 

$select_pending_products = "select * from products where status='product' and product_vendor_status='pending'";

$run_pending_products = mysqli_query($con,$select_pending_products);

$count_pending_products = mysqli_num_rows($run_pending_products);

if($count_pending_products != 0){ 

?>

<span class="badge"><?php echo $count_pending_products; ?></span>

<?php } ?>

<i class="fa fa-fw fa-caret-down"></i>

</a>

<ul id="products" class="collapse">

<li>
<a href="index.php?insert_product"> Agregar producto </a>
</li>

<li>
<a href="index.php?view_products"> Ver Productos </a>
</li>


</ul>

</li><!-- Products li Ends -->

<li><!-- Bundles Li Starts --->

<a href="#" data-toggle="collapse" data-target="#bundles">

<i class="fa fa-fw fa-edit"></i> Paquetes

<?php 

$select_pending_products = "select * from products where status='bundle' and product_vendor_status='pending'";

$run_pending_products = mysqli_query($con,$select_pending_products);

$count_pending_products = mysqli_num_rows($run_pending_products);

if($count_pending_products != 0){ 

?>

<span class="badge"><?php echo $count_pending_products; ?></span>

<?php } ?>

<i class="fa fa-fw fa-caret-down"></i>

</a>

<ul id="bundles" class="collapse">

<li>
<a href="index.php?insert_bundle"> Agregar Paquete </a>
</li>

<li>
<a href="index.php?view_bundles"> Ver Paquetes </a>
</li>

</ul>

</li><!-- Bundles Li Ends --->

<li><!-- relations li Starts -->

<a href="#" data-toggle="collapse" data-target="#relations"><!-- anchor Starts -->

<i class="fa fa-fw fa-retweet"></i> Asignar productos a relaciones de paquetes

<i class="fa fa-fw fa-caret-down"></i>

</a><!-- anchor Ends -->

<ul id="relations" class="collapse"><!-- collapse Starts -->

<li>

<a href="index.php?insert_rel"> Agregar relación </a>

</li>


<li>

<a href="index.php?view_rel"> Ver relaciones </a>

</li>

</ul><!-- collapse Ends -->


</li><!-- relations li Ends -->


<li><!-- reviews li Starts -->

<a href="#" data-toggle="collapse" data-target="#reviews">

<i class="fa fa-fw fa-star"></i> Reseñas

<i class="fa fa-fw fa-caret-down"></i>

</a>

<ul id="reviews" class="collapse">

<li>
<a href="index.php?insert_review"> Agregar reseña </a>
</li>

<li>
<a href="index.php?view_reviews"> Ver Reseñas </a>
</li>

</ul>

</li><!-- reviews li Ends -->


<li><!-- Icons Li Starts -->

<a href="#" data-toggle="collapse" data-target="#shipping_zones">

<i class="fa fa-truck" aria-hidden="true"></i> Envíos

<i class="fa fa-fw fa-caret-down" ></i>

</a>

<ul id="shipping_zones" class="collapse"><!-- Icons Ul Starts -->


<li>

<a href="index.php?shipping_settings"> Configuración de envío </a>

</li>

<li>
<a href="index.php?insert_shipping_zone"> Agregar Zona de envío  </a>
</li>

<li>
<a href="index.php?view_shipping_zones"> Ver Zonas de envío </a>
</li>

<li>
<a href="index.php?insert_shipping_type"> Agregar tipo de envío  </a>
</li>

<li>
<a href="index.php?view_shipping_types"> Ver tipos de envío </a>
</li>

</ul><!-- Icons Ul Ends -->

</li><!-- Icons Li Ends -->

<li><!-- Icons Li Starts -->

<a href="#" data-toggle="collapse" data-target="#countries">

<i class="fa fa-globe" aria-hidden="true"></i> Países

<i class="fa fa-fw fa-caret-down" ></i>

</a>

<ul id="countries" class="collapse"><!-- Icons Ul Starts -->

<li>
<a href="index.php?insert_country"> Agregar Países</a>
</li>

<li>
<a href="index.php?view_countries"> Ver Países  </a>
</li>

</ul><!-- Icons Ul Ends -->

</li><!-- Icons Li Ends -->


<li><!-- Icons Li Starts -->

<a href="#" data-toggle="collapse" data-target="#icons">

<i class="fa fa-fw fa-retweet"> </i> Iconos

<i class="fa fa-fw fa-caret-down" ></i>

</a>

<ul id="icons" class="collapse"><!-- Icons Ul Starts -->

<li>
<a href="index.php?insert_icon"> Agregar icono </a>
</li>

<li>
<a href="index.php?view_icons"> Ver Iconos </a>
</li>

</ul><!-- Icons Ul Ends -->

</li><!-- Icons Li Ends -->


<li><!-- manufacturer li Starts -->

<a href="#" data-toggle="collapse" data-target="#manufacturers"><!-- anchor Starts -->

<i class="fa fa-fw fa-briefcase"></i> Fabricantes

<i class="fa fa-fw fa-caret-down"></i>


</a><!-- anchor Ends -->

<ul id="manufacturers" class="collapse"><!-- ul collapse Starts -->

<li>
<a href="index.php?insert_manufacturer"> Agregar fabricante </a>
</li>

<li>
<a href="index.php?view_manufacturers"> Ver fabricantes </a>
</li>

</ul><!-- ul collapse Ends -->


</li><!-- manufacturer li Ends -->


<li><!-- li Starts -->

<a href="#" data-toggle="collapse" data-target="#p_cat">

<i class="fa fa-fw fa-pencil"></i> Categorías de producto

<i class="fa fa-fw fa-caret-down"></i>


</a>

<ul id="p_cat" class="collapse">

<li>
<a href="index.php?insert_p_cat"> Agregar categoría de producto </a>
</li>

<li>
<a href="index.php?view_p_cats"> Ver categoría de productos </a>
</li>


</ul>

</li><!-- li Ends -->


<li><!-- li Starts -->

<a href="#" data-toggle="collapse" data-target="#cat">

<i class="fa fa-fw fa-arrows-v"></i> Categorías

<i class="fa fa-fw fa-caret-down"></i>

</a>

<ul id="cat" class="collapse">

<li>
<a href="index.php?insert_cat"> Agregar categorías </a>
</li>

<li>
<a href="index.php?view_cats"> Ver Categorías </a>
</li>


</ul>

</li><!-- li Ends -->


<li><!-- boxes section li Starts -->

<a href="#" data-toggle="collapse" data-target="#boxes"><!-- anchor Starts -->

<i class="fa fa-fw fa-arrows"></i> Sección de casillas

<i class="fa fa-fw fa-caret-down"></i>

</a><!-- anchor Ends -->

<ul id="boxes" class="collapse">

<li>

<a href="index.php?insert_box"> Agregar casilla </a>

</li>


<li>

<a href="index.php?view_boxes"> Ver Casillas </a>

</li>

</ul>

</li><!--boxes section li Ends -->

<li><!-- services section li Starts -->

<a href="#" data-toggle="collapse" data-target="#services">

<i class="fa fa-fw fa-briefcase"></i> Servicios

<i class="fa fa-fw fa-caret-down"></i>

</a>

<ul id="services" class="collapse">

<li>
<a href="index.php?insert_service"> Agregar Servicios </a>
</li>

<li>
<a href="index.php?view_services"> Ver Servicios </a>
</li>

</ul>

</li><!-- services section li Ends -->


<li><!-- contact us li Starts -->

<a href="#" data-toggle="collapse" data-target="#contact_us"><!-- anchor Starts -->

<i class="fa fa-fw fa-pencil"> </i> Sección Contáctanos

<i class="fa fa-fw fa-caret-down"></i>

</a><!-- anchor Ends -->

<ul id="contact_us" class="collapse">

<li>

<a href="index.php?edit_contact_us"> Editar </a>

</li>

<li>

<a href="index.php?insert_enquiry"> Agregar tipo de consulta </a>

</li>

<li>

<a href="index.php?view_enquiry"> Ver tipos de consultas </a>

</li>

</ul>

</li><!-- contact us li Ends -->

<li><!-- about us li Starts -->

<a href="index.php?edit_about_us">

<i class="fa fa-fw fa-edit"></i> Editar Seccion ¿Quiénes Somos?

</a>

</li><!-- about us li Ends -->


<li><!-- Coupons Section li Starts -->

<a href="#" data-toggle="collapse" data-target="#coupons"><!-- anchor Starts -->

<i class="fa fa-fw fa-arrows-v"></i> Cupones

<i class="fa fa-fw fa-caret-down"></i>

</a><!-- anchor Ends -->

<ul id="coupons" class="collapse"><!-- ul collapse Starts -->

<li>
<a href="index.php?insert_coupon"> Agregar cupón </a>
</li>

<li>
<a href="index.php?view_coupons"> Ver cupones </a>
</li>

</ul><!-- ul collapse Ends -->

</li><!-- Coupons Section li Ends -->

<li><!-- slide li Starts -->

<a href="#" data-toggle="collapse" data-target="#slides">

<i class="fa fa-fw fa-gear"></i> Slides

<i class="fa fa-fw fa-caret-down"></i>


</a>

<ul id="slides" class="collapse">

<li>
<a href="index.php?insert_slide"> Agregar Slide </a>
</li>

<li>
<a href="index.php?view_slides"> Ver Slides </a>
</li>


</ul>

</li><!-- slide li Ends -->

<li><!-- terms li Starts -->

<a href="#" data-toggle="collapse" data-target="#terms" ><!-- anchor Starts -->

<i class="fa fa-fw fa-table"></i> Términos

<i class="fa fa-fw fa-caret-down"></i>

</a><!-- anchor Ends -->

<ul id="terms" class="collapse"><!-- ul collapse Starts -->

<li>
<a href="index.php?insert_term"> Ingresar término </a> 
</li>

<li>
<a href="index.php?view_terms"> Ver términos </a> 
</li>

</ul><!-- ul collapse Ends -->


</li><!-- terms li Ends -->

<li><!-- Edit Css li Starts -->

<a href="index.php?edit_css">

<i class="fa fa-fw fa-list"></i> Editar Estilo CSS

</a>

</li><!-- Edit Css li Ends -->

<li>

<a href="index.php?view_customers">

<i class="fa fa-fw fa-edit"></i> Ver Clientes

</a>

</li>

<li>

<a href="index.php?view_orders">

<i class="fa fa-fw fa-list"></i> Ver Ordenes

</a>

</li>

<li>

<a href="index.php?view_payments">

<i class="fa fa-fw fa-pencil"></i> Ver Pagos

</a>

</li>

<li><!-- li Starts -->

<a href="#" data-toggle="collapse" data-target="#users">

<i class="fa fa-fw fa-gear"></i> Admins

<i class="fa fa-fw fa-caret-down"></i>


</a>

<ul id="users" class="collapse">

<li>
<a href="index.php?insert_user"> Agregar Admins </a>
</li>

<li>
<a href="index.php?view_users"> Ver Admins </a>
</li>

<li>
<a href="index.php?user_profile=<?php echo $admin_id; ?>"> Editar Perfil </a>
</li>

</ul>

</li><!-- li Ends -->

<li><!-- li Starts -->

<a href="logout.php">

<i class="fa fa-fw fa-power-off"></i> Cerrar Sesión

</a>

</li><!-- li Ends -->

</ul><!-- nav navbar-nav side-nav Ends -->

</div><!-- collapse navbar-collapse navbar-ex1-collapse Ends -->

</nav><!-- navbar navbar-inverse navbar-fixed-top Ends -->

<?php } ?>