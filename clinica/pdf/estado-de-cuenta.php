<?php
require_once('../dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Inicializa Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('../global.php');
$link = bases();

// Consulta los datos del paciente
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
$resultado = $link->query($sql);
$paciente = $resultado->fetch_assoc();

// Consulta los pagos del paciente
$sqlPagos = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente AND archivado = 'no' AND estatus = 'Pagado'";
$resultadoPagos = $link->query($sqlPagos);

// Consulta los pagos del paciente no pagado
$sqlPagosNoPagados = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente AND archivado = 'no' AND estatus = 'No Pagado'";
$resultadoPagosNoPagados = $link->query($sqlPagosNoPagados);

// Consulta el historial de saldo del paciente
$sqlHistorialSaldo = "SELECT * FROM historial_saldo WHERE id_paciente = $id_paciente AND archivado = 'no'";
$resultadoHistorialSaldo = $link->query($sqlHistorialSaldo);

// Consulta las órdenes del paciente
$sqlOrdenes = "SELECT * FROM ordenes WHERE id_paciente = $id_paciente";
$resultadoOrdenes = $link->query($sqlOrdenes);

$anioActual = date("Y");

// Obtiene el mes actual (sin ceros a la izquierda)
$meses = array(
    1 => "enero",
    2 => "febrero",
    3 => "marzo",
    4 => "abril",
    5 => "mayo",
    6 => "junio",
    7 => "julio",
    8 => "agosto",
    9 => "septiembre",
    10 => "octubre",
    11 => "noviembre",
    12 => "diciembre"
);

// Obtiene el número del mes actual (1 al 12)
$numeroMes = date("n");

// Obtiene el nombre completo del mes actual en español
$nombreMes = $meses[$numeroMes];

// Obtiene el día del mes actual
$diaActual = date("j");

// Inicializa las sumas
$sumaPagado = 0;
$sumaNoPagado = 0;
$sumaAbonos = 0;
$sumaCreditos = 0;
$sumaPendientesTratamiento = 0;

// HTML para el contenido del PDF (estado de cuenta)
$html = '<html> 
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .content { text-align: justify; }
        .center { text-align: center; }
        .table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        .table th, .table td { border: 1px solid #000; padding: 8px; text-align: left; }
        .table th { background-color: #f2f2f2; }
    </style>
</head>
<body>

<div class="content">
    <div class="center"><b>Estado de cuenta</b></div><br><br><br>
    Santiago Undameo, Michoacán a ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'<br>
    <br><br>
    <b>Detalles del paciente:</b><br>
    Nombre del paciente: ' . htmlspecialchars($paciente['nombre'])  . ' ' . htmlspecialchars($paciente['aPaterno'])  ." ". htmlspecialchars($paciente['aMaterno']) .'<br>
    Saldo disponible: $' . htmlspecialchars($paciente['saldo'])  . '<br>';

// Suma de pagos pendientes
while ($pago = $resultadoPagosNoPagados->fetch_assoc()) {
    if ($pago['observaciones'] !== 'Tratamiento') {
        $sumaNoPagado += $pago['monto'];
    } else {
        $sumaPendientesTratamiento += $pago['monto'];
    }
}
$html .= 'Suma de pagos pendientes: $' . number_format($sumaNoPagado, 2) . '<br>';
$html .= 'Suma de pagos pendientes (Tratamiento): $' . number_format($sumaPendientesTratamiento, 2) . '<br>';

// Suma de pagos realizados
while ($pago = $resultadoPagos->fetch_assoc()) {
    $sumaPagado += $pago['total'];
}
$html .= 'Suma de pagos realizados: $' . number_format($sumaPagado, 2) . '<br><br><br>';

// Define las observaciones a filtrar
$observaciones = [
    'Tratamiento',
    'Adeudo tiendita',
    'donaciones adicionales',
    'donación de ingreso',
    'medicamento',
    'peticiones',
    'consultas externas'
];

foreach ($observaciones as $obs) {
    // Reinicia la suma para cada observación
    $sumaObservacion = 0;
    
    // Filtra los pagos por observación
    $resultadoPagos->data_seek(0); // Reinicia el puntero del resultado de la consulta
    $pagosFiltrados = [];
    
    while ($pago = $resultadoPagos->fetch_assoc()) {
        if ($pago['observaciones'] === $obs) {
            $pagosFiltrados[] = $pago;
            $sumaObservacion += $pago['total'];
        }
    }
    
    // Solo muestra la tabla si hay pagos para la observación actual
    if (!empty($pagosFiltrados)) {
        $html .= '<b>Pagos Realizados (' . htmlspecialchars($obs) . '):</b>
            <table class="table">
                <tr>
                    <th>ID Pago</th>
                    <th>Monto</th>
                    <th>Descuento</th>
                    <th>Total Pagado</th>
                    <th>Fecha Agregado</th>
                    <th>Fecha Pagado</th>
                    <th>Observaciones</th>
                    <th>Forma Pago</th>
                </tr>';

        foreach ($pagosFiltrados as $pago) {
            $html .= '
                <tr>
                    <td>' . htmlspecialchars($pago['id_pago']) . '</td>
                    <td>' . htmlspecialchars($pago['monto']) . '</td>
                    <td>' . htmlspecialchars($pago['descuento']) . '</td>
                    <td>' . htmlspecialchars($pago['total']) . '</td>
                    <td>' . htmlspecialchars($pago['fecha_agregado']) . '</td>
                    <td>' . htmlspecialchars($pago['fecha_pagado']) . '</td>
                    <td>' . htmlspecialchars($pago['observaciones']) . '</td>
                    <td>' . htmlspecialchars($pago['forma_pago']) . '</td>
                </tr>';
        }

        $html .= '
            </table>';

        $html .= '<br>Suma pagos realizados (' . htmlspecialchars($obs) . '): $' . number_format($sumaObservacion, 2) . '<br><br><br><br>';
    }
}

// Consulta los pagos pendientes (sin tratamiento)
$html .= '<b>Pagos Pendientes (adicionales):</b>
    <table class="table">
        <tr>
            <th>ID Pago</th>
            <th>Monto</th>
            <th>Fecha Agregado</th>
            <th>Fecha Pagado</th>
            <th>Observaciones</th>
        </tr>';

$resultadoPagosNoPagados->data_seek(0); // Reinicia el puntero del resultado de la consulta
while ($pago = $resultadoPagosNoPagados->fetch_assoc()) {
    if ($pago['observaciones'] !== 'Tratamiento') {
        $html .= '
            <tr>
                <td>' . htmlspecialchars($pago['id_pago']) . '</td>
                <td>' . htmlspecialchars($pago['monto']) . '</td>
                <td>' . htmlspecialchars($pago['fecha_agregado']) . '</td>
                <td>' . htmlspecialchars($pago['fecha_pagado']) . '</td>
                <td>' . htmlspecialchars($pago['observaciones']) . '</td>
            </tr>';
    }
}
$html .= '
    </table>';
$html .= '<br>Suma de pagos pendientes (adicionales): $' . number_format($sumaNoPagado, 2) . '<br><br><br><br>';

// Consulta los pagos pendientes (tratamiento)
$html .= '<b>Pagos Pendientes (Tratamiento):</b>
    <table class="table">
        <tr>
            <th>ID Pago</th>
            <th>Monto</th>
            <th>Fecha Agregado</th>
            <th>Fecha Pagado</th>
            <th>Observaciones</th>
        </tr>';

$resultadoPagosNoPagados->data_seek(0); // Reinicia el puntero del resultado de la consulta
while ($pago = $resultadoPagosNoPagados->fetch_assoc()) {
    if ($pago['observaciones'] === 'Tratamiento') {
        $html .= '
            <tr>
                <td>' . htmlspecialchars($pago['id_pago']) . '</td>
                <td>' . htmlspecialchars($pago['monto']) . '</td>
                <td>' . htmlspecialchars($pago['fecha_agregado']) . '</td>
                <td>' . htmlspecialchars($pago['fecha_pagado']) . '</td>
                <td>' . htmlspecialchars($pago['observaciones']) . '</td>
            </tr>';
    }
}
$html .= '
    </table>';
$html .= '<br>Suma de pagos pendientes (Tratamiento): $' . number_format($sumaPendientesTratamiento, 2) . '<br><br><br><br>';

// Consulta el historial de saldo y agrega los datos al HTML
$html .= '<br><b>Historial de Abonos:</b>
    <table class="table">
        <tr>
            <th>ID Historial</th>
            <th>Monto</th>
            <th>Fecha Agregado</th>
            <th>Fecha Pagado</th>
            <th>Observaciones</th>
            <th>Forma Pago</th>
        </tr>';

while ($historial = $resultadoHistorialSaldo->fetch_assoc()) {
    $sumaAbonos += $historial['monto'];
    $html .= '
        <tr>
            <td>' . htmlspecialchars($historial['id_historial']) . '</td>
            <td>' . htmlspecialchars($historial['monto']) . '</td>
            <td>' . htmlspecialchars($historial['fecha_agregado']) . '</td>
            <td>' . htmlspecialchars($historial['fecha_pagado']) . '</td>
            <td>' . htmlspecialchars($historial['observaciones']) . '</td>
            <td>' . htmlspecialchars($historial['forma_pago']) . '</td>
        </tr>';
}

$html .= '
    </table>';

$html .= '<br>Suma de Abonos: $' . number_format($sumaAbonos, 2) . '<br><br><br><br>';

// Consulta las órdenes y agrega los datos al HTML
$html .= '<br><br><b>Consumos de la tiendita:</b>
    <table class="table">
        <tr>
            <th>ID Orden</th>
            <th>Fecha de consumo</th>
            <th>Total</th>
        </tr>';

while ($orden = $resultadoOrdenes->fetch_assoc()) {
    $sumaCreditos += $orden['total'];
    $html .= '
        <tr>
            <td>' . htmlspecialchars($orden['id_orden']) . '</td>
            <td>' . htmlspecialchars($orden['fecha_creacion']) . '</td>
            <td>' . htmlspecialchars($orden['total']) . '</td>
        </tr>';
}

$html .= '
    </table>';
$html .= '<br>Suma de consumo de tiendita: $' . number_format($sumaCreditos, 2) . '<br><br><br><br>';

$html .= '
</div>
</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envía el PDF al navegador
$dompdf->stream('estado_de_cuenta.pdf', ['Attachment' => 0]);
?>
