<?php

if(!defined("customer_login")){
	
echo "<script> window.open('../checkout.php','_self'); </script>";	
	
}

?>


<div class="box" ><!-- box Starts -->

<div class="box-header" ><!-- box-header Starts -->

<center>

<h1>Acceder</h1>

<p class="lead" >Ingrese su Cuenta</p>

</center>

<center><p class="text-muted">Para poder acceder a su cuenta de ShoiStore debe ingresar el correo y contraseña que registro en el sistema.</p></center>



</div><!-- box-header Ends -->

<form action="checkout.php" method="post" ><!--form Starts -->

<div class="form-group" ><!-- form-group Starts -->

<label>Email</label>

<input type="text" class="form-control" name="c_email" required >

</div><!-- form-group Ends -->

<div class="form-group" ><!-- form-group Starts -->

<label>Contraseña</label>

<input type="password" class="form-control" name="c_pass" required >

<h4 align="center">

<a href="forgot_pass.php">¿Olvido su Contraseña?</a>

</h4>

</div><!-- form-group Ends -->

<div class="text-center" ><!-- text-center Starts -->

<button name="login" value="Login" class="btn btn-primary" >

<i class="fa fa-sign-in" ></i> Ingresar


</button>

</div><!-- text-center Ends -->


</form><!--form Ends -->

<center><!-- center Starts -->

<a href="customer_register.php" >

<h3>¿Nuevo? Regístrate Aquí</h3>

</a>

</center><!-- center Ends -->

</div><!-- box Ends -->

<?php

if(isset($_POST['login'])){

$customer_email = $_POST['c_email'];

$customer_pass = $_POST['c_pass'];

$select_customer = "select * from customers where customer_email='$customer_email'";

$run_customer = mysqli_query($con,$select_customer);

$check_customer = mysqli_num_rows($run_customer);

$row_customer = mysqli_fetch_array($run_customer);

$hash_password = $row_customer["customer_pass"];

$customer_role = $row_customer["customer_role"];

$decryt_password = password_verify($customer_pass, $hash_password);

if($decryt_password == 0){
	
echo "<script>alert('Correo o Contraseña Incorrectas')</script>";

exit();
	
}

$get_ip = getRealUserIp();

$select_cart = "select * from cart where ip_add='$get_ip'";

$run_cart = mysqli_query($con,$select_cart);

$check_cart = mysqli_num_rows($run_cart);

if($check_customer==1 AND $check_cart==0){

$_SESSION['customer_email']=$customer_email;

echo "<script>alert('Ingresaste!')</script>";

if($customer_role == "customer"){

echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

}elseif($customer_role == "vendor"){
	
echo "<script>window.open('vendor_dashboard/index.php','_self')</script>";

}

}
else {

$_SESSION['customer_email']=$customer_email;

echo "<script>alert('Ingresaste!')</script>";

echo "<script>window.open('checkout.php','_self')</script>";

} 

}

?>