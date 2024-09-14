<?php
// Verifica si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recupera los datos del formulario
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $motivos_egreso = isset($_POST['motivos_egreso']) ? $_POST['motivos_egreso'] : '';
    $diagnostico_ingreso = isset($_POST['diagnostico_ingreso']) ? $_POST['diagnostico_ingreso'] : '';
    $periodo_internamiento = isset($_POST['periodo_internamiento']) ? $_POST['periodo_internamiento'] : '';
    $tratamiento_llevado_cabo = isset($_POST['tratamiento_llevado_cabo']) ? $_POST['tratamiento_llevado_cabo'] : '';
    $estudios_realizados = isset($_POST['estudios_realizados']) ? $_POST['estudios_realizados'] : '';
    $eeg = isset($_POST['eeg']) ? $_POST['eeg'] : '';
    $laboratorio = isset($_POST['laboratorio']) ? $_POST['laboratorio'] : '';
    $rx = isset($_POST['rx']) ? $_POST['rx'] : '';
    $pruebas_psicologicas = isset($_POST['pruebas_psicologicas']) ? $_POST['pruebas_psicologicas'] : '';
    $otros = isset($_POST['otros']) ? $_POST['otros'] : '';
    $evolucion_manejo_estancia = isset($_POST['evolucion_manejo_estancia']) ? $_POST['evolucion_manejo_estancia'] : '';
    $descripcion_estado_general = isset($_POST['descripcion_estado_general']) ? $_POST['descripcion_estado_general'] : '';
    $exploracion_fisica_egreso = isset($_POST['exploracion_fisica_egreso']) ? $_POST['exploracion_fisica_egreso'] : '';
    $problemas_clinicos_pendientes = isset($_POST['problemas_clinicos_pendientes']) ? $_POST['problemas_clinicos_pendientes'] : '';
    $recomendaciones_seguimiento = isset($_POST['recomendaciones_seguimiento']) ? $_POST['recomendaciones_seguimiento'] : '';
    $pronostico = isset($_POST['pronostico']) ? $_POST['pronostico'] : '';
    $observaciones_generales = isset($_POST['observaciones_generales']) ? $_POST['observaciones_generales'] : '';

    // Recupera las fechas y horas en formato JSON
    $fechas_horas = isset($_POST['fechas_horas']) ? $_POST['fechas_horas'] : [];

    // Valida que los campos obligatorios no estén vacíos
    if (empty($id_paciente) || empty($id_usuario) || empty($fecha) || empty($motivos_egreso) || empty($diagnostico_ingreso) || empty($periodo_internamiento) || empty($tratamiento_llevado_cabo) || empty($estudios_realizados) || empty($evolucion_manejo_estancia) || empty($descripcion_estado_general) || empty($exploracion_fisica_egreso) || empty($recomendaciones_seguimiento)) {
        die('Error: Todos los campos obligatorios deben ser completados.');
    }

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();

    // Escapa los datos para evitar inyección SQL
    $fecha = $link->real_escape_string($fecha);
    $motivos_egreso = $link->real_escape_string($motivos_egreso);
    $diagnostico_ingreso = $link->real_escape_string($diagnostico_ingreso);
    $periodo_internamiento = $link->real_escape_string($periodo_internamiento);
    $tratamiento_llevado_cabo = $link->real_escape_string($tratamiento_llevado_cabo);
    $estudios_realizados = $link->real_escape_string($estudios_realizados);
    $eeg = $link->real_escape_string($eeg);
    $laboratorio = $link->real_escape_string($laboratorio);
    $rx = $link->real_escape_string($rx);
    $pruebas_psicologicas = $link->real_escape_string($pruebas_psicologicas);
    $otros = $link->real_escape_string($otros);
    $evolucion_manejo_estancia = $link->real_escape_string($evolucion_manejo_estancia);
    $descripcion_estado_general = $link->real_escape_string($descripcion_estado_general);
    $exploracion_fisica_egreso = $link->real_escape_string($exploracion_fisica_egreso);
    $problemas_clinicos_pendientes = $link->real_escape_string($problemas_clinicos_pendientes);
    $recomendaciones_seguimiento = $link->real_escape_string($recomendaciones_seguimiento);
    $pronostico = $link->real_escape_string($pronostico);
    $observaciones_generales = $link->real_escape_string($observaciones_generales);
    
    // Convierte el array de fechas y horas a JSON
    $fechas_horas_json = $link->real_escape_string(json_encode($fechas_horas));

    // Inserta la nueva hoja de egreso en la tabla hojas_egreso
    $sql_insert = "INSERT INTO hojas_egreso (id_paciente, id_usuario, fecha, motivos_egreso, diagnostico_ingreso, periodo_internamiento, tratamiento_llevado_cabo, estudios_realizados, eeg, laboratorio, rx, pruebas_psicologicas, otros, evolucion_manejo_estancia, descripcion_estado_general, exploracion_fisica_egreso, problemas_clinicos_pendientes, recomendaciones_seguimiento, pronostico, observaciones_generales, fechas_horas) 
                   VALUES ($id_paciente, $id_usuario, '$fecha', '$motivos_egreso', '$diagnostico_ingreso', '$periodo_internamiento', '$tratamiento_llevado_cabo', '$estudios_realizados', '$eeg', '$laboratorio', '$rx', '$pruebas_psicologicas', '$otros', '$evolucion_manejo_estancia', '$descripcion_estado_general', '$exploracion_fisica_egreso', '$problemas_clinicos_pendientes', '$recomendaciones_seguimiento', '$pronostico', '$observaciones_generales', '$fechas_horas_json')";

    if ($link->query($sql_insert) === TRUE) {
        // La inserción fue exitosa
        header("Location: ../documentos-egreso-apoyo.php?id_paciente=$id_paciente"); // Redirecciona a la página de hojas de egreso
        exit();
    } else {
        // Ocurrió un error en la inserción
        die('Error al insertar la hoja de egreso en la base de datos: ' . $link->error);
    }

    // Cierra la conexión a la base de datos
    $link->close();
} else {
    // Si no se reciben datos por POST, redirecciona a alguna página de error o vuelve atrás
    header("Location: ../index.php"); // Cambia "index.php" por la página a la que quieras redireccionar
    exit();
}
?>
