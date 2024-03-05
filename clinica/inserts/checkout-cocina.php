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
    $totprecio = isset($_POST["totprecio"]) ? $_POST["totprecio"] : 0;

    // Datos adicionales
    $id_paciente = isset($_POST["id_paciente"]) ? $_POST["id_paciente"] : 0;
    $concepto = isset($_POST["concepto"]) ? $_POST["concepto"] : "Compra en la tiendita";

    // Otros datos que pueden ser necesarios
    $id_usuario = $_SESSION["id_usuario"];  // Asegúrate de tener este dato en la sesión
} else {
    // Si no hay datos en POST, redirigir al carrito o a donde sea necesario
    header("Location: ../cocina.php");
    exit;
}

// Insertar datos en la tabla consumo
$link = bases();

// Obtener la fecha actual
$fecha_consumo = date("Y-m-d H:i:s");

// Preparar la consulta SQL
$sql = "INSERT INTO consumo (concepto, monto, fecha_consumo, id_usuario) VALUES (?, ?, ?, ?)";

// Preparar y ejecutar la declaración
$stmt = $link->prepare($sql);

if ($stmt) {
    // Vincular los parámetros
    $stmt->bind_param("sdsi", $concepto, $totprecio, $fecha_consumo, $id_usuario);

    // Ejecutar la consulta
    $stmt->execute();

    // Obtener el ID del consumo recién insertado
    $id_consumo = $stmt->insert_id;

    // Insertar los detalles del consumo
    for ($i = 0; $i < count($vai_nom); $i++) {
        $sql_detalle = "INSERT INTO consumo_detalle (id_consumo, id_producto, cantidad, precio_unitario) VALUES (?, ?, ?, ?)";
        $stmt_detalle = $link->prepare($sql_detalle);

        if ($stmt_detalle) {
            $stmt_detalle->bind_param("iiid", $id_consumo, $vai_cod[$i], $txtcantidad[$i], $vai_pre[$i]);
            $stmt_detalle->execute();
            $stmt_detalle->close();
        }
    }

    // Cerrar la conexión y liberar recursos
    $stmt->close();
    $link->close();

    // Redirigir a cocina.php después del éxito
    header("Location: ../cocina.php");
    exit;
} else {
    echo "Error en la preparación de la consulta: " . $link->error;
}
?>
