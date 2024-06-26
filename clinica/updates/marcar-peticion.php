<?php
require('../global.php');
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['rol'])) {
    header("Location: ../login.php");
    exit();
}

// Verificar el rol del usuario
$user_role = $_SESSION['rol'];
if ($user_role != 'SuperAdministrador' && $user_role != 'Recepcion') {
    echo "No tienes permisos para realizar esta acción.";
    exit();
}

// Obtener id_peticion e id_paciente de la URL
$id_peticion = isset($_GET['id_peticion']) ? intval($_GET['id_peticion']) : 0;
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;
if ($id_peticion == 0 || $id_paciente == 0) {
    echo "Petición o paciente no encontrado.";
    exit();
}

// Conexión a la base de datos
$link = bases();

// Actualizar el estatus de la petición
$sql = "UPDATE peticion_paciente SET estatus = 'resuelta' WHERE id_peticion = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_peticion);

if ($stmt->execute()) {
    // Redirigir a la página del paciente
    header("Location: ../peticion.php?id_paciente=$id_paciente");
    exit();
} else {
    echo "Error al actualizar la petición.";
}

// Cerrar la conexión
$stmt->close();
$link->close();
?>
