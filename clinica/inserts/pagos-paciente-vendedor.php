<?php
// Conecta a la base de datos
require('../global.php');
$link = bases();

$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Recupera los datos del formulario
$monto = $_POST['monto'];
$cantidad_registros = intval($_POST['cantidad_registros']);
$periodicidad = $_POST['periodicidad'];
$observaciones = $_POST['observaciones'];

// Define el estatus por defecto
$estatus = 'No Pagado';
$archivado = 'no';

// Define la fecha inicial
$fecha_actual = new DateTime();

// Define el número de meses según la periodicidad seleccionada
switch ($periodicidad) {
    case 'semanal':
        $intervalo = new DateInterval('P7D'); // Intervalo de 7 días
        break;
    case 'quincenal':
        $intervalo = new DateInterval('P15D'); // Intervalo de 15 días
        break;
    case '1 mes':
        $intervalo = new DateInterval('P1M'); // Intervalo de 1 mes
        break;
    case '2 meses':
        $intervalo = new DateInterval('P2M'); // Intervalo de 2 meses
        break;
    case '3 meses':
        $intervalo = new DateInterval('P3M'); // Intervalo de 3 meses
        break;
    case '4 meses':
        $intervalo = new DateInterval('P4M'); // Intervalo de 4 meses
        break;
    case '5 meses':
        $intervalo = new DateInterval('P5M'); // Intervalo de 5 meses
        break;
    case '6 meses':
        $intervalo = new DateInterval('P6M'); // Intervalo de 6 meses
        break;
    case '7 meses':
        $intervalo = new DateInterval('P7M'); // Intervalo de 7 meses
        break;
    case '8 meses':
        $intervalo = new DateInterval('P8M'); // Intervalo de 8 meses
        break;
    case '9 meses':
        $intervalo = new DateInterval('P9M'); // Intervalo de 9 meses
        break;
    case '10 meses':
        $intervalo = new DateInterval('P10M'); // Intervalo de 10 meses
        break;
    case '11 meses':
        $intervalo = new DateInterval('P11M'); // Intervalo de 11 meses
        break;
    case '12 meses':
        $intervalo = new DateInterval('P12M'); // Intervalo de 12 meses
        break;
    default:
        $intervalo = new DateInterval('P0D'); // Intervalo de 0 días (sin cambio)
}

// Inserta los registros en la base de datos
for ($i = 1; $i <= $cantidad_registros; $i++) {
    // Calcula la fecha para el próximo registro
    $fecha_actual->add($intervalo);
    $fecha_agregado = $fecha_actual->format('Y-m-d');

    // Inserta el registro
    $sql_insert = "INSERT INTO pago_paciente (monto, estatus, id_paciente, numero_pago, archivado, observaciones, fecha_agregado) VALUES ($monto, '$estatus', '$id_paciente', $i, '$archivado', '$observaciones', '$fecha_agregado')";
    
    if ($link->query($sql_insert) !== TRUE) {
        echo "Error al insertar el pago número " . $i . ": " . $link->error;
        break;
    }
}

// Cierra la conexión a la base de datos
$link->close();

// Redirecciona a la página principal o muestra un mensaje de éxito
// header("Location: index.php"); // Descomenta si deseas redireccionar
echo "Pagos insertados exitosamente";
header("Location: ../pago-paciente-inicial-vendedor.php?id_paciente=$id_paciente");
?>
