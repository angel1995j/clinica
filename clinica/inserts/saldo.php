<?php
// Conecta a la base de datos
require('../global.php');
$link = bases();

$id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
$id_usuario = isset($_SESSION['id_usuario']) ? intval($_SESSION['id_usuario']) : 0;

// Recupera los datos del formulario
$monto = $_POST['monto'];
$comprobante = $_FILES['comprobante'];
$fecha_agregado = isset($_POST['fecha_agregado']) ? $_POST['fecha_agregado'] : date('Y-m-d');
$fecha_pagado = $_POST['fecha_pagado'];
$observaciones = $_POST['observaciones'];
$estatus = $_POST['estatus'];
$forma_pago = $_POST['forma_pago'];
$archivado = 'no';

// Manejo del archivo del comprobante
$comprobante_nombre = '';
if ($comprobante['size'] > 0) {
    $target_dir = "../uploads/";
    $comprobante_nombre = basename($comprobante["name"]);
    $target_file = $target_dir . $comprobante_nombre;
    move_uploaded_file($comprobante["tmp_name"], $target_file);
}

// Inserta el registro en la base de datos
$sql_insert = "INSERT INTO historial_saldo (monto, comprobante, fecha_agregado, fecha_pagado, observaciones, forma_pago, estatus, archivado, id_paciente) 
               VALUES ('$monto', '$comprobante_nombre', '$fecha_agregado', '$fecha_pagado', '$observaciones', '$forma_pago', '$estatus', '$archivado', '$id_paciente')";

if ($link->query($sql_insert) === TRUE) {
    // Obtener el saldo actual del paciente
    $sql_saldo = "SELECT saldo FROM pacientes WHERE id_paciente = $id_paciente";
    $resultado_saldo = $link->query($sql_saldo);
    if ($resultado_saldo->num_rows > 0) {
        $saldo_row = $resultado_saldo->fetch_assoc();
        $saldo_actual = $saldo_row['saldo'];

        // Calcular el nuevo saldo
        $nuevo_saldo = $saldo_actual + $monto;

        // Actualizar el saldo del paciente en la tabla pacientes
        $sql_update_saldo = "UPDATE pacientes SET saldo = $nuevo_saldo WHERE id_paciente = $id_paciente";
        if ($link->query($sql_update_saldo) === TRUE) {
            echo "Saldo actualizado exitosamente";
        } else {
            echo "Error al actualizar el saldo: " . $link->error;
        }
    } else {
        echo "Paciente no encontrado";
    }

    // Redirecciona a la página principal o muestra un mensaje de éxito
    header("Location: ../saldo.php?id_paciente=$id_paciente");
} else {
    echo "Error al insertar el saldo: " . $link->error;
}

// Cierra la conexión a la base de datos
$link->close();
?>
