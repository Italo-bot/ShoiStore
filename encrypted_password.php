<?php

$encrypted_password = password_hash("Contraseña de tu usuario", PASSWORD_DEFAULT);

echo "<script> alert('$encrypted_password'); </script>";	

?>