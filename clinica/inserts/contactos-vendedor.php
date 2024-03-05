<?php
// Inicia o reanuda la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit();
}

// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera el id_usuario de la sesión actual
$id_usuario = $_SESSION['id_usuario'];

// Recupera los datos del formulario, incluyendo el campo intensidad
$nombre = $_POST['nombre'];
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$telefono = $_POST['telefono'];
$estado = $_POST['estado'];
$observaciones = $_POST['observaciones'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$archivado = "no";
$intensidad = $_POST['intensidad'];  // Asegúrate de que 'intensidad' sea el nombre correcto en tu formulario

// Inserta los datos en la tabla
$sql_insert = "INSERT INTO contactos (id_usuario, nombre, aPaterno, aMaterno, telefono, estado, observaciones, fecha_ingreso, archivado, intensidad) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Vincula los parámetros
    $stmt->bind_param("dsssssssss", $id_usuario, $nombre, $aPaterno, $aMaterno, $telefono, $estado, $observaciones, $fecha_ingreso, $archivado, $intensidad);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro de contacto exitoso";
        header("Location: ../crm-vendedor.php");
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
