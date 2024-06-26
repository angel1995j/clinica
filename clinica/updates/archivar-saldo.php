<?php
require "../global.php";
$link = bases();


    // Procesa el formulario de actualización
    $id_historial = $_GET['id_historial'];
    $id_paciente = $_GET['id_paciente'];
    $archivado = "si";



    // Actualiza los datos en la base de datos, incluyendo el nombre de la imagen
    $sql_actualizar = "UPDATE historial_saldo SET archivado = '$archivado' WHERE id_historial = $id_historial";

    if ($link->query($sql_actualizar) === TRUE) {
        echo "Saldo actualizado correctamente.";
        header("Location: ../saldo.php?id_paciente=" . $id_paciente);
        exit;
    } else {
        echo "Error al actualizar el pago: " . $link->error;
    }

?>
