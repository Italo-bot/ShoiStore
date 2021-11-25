<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

$file = "../styles/style.css";

if(file_exists($file)){

$data = file_get_contents($file);

}

?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar Estilo CSS

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Editar Estilo CSS

</h3>

</div>


<div class="panel-body">

<form class="form-horizontal" action="" method="post">

<div class="form-group">

<div class="col-md-12">

<textarea class="form-control" name="newdata" rows="25">
<?php echo $data; ?>
</textarea>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"> </label>

<div class="col-md-6">

<input type="submit" name="update" value="Actualizar" class="btn btn-primary form-control">

</div>

</div>

</form>

</div>


</div>

</div>

</div>

<?php

if(isset($_POST['update'])){

$newdata = $_POST['newdata'];

$handle = fopen($file, "w");

fwrite($handle, $newdata);

fclose($handle);

echo "<script>alert('El archivo CSS se ha actualizado')</script>";

echo "<script>window.open('index.php?edit_css','_self')</script>";

}

?>

<?php } ?>