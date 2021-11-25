<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb" >

<li class="active" >

<i class="fa fa-dashboard"></i> Dashboard / Ver Términos

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Ver Términos

</h3>

</div>

<div class="panel-body">

<?php

$get_terms = "select * from terms";

$run_terms = mysqli_query($con,$get_terms);

while($row_terms = mysqli_fetch_array($run_terms)){

$term_id = $row_terms['term_id'];

$term_title = $row_terms['term_title'];

$term_desc = substr($row_terms['term_desc'],0,400);

?>

<div class="col-lg-4 col-md-4">

<div class="panel panel-primary">

<div class="panel-heading">

<h3 class="panel-title" align="center">

<?php echo $term_title; ?>

</h3>

</div>

<div class="panel-body">

<?php echo $term_desc; ?>

</div>

<div class="panel-footer">

<a href="index.php?delete_term=<?php echo $term_id; ?>" class="pull-left">

<i class="fa fa-trash-o"></i> Borrar

</a>


<a href="index.php?edit_term=<?php echo $term_id; ?>" class="pull-right">

<i class="fa fa-pencil"></i> Editar

</a>


<div class="clearfix"> </div>

</div>

</div>

</div>

<?php } ?>

</div>

</div>

</div>

</div>

<?php } ?>