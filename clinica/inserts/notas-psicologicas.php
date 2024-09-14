<?php
// Verifica si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los datos del formulario
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $hora = isset($_POST['hora']) ? $_POST['hora'] : '';
    $no_exp = isset($_POST['no_exp']) ? $_POST['no_exp'] : '';
    $objetivo = isset($_POST['objetivo']) ? $_POST['objetivo'] : '';
    $resumen = isset($_POST['resumen']) ? $_POST['resumen'] : '';
    $resultados = isset($_POST['resultados']) ? $_POST['resultados'] : '';
    $actividades = isset($_POST['actividades']) ? $_POST['actividades'] : '';
    $plan = isset($_POST['plan']) ? $_POST['plan'] : '';
    $fecha_proxima = isset($_POST['fecha_proxima']) ? $_POST['fecha_proxima'] : NULL;
    $cedula = isset($_POST['cedula']) ? $_POST['cedula'] : '';
    $nombre_psicologo = isset($_POST['nombre_psicologo']) ? $_POST['nombre_psicologo'] : '';

    // Valida que los campos obligatorios no estén vacíos
    if (empty($id_paciente) || empty($id_usuario) || empty($fecha) || empty($hora) || empty($no_exp) || empty($objetivo) || empty($resumen) || empty($resultados) || empty($actividades) || empty($plan)) {
        die('Error: Todos los campos obligatorios deben ser completados.');
    }

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();

    // Escapa los datos para evitar inyección SQL
    $fecha = $link->real_escape_string($fecha);
    $hora = $link->real_escape_string($hora);
    $no_exp = $link->real_escape_string($no_exp);
    $objetivo = $link->real_escape_string($objetivo);
    $resumen = $link->real_escape_string($resumen);
    $resultados = $link->real_escape_string($resultados);
    $actividades = $link->real_escape_string($actividades);
    $plan = $link->real_escape_string($plan);
    $cedula = $link->real_escape_string($cedula);
    $nombre_psicologo = $link->real_escape_string($nombre_psicologo);
    $fecha_proxima = $fecha_proxima ? $link->real_escape_string($fecha_proxima) : NULL;

    // Inserta la nueva nota en la tabla notas_psicologicas
    $sql_insert = "INSERT INTO notas_psicologicas (fecha, hora, no_exp, objetivo, resumen, resultados, actividades, plan, fecha_proxima, cedula, nombre_psicologo, id_paciente, id_usuario) 
                   VALUES ('$fecha', '$hora', '$no_exp', '$objetivo', '$resumen', '$resultados', '$actividades', '$plan', " . ($fecha_proxima ? "'$fecha_proxima'" : "NULL") . ", '$cedula', '$nombre_psicologo', $id_paciente, $id_usuario)";

    if ($link->query($sql_insert) === TRUE) {
        // La inserción fue exitosa
        header("Location: ../notas-psicologicas-apoyo.php?id_paciente=$id_paciente"); // Redirecciona a la página del perfil del paciente
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
