<?php

// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera los datos del formulario
$nombre_usuario = $_POST['nombre_usuario'];
$contrasena = $_POST['contrasena'];
$nombre = $_POST['nombre'];
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$telefono = $_POST['telefono'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$rol = $_POST['rol'];
$archivado = $_POST['archivado'];

// Inserta los datos en la tabla
$sql_insert = "INSERT INTO usuarios (nombre_usuario, contrasena, nombre, aPaterno, aMaterno, telefono, fecha_ingreso, rol, archivado) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Hashea la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    // Vincula los parámetros
    $stmt->bind_param("sssssssss", $nombre_usuario, $hashedPassword, $nombre, $aPaterno, $aMaterno, $telefono, $fecha_ingreso, $rol, $archivado);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro de usuario exitoso";
        header("Location: ../usuarios.php");
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
