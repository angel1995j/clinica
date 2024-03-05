<?php
// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera los datos del formulario
$nombreEncargado = $_POST['nombreEncargado'];
$personasApoyo = $_POST['personasApoyo'];
$municipioPaciente = $_POST['municipioPaciente'];
$marcaVehiculo = $_POST['marcaVehiculo'];
$tipoVehiculo = $_POST['tipoVehiculo'];
$modeloVehiculo = $_POST['modeloVehiculo'];
$placasVehiculo = $_POST['placasVehiculo'];
$direccionTraslado = isset($_POST['direccionTraslado']) ? $_POST['direccionTraslado'] : '';  // Asegura que $direccionTraslado esté definido
$costoTraslado = $_POST['costoTraslado'];
$costoTrasladoTexto = $_POST['costoTrasladoTexto'];

// Inserta los datos en la tabla
$sql_insert = "INSERT INTO traslado_paciente (nombreEncargado, personasApoyo, municipioPaciente, marcaVehiculo, tipoVehiculo, modeloVehiculo, placasVehiculo, direccionTraslado, costoTraslado, costoTrasladoTexto, id_paciente) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Vincula los parámetros
    $stmt->bind_param("ssssssssdds", $nombreEncargado, $personasApoyo, $municipioPaciente, $marcaVehiculo, $tipoVehiculo, $modeloVehiculo, $placasVehiculo, $direccionTraslado, $costoTraslado, $costoTrasladoTexto, $id_paciente);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro de traslado exitoso";
        header("Location: ../pago-paciente-vendedor.php?id_paciente=$id_paciente");
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
