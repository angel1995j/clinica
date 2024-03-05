<?php
require "../global.php";
$link = bases();

// Verifica si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa el formulario de actualización
    $id_compra = $_POST['id_compra'];
    $monto = $_POST['monto'];
    $fecha_aplicacion = $_POST['fecha_aplicacion'];
    $estatus = $_POST['estatus'];

    // Obtén el ID del usuario desde la sesión (asumido aquí como $_SESSION['id_usuario'])
    session_start();
    $id_usuario = $_SESSION['id_usuario']; // Asegúrate de ajustar según cómo almacenes el ID del usuario en la sesión

    // Manejo de la imagen
    $carpetaDestino = '../assets/images/comprobantes/';
    $nombreArchivo = $_FILES['comprobante']['name'];
    $rutaArchivo = $carpetaDestino . $nombreArchivo;
    move_uploaded_file($_FILES['comprobante']['tmp_name'], $rutaArchivo);

    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen y el ID del usuario
    $sql_actualizar = "UPDATE compras 
                      SET monto = '$monto', 
                          comprobante = '$nombreArchivo', 
                          fecha_aplicacion = '$fecha_aplicacion', 
                          estatus = '$estatus',
                          id_usuario = '$id_usuario' 
                      WHERE id_compra = $id_compra";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Compra actualizada correctamente.";
        header("Location: ../reportar-compra.php?id_compra=$id_compra");
    } else {
        echo "Error al actualizar la compra: " . $link->error;
    }
}
?>
