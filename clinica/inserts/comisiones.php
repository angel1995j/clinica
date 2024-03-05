<?php
// Conexión a la base de datos
require('../global.php');
$link = bases();

// Recuperar datos del formulario
$concepto = $_POST['concepto'];
$total_venta = $_POST['total_venta'];
$porcentaje = $_POST['porcentaje'];
$estatus = $_POST['estatus'];
$archivado = $_POST['archivado'];
$fecha_venta = $_POST['fecha_venta'];
$fecha_pagado = $_POST['fecha_pagado'];
$id_usuario = $_POST['id_usuario'];

// Insertar datos en la tabla
$sql_insert = "INSERT INTO comisiones (concepto, total_venta, porcentaje, estatus, archivado, fecha_venta, fecha_pagado, id_usuario) 
               VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

if ($stmt = $link->prepare($sql_insert)) {
    // Vincular parámetros
    $stmt->bind_param("sddsssdi", $concepto, $total_venta, $porcentaje, $estatus, $archivado, $fecha_venta, $fecha_pagado, $id_usuario);

    // Ejecutar consulta
    if ($stmt->execute()) {
        echo "Comisión agregada correctamente";
        // Redireccionar a alguna página después de agregar
        header("Location: ../vendedores.php");
    } else {
        echo "Error al insertar datos: " . $stmt->error;
    }

    // Cerrar consulta preparada
    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $link->error;
}

// Cerrar conexión a la base de datos
$link->close();
?>
