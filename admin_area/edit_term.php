<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<?php


if(isset($_GET['edit_term'])){

$edit_id = $_GET['edit_term'];

$get_term = "select * from terms where term_id='$edit_id'";

$run_term = mysqli_query($con,$get_term);

$row_term = mysqli_fetch_array($run_term);

$term_id = $row_term['term_id'];

$term_title = $row_term['term_title'];

$term_link = $row_term['term_link'];

$term_desc = $row_term['term_desc'];

}

?>

 <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar Términos

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Editar Términos

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post">

<div class="form-group">

<label class="col-md-3 control-label"> Título </label>

<div class="col-md-6">

<input type="text" name="term_title" class="form-control" value="<?php echo $term_title; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Descripción </label>

<div class="col-md-6">

<textarea name="term_desc" class="form-control" rows="6" cols="19" >
<?php echo $term_desc; ?>
</textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> Términos Link </label>

<div class="col-md-6">

<input type="text" name="term_link" class="form-control" value="<?php echo $term_link; ?>">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="update" value="Actualizar" class="btn btn-primary form-control" >

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['update'])){

$term_title = $_POST['term_title'];

$term_desc = $_POST['term_desc'];

$term_link = $_POST['term_link'];

$update_term = "update terms set term_title='$term_title',term_link='$term_link',term_desc='$term_desc' where term_id='$term_id'";

$run_term = mysqli_query($con,$update_term);

if($run_term){

echo "<script>alert('Se ha actualizado una casilla de término.')</script>";

echo "<script>window.open('index.php?view_terms','_self')</script>";

}

}


?>


<?php } ?>