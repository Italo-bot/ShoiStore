<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row"><!-- 1 row Starts --->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<ol class="breadcrumb"><!-- breadcrumb Starts --->

<li class="active">

<i class="fa fa-dashboard"> </i> Dashboard / Agregar Icono

</li>

</ol><!-- breadcrumb Ends --->

</div><!-- col-lg-12 Ends -->

</div><!-- 1 row Ends --->


<div class="row"><!-- 2 row Starts -->

<div class="col-lg-12"><!-- col-lg-12 Starts -->

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"><!-- panel-title Starts -->

<i class="fa fa-money fa-fw"> </i> Agregar Icono

</h3><!-- panel-title Ends -->

</div><!-- panel-heading Ends -->

<div class="panel-body"><!-- panel-body Starts -->

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data"><!-- form-horizontal Starts -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-6">

<input type="text" name="icon_title" class="form-control" >

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Seleccione el icono para productos o paquetes </label>

<div class="col-md-6">

<div class="panel panel-default"><!-- panel panel-default Starts -->

<div class="panel-heading"><!-- panel-heading Starts -->

<h3 class="panel-title"> Seleccione el icono para productos o paquetes </h3>

</div><!-- panel-heading Ends -->

<div class="panel-body" style="height:200px; overflow-y:scroll;"><!-- panel-body  Starts -->

<ul class="nav nav-pills nav-stacked category-menu"><!-- nav nav-pills nav-stacked category-menu Starts -->

<h4> Seleccione el icono para productos </h4>


<?php

$get_p = "select * from products where status='product'";

$run_p = mysqli_query($con,$get_p);

while($row_p = mysqli_fetch_array($run_p)){

$p_id = $row_p['product_id'];

$p_title = $row_p['product_title'];

echo "<input type='checkbox' value='$p_id' name='product_id[]'> &nbsp;$p_title <br> ";

}


?>

<h4> Seleccionar icono para paquetes </h4>

<?php

$get_p = "select * from products where status='bundle'";

$run_p = mysqli_query($con,$get_p);

while($row_p = mysqli_fetch_array($run_p)){

$p_id = $row_p['product_id'];

$p_title = $row_p['product_title'];

echo "<input type='checkbox' value='$p_id' name='product_id[]'> &nbsp;$p_title <br> ";

}


?>


</ul><!-- nav nav-pills nav-stacked category-menu Ends -->

</div><!-- panel-body  Ends -->

</div><!-- panel panel-default Ends -->

</div>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> Seleccionar Imagen </label>

<div class="col-md-6">

<input type="file" name="icon_image" class="form-control" >

</div>

</div><!-- form-group Ends -->

<div class="form-group"><!-- form-group Starts -->

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Agregar" >

</div>

</div><!-- form-group Ends -->

</form><!-- form-horizontal Ends -->

</div><!-- panel-body Ends -->


</div><!-- panel panel-default Ends -->

</div><!-- col-lg-12 Ends -->

</div><!-- 2 row Ends -->

<?php

if(isset($_POST['submit'])){

$icon_title = $_POST['icon_title'];

$icon_image = $_FILES['icon_image']['name'];

$temp_name = $_FILES['icon_image']['tmp_name'];

move_uploaded_file($temp_name,"icon_images/$icon_image");

foreach($_POST['product_id'] as $product_id){

$insert_icon = "insert into icons (icon_product,icon_title,icon_image) values ('$product_id','$icon_title','$icon_image')";

$run_icon = mysqli_query($con,$insert_icon);


}

echo "<script>alert('Se ha insertado un nuevo icono')</script>";

echo "<script> window.open('index.php?view_icons','_self') </script>";


}


?>


<?php } ?>