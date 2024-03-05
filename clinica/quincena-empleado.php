<?php
require('global.php');
$link = bases();
$id_empleado = isset($_GET['id_empleado']) ? intval($_GET['id_empleado']) : 0;

if (!$id_empleado) {
    die('ID del empleado no proporcionado');
}

$sql_select = "SELECT * FROM empleados WHERE id_empleado = ?";
if ($stmt = $link->prepare($sql_select)) {
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nombre = $row['nombre'];
        $aPaterno = $row['aPaterno'];
        $aMaterno = $row['aMaterno'];
        $numero_telefono = $row['numero_telefono'];
        $fecha_ingreso = $row['fecha_ingreso'];
        $fecha_salida = $row['fecha_salida'];
        $puesto = $row['puesto'];
        $salario_bruto = $row['salario_bruto'];
        $salario_neto = $row['salario_neto'];
        $otros_conceptos = $row['otros_conceptos'];
        $monto_otros_conceptos = $row['monto_otros_conceptos'];
        $archivado = $row['archivado'];
    } else {
        die('No se encontró el empleado con ID ' . $id_empleado);
    }

    $stmt->close();
} else {
    die('Error en la preparación de la consulta');
}

$dias_laborados = 30;
$salario_diario = $salario_bruto / $dias_laborados;

$hoy = date('d');
if ($hoy <= 15) {
    $fecha_quincena = '15';
} else {
    $fecha_quincena = date('t');
}

$proximo_mes = date('m', strtotime('+1 month'));
$proximo_anio = date('Y', strtotime('+1 month'));
$proximo_quincena = date('t', strtotime("15/$proximo_mes/$proximo_anio"));
$salario_proxima_quincena = $salario_neto / 2;

$sql_pagos_empleado = "SELECT id_pagos_empleado, monto, motivo, tipo_operacion, fecha FROM pagos_empleado WHERE id_empleado = ? AND estatus= 'pendiente'";

if ($stmt_pagos_empleado = $link->prepare($sql_pagos_empleado)) {
    $stmt_pagos_empleado->bind_param("i", $id_empleado);
    $stmt_pagos_empleado->execute();
    $result_pagos_empleado = $stmt_pagos_empleado->get_result();
    $stmt_pagos_empleado->close();
} else {
    die('Error en la preparación de la consulta para obtener los pagos del empleado');
}

$total_pagos = 0;
while ($row_pagos_empleado = $result_pagos_empleado->fetch_assoc()) {
    $monto = ($row_pagos_empleado['tipo_operacion'] === 'Descuento') ? -$row_pagos_empleado['monto'] : $row_pagos_empleado['monto'];
    $total_pagos += $monto;
}

require('header.php');
?>

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-md-12 mt-5">
            <h3 class="mt-3">Quincena del empleado: <?php echo $nombre . " " . $aPaterno; ?></h3>
            <span>Días Laborados en el Mes: <?php echo $dias_laborados; ?></span>
            <span style="margin-left: 10%;">Salario Diario: $<?php echo $salario_diario; ?></span><br>
            <span>Próxima quincena: <?php echo $fecha_quincena . "/" . date('m/Y', strtotime('+1 day')); ?></span>
            <span style="margin-left: 9%;">Salario Próxima Quincena: $<?php echo $salario_proxima_quincena; ?></span>
        </div>
        
        <div class="col-md-6">
            <table class="table table-bordered mt-4">
                <tr>
                    <th>Nombre</th>
                    <td><?php echo $nombre . " " . $aPaterno . " " . $aMaterno; ?></td>
                </tr>
                <tr>
                    <th>Teléfono</th>
                    <td><?php echo $numero_telefono; ?></td>
                </tr>
                <tr>
                    <th>Fecha de Ingreso</th>
                    <td><?php echo $fecha_ingreso; ?></td>
                </tr>
            </table>
        </div>

        <div class="col-md-6">
            <table class="table table-bordered mt-4">
                <tr>
                    <th>Salario Bruto</th>
                    <td><?php echo $salario_bruto; ?></td>
                </tr>
                <tr>
                    <th>Salario Neto</th>
                    <td><?php echo $salario_neto; ?></td>
                </tr>
                <tr>
                    <th>Otros Conceptos</th>
                    <td><?php echo $otros_conceptos; ?></td>
                </tr>
                <tr>
                    <th>Monto Otros Conceptos</th>
                    <td><?php echo $monto_otros_conceptos; ?></td>
                </tr>
            </table>
        </div>

        <h3 class="mt-3">Pagos o descuentos extras del empleado</h3>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Monto</th>
                    <th>Motivo</th>
                    <th>Tipo de Operación</th>
                    <th>Fecha</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $result_pagos_empleado->data_seek(0);
                while ($row_pagos_empleado = $result_pagos_empleado->fetch_assoc()) :
                    $monto = ($row_pagos_empleado['tipo_operacion'] === 'Descuento') ? -$row_pagos_empleado['monto'] : $row_pagos_empleado['monto'];
                ?>
                    <tr>
                        <td><?php echo $row_pagos_empleado['id_pagos_empleado']; ?></td>
                        <td><?php echo $monto; ?></td>
                        <td><?php echo $row_pagos_empleado['motivo']; ?></td>
                        <td><?php echo $row_pagos_empleado['tipo_operacion']; ?></td>
                        <td><a href="updates/archivar-pagos-empleado.php?id_pagos_empleado=<?php echo $row_pagos_empleado['id_pagos_empleado']; ?>">Resolver pago</a></td>
                    </tr>
                <?php endwhile; ?>
                <tr>
                    <td colspan="4"><strong>Total:</strong></td>
                    <td><strong>$<?php echo $total_pagos; ?></strong></td>
                </tr>
            </tbody>
        </table>

    </div>
</div>

<?php
require('footer.php');
?>
