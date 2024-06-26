<?php
session_start();
require('../global.php');
$link = bases();

// Verificar si se recibió el formulario correctamente
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $id_credito = isset($_POST['id_credito']) ? intval($_POST['id_credito']) : 0;
    $saldo = isset($_POST['saldo']) ? floatval($_POST['saldo']) : 0;
    $operacion = isset($_POST['operacion']) ? $_POST['operacion'] : '';

    if ($id_paciente > 0 && $id_credito > 0 && !empty($operacion)) {
        // Obtener el saldo actual del crédito
        $sql = "SELECT saldo FROM credito WHERE id_credito = $id_credito";
        $resultado = $link->query($sql);
        if ($resultado->num_rows > 0) {
            $credito = $resultado->fetch_assoc();
            $saldo_actual = $credito['saldo'];

            // Ajustar el saldo según la operación
            if ($operacion == 'Saldo a favor') {
                $nuevo_saldo = $saldo_actual + $saldo;
            } elseif ($operacion == 'Ajuste de saldo') {
                $nuevo_saldo = $saldo_actual - $saldo;
            }

            // Actualizar el saldo en la base de datos
            $sql_update = "UPDATE credito SET saldo = $nuevo_saldo WHERE id_credito = $id_credito";
            if ($link->query($sql_update) === TRUE) {
                // Redireccionar a la página de perfil del paciente
                header("Location: ../tiendita_paciente.php?id_paciente=$id_paciente");
                exit();
            } else {
                echo "Error al actualizar el saldo: " . $link->error;
            }
        } else {
            echo "No se pudo obtener el saldo actual del crédito.";
        }
    } else {
        echo "Datos incompletos en el formulario.";
    }
} else {
    echo "Solicitud no válida.";
}
?>
