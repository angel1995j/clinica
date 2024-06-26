<?php
// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera los datos del formulario
$descripcion = $_POST['descripcion'];
$fecha = $_POST['fecha'];
$archivado = isset($_POST['archivado']) ? $_POST['archivado'] : 'no';  // Asegura que $archivado esté definido

// Obtén el ID del usuario logueado
$id_usuario = $_POST['id_usuario'];

// Inserta los datos en la tabla
$sql_insert = "INSERT INTO solicitudes (descripcion, fecha, archivado, id_usuario) 
               VALUES (?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Vincula los parámetros
    $stmt->bind_param("ssss", $descripcion, $fecha, $archivado, $id_usuario);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro de solicitud exitoso";
        header("Location: ../index_cocina.php");
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
