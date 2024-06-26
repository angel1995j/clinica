<?php
// Inicia o reanuda la sesión
session_start();

// Verifica si el usuario ha iniciado sesión
if (!isset($_SESSION['id_usuario'])) {
    // Si no ha iniciado sesión, redirige a la página de inicio de sesión
    header("Location: ../login.php");
    exit();
}

// Conecta a la base de datos
require('../global.php');
$link = bases();

$concepto = $_POST['concepto'];
$quien_compra = $_POST['quien_compra'];
$monto = $_POST['monto'];
$fecha_aplicacion = $_POST['fecha_aplicacion'];
$comprobante = $_FILES['comprobante']['name'];
$ruta_temporal = $_FILES['comprobante']['tmp_name'];
$ruta_destino = '../assets/images/comprobantes/' . $comprobante;
$archivado = "no";

// Recupera el valor del campo 'estatus' desde el formulario
$estatus = $_POST['estatus'];

// Recupera el valor del campo 'cuenta_compra' desde el formulario
$cuenta_compra = $_POST['cuenta_compra'];

// Recupera el valor del campo 'tipo_compra' desde el formulario
$tipo_compra = $_POST['tipo_compra'];

// Obtiene el id_usuario de la sesión actual
$id_usuario = $_SESSION['id_usuario'];

// Mueve el archivo subido a la ubicación deseada
if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
    echo "Comprobante subido correctamente.";
} else {
    echo "Error al subir el comprobante.";
}

$sql = "INSERT INTO compras (concepto, quien_compra, monto, fecha_aplicacion, comprobante, estatus, archivado, cuenta_compra, tipo_compra, id_usuario) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("ssdssssssi", $concepto, $quien_compra, $monto, $fecha_aplicacion, $comprobante, $estatus, $archivado, $cuenta_compra, $tipo_compra, $id_usuario);

if ($stmt->execute()) {
    echo "Compra registrada correctamente.";
    header("Location: ../compras.php");
} else {
    echo "Error al registrar la compra: " . $stmt->error;
}

$stmt->close();
$link->close();
?>
