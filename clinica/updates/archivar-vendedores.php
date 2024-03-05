<?php
require "../global.php";
$link = bases();

// Procesa el formulario de actualización
$id_usuario = $_GET['id_usuario'];
$archivado = "si";

// Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
$sql_actualizar = "UPDATE usuarios SET archivado = '$archivado' WHERE id_usuario = $id_usuario";

if ($link->query($sql_actualizar) === TRUE) {
    //echo "Pago actualizado correctamente.";
    // Redirige a la URL deseada
    header("Location: ../vendedores.php");  
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al actualizar el empleado: " . $link->error;
}
?>
