<?php


if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"> </i> Dashboard / Agregar Icono

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Agregar Icono

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label"> Nombre </label>

<div class="col-md-6">

<input type="text" name="icon_title" class="form-control" >

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccione el icono para productos o paquetes </label>

<div class="col-md-6">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title"> Seleccione el icono para productos o paquetes </h3>

</div>

<div class="panel-body" style="height:200px; overflow-y:scroll;">

<ul class="nav nav-pills nav-stacked category-menu">

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

</ul>

</div>

</div>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Seleccionar Imagen </label>

<div class="col-md-6">

<input type="file" name="icon_image" class="form-control" >

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="submit" class="form-control btn btn-primary" value="Agregar" >

</div>

</div>

</form>

</div>

</div>

</div>

</div>

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