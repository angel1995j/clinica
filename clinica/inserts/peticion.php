<?php
require('../global.php');
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar que se hayan recibido todos los datos necesarios
if (!isset($_POST['detalle'], $_POST['quien_procesa'], $_POST['monto'], $_POST['estatus'], $_POST['id_paciente'])) {
    echo "Todos los campos son obligatorios.";
    exit();
}

$detalle = $_POST['detalle'];
$quien_procesa = $_POST['quien_procesa'];
$monto = $_POST['monto'];
$estatus = $_POST['estatus'];
$id_paciente = intval($_POST['id_paciente']);

// Conexión a la base de datos
$link = bases();

// Consulta para insertar la nueva petición
$sql = "INSERT INTO peticion_paciente (detalle, quien_procesa, monto, estatus, id_paciente, id_usuario) 
        VALUES (?, ?, ?, ?, ?, ?)";

// Verificar si la consulta fue preparada correctamente
if ($stmt = $link->prepare($sql)) {
    $id_usuario = $_SESSION['id_usuario']; // Suponiendo que el ID del usuario que crea la petición está en la sesión
    $stmt->bind_param("ssdssi", $detalle, $quien_procesa, $monto, $estatus, $id_paciente, $id_usuario);
    
    // Ejecutar la consulta
    if ($stmt->execute()) {
        // Redirigir a la página de peticiones del paciente
        header("Location: ../peticion.php?id_paciente=$id_paciente");
        exit();
    } else {
        echo "Error al insertar la petición: " . $stmt->error;
    }
    
    $stmt->close();
} else {
    echo "Error al preparar la consulta: " . $link->error;
}

$link->close();
?>
