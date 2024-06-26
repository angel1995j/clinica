<?php

// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera los datos del formulario
$nombre = $_POST['nombre'];
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$numero_telefono = $_POST['numero_telefono'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : ''; 
$puesto = $_POST['puesto'];
$salario_bruto = $_POST['salario_bruto'];
$salario_neto = $_POST['salario_neto'];
$otros_conceptos = $_POST['otros_conceptos'];
$monto_otros_conceptos = $_POST['monto_otros_conceptos'];
$archivado = $_POST['archivado'];
$contactos = $_POST['contactos'];  // Nuevo campo

// Inserta los datos en la tabla
$sql_insert = "INSERT INTO empleados (nombre, aPaterno, aMaterno, numero_telefono, fecha_ingreso, fecha_salida, puesto, salario_bruto, salario_neto, otros_conceptos, monto_otros_conceptos, archivado, contactos) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Vincula los parámetros
    $stmt->bind_param("ssssssssdssss", $nombre, $aPaterno, $aMaterno, $numero_telefono, $fecha_ingreso, $fecha_salida, $puesto, $salario_bruto, $salario_neto, $otros_conceptos, $monto_otros_conceptos, $archivado, $contactos);

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
    echo "Error en la preparación de la consulta";
}

// Cierra la conexión a la base de datos
$link->close();
?>
