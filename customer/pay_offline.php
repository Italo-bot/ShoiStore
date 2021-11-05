
<?php

@session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}

?>

<center><!-- center Starts -->

<h1> Método de pago Offline  </h1>

<p class="text-muted" >

Si tiene alguna pregunta, no dude en <a href="../contact.php" >contáctarnos,</a> nuestro centro de servicio al cliente está trabajando para usted 24 horas al día, 7 días a la semana.

</p>

</center><!-- center Ends -->

<hr>


<div class="table-responsive" ><!-- table-responsive Starts -->

<table class="table table-bordered table-hover table-striped" ><!-- table table-bordered table-hover table-striped Starts -->

<thead><!-- thead Starts -->

<tr>

<th> Detalles de la cuenta bancaria </th>

<th> Easy Paisa, UBL Omni, Mobi Cash Detalles: </th>

<th> Detalles de Western Union: </th>

</tr>

</thead><!-- thead Ends -->

<tbody><!-- tbody Starts -->

<tr>

<td> Nombre del banco: ubl Número de cuenta: 03333333 Código de sucursal: 0342 Nombre de sucursal: Shadara Lahore </td>

<td> NIC # 001234567 Número de móvil: 03334566931, Nombre: M.T.Ahmed </td>

<td> Nombre completo: M.T.Ahmed, número de móvil: 03334566931, nombre: M.T.Ahmed, país: Pakistán, N.I.C No: 001234567
    
</td>


</tr>

</tbody><!-- tbody Ends -->


</table><!-- table table-bordered table-hover table-striped Ends -->

</div><!-- table-responsive Ends -->