<?php
require "../global.php";
$link = bases();

// Procesa el formulario de actualización
$id_pagos_empleado = $_GET['id_pagos_empleado'];
$estatus = "pagado";

// Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
$sql_actualizar = "UPDATE pagos_empleado SET estatus = '$estatus' WHERE id_pagos_empleado = $id_pagos_empleado";

if ($link->query($sql_actualizar) === TRUE) {
    //echo "Pago actualizado correctamente.";
    // Redirige a la URL deseada
    header("Location: ../empleados.php");  
    exit(); // Asegura que el script se detenga después de la redirección
} else {
    echo "Error al actualizar el pago: " . $link->error;
}
?>
