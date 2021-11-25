<?php



if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

if(isset($_GET['edit_box'])){

$edit_box = $_GET['edit_box'];

$get_boxes = "select * from boxes_section where box_id='$edit_box'";

$run_boxes = mysqli_query($con,$get_boxes);

$row_boxes = mysqli_fetch_array($run_boxes);

$box_id = $row_boxes['box_id'];

$box_title = $row_boxes['box_title'];

$box_desc = $row_boxes['box_desc'];



}


?>

<div class="row" >

<div class="col-lg-12">

<ol class="breadcrumb" >

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Editar Caja

</li>

</ol>

</div>

</div>

<div class="row" >

<div class="col-lg-12" >

<div class="panel panel-default">

<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-money fa-fw"></i> Editar Caja

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post" action="">

<div class="form-group">

<label class="col-md-3 control-label">Título : </label>

<div class="col-md-6">

<input type="text" name="box_title" class="form-control" value="<?php echo $box_title; ?>">

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label">Descripción : </label>

<div class="col-md-6">

<textarea name="box_desc" class="form-control" rows="6" cols="19">
<?php echo $box_desc; ?>
 </textarea>

</div>

</div>


<div class="form-group">

<label class="col-md-3 control-label"></label>

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

$box_title = $_POST['box_title'];

$box_desc = $_POST['box_desc'];

$update_box = "update boxes_section set box_title='$box_title',box_desc='$box_desc' where box_id='$box_id'";

$run_box = mysqli_query($con,$update_box);

echo "<script>alert('Caja ha sido actualizada')</script>";

echo "<script>window.open('index.php?view_boxes','_self')</script>";

}


?>




<?php } ?>