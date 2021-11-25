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

<i class="fa fa-dashboard"></i> Dashboard / Ver Países

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">
<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Ver Países

</h3>

</div>

<div class="panel-body">

<div class="table-responsive">

<table class="table table-hover table-bordered table-striped">

<thead>

<tr>

<th> País N°: </th>
<th> Nombre del país: </th>
<th> Eliminar país: </th>
<th> Editar país: </th>

</tr>

</thead>

<tbody>

<?php

$i = 0;

$per_page=15;

if (isset($_GET["countries_pagination"])) {

$page = $_GET["countries_pagination"];

}

else {

$page=1;

}
$start_from = ($page-1) * $per_page;

$get_countries = "select * from countries order by 1 DESC LIMIT $start_from, $per_page";

$run_countries = mysqli_query($con,$get_countries);

while($row_countries = mysqli_fetch_array($run_countries)) {

$country_id = $row_countries['country_id'];

$country_name = $row_countries['country_name'];

$i++;

?>

<tr>

<td><?php echo $i; ?></td>

<td><?php echo $country_name; ?></td>

<td>

<a href="index.php?edit_country=<?php echo $country_id; ?>">

<i class="fa fa-pencil"> </i> Editar

</a>

</td>

<td>

<a href="index.php?delete_country=<?php echo $country_id; ?>">

<i class="fa fa-trash-o"></i> Borrar

</a>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

<center>

<ul class="pagination">

<?php

$query = "select * from countries order by 1 DESC";

$result = mysqli_query($con, $query);

$total_records = mysqli_num_rows($result);

$total_pages = ceil($total_records / $per_page);

echo "<li class='page-item' ><a href='index.php?countries_pagination=1' class='page-link' >".'Primera'. "</a><li> ";

for ($i=1; $i<=$total_pages; $i++) {		

echo "<li "; 

if($i == $page){

echo "class='page-item active'";	
	
}

echo "><a href='index.php?countries_pagination=".$i."' class='page-link' >".$i."</a></li>";

};

echo "<li class='page-item'><a href='index.php?countries_pagination=$total_pages' class='page-link' >".'Última'."</a></li> ";

?>

</ul>

</center>

</div>

</div>

</div>

</div>

<?php } ?>