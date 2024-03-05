<?php
require "../global.php";
$link = bases();

// Verifica si se ha enviado el formulario de actualización
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Procesa el formulario de actualización
    $id_producto = $_GET['id_producto'];
    $precio_venta = $_POST['precio_venta'];
    $precio_compra = $_POST['precio_compra'];
    $stock = $_POST['stock'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $tipo_producto = "medicina";

    // Verifica si se cargó un nuevo archivo de imagen
    if (!empty($_FILES['imagen']['name'])) {
        // Manejo de la imagen
        $carpetaDestino = '../assets/images/products/';
        $nombreArchivo = $_FILES['imagen']['name'];
        $rutaArchivo = $carpetaDestino . $nombreArchivo;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaArchivo);

        // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
        $sql_actualizar = "UPDATE productos SET precio_venta = '$precio_venta', precio_compra = '$precio_compra', stock = '$stock', imagen = '$nombreArchivo', titulo = '$titulo', descripcion = '$descripcion', tipo_producto = '$tipo_producto' WHERE id_producto = $id_producto";
    } else {
        // No se cargó un nuevo archivo de imagen, mantener la imagen existente
        $sql_actualizar = "UPDATE productos SET precio_venta = '$precio_venta', precio_compra = '$precio_compra', stock = '$stock', titulo = '$titulo', descripcion = '$descripcion', tipo_producto = '$tipo_producto' WHERE id_producto = $id_producto";
    }

    if ($link->query($sql_actualizar) === TRUE) {
        //echo "Producto actualizado correctamente.";
        header("Location: ../medicina.php");
    } else {
        echo "Error al actualizar el producto: " . $link->error;
    }
}
?>
