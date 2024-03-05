<?php
require "../global.php";
$link = bases();

// Procesa el formulario de actualización
$id_solicitud = $_GET['id_solicitud'];
$archivado = "si";

// Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
$sql_actualizar = "UPDATE solicitudes SET archivado = '$archivado' WHERE id_solicitud = $id_solicitud";

if ($link->query($sql_actualizar) === TRUE) {
    //echo "Pago actualizado correctamente.";
    // Redirige a la URL deseada
    header("Location: ../solicitudes.php");  
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al actualizar el empleado: " . $link->error;
}
?>
