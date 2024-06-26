<?php
session_start();

require_once("../global.php");

// Verificar si se enviaron datos mediante POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recuperar datos del carrito de compras
    $vai_nom = isset($_POST["vai_nom"]) ? $_POST["vai_nom"] : array();
    $vai_cod = isset($_POST["vai_cod"]) ? $_POST["vai_cod"] : array();
    $txtcantidad = isset($_POST["txtcantidad"]) ? $_POST["txtcantidad"] : array();
    $vai_pre = isset($_POST["vai_pre"]) ? $_POST["vai_pre"] : array();
    $totprecio = isset($_POST["totprecio"]) ? str_replace(',', '', $_POST["totprecio"]) : 0;  // Remover comas del totprecio

    // Datos adicionales
    $id_paciente = isset($_POST["id_paciente"]) ? $_POST["id_paciente"] : 0;
    $concepto = isset($_POST["concepto"]) ? $_POST["concepto"] : "Consumo de medicamento";

    // Otros datos que pueden ser necesarios
    $id_usuario = $_SESSION["id_usuario"];  // Asegúrate de tener este dato en la sesión

    // Concatenar los textos del array vai_nom en un solo string
    $detalles = implode(", ", $vai_nom);

    // Insertar datos en la tabla consumo
    $link = bases();

    // Obtener la fecha actual
    $fecha_consumo = date("Y-m-d H:i:s");

    // Preparar la consulta SQL para la tabla consumo
    $sql = "INSERT INTO consumo (concepto, monto, fecha_consumo, detalles, id_paciente, id_usuario) VALUES (?, ?, ?, ?, ?, ?)";

    // Preparar y ejecutar la declaración
    $stmt = $link->prepare($sql);

    if ($stmt) {
        // Vincular los parámetros
        $stmt->bind_param("sdssii", $concepto, $totprecio, $fecha_consumo, $detalles, $id_paciente, $id_usuario);

        // Ejecutar la consulta
        if ($stmt->execute()) {
            // Obtener el ID del consumo recién insertado
            $id_consumo = $stmt->insert_id;

            // Actualizar el stock de productos y manejar los detalles del consumo
            for ($i = 0; $i < count($vai_cod); $i++) {
                // Actualizar el stock en la tabla productos
                $sql_update_stock = "UPDATE productos SET stock = stock - ? WHERE id_producto = ?";
                $stmt_update_stock = $link->prepare($sql_update_stock);

                if ($stmt_update_stock) {
                    $stmt_update_stock->bind_param("ii", $txtcantidad[$i], $vai_cod[$i]);
                    $stmt_update_stock->execute();
                    $stmt_update_stock->close();
                }

                // Insertar los detalles del consumo
                $sql_detalle = "INSERT INTO consumo_detalle (id_consumo, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
                $stmt_detalle = $link->prepare($sql_detalle);

                if ($stmt_detalle) {
                    $stmt_detalle->bind_param("iiid", $id_consumo, $vai_cod[$i], $txtcantidad[$i], $vai_pre[$i]);
                    $stmt_detalle->execute();
                    $stmt_detalle->close();
                }
            }

            // Insertar un nuevo registro en la tabla pago_paciente
            $sql_pago = "INSERT INTO pago_paciente (monto, descuento, total, comprobante, numero_pago, fecha_agregado, fecha_pagado, periodicidad, observaciones, nota, forma_pago, estatus, archivado, id_paciente, id_usuario) VALUES (?, 0, ?, '', '', ?, ?, '', 'medicamento', ?, '', 'No Pagado', 'no', ?, ?)";
            $stmt_pago = $link->prepare($sql_pago);

            if ($stmt_pago) {
                $stmt_pago->bind_param("ddsssii", $totprecio, $totprecio, $fecha_consumo, $fecha_consumo, $detalles, $id_paciente, $id_usuario);
                $stmt_pago->execute();
                $stmt_pago->close();
            }

            // Redirigir según el id_usuario
            if ($id_usuario == 1) {
                header("Location: ../medicina.php");
            } else {
                header("Location: ../medicina-recepcion.php");
            }
            exit;
        } else {
            echo "Error al ejecutar la consulta: " . $stmt->error;
        }

        // Cerrar la declaración
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta: " . $link->error;
    }

    // Cerrar la conexión
    $link->close();
} else {
    // Si no hay datos en POST, redirigir según el id_usuario
    if ($_SESSION["id_usuario"] == 1) {
        header("Location: ../medicina.php");
    } else {
        header("Location: ../medicina-recepcion.php");
    }
    exit;
}
?>
