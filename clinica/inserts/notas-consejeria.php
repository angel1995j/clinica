<?php
// Verifica si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los datos del formulario
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $hora = isset($_POST['hora']) ? $_POST['hora'] : '';
    $objetivo = isset($_POST['objetivo']) ? $_POST['objetivo'] : '';
    $resumen = isset($_POST['resumen']) ? $_POST['resumen'] : '';
    $resultados = isset($_POST['resultados']) ? $_POST['resultados'] : '';
    $aspectos_esperados = isset($_POST['aspectos_esperados']) ? $_POST['aspectos_esperados'] : '';
    $tareas = isset($_POST['tareas']) ? $_POST['tareas'] : '';
    $aspectos_trabajados = isset($_POST['aspectos_trabajados']) ? $_POST['aspectos_trabajados'] : '';
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
    $fecha_proxima = isset($_POST['fecha_proxima']) ? $_POST['fecha_proxima'] : NULL;

    // Valida que los campos obligatorios no estén vacíos
    if (empty($id_paciente) || empty($id_usuario) || empty($fecha) || empty($hora) || empty($objetivo) || empty($resumen) || empty($resultados) || empty($aspectos_esperados) || empty($tareas) || empty($aspectos_trabajados) || empty($observaciones)) {
        die('Error: Todos los campos obligatorios deben ser completados.');
    }

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();

    // Escapa los datos para evitar inyección SQL
    $fecha = $link->real_escape_string($fecha);
    $hora = $link->real_escape_string($hora);
    $objetivo = $link->real_escape_string($objetivo);
    $resumen = $link->real_escape_string($resumen);
    $resultados = $link->real_escape_string($resultados);
    $aspectos_esperados = $link->real_escape_string($aspectos_esperados);
    $tareas = $link->real_escape_string($tareas);
    $aspectos_trabajados = $link->real_escape_string($aspectos_trabajados);
    $observaciones = $link->real_escape_string($observaciones);
    $fecha_proxima = $fecha_proxima ? $link->real_escape_string($fecha_proxima) : NULL;

    // Inserta la nueva nota en la tabla notas_consejeria
    $sql_insert = "INSERT INTO notas_consejeria (fecha, hora, objetivo, resumen, resultados, aspectos_esperados, tareas, aspectos_trabajados, observaciones, fecha_proxima, id_paciente, id_usuario) 
                   VALUES ('$fecha', '$hora', '$objetivo', '$resumen', '$resultados', '$aspectos_esperados', '$tareas', '$aspectos_trabajados', '$observaciones', " . ($fecha_proxima ? "'$fecha_proxima'" : "NULL") . ", $id_paciente, $id_usuario)";

    if ($link->query($sql_insert) === TRUE) {
        // La inserción fue exitosa
        header("Location: ../notas-consejeria-apoyo.php?id_paciente=$id_paciente"); // Redirecciona a la página de notas del paciente
        exit();
    } else {
        // Ocurrió un error en la inserción
        die('Error al insertar la nota en la base de datos: ' . $link->error);
    }

    // Cierra la conexión a la base de datos
    $link->close();
} else {
    // Si no se reciben datos por POST, redirecciona a alguna página de error o vuelve atrás
    header("Location: ../index.php"); // Cambia "index.php" por la página a la que quieras redireccionar
    exit();
}
?>
