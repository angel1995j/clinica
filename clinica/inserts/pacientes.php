<?php
require('../global.php');
$link = bases();

$horaIngreso = $_POST['horaIngreso'];
$fechaIngreso = $_POST['fechaIngreso'];
$nombre = $_POST['nombre'];
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$sexo = $_POST['sexo'];
$fechaNacimiento = $_POST['fechaNacimiento'];
$edad = $_POST['edad'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$nacionalidad = $_POST['nacionalidad'];
$estadoCivil = $_POST['estadoCivil'];
$escolaridad = $_POST['escolaridad'];
$ocupacion = $_POST['ocupacion'];
$ingresosPrevios = $_POST['ingresosPrevios'];
$fechasIngresosPrevios = $_POST['fechasIngresosPrevios'];
$institucionRefiere = $_POST['institucionRefiere'];
$nombreReferencia = $_POST['nombreReferencia'];
$hojaReferencia = isset($_POST['hojaReferencia']) ? $_POST['hojaReferencia'] : "No";
$tipoIngreso = $_POST['tipoIngreso'];
$nombreFamiliar = $_POST['nombreFamiliar'];
$edadFamiliar = $_POST['edadFamiliar'];
$ocupacionFamiliar = $_POST['ocupacionFamiliar'];
$parentescoFamiliar = $_POST['parentescoFamiliar'];
$direccionFamiliar = $_POST['direccionFamiliar'];
$identificacionFamiliar = $_POST['identificacionFamiliar'];
$correoFamiliar = $_POST['correoFamiliar'];
$telefonoFamiliar = $_POST['telefonoFamiliar'];
$revisionFisicaGeneral = $_POST['revisionFisicaGeneral'];
$vestimentaIngreso = $_POST['vestimentaIngreso'];
$pertenenciasIngreso = $_POST['pertenenciasIngreso'];
$ultimoConsumo = $_POST['ultimoConsumo'];
$llegaIntoxicado = isset($_POST['llegaIntoxicado']) ? $_POST['llegaIntoxicado'] : "No";

$sustanciaPsicoactiva = $_POST['sustanciaPsicoactiva'];
$tiempoSustanciaPsicoactiva = $_POST['tiempoSustanciaPsicoactiva'];
$enfermedades = $_POST['enfermedades'];
$hospitalizacionesRecientes = $_POST['hospitalizacionesRecientes'];
$centroReclusion = $_POST['centroReclusion'];
$asistenciaGrupos = $_POST['asistenciaGrupos'];
$estatus = 1;

$codigoUnico = bin2hex(random_bytes(20));

$sql = "INSERT INTO pacientes (codigoUnico, horaIngreso, fechaIngreso, nombre, aPaterno, aMaterno, sexo, fechaNacimiento, edad, direccion, telefono, nacionalidad, estadoCivil, escolaridad, ocupacion, ingresosPrevios, fechasIngresosPrevios, institucionRefiere, nombreReferencia, hojaReferencia, tipoIngreso, revisionFisicaGeneral, vestimentaIngreso, pertenenciasIngreso, ultimoConsumo, intoxicado, nombreFamiliar, estatus, edadFamiliar, ocupacionFamiliar, parentescoFamiliar, direccionFamiliar, identificacionFamiliar, correoFamiliar, telefonoFamiliar, sustanciaPsicoactiva, tiempoSustanciaPsicoactiva, enfermedades, hospitalizacionesRecientes, centroReclusion, asistenciaGrupos, archivado) VALUES ('$codigoUnico', '$horaIngreso', '$fechaIngreso', '$nombre', '$aPaterno', '$aMaterno', '$sexo', '$fechaNacimiento', '$edad', '$direccion', '$telefono', '$nacionalidad', '$estadoCivil', '$escolaridad', '$ocupacion', '$ingresosPrevios', '$fechasIngresosPrevios', '$institucionRefiere', '$nombreReferencia', '$hojaReferencia', '$tipoIngreso', '$revisionFisicaGeneral', '$vestimentaIngreso', '$pertenenciasIngreso', '$ultimoConsumo', '$llegaIntoxicado', '$nombreFamiliar', '$estatus', '$edadFamiliar', '$ocupacionFamiliar', '$parentescoFamiliar', '$direccionFamiliar', '$identificacionFamiliar', '$correoFamiliar', '$telefonoFamiliar', '$sustanciaPsicoactiva', '$tiempoSustanciaPsicoactiva', '$enfermedades', '$hospitalizacionesRecientes', '$centroReclusion', '$asistenciaGrupos', 'No')";


$resultado = mysqli_query($link, $sql);

if ($resultado) {
    $id_paciente = mysqli_insert_id($link);
    header("Location: ../traslado-paciente.php?id_paciente=$id_paciente");
} else {
    echo "Error al insertar el registro: " . mysqli_error($link);
}

mysqli_close($link);
?>
