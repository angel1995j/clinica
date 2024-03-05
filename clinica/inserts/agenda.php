<?php
// Verifica si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recupera los datos del formulario
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;

    // Valida que los datos no estén vacíos
    if (empty($id_paciente) || empty($fecha) || empty($observaciones) || empty($id_usuario)) {
        die('Error: Todos los campos son obligatorios.');
    }

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();

    // Escapa los datos para evitar inyección SQL
    $fecha = $link->real_escape_string($fecha);
    $observaciones = $link->real_escape_string($observaciones);

    // Inserta la nueva cita en la tabla agenda
    $sql_insert = "INSERT INTO agenda (fecha, observaciones, id_paciente, id_usuario) VALUES ('$fecha', '$observaciones', $id_paciente, $id_usuario)";

    if ($link->query($sql_insert) === TRUE) {
        // La inserción fue exitosa
        header("Location: ../agenda-paciente.php?id_paciente=$id_paciente"); // Redirecciona a la página del perfil del paciente
        exit();
    } else {
        // Ocurrió un error en la inserción
        die('Error al insertar la cita en la base de datos: ' . $link->error);
    }

    // Cierra la conexión a la base de datos
    $link->close();
} else {
    // Si no se reciben datos por POST, redirecciona a alguna página de error o vuelve atrás
    header("Location: index.php"); // Cambia "index.php" por la página a la que quieras redireccionar
    exit();
}
?>
