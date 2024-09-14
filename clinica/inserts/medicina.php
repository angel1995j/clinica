<?php

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();

    $precio_venta = $_POST['precio_venta'];
    $stock = $_POST['stock'];
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $codigo = $_POST['codigo'];
    $precio_compra = $_POST['precio_compra'];
    $tipo_producto = "medicina";
    $estatus = 1;

    $imagen = $_FILES['imagen']['name'];
    $ruta_temporal = $_FILES['imagen']['tmp_name'];
    $ruta_destino = '../assets/images/products/' . $imagen;

    $sql = "INSERT INTO productos (precio_venta, stock, titulo, descripcion, codigo, precio_compra, imagen, tipo_producto, estatus) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $link->prepare($sql);
$stmt->bind_param("dissddssi", $precio_venta, $stock, $titulo, $descripcion, $codigo, $precio_compra, $imagen, $tipo_producto, $estatus);



    if ($stmt->execute()) {
        echo "Producto insertado correctamente.";
        header("Location: ../medicina.php");
    } else {
        echo "Error al insertar el producto: " . $stmt->error;
    }

    $stmt->close();
    $link->close();

?>
