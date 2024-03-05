<?php
require "header.php";
require "global.php";
$link = bases();

// Verificamos si se ha enviado una solicitud POST desde procesar_carrito.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'procesarOrden') {
    // Recuperamos los datos del carrito almacenados en la sesión
    $cartData = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];

    // Recuperamos otros datos necesarios (puedes adaptar esto según tu lógica)
    $idPaciente = isset($_POST['idPaciente']) ? $_POST['idPaciente'] : 0;

    // Iniciamos una transacción para garantizar la consistencia de la base de datos
    $link->begin_transaction();

    try {
        // Insertamos los datos en la tabla "ordenes"
        $fechaCreacion = date('Y-m-d H:i:s');
        $totalOrden = 0;

        foreach ($cartData as $item) {
            $totalOrden += ($item['price'] * $item['quantity']);
        }

        $sqlOrden = "INSERT INTO ordenes (id_paciente, fecha_creacion, total) VALUES (?, ?, ?)";
        $stmtOrden = $link->prepare($sqlOrden);
        $stmtOrden->bind_param("iss", $idPaciente, $fechaCreacion, $totalOrden);
        $stmtOrden->execute();

        // Obtenemos el ID de la orden recién insertada
        $idOrden = $stmtOrden->insert_id;

        // Insertamos los datos en la tabla "detalles_orden"
        foreach ($cartData as $item) {
            $subtotal = $item['price'] * $item['quantity'];

            $sqlDetalle = "INSERT INTO detalles_orden (id_orden, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
            $stmtDetalle = $link->prepare($sqlDetalle);
            $stmtDetalle->bind_param("iiidd", $idOrden, $item['id'], $item['quantity'], $item['price'], $subtotal);
            $stmtDetalle->execute();
        }

        // Confirmamos la transacción
        $link->commit();

        // Limpia el carrito después de procesar la orden
        unset($_SESSION['cart']);

        echo "Orden procesada con éxito. ID de la orden: $idOrden";
    } catch (Exception $e) {
        // Si ocurre algún error, revertimos la transacción
        $link->rollback();
        echo "Error al procesar la orden: " . $e->getMessage();
    }

    // Cerramos la conexión
    $link->close();
} else {
    // Si se intenta acceder directamente a esta página sin datos de carrito, redirigir a algún lugar adecuado
    header("Location: alguna_pagina.php");
    exit();
}

require "footer.php";
?>
