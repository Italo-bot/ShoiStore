<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<link rel="stylesheet" href="css/chosen.min.css">

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"></i> Dashboard / Configuración envíos

</li>

</ol>

</div>

</div>

<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"> </i> Configuración envíos

</h3>

</div>
<div class="panel-body">

<form class="form-horizontal" method="post">

<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-7">

<input type="submit" name="submit" value="Actualizar" class="form-control btn btn-primary">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['submit'])){


}

?>

<?php } ?>