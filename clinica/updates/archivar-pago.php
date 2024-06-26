<?php
require "../global.php";
$link = bases();


    // Procesa el formulario de actualización
    $id_pago = $_GET['id_pago'];
    $id_paciente = $_GET['id_paciente'];
    $archivado = "si";



    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
    $sql_actualizar = "UPDATE pago_paciente SET archivado = '$archivado' WHERE id_pago = $id_pago";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Pago actualizado correctamente.";
        header("Location: ../pagos-individual.php?id_paciente=" . $id_paciente);
        exit;
    } else {
        echo "Error al actualizar el pago: " . $link->error;
    }

?>
