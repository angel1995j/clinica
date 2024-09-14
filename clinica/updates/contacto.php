<?php
require('../global.php');
$link = bases();

// Verificar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener los datos del formulario
    $id_contacto = $_POST['id_contacto'];
    $nombre = $_POST['nombre'];
    $aPaterno = $_POST['aPaterno'];
    $aMaterno = $_POST['aMaterno'];
    $telefono = $_POST['telefono'];
    $fecha_ingreso = $_POST['fecha_ingreso'];
    $estado = $_POST['estado'];
    $intensidad = $_POST['intensidad'];
    $observaciones = $_POST['observaciones'];
    $archivado = $_POST['archivado'];

    // Preparar la consulta SQL para actualizar el contacto
    $sql = "UPDATE contactos 
            SET nombre = ?, aPaterno = ?, aMaterno = ?, telefono = ?, fecha_ingreso = ?, estado = ?, intensidad = ?, observaciones = ?, archivado = ?
            WHERE id_contacto = ?";
    
    // Preparar la declaración
    if ($stmt = $link->prepare($sql)) {
        // Vincular los parámetros
        $stmt->bind_param('sssssssssi', $nombre, $aPaterno, $aMaterno, $telefono, $fecha_ingreso, $estado, $intensidad, $observaciones, $archivado, $id_contacto);

        // Ejecutar la declaración
        if ($stmt->execute()) {
            // Redirigir a la página de detalles del contacto o al CRM con un mensaje de éxito
            header("Location: ../crm.php?mensaje=Contacto+actualizado+con+éxito");
            exit();
        } else {
            echo "Error al actualizar el contacto: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error al preparar la declaración: " . $link->error;
    }
}

// Cerrar la conexión
$link->close();
?>
