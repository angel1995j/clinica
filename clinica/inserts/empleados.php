<?php

// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera los datos del formulario con valores predeterminados si no están definidos
$nombre = $_POST['nombre'] ?? '';
$aPaterno = $_POST['aPaterno'] ?? '';
$aMaterno = $_POST['aMaterno'] ?? '';
$numero_telefono = $_POST['numero_telefono'] ?? NULL;
$fecha_ingreso = $_POST['fecha_ingreso'] ?? '';
$fecha_salida = $_POST['fecha_salida'] ?? NULL; // Puede ser NULL si el campo oculto está vacío
$puesto = $_POST['puesto'] ?? '';
$salario_bruto = $_POST['salario_bruto'] ?? NULL;
$salario_neto = $_POST['salario_neto'] ?? '';
$otros_conceptos = $_POST['otros_conceptos'] ?? '';
$monto_otros_conceptos = $_POST['monto_otros_conceptos'] ?? NULL;
$contactos = $_POST['contactos'] ?? '';
$domicilio = $_POST['domicilio'] ?? '';
$fecha_antidoping = $_POST['fecha_antidoping'] ?? NULL;
$referencias_laborales = $_POST['referencias_laborales'] ?? '';
$datos_familiares = $_POST['datos_familiares'] ?? '';
$archivado = $_POST['archivado'] ?? '';

// Inserta los datos en la tabla
$sql_insert = "INSERT INTO empleados (nombre, aPaterno, aMaterno, numero_telefono, fecha_ingreso, fecha_salida, puesto, salario_bruto, salario_neto, otros_conceptos, monto_otros_conceptos, archivado, contactos, domicilio, fecha_antidoping, referencias_laborales, datos_familiares) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Vincula los parámetros
    $stmt->bind_param(
        "ssssssssdssssssss",
        $nombre,
        $aPaterno,
        $aMaterno,
        $numero_telefono,
        $fecha_ingreso,
        $fecha_salida,
        $puesto,
        $salario_bruto,
        $salario_neto,
        $otros_conceptos,
        $monto_otros_conceptos,
        $archivado,
        $contactos,
        $domicilio,
        $fecha_antidoping,
        $referencias_laborales,
        $datos_familiares
    );

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Registro de empleado exitoso";
        header("Location: ../empleados.php");
    } else {
        echo "Error: " . $stmt->error;
    }

    // Cierra la consulta preparada
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $link->error;
}

// Cierra la conexión a la base de datos
$link->close();
?>
