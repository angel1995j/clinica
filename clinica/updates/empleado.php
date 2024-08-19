<?php
// Incluye el archivo global.php
require('../global.php');

// Conecta a la base de datos
$link = bases();

// Recupera los datos del formulario
$id_empleado = $_POST['id_empleado'];
$nombre = $_POST['nombre'];
$aPaterno = $_POST['aPaterno'];
$aMaterno = $_POST['aMaterno'];
$numero_telefono = $_POST['numero_telefono'];
$fecha_ingreso = $_POST['fecha_ingreso'];
$fecha_salida = isset($_POST['fecha_salida']) ? $_POST['fecha_salida'] : '';
$puesto = $_POST['puesto'];
$salario_neto = $_POST['salario_neto'];
$otros_conceptos = $_POST['otros_conceptos'];
$monto_otros_conceptos = $_POST['monto_otros_conceptos'];
$archivado = $_POST['archivado'];
$contactos = $_POST['contactos'];
$datos_familiares = $_POST['datos_familiares'];
$domicilio = $_POST['domicilio'];
$fecha_antidoping = $_POST['fecha_antidoping'];
$referencias_laborales = $_POST['referencias_laborales'];

// Actualiza los datos en la tabla
$sql_update = "UPDATE empleados SET 
               nombre = ?,
               aPaterno = ?,
               aMaterno = ?,
               numero_telefono = ?,
               fecha_ingreso = ?,
               fecha_salida = ?,
               puesto = ?,
               salario_neto = ?,
               otros_conceptos = ?,
               monto_otros_conceptos = ?,
               archivado = ?,
               contactos = ?,
               datos_familiares = ?,
               domicilio = ?,
               fecha_antidoping = ?,
               referencias_laborales = ?
               WHERE id_empleado = ?";

if ($stmt = $link->prepare($sql_update)) {
    // Vincula los parámetros
    $stmt->bind_param("ssssssssdsssssssi", $nombre, $aPaterno, $aMaterno, $numero_telefono, $fecha_ingreso, $fecha_salida, $puesto, $salario_neto, $otros_conceptos, $monto_otros_conceptos, $archivado, $contactos, $datos_familiares, $domicilio, $fecha_antidoping, $referencias_laborales, $id_empleado);

    // Ejecuta la consulta
    if ($stmt->execute()) {
        echo "Actualización de empleado exitosa";
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
