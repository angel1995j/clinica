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
    $estatus = $_POST['estatus'];
    $forma_pago = $_POST['forma_pago']; // Nuevo campo forma_pago

    // Obtén el ID del usuario desde la sesión (asumido aquí como $_SESSION['id_usuario'])
    session_start();
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de ajustar según cómo almacenes el ID del usuario en la sesión

    // Manejo de la imagen
    $carpetaDestino = '../assets/images/comprobantes/';
    $nombreArchivo = $_FILES['comprobante']['name'];
    $rutaArchivo = $carpetaDestino . $nombreArchivo;
    move_uploaded_file($_FILES['comprobante']['tmp_name'], $rutaArchivo);

    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen, el nuevo campo forma_pago y el ID del usuario
    $sql_actualizar = "UPDATE pago_paciente 
                      SET monto = '$monto', 
                          descuento = '$descuento', 
                          total = '$total', 
                          comprobante = '$nombreArchivo', 
                          fecha_agregado = '$fecha_agregado', 
                          fecha_pagado = '$fecha_pagado', 
                          observaciones = '$observaciones', 
                          estatus = '$estatus',
                          forma_pago = '$forma_pago',
                          id_usuario = '$id_usuario' 
                      WHERE id_pago = $id_pago";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Pago actualizado correctamente.";
        header("Location: ../reportar-pago.php?id_pago=$id_pago");
    } else {
        echo "Error al actualizar el pago: " . $link->error;
    }
}
?>
