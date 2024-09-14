<?php
require "../global.php";
$link = bases();

// Verifica si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa el formulario de actualización
    $id_pago = $_POST['id_pago'];
    $monto = $_POST['monto'];
    $descuento = $_POST['descuento'];
    $total = $_POST['total'];
    $numero_pago = $_POST['numero_pago'];
    $fecha_agregado = $_POST['fecha_agregado'];
    $fecha_pagado = $_POST['fecha_pagado'];
    $observaciones = $_POST['observaciones'];
    $nota = $_POST['nota']; // Nuevo campo nota
    $estatus = $_POST['estatus'];
    $forma_pago = $_POST['forma_pago']; // Nuevo campo forma_pago

    $id_paciente = $_POST['id_paciente'];

    // Obtén el ID del usuario desde la sesión (asumido aquí como $_SESSION['id_usuario'])
    session_start();
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de ajustar según cómo almacenes el ID del usuario en la sesión

    // Manejo de la imagen
    $carpetaDestino = '../assets/images/comprobantes/';
    $nombreArchivo = $_FILES['comprobante']['name'];
    $rutaArchivo = $carpetaDestino . $nombreArchivo;
    move_uploaded_file($_FILES['comprobante']['tmp_name'], $rutaArchivo);

    // Validación de forma de pago con saldo disponible
    if ($forma_pago == 'Saldo') {
        // Consulta para obtener el saldo del paciente
        $sql_saldo = "SELECT saldo FROM pacientes WHERE id_paciente = (SELECT id_paciente FROM pago_paciente WHERE id_pago = $id_pago)";
        $resultado_saldo = $link->query($sql_saldo);
        if ($resultado_saldo->num_rows > 0) {
            $saldo_paciente = $resultado_saldo->fetch_assoc()['saldo'];
            // Verifica si el saldo es suficiente para cubrir el monto del pago
            if ($saldo_paciente < $total) {
                echo "El saldo disponible no es suficiente para pagar el monto total del pago.";
                exit; // Termina la ejecución del script si el saldo no es suficiente
            } else {
                // Restar el monto del saldo del paciente
                $nuevo_saldo = $saldo_paciente - $total;
                // Actualizar el saldo del paciente en la tabla
                $sql_actualizar_saldo = "UPDATE pacientes SET saldo = $nuevo_saldo WHERE id_paciente = (SELECT id_paciente FROM pago_paciente WHERE id_pago = $id_pago)";
                if ($link->query($sql_actualizar_saldo) !== TRUE) {
                    echo "Error al actualizar el saldo del paciente: " . $link->error;
                    exit; // Termina la ejecución del script si hay un error al actualizar el saldo
                }
            }
        } else {
            echo "No se encontró el saldo del paciente.";
            exit; // Termina la ejecución del script si no se encuentra el saldo del paciente
        }
    }

    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen, el nuevo campo forma_pago y el ID del usuario
    $sql_actualizar = "UPDATE pago_paciente 
                      SET monto = '$monto', 
                          descuento = '$descuento', 
                          total = '$total', 
                          comprobante = '$nombreArchivo', 
                          fecha_agregado = '$fecha_agregado', 
                          fecha_pagado = '$fecha_pagado', 
                          observaciones = '$observaciones', 
                          nota = '$nota', 
                          estatus = '$estatus',
                          forma_pago = '$forma_pago',
                          id_usuario = '$id_usuario' 
                      WHERE id_pago = $id_pago";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Pago actualizado correctamente.";
        // Redirecciona al usuario a la página de pagos individuales del paciente
        header("Location: ../pagos-individual.php?id_paciente=$id_paciente");
    } else {
        echo "Error al actualizar el pago: " . $link->error;
    }
}
?>
