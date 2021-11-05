<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}else{

if(isset($_GET["change_review_status"])){

$review_id = $_GET["change_review_status"];

$review_status = $_GET["status"];

if($review_status == "unspam" or $review_status == "restore"){

$update_review_status = "update reviews set review_status='active' where review_id='$review_id'";

}else{

$update_review_status = "update reviews set review_status='$review_status' where review_id='$review_id'";
	
}

$run_review_status = mysqli_query($con,$update_review_status);

if($run_review_status){
	
if($review_status == "active"){
	
$alert_text = "Su revisión ha sido aprobada con éxito.";
	
}elseif($review_status == "pending"){

$alert_text = "Su revisión no se aprobó correctamente y se movió a pendiente.";
	
}elseif($review_status == "spam"){

$alert_text = "Tu opinión se ha transferido a spam con éxito.";
	
}elseif($review_status == "unspam"){

$alert_text = "Su reseña no ha recibido spam y se ha aprobado correctamente.";
	
}elseif($review_status == "trash"){

$alert_text = "Tu reseña se ha movido a la papelera Sccessfully.";
	
}elseif($review_status == "restore"){

$alert_text = "Su reseña ha sido restaurada y trasladada a aprobada.";
	
}

echo "

<script>

alert('$alert_text');

window.open('index.php?view_reviews','_self');

</script>

";

}

}

}

?>
