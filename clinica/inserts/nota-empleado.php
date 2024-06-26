<?php
// Incluye el archivo global.php
require('../global.php');

// Conecta a la base de datos
$link = bases();

// Recupera los datos del formulario
$id_empleado = isset($_POST['id_empleado']) ? intval($_POST['id_empleado']) : 0;
$tipo_operacion = isset($_POST['tipo_operacion']) ? $_POST['tipo_operacion'] : '';
$monto = isset($_POST['monto']) ? floatval($_POST['monto']) : 0.0;
$fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
$motivo = isset($_POST['motivo']) ? $_POST['motivo'] : '';

// Valor por defecto para estatus
$estatus = 'pendiente';

// Validaciones adicionales si es necesario

// Inserta la nota en la base de datos
$sql_insert = "INSERT INTO pagos_empleado (id_empleado, tipo_operacion, monto, fecha, motivo, estatus) VALUES (?, ?, ?, ?, ?, ?)";
if ($stmt = $link->prepare($sql_insert)) {
    $stmt->bind_param("isdsss", $id_empleado, $tipo_operacion, $monto, $fecha, $motivo, $estatus);
    
    if ($stmt->execute()) {
        // Nota creada exitosamente, redirige a la página quincena-empleado.php?id_empleado=$id_empleado
        header("Location: ../quincena-empleado.php?id_empleado=$id_empleado");
        exit; // Asegura que el script se detenga después de la redirección
    } else {
        echo "Error al crear la nota: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error en la preparación de la consulta: " . $link->error;
}

// Cierra la conexión a la base de datos
$link->close();
?>
