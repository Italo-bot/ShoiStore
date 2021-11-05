<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {

?>

<?php

if(isset($_GET['delete_review'])){

$review_id = $_GET['delete_review'];

$delete_review = "delete from reviews where review_id='$review_id'";

$run_delete_review = mysqli_query($con,$delete_review);

if($run_delete_review){
	
$delete_reviews_meta = "delete from reviews_meta where review_id='$review_id'";

$run_delete_reviews_meta = mysqli_query($con,$delete_reviews_meta);

if($run_delete_reviews_meta){

echo "

<script>

alert('Su opinión ha sido eliminada completamente.');

window.open('index.php?view_reviews','_self');

</script>

";

}

}

}

?>

<?php } ?>