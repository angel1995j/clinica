<?php
require('../global.php');

// Verifica si se enviaron datos por POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Conecta a la base de datos
    $link = bases();

    // Recupera los datos del formulario
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $aPaterno = isset($_POST['aPaterno']) ? $_POST['aPaterno'] : '';
    $aMaterno = isset($_POST['aMaterno']) ? $_POST['aMaterno'] : '';
    $fechaNacimiento = isset($_POST['fechaNacimiento']) ? $_POST['fechaNacimiento'] : '';
    $sexo = isset($_POST['sexo']) ? $_POST['sexo'] : '';
    $edad = isset($_POST['edad']) ? intval($_POST['edad']) : 0;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : '';
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : '';
    $nacionalidad = isset($_POST['nacionalidad']) ? $_POST['nacionalidad'] : '';
    $ocupacion = isset($_POST['ocupacion']) ? $_POST['ocupacion'] : '';
    $ingresosPrevios = isset($_POST['ingresosPrevios']) ? $_POST['ingresosPrevios'] : '';
    $fechasIngresosPrevios = isset($_POST['fechasIngresosPrevios']) ? $_POST['fechasIngresosPrevios'] : '';
    $institucionRefiere = isset($_POST['institucionRefiere']) ? $_POST['institucionRefiere'] : '';
    $nombreReferencia = isset($_POST['nombreReferencia']) ? $_POST['nombreReferencia'] : '';
    $fechaIngreso = isset($_POST['fechaIngreso']) ? $_POST['fechaIngreso'] : '';
    $horaIngreso = isset($_POST['horaIngreso']) ? $_POST['horaIngreso'] : '';
    $hojaReferencia = isset($_POST['hojaReferencia']) ? $_POST['hojaReferencia'] : '';
    $tipoIngreso = isset($_POST['tipoIngreso']) ? $_POST['tipoIngreso'] : '';
    $revisionFisicaGeneral = isset($_POST['revisionFisicaGeneral']) ? $_POST['revisionFisicaGeneral'] : '';
    $vestimentaIngreso = isset($_POST['vestimentaIngreso']) ? $_POST['vestimentaIngreso'] : '';
    $pertenenciasIngreso = isset($_POST['pertenenciasIngreso']) ? $_POST['pertenenciasIngreso'] : '';
    $ultimoConsumo = isset($_POST['ultimoConsumo']) ? $_POST['ultimoConsumo'] : '';
    $intoxicado = isset($_POST['intoxicado']) ? $_POST['intoxicado'] : '';
    $estatus = isset($_POST['estatus']) ? intval($_POST['estatus']) : 0;
    $nombreFamiliar = isset($_POST['nombreFamiliar']) ? $_POST['nombreFamiliar'] : '';
    $edadFamiliar = isset($_POST['edadFamiliar']) ? $_POST['edadFamiliar'] : '';
    $ocupacionFamiliar = isset($_POST['ocupacionFamiliar']) ? $_POST['ocupacionFamiliar'] : '';
    $parentescoFamiliar = isset($_POST['parentescoFamiliar']) ? $_POST['parentescoFamiliar'] : '';
    $direccionFamiliar = isset($_POST['direccionFamiliar']) ? $_POST['direccionFamiliar'] : '';
    $identificacionFamiliar = isset($_POST['identificacionFamiliar']) ? $_POST['identificacionFamiliar'] : '';
    $correoFamiliar = isset($_POST['correoFamiliar']) ? $_POST['correoFamiliar'] : '';
    $telefonoFamiliar = isset($_POST['telefonoFamiliar']) ? $_POST['telefonoFamiliar'] : '';
    $sustanciaPsicoactiva = isset($_POST['sustanciaPsicoactiva']) ? $_POST['sustanciaPsicoactiva'] : '';
    $tiempoSustanciaPsicoactiva = isset($_POST['tiempoSustanciaPsicoactiva']) ? $_POST['tiempoSustanciaPsicoactiva'] : '';
    $enfermedades = isset($_POST['enfermedades']) ? $_POST['enfermedades'] : '';
    $hospitalizacionesRecientes = isset($_POST['hospitalizacionesRecientes']) ? $_POST['hospitalizacionesRecientes'] : '';
    $centroReclusion = isset($_POST['centroReclusion']) ? $_POST['centroReclusion'] : '';
    $asistenciaGrupos = isset($_POST['asistenciaGrupos']) ? $_POST['asistenciaGrupos'] : '';
    $restriccionesConsumo = isset($_POST['restriccionesConsumo']) ? $_POST['restriccionesConsumo'] : '';

    // Actualiza los datos del paciente en la base de datos
    $sql_update = "UPDATE pacientes SET 
                    nombre='$nombre', 
                    aPaterno='$aPaterno', 
                    aMaterno='$aMaterno', 
                    fechaNacimiento='$fechaNacimiento', 
                    sexo='$sexo', 
                    edad=$edad, 
                    direccion='$direccion', 
                    telefono='$telefono', 
                    nacionalidad='$nacionalidad', 
                    ocupacion='$ocupacion', 
                    ingresosPrevios='$ingresosPrevios', 
                    fechasIngresosPrevios='$fechasIngresosPrevios', 
                    institucionRefiere='$institucionRefiere', 
                    nombreReferencia='$nombreReferencia', 
                    fechaIngreso='$fechaIngreso', 
                    horaIngreso='$horaIngreso', 
                    hojaReferencia='$hojaReferencia', 
                    tipoIngreso='$tipoIngreso', 
                    revisionFisicaGeneral='$revisionFisicaGeneral', 
                    vestimentaIngreso='$vestimentaIngreso', 
                    pertenenciasIngreso='$pertenenciasIngreso', 
                    ultimoConsumo='$ultimoConsumo', 
                    intoxicado='$intoxicado', 
                    estatus=$estatus, 
                    nombreFamiliar='$nombreFamiliar', 
                    edadFamiliar='$edadFamiliar', 
                    ocupacionFamiliar='$ocupacionFamiliar', 
                    parentescoFamiliar='$parentescoFamiliar', 
                    direccionFamiliar='$direccionFamiliar', 
                    identificacionFamiliar='$identificacionFamiliar', 
                    correoFamiliar='$correoFamiliar', 
                    telefonoFamiliar='$telefonoFamiliar', 
                    sustanciaPsicoactiva='$sustanciaPsicoactiva', 
                    tiempoSustanciaPsicoactiva='$tiempoSustanciaPsicoactiva', 
                    enfermedades='$enfermedades', 
                    hospitalizacionesRecientes='$hospitalizacionesRecientes', 
                    centroReclusion='$centroReclusion', 
                    asistenciaGrupos='$asistenciaGrupos', 
                    restriccionesConsumo='$restriccionesConsumo' 
                    WHERE id_paciente=$id_paciente";

    if ($link->query($sql_update) === TRUE) {
        echo "Registro actualizado correctamente.";
        header("Location: ../perfil.php?id_paciente=$id_paciente");
    } else {
        echo "Error al actualizar el registro: " . $link->error;
    }

    // Cierra la conexión a la base de datos
    $link->close();
} else {
    // Si no se enviaron datos por POST, redirige a la página principal o muestra un mensaje de error
    header('Location: index.php');
    exit();
}
?>
