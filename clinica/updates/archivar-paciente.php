<?php
require "../global.php";
$link = bases();

// Procesa el formulario de actualización
$id_paciente = $_GET['id_paciente'];
$archivado = "si";

// Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
$sql_actualizar = "UPDATE pacientes SET archivado = '$archivado' WHERE id_paciente = $id_paciente";

if ($link->query($sql_actualizar) === TRUE) {
    //echo "Pago actualizado correctamente.";
    // Redirige a la URL deseada
    header("Location: ../pacientes.php");  
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al actualizar el empleado: " . $link->error;
}
?>
