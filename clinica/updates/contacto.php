<?php
// Incluye el archivo global.php
require('../global.php');

// Inicia o reanuda la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit();
}

// Conecta a la base de datos
$link = bases();

// Recupera el id_usuario de la sesión actual
$id_usuario = $_SESSION['id_usuario'];

// Recupera los datos del formulario
$id_contacto = $_POST['id_contacto'];
$nombre = $_POST['nombre'];
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$telefono = $_POST['telefono'];
$estado = $_POST['estado'];
$observaciones = $_POST['observaciones'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$archivado = $_POST['archivado'];

// Añade el campo intensidad al formulario y recupera su valor
$intensidad = isset($_POST['intensidad']) ? $_POST['intensidad'] : '';

// Actualiza los datos en la tabla
$sql_update = "UPDATE contactos SET 
               nombre = ?,
               aPaterno = ?,
               aMaterno = ?,
               telefono = ?,
               estado = ?,
               observaciones = ?,
               fecha_ingreso = ?,
               archivado = ?,
               intensidad = ?
               WHERE id_contacto = ?";

if ($stmt = $link->prepare($sql_update)) {
    // Vincula los parámetros
    $stmt->bind_param("sssssssssi", $nombre, $aPaterno, $aMaterno, $telefono, $estado, $observaciones, $fecha_ingreso, $archivado, $intensidad, $id_contacto);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        // Verifica si se afectó algún registro
        if ($stmt->affected_rows > 0) {
            echo "Actualización de contacto exitosa";
        } else {
            echo "No se realizaron cambios. Los datos proporcionados son iguales a los existentes.";
        }
        header("Location: ../crm.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cierra la consulta preparada
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta";
}

// Cierra la conexión a la base de datos
$link->close();
?>
