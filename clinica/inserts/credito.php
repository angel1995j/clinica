<?php
// Incluir el archivo de conexión
require('../global.php');

// Obtener los datos del formulario
$id_paciente = $_POST['id_paciente'];
$nuevo_saldo = $_POST['saldo'];
$operacion = $_POST['operacion'];
$metodoPago = $_POST['metodoPago'];
$fecha_actualizacion = $_POST['fecha_actualizacion'];

// Realizar la inserción en la base de datos
$link = bases(); 

session_start();

// Obtener el id_usuario de la sesión actual
$id_usuario = $_SESSION['id_usuario'];


// Verificar si la conexión fue exitosa
if ($link) {
    // Obtener el saldo actual del paciente
    $consulta_saldo = "SELECT saldo FROM credito WHERE id_paciente = $id_paciente ORDER BY id_credito DESC LIMIT 1";
    $resultado_saldo = mysqli_query($link, $consulta_saldo);

    if ($resultado_saldo) {
        $fila_saldo = mysqli_fetch_assoc($resultado_saldo);
        $saldo_anterior = $fila_saldo['saldo'];

        // Ajustar el saldo según la operación
        if ($operacion == "Saldo a favor") {
            $nuevo_saldo = $saldo_anterior + $nuevo_saldo;

            // Crear la consulta SQL para insertar en la tabla pago_paciente
            $sql_pago = "INSERT INTO pago_paciente (monto, total, fecha_agregado, fecha_pagado, observaciones, forma_pago, estatus, archivado, id_paciente, id_usuario)
                         VALUES ('$nuevo_saldo', '$nuevo_saldo', CURDATE(), CURDATE(), 'Saldo a favor en tiendita', '$metodoPago', 'Pagado', 'No', '$id_paciente', '$id_usuario')";

            // Ejecutar la consulta de inserción en pago_paciente
            $result_pago = mysqli_query($link, $sql_pago);

            // Verificar si la inserción en pago_paciente fue exitosa
            if (!$result_pago) {
                // Manejar el error en caso de que la inserción falle
                echo "Error al insertar en la tabla pago_paciente: " . mysqli_error($link);
            }
        } elseif ($operacion == "Ajuste de saldo") {
            $nuevo_saldo = $saldo_anterior - $nuevo_saldo;
            // Puedes ajustar la lógica de acuerdo a tus necesidades específicas
        }

        // Escapar las variables para prevenir inyección de SQL
        $id_paciente = mysqli_real_escape_string($link, $id_paciente);
        $nuevo_saldo = mysqli_real_escape_string($link, $nuevo_saldo);
        $operacion = mysqli_real_escape_string($link, $operacion);
        $metodoPago = mysqli_real_escape_string($link, $metodoPago);
        $fecha_actualizacion = mysqli_real_escape_string($link, $fecha_actualizacion);

        // Crear la consulta SQL
        $sql = "INSERT INTO credito (id_paciente, saldo, operacion, metodoPago, fecha_actualizacion) VALUES ('$id_paciente', '$nuevo_saldo', '$operacion', '$metodoPago', '$fecha_actualizacion')";

        // Ejecutar la consulta
        $result = mysqli_query($link, $sql);

        // Verificar si la inserción fue exitosa
        if ($result) {
            // Redireccionar después de la inserción exitosa
            header("Location: ../tiendita_paciente.php?id_paciente=$id_paciente");
            exit();
        } else {
            // Manejar el error en caso de que la inserción falle
            echo "Error al insertar en la base de datos: " . mysqli_error($link);
        }
    } else {
        // Manejar el error en caso de que la consulta del saldo falle
        echo "Error al obtener el saldo actual: " . mysqli_error($link);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($link);
} else {
    // Manejar el error si la conexión no se estableció correctamente
    echo "Error al conectar a la base de datos.";
}
?>
