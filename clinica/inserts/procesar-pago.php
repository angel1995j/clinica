<?php
session_start();
require "../global.php";
$link = bases();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['carrito']) && count($_SESSION['carrito']) > 0 && isset($_POST['id_paciente'])) {
    $id_paciente = $_POST['id_paciente'];

    // Calcular el total de la orden
    $total_orden = 0;

    // Crear la orden
    $sql_insert_orden = "INSERT INTO ordenes (id_paciente, total) VALUES (?, ?)";
    $stmt_orden = $link->prepare($sql_insert_orden);
    $stmt_orden->bind_param("id", $id_paciente, $total_orden);
    $stmt_orden->execute();

    // Obtener el ID de la orden recién creada
    $id_orden = $stmt_orden->insert_id;

    // Insertar detalles de la orden
    foreach ($_SESSION['carrito'] as $item) {
        $id_producto = $item['id_producto'];
        $cantidad = $item['cantidad'];
        $precio_unitario = $item['precio_venta'];
        $subtotal = $cantidad * $precio_unitario;

        // Actualizar el total de la orden
        $total_orden += $subtotal;

        // Insertar detalle de la orden
        $sql_insert_detalle = "INSERT INTO detalles_orden (id_orden, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";
        $stmt_detalle = $link->prepare($sql_insert_detalle);
        $stmt_detalle->bind_param("iiidd", $id_orden, $id_producto, $cantidad, $precio_unitario, $subtotal);
        $stmt_detalle->execute();
    }

    // Actualizar el total de la orden después de insertar los detalles
    $sql_update_orden = "UPDATE ordenes SET total = ? WHERE id_orden = ?";
    $stmt_update_orden = $link->prepare($sql_update_orden);
    $stmt_update_orden->bind_param("di", $total_orden, $id_orden);
    $stmt_update_orden->execute();

    // Limpiar el carrito después de procesar el pago
    unset($_SESSION['carrito']);

    // Redireccionar o mostrar un mensaje de éxito
    header("Location: ../tiendita.php");
} else {
    echo "Error: Datos de pago inválidos. Comprueba que todos los campos requeridos estén completos.";
}

// Cerrar la conexión y liberar recursos
$stmt_orden->close();
$stmt_detalle->close();
$link->close();
?>
