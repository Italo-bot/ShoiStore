
<?php

@session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}

?>

<h1 align="center">Cambiar Contraseña</h1>

<form action="" method="post"><!-- form Starts -->

<div class="form-group"><!-- form-group Starts -->

<label>Introduce tu contraseña actual</label>

<input type="text" name="old_pass" class="form-control" required>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label>Introduzca su nueva contraseña</label>

<input type="text" name="new_pass" class="form-control" required>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label>Confirme su nueva contraseña </label>

<input type="text" name="new_pass_again" class="form-control" required>

</div><!-- form-group Ends -->

<div class="text-center"><!-- text-center Starts -->

<button type="submit" name="submit" class="btn btn-primary">

<i class="fa fa-user-md"> </i> Cambiar Contraseña

</button>

</div><!-- text-center Ends -->

</form><!-- form Ends -->
<?php

if(isset($_POST['submit'])){

$c_email = $_SESSION['customer_email'];

$old_pass = $_POST['old_pass'];

$new_pass = $_POST['new_pass'];

$new_pass_again = $_POST['new_pass_again'];

$encrypted_password = password_hash($new_pass_again, PASSWORD_DEFAULT);	

$select_customer = "select * from customers where customer_email='$c_email'";

$run_customer = mysqli_query($con,$select_customer);

$check_customer = mysqli_num_rows($run_customer);

$row_customer = mysqli_fetch_array($run_customer);

$hash_password = $row_customer["customer_pass"];

$check_old_pass = password_verify($old_pass, $hash_password);

if($check_old_pass == 0){
	
echo "<script>alert('Su contraseña actual no es válida inténtelo de nuevo')</script>";

exit();
	
}

if($new_pass!=$new_pass_again){

echo "<script>alert('La confirmación de su nueva contraseña no coincide')</script>";

exit();

}

$update_pass = "update customers set customer_pass='$encrypted_password' where customer_email='$c_email'";

$run_pass = mysqli_query($con,$update_pass);

if($run_pass){

echo "<script>alert('Tu contraseña ha sido cambiada exitosamente')</script>";

echo "<script>window.open('my_account.php?my_orders','_self')</script>";

}

}

?>
