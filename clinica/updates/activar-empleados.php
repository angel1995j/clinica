<?php
require "../global.php";
$link = bases();

// Procesa el formulario de actualización
$id_empleado = $_GET['id_empleado'];
$archivado = "no";

// Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
$sql_actualizar = "UPDATE empleados SET archivado = '$archivado' WHERE id_empleado = $id_empleado";

if ($link->query($sql_actualizar) === TRUE) {
    //echo "Pago actualizado correctamente.";
    // Redirige a la URL deseada
    header("Location: ../empleados.php");  
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al actualizar el empleado: " . $link->error;
}
?>
