<?php
require "../global.php";
$link = bases();


    // Procesa el formulario de actualización
    $id_producto = $_GET['id_producto'];
    $estatus = "0";



    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
    $sql_actualizar = "UPDATE productos SET estatus = '$estatus' WHERE id_producto = $id_producto";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Pago actualizado correctamente.";
        header("Location: ../cocina.php");
    } else {
        echo "Error al actualizar el pago: " . $link->error;
    }

?>
