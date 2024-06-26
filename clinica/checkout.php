<?php
session_start();

// Verificar si la solicitud es GET para procesar los datos del carrito desde checkout.php
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Verificar que todos los datos necesarios estén presentes en la solicitud GET
    if (!isset($_GET["vai_nom"]) || !isset($_GET["vai_cod"]) || !isset($_GET["txtcantidad"]) || !isset($_GET["vai_pre"]) || !isset($_GET["totprecio"]) || !isset($_GET["id_paciente"])) {
        die('Faltan parámetros necesarios para procesar la orden.');
    }

    // Obtener id_paciente de la URL
    $id_paciente = intval($_GET["id_paciente"]);

    if ($id_paciente == 0) {
        die('ID del paciente no proporcionado');
    }

    // Verificar la autenticación del usuario
    if (!isset($_SESSION['id_usuario'])) {
        die('Usuario no autenticado');
    }

    // Obtener el id_usuario de la sesión
    $id_usuario = $_SESSION['id_usuario'];

    // Incluir el archivo global.php y establecer la conexión a la base de datos
    require_once('global.php');
    $link = bases();

    // Recuperar datos del carrito
    $vai_nom = $_GET["vai_nom"];
    $vai_cod = $_GET["vai_cod"];
    $txtcantidad = $_GET["txtcantidad"];
    $vai_pre = $_GET["vai_pre"];
    $totprecio = floatval($_GET["totprecio"]);

    // Insertar en la tabla 'ordenes' con estatus 'No Pagado'
    $sqlOrdenes = "INSERT INTO ordenes (id_paciente, fecha_creacion, total, estatus) VALUES (?, NOW(), ?, 'No Pagado')";

    // Preparar la declaración SQL
    $stmtOrdenes = $link->prepare($sqlOrdenes);

    if ($stmtOrdenes === false) {
        die('Error al preparar la consulta de ordenes: ' . $link->error);
    }

    // Vincular parámetros
    $stmtOrdenes->bind_param("id", $id_paciente, $totprecio);

    // Asignar valor al parámetro y ejecutar la inserción
    if (!$stmtOrdenes->execute()) {
        die('Error al ejecutar la consulta de ordenes: ' . $stmtOrdenes->error);
    }

    // Obtener el ID de la orden recién insertada
    $id_orden = $stmtOrdenes->insert_id;

    // Cerrar la declaración de ordenes
    $stmtOrdenes->close();

    // Insertar en la tabla 'detalles_orden' para cada ítem en el carrito
    $num_items = count($vai_cod); // Obtener el número de ítems en el carrito
    for ($i = 0; $i < $num_items; $i++) {
        // Calcular el subtotal
        $subtotal = $txtcantidad[$i] * $vai_pre[$i];

        $sqlDetallesOrden = "INSERT INTO detalles_orden (id_orden, id_producto, cantidad, precio_unitario, subtotal) VALUES (?, ?, ?, ?, ?)";

        // Preparar la declaración SQL
        $stmtDetallesOrden = $link->prepare($sqlDetallesOrden);

        if ($stmtDetallesOrden === false) {
            die('Error al preparar la consulta de detalles_orden: ' . $link->error);
        }

        // Vincular parámetros
        $stmtDetallesOrden->bind_param("iiidd", $id_orden, $vai_cod[$i], $txtcantidad[$i], $vai_pre[$i], $subtotal);

        // Ejecutar la inserción
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

    // Obtener el crédito próximo con la fecha de fin más cercana
    $fecha_actual = date('Y-m-d');
    $sqlCreditosSimilares = "SELECT id_credito, saldo, fecha_fin FROM credito WHERE id_paciente = ? AND operacion = 'Generación de límite de crédito' AND fecha_fin > ? ORDER BY fecha_fin ASC LIMIT 1";
    $stmtCreditosSimilares = $link->prepare($sqlCreditosSimilares);

    if ($stmtCreditosSimilares === false) {
        die('Error al preparar la consulta de créditos similares: ' . $link->error);
    }

    // Vincular parámetros
    $stmtCreditosSimilares->bind_param("is", $id_paciente, $fecha_actual);

    // Ejecutar la consulta
    if (!$stmtCreditosSimilares->execute()) {
        die('Error al ejecutar la consulta de créditos similares: ' . $stmtCreditosSimilares->error);
    }

    // Vincular resultados
    $stmtCreditosSimilares->bind_result($id_credito, $saldo, $fecha_fin);

    // Obtener el crédito próximo
    if ($stmtCreditosSimilares->fetch()) {
        // Calcular el nuevo saldo restando el total de la compra del saldo del crédito próximo
        $nuevoSaldoProximo = $saldo - $totprecio;

        // Cerrar la declaración de créditos similares
        $stmtCreditosSimilares->close();

        // Actualizar el saldo del crédito próximo en la base de datos
        $sqlActualizarCreditoProximo = "UPDATE credito SET saldo = ? WHERE id_credito = ?";
        $stmtActualizarCreditoProximo = $link->prepare($sqlActualizarCreditoProximo);

        if ($stmtActualizarCreditoProximo === false) {
            die('Error al preparar la consulta de actualización de crédito próximo: ' . $link->error);
        }

        // Vincular parámetros
        $stmtActualizarCreditoProximo->bind_param("di", $nuevoSaldoProximo, $id_credito);

        // Ejecutar la actualización
        if (!$stmtActualizarCreditoProximo->execute()) {
            die('Error al ejecutar la consulta de actualización de crédito próximo: ' . $stmtActualizarCreditoProximo->error);
        }

        // Cerrar la declaración de actualización de crédito próximo
        $stmtActualizarCreditoProximo->close();
    } else {
        // Si no se encontró un crédito próximo válido
        die('No se encontró un crédito próximo válido.');
    }

    // Cerrar la conexión a la base de datos
    $link->close();

    // Redirigir a finalizarOrden.php
    header('Location: finalizarOrden.php?id_orden=' . $id_orden . '&total=' . $totprecio);
    exit;
}
?>
