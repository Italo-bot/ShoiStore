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

<i class="fa fa-dashboard"> </i> Dashboard / Ver Iconos

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Ver Iconos

</h3>

</div>

<div class="panel-body">

<div class="table-responsive">

<table class="table table-bordered table-hover table-striped">

<thead>

<tr>

<th> ID de icono: </th>
<th> Mosaico de iconos: </th>
<th> Producto de icono: </th>
<th> Imagen del icono: </th>
<th> Eliminar icono: </th>
<th> Editar icono: </th>

</tr>

</thead>

<tbody>

<?php

$i = 0;

$get_icons = "select * from icons";

$run_icons = mysqli_query($con,$get_icons);

while($row_icons = mysqli_fetch_array($run_icons)){

$icon_id = $row_icons['icon_id'];

$product_id = $row_icons['icon_product'];

$icon_title = $row_icons['icon_title'];

$icon_image = $row_icons['icon_image'];

$get_p = "select * from products where product_id='$product_id'";

$run_p = mysqli_query($con,$get_p);

$row_p = mysqli_fetch_array($run_p);

$p_title = $row_p['product_title'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td><?php echo $icon_title; ?></td>

<td><?php echo $p_title; ?></td>

<td>

<img src="icon_images/<?php echo $icon_image; ?>" width="50" height="50">

</td>

<td>

<a href="index.php?delete_icon=<?php echo $icon_id; ?>">

<i class="fa fa-trash-o"> </i> Borrar

</a>

</td>

<td>

<a href="index.php?edit_icon=<?php echo $icon_id; ?>">

<i class="fa fa-pencil"> </i> Editar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

<?php } ?>