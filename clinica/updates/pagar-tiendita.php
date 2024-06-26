<?php
require "../global.php";

// Verificar si la solicitud es POST para procesar los datos
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos enviados por POST
    $total_no_pagado = isset($_POST['total_no_pagado']) ? floatval($_POST['total_no_pagado']) : 0;
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';

    // Conectar a la base de datos
    $link = bases();

    // Iniciar transacción
    mysqli_autocommit($link, false);

    // Operación 1: Actualizar estatus de las órdenes a 'Pagado'
    $sql_update_ordenes = "UPDATE ordenes SET estatus = 'Pagado' WHERE id_paciente = $id_paciente AND estatus = 'No Pagado'";
    if (!$link->query($sql_update_ordenes)) {
        echo "Error actualizando órdenes: " . $link->error;
        mysqli_rollback($link);
        exit;
    }

    // Operación 2: Actualizar el saldo del paciente
    $sql_saldo_actual = "SELECT saldo FROM pacientes WHERE id_paciente = $id_paciente";
    $resultado_saldo_actual = $link->query($sql_saldo_actual);
    if ($resultado_saldo_actual->num_rows > 0) {
        $saldo_actual = $resultado_saldo_actual->fetch_assoc()['saldo'];
        $nuevo_saldo = $saldo_actual - $total_no_pagado;

        $sql_actualizar_saldo = "UPDATE pacientes SET saldo = $nuevo_saldo WHERE id_paciente = $id_paciente";
        if (!$link->query($sql_actualizar_saldo)) {
            echo "Error actualizando saldo del paciente: " . $link->error;
            mysqli_rollback($link);
            exit;
        }
    } else {
        echo "No se encontró el paciente con ID: $id_paciente";
        mysqli_rollback($link);
        exit;
    }

    // Operación 3: Insertar registro en la tabla pago_paciente
    $monto = $total_no_pagado;
    $total = $total_no_pagado;
    $fecha_hoy = date("Y-m-d H:i:s");
    $forma_pago = 'Saldo'; // asumiendo que siempre es pago con saldo en este contexto

    $sql_insert_pago = "INSERT INTO pago_paciente (monto, descuento, total, comprobante, numero_pago, fecha_agregado, fecha_pagado, periodicidad, observaciones, nota, forma_pago, estatus, archivado, id_paciente, id_usuario) 
                        VALUES ($monto, 0, $total, '', '', '$fecha_hoy', '$fecha_hoy', '', '$observaciones', '', '$forma_pago', 'Pagado', 'no', $id_paciente, $id_usuario)";
    
    if (!$link->query($sql_insert_pago)) {
        echo "Error insertando pago del paciente: " . $link->error;
        mysqli_rollback($link);
        exit;
    }

    // Confirmar todas las operaciones si no hay errores
    mysqli_commit($link);

    // Cerrar conexión
    mysqli_close($link);

    // Redireccionar a la página tiendita_paciente.php con el id_paciente correspondiente
    header("Location: ../tiendita_paciente.php?id_paciente=$id_paciente");
    exit;
} else {
    // Si no es POST, redirigir a una página de error o mostrar un mensaje
    die('Método de solicitud no válido');
}
?>
