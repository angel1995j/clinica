<?php
// Conecta a la base de datos
require('../global.php');
$link = bases();

// Recupera los datos del formulario
$id_paciente = $_POST['id_paciente'];
$saldo = floatval($_POST['saldo']);
$fecha_actualizacion = $_POST['fecha_actualizacion'];
$duracion = $_POST['duracion'];
$numero_periodos = intval($_POST['numero_periodos']);
$saldo_paciente = floatval($_POST['saldo_paciente']);

// Define la operación
$operacion = "Generación de límite de crédito";

// Calcula el intervalo de tiempo
switch ($duracion) {
    case 'semanal':
        $intervalo = 'week';
        break;
    case 'quincenal':
        $intervalo = 'week';
        $numero_periodos *= 2; // Cada quincena equivale a 2 semanas
        break;
    case 'mensual':
        $intervalo = 'month';
        break;
}

// Prepara la consulta SQL para la inserción múltiple
$sql_insert = "INSERT INTO credito (id_paciente, saldo, fecha_actualizacion, fecha_fin, operacion, numeroMonto) VALUES (?, ?, ?, ?, ?, ?)";

// Prepara la consulta
$stmt = $link->prepare($sql_insert);

// Variable para almacenar la suma de los saldos
$total_saldo = 0;

// Verifica si la consulta se preparó correctamente
if ($stmt) {
    // Realiza múltiples inserciones
    for ($i = 1; $i <= $numero_periodos; $i++) {
        // Calcula la fecha de finalización para cada periodo
        $fecha_fin = date('Y-m-d', strtotime("+$i $intervalo", strtotime($fecha_actualizacion)));
        
        // Vincula los parámetros
        $stmt->bind_param("idsssi", $id_paciente, $saldo, $fecha_actualizacion, $fecha_fin, $operacion, $i);
        
        // Ejecuta la consulta
        if (!$stmt->execute()) {
            echo "Error al insertar el registro número " . $i . ": " . $stmt->error;
            break; // Sale del bucle en caso de error
        }

        // Suma el saldo actual al total
        $total_saldo += $saldo;
    }

    // Cierra la consulta preparada
    $stmt->close();

    // Calcula la fecha actual
    $fecha_actual = date('Y-m-d');

    // Agrega un registro adicional
    $sql_extra_insert = "INSERT INTO credito (id_paciente, saldo, fecha_actualizacion, fecha_fin, operacion, numeroMonto) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt_extra = $link->prepare($sql_extra_insert);
    
    // Verifica si la consulta se preparó correctamente
    if ($stmt_extra) {
        // Calcula la nueva fecha de finalización (fecha actual)
        $fecha_fin_extra = $fecha_actual;

        // Define la operación para el registro adicional
        $operacion_extra = "Ajuste automático de saldos";

        // Calcula el nuevo saldo sumando o restando el saldo del paciente
        $nuevo_saldo = $total_saldo + $saldo_paciente;

        // Asigna el valor a una variable
        $numero_monto_extra = 0;

        // Vincula los parámetros para el registro adicional
        $stmt_extra->bind_param("idsssi", $id_paciente, $nuevo_saldo, $fecha_actual, $fecha_fin_extra, $operacion_extra, $numero_monto_extra);

        // Ejecuta la consulta para el registro adicional
        if ($stmt_extra->execute()) {
            // Cierra la consulta preparada para el registro adicional
            $stmt_extra->close();

            // Redirige a tiendita_paciente.php con el ID del paciente actual
            header("Location: ../tiendita_paciente.php?id_paciente=$id_paciente");
            exit(); // Se asegura de que se detenga la ejecución del script después de redirigir
        } else {
            echo "Error al insertar el registro adicional: " . $stmt_extra->error;
        }
    } else {
        echo "Error en la preparación de la consulta para el registro adicional: " . $link->error;
    }
} else {
    echo "Error en la preparación de la consulta: " . $link->error;
}

// Cierra la conexión a la base de datos
$link->close();
?>
