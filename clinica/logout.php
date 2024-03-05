<?php
session_start();

// Destruye todas las variables de sesión
session_destroy();

// Redirige a la página de inicio de sesión
header("Location: login.php");
exit();
?>
