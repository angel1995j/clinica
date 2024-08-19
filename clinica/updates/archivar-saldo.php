<?php
require "../global.php";
$link = bases();

// Obtiene los parámetros de la URL
$id_historial = $_GET['id_historial'];
$id_paciente = $_GET['id_paciente'];
$archivado = "si";

// Recupera el monto del historial antes de archivarlo
$sql_recuperar_monto = "SELECT monto FROM historial_saldo WHERE id_historial = $id_historial";
$result = $link->query($sql_recuperar_monto);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $monto = $row['monto'];

    // Actualiza la columna 'archivado' en la tabla 'historial_saldo'
    $sql_actualizar_historial = "UPDATE historial_saldo SET archivado = '$archivado' WHERE id_historial = $id_historial";

    if ($link->query($sql_actualizar_historial) === TRUE) {
        // Resta el monto del saldo actual del paciente en la tabla 'pacientes'
        $sql_actualizar_saldo = "UPDATE pacientes SET saldo = saldo - $monto WHERE id_paciente = $id_paciente";
        if ($link->query($sql_actualizar_saldo) === TRUE) {
            echo "Saldo actualizado correctamente.";
            header("Location: ../saldo.php?id_paciente=" . $id_paciente);
            exit;
        } else {
            echo "Error al actualizar el saldo del paciente: " . $link->error;
        }
    } else {
        echo "Error al actualizar el historial: " . $link->error;
    }
} else {
    echo "No se encontró el registro de historial.";
}

?>
