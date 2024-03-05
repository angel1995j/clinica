<?php
//require "../header.php";
require "../global.php";

$link = bases();

// Recupera el ID del paciente desde POST
$id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Consulta para obtener datos existentes de la historia_clinica
$sqlConsulta = "SELECT * FROM historia_clinica WHERE id_paciente = $id_paciente";
$resultadoConsulta = $link->query($sqlConsulta);
$datosHistoriaClinica = $resultadoConsulta->fetch_assoc();

// Verifica si ya existe una entrada en la tabla historia_clinica para este paciente
$sqlVerificar = "SELECT * FROM historia_clinica WHERE id_paciente = $id_paciente";
$resultadoVerificar = $link->query($sqlVerificar);

if ($resultadoVerificar->num_rows > 0) {
    // Ya existe una entrada, realiza un UPDATE
    $sqlUpdate = "UPDATE historia_clinica SET
        alergias = '{$_POST['alergias']}',
        operaciones_previas = '{$_POST['operaciones']}',
        diagnostico = '{$_POST['diagnostico']}',
        tratamiento = '{$_POST['tratamiento']}',
        resultados_bioquimica = '{$_POST['bioquimica']}',
        hospitalizaciones_previas = '{$_POST['hospitalizaciones']}',
        padecimientos_actuales = '{$_POST['padecimientos']}',
        historia_familiar_enfermedades = '{$_POST['historiaFamiliar']}'
    WHERE id_paciente = $id_paciente";

    $resultadoUpdate = $link->query($sqlUpdate);

    if (!$resultadoUpdate) {
        die('Error al actualizar la historia clínica: ' . $link->error);
    }

    // Redirección en caso de actualización exitosa
    header("Location: ../perfil.php?id_paciente=$id_paciente");
    exit();
} else {
    // No existe una entrada, realiza un INSERT
    $sqlInsert = "INSERT INTO historia_clinica (
        id_paciente,
        alergias,
        operaciones_previas,
        diagnostico,
        tratamiento,
        resultados_bioquimica,
        hospitalizaciones_previas,
        padecimientos_actuales,
        historia_familiar_enfermedades
    ) VALUES (
        $id_paciente,
        '{$_POST['alergias']}',
        '{$_POST['operaciones']}',
        '{$_POST['diagnostico']}',
        '{$_POST['tratamiento']}',
        '{$_POST['bioquimica']}',
        '{$_POST['hospitalizaciones']}',
        '{$_POST['padecimientos']}',
        '{$_POST['historiaFamiliar']}'
    )";

    $resultadoInsert = $link->query($sqlInsert);

    if (!$resultadoInsert) {
        die('Error al insertar la historia clínica: ' . $link->error);
    }

    // Redirección en caso de inserción exitosa
    header("Location: ../perfil.php?id_paciente=$id_paciente");
    exit();
}
?>
