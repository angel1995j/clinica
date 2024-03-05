<?php
require "../global.php";
$link = bases();


    // Procesa el formulario de actualización
    $id_compra = $_GET['id_compra'];
    $archivado = "no";



    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
    $sql_actualizar = "UPDATE compras SET archivado = '$archivado' WHERE id_compra = $id_compra";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Pago actualizado correctamente.";
        header("Location: ../compras.php");
    } else {
        echo "Error al actualizar el pago: " . $link->error;
    }

?>
