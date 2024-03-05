<?php
session_start();

// Lógica para agregar productos al carrito
if (!isset($_SESSION["items_carrito"])) {
    $_SESSION["items_carrito"] = array();  // Inicializa la variable de sesión como un array vacío si no está definida
}

// Recuperar los datos del formulario en checkout.php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $vai_nom = $_GET["vai_nom"];
    $vai_cod = $_GET["vai_cod"];
    $txtcantidad = $_GET["txtcantidad"];
    $vai_pre = $_GET["vai_pre"];
    $item_price = $_GET["item_price"];
    $totcantidad = $_GET["totcantidad"];
    $totprecio = $_GET["totprecio"];

    // Obtener id_paciente de la URL
    $id_paciente = isset($_GET["id_paciente"]) ? intval($_GET["id_paciente"]) : 0;

    if ($id_paciente == 0) {
        die('ID del paciente no proporcionado');
    }

    // Puedes utilizar estos datos como desees, por ejemplo, insertar en la base de datos
    // o realizar otras operaciones.

    require('global.php');
    $link = bases();

    // Insertar en la tabla 'ordenes'
    $sqlOrdenes = "INSERT INTO ordenes (id_paciente, fecha_creacion, total) VALUES (?, NOW(), ?)";

    // Usar una declaración preparada para evitar la inyección de SQL
    $stmtOrdenes = $link->prepare($sqlOrdenes);

    if ($stmtOrdenes === false) {
        die('Error al preparar la consulta de ordenes: ' . $link->error);
    }

    // Vincular parámetros
    $stmtOrdenes->bind_param("id", $id_paciente, $total);

    // Asignar valores a los parámetros y ejecutar la inserción
    $total = $totprecio;

    if (!$stmtOrdenes->execute()) {
        die('Error al ejecutar la consulta de ordenes: ' . $stmtOrdenes->error);
    }

    // Obtener el ID de la orden recién insertada
    $id_orden = $stmtOrdenes->insert_id;

    // Insertar en la tabla 'detalles_orden' para cada ítem en el carrito
    foreach ($_SESSION["items_carrito"] as $item) {
        $sqlDetallesOrden = "INSERT INTO detalles_orden (id_orden, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";

        // Usar una declaración preparada para evitar la inyección de SQL
        $stmtDetallesOrden = $link->prepare($sqlDetallesOrden);

        if ($stmtDetallesOrden === false) {
            die('Error al preparar la consulta de detalles_orden: ' . $link->error);
        }

        // Vincular parámetros
        $stmtDetallesOrden->bind_param("iiidd", $id_orden, $id_producto, $cantidad, $precio_unitario, $subtotal);

        // Asignar valores a los parámetros y ejecutar la inserción
        $id_producto = $item["vai_cod"];
        $cantidad = $item["txtcantidad"];
        $precio_unitario = $item["vai_pre"];
        $subtotal = $item["txtcantidad"] * $item["vai_pre"];

        if (!$stmtDetallesOrden->execute()) {
            die('Error al ejecutar la consulta de detalles_orden: ' . $stmtDetallesOrden->error);
        }

        // Cerrar la declaración de detalles_orden
        $stmtDetallesOrden->close();
    }

    // Actualizar el valor total en la tabla 'ordenes'
    $sqlUpdateTotal = "UPDATE ordenes SET total = (SELECT SUM(subtotal) FROM detalles_orden WHERE id_orden = ?) WHERE id_orden = ?";
    $stmtUpdateTotal = $link->prepare($sqlUpdateTotal);

    if ($stmtUpdateTotal === false) {
        die('Error al preparar la consulta de actualización de total: ' . $link->error);
    }

    // Vincular parámetros
    $stmtUpdateTotal->bind_param("ii", $id_orden, $id_orden);

    // Ejecutar la actualización
    if (!$stmtUpdateTotal->execute()) {
        die('Error al ejecutar la consulta de actualización de total: ' . $stmtUpdateTotal->error);
    }

    // Cerrar la declaración de actualización de total
    $stmtUpdateTotal->close();

    // Obtener el último saldo de la tabla 'credito'
    $sqlObtenerSaldo = "SELECT saldo FROM credito WHERE id_paciente = ? ORDER BY id_credito DESC LIMIT 1";
    $stmtObtenerSaldo = $link->prepare($sqlObtenerSaldo);

    if ($stmtObtenerSaldo === false) {
        die('Error al preparar la consulta para obtener el último saldo de credito: ' . $link->error);
    }

    // Vincular parámetros
    $stmtObtenerSaldo->bind_param("i", $id_paciente);

    // Ejecutar la consulta para obtener el último saldo de credito
    if (!$stmtObtenerSaldo->execute()) {
        die('Error al ejecutar la consulta para obtener el último saldo de credito: ' . $stmtObtenerSaldo->error);
    }

    // Vincular el resultado
    $stmtObtenerSaldo->bind_result($saldoActual);

    // Obtener el resultado
    $stmtObtenerSaldo->fetch();

    // Cerrar la declaración de obtener el último saldo de credito
    $stmtObtenerSaldo->close();

    // Calcular el nuevo saldo restando el total
    $nuevoSaldo = $saldoActual - floatval($total); // Convertir $total a tipo float

    // Insertar un nuevo registro en la tabla 'credito' para reflejar la nueva operación y saldo
    $sqlInsertCredito = "INSERT INTO credito (id_paciente, saldo, fecha_actualizacion, operacion, metodoPago) VALUES (?, ?, NOW(), 'Compra', 'Tarjeta')";
    $stmtInsertCredito = $link->prepare($sqlInsertCredito);

    if ($stmtInsertCredito === false) {
        die('Error al preparar la consulta de inserción de crédito: ' . $link->error);
    }

    // Vincular parámetros
    $stmtInsertCredito->bind_param("id", $id_paciente, $nuevoSaldo);

    // Ejecutar la inserción
    if (!$stmtInsertCredito->execute()) {
        die('Error al ejecutar la consulta de inserción de crédito: ' . $stmtInsertCredito->error);
    }

    // Cerrar la declaración de inserción de crédito
    $stmtInsertCredito->close();

    // Cerrar la conexión
    $link->close();

    // Restablecer la variable de sesión del carrito después de la compra
    unset($_SESSION["items_carrito"]);

    // Enviar datos por POST a finalizarOrden.php
    $data = array(
        'id_orden' => $id_orden,
        'total' => $total
    );

    // Redireccionar a finalizarOrden.php
    header('Location: finalizarOrden.php?' . http_build_query($data));

    // Puedes realizar otras operaciones o redireccionar al usuario según tus necesidades.
}
?>
