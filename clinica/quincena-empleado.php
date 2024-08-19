<?php
require('global.php');
$link = bases();
$id_empleado = isset($_GET['id_empleado']) ? intval($_GET['id_empleado']) : 0;

if (!$id_empleado) {
    die('ID del empleado no proporcionado');
}

$sql_select = "SELECT id_empleado, nombre, aPaterno, aMaterno, numero_telefono, fecha_ingreso, puesto, salario_bruto, salario_neto, otros_conceptos, monto_otros_conceptos, archivado, contactos, fecha_antidoping FROM empleados WHERE id_empleado = ?";
if ($stmt = $link->prepare($sql_select)) {
    $stmt->bind_param("i", $id_empleado);
    $stmt->execute();
    $stmt->bind_result($id_empleado, $nombre, $aPaterno, $aMaterno, $numero_telefono, $fecha_ingreso, $puesto, $salario_bruto, $salario_neto, $otros_conceptos, $monto_otros_conceptos, $archivado, $contactos, $fecha_antidoping);

    if ($stmt->fetch()) {
        // Continuar con la lógica
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

$sql_pagos_empleado = "SELECT id_pagos_empleado, monto, motivo, tipo_operacion, fecha FROM pagos_empleado WHERE id_empleado = ? AND estatus = 'pendiente'";

if ($stmt_pagos_empleado = $link->prepare($sql_pagos_empleado)) {
    $stmt_pagos_empleado->bind_param("i", $id_empleado);
    $stmt_pagos_empleado->execute();
    $stmt_pagos_empleado->bind_result($id_pagos_empleado, $monto, $motivo, $tipo_operacion, $fecha);

    $total_pagos = 0;
    ?>

    <?php require('header.php'); ?>

    <div class="container-fluid py-4 mt-5">
        <div class="row mt-5">
            <div class="col-md-12 mt-5">
                <a href="empleados.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i> Volver a todos los empleados</a>

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
                    <tr>
                        <th>Contactos</th>
                        <td><?php echo $contactos; ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-6">
                <table class="table table-bordered mt-4">
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

                     <tr>
                        <th>Fecha Antidoping</th>
                        <td><?php echo $fecha_antidoping; ?></td>
                    </tr>
                </table>
            </div>

            <div class="col-md-12 mt-4">
                <h3>Pagos o descuentos extras del empleado</h3>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>Monto</th>
                            <th>Motivo</th>
                            <th>Tipo de Operación</th>
                            <th>Fecha</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($stmt_pagos_empleado->fetch()) :
                            $monto_formateado = ($tipo_operacion === 'Descuento') ? -$monto : $monto;
                            $total_pagos += $monto_formateado;
                        ?>
                            <tr>
                                <td><?php echo $monto_formateado; ?></td>
                                <td><?php echo $motivo; ?></td>
                                <td><?php echo $tipo_operacion; ?></td>
                                <td><?php echo $fecha; ?></td>
                                <td><a href="updates/archivar-pagos-empleado.php?id_pagos_empleado=<?php echo $id_pagos_empleado; ?>">Resolver pago</a></td>
                            </tr>
                        <?php endwhile; ?>
                        <tr>
                            <td colspan="4"><strong>Total:</strong></td>
                            <td><strong>$<?php echo $total_pagos; ?></strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Nueva Sección: Documentos del Empleado -->
            <div class="col-md-12 mt-4">
                <h3>Documentos del Empleado / Actualizaciones / Actas Administrativas</h3>
                <?php
                $sql_docs_empleado = "SELECT id_docs, tipo_documento, fecha, observaciones, archivo FROM docs_empleado WHERE id_empleado = ?";
                if ($stmt_docs_empleado = $link->prepare($sql_docs_empleado)) {
                    $stmt_docs_empleado->bind_param("i", $id_empleado);
                    $stmt_docs_empleado->execute();
                    $stmt_docs_empleado->bind_result($id_docs, $tipo_documento, $fecha_doc, $observaciones_doc, $archivo);
                ?>
                    <table class="table table-bordered mt-2">
                        <thead>
                            <tr>
                                <th>Tipo de Documento</th>
                                <th>Fecha</th>
                                <th>Observaciones</th>
                                <th>Archivo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($stmt_docs_empleado->fetch()) : ?>
                                <tr>
                                    <td><?php echo $tipo_documento; ?></td>
                                    <td><?php echo $fecha_doc; ?></td>
                                    <td><?php echo $observaciones_doc; ?></td>
                                    <td><a href="assets/docs/empleados/<?php echo $archivo; ?>" target="_blank">Ver Documento</a></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                <?php
                    $stmt_docs_empleado->close();
                } else {
                    echo 'Error en la preparación de la consulta para obtener los documentos del empleado';
                }
                ?>
            </div>

            <div class="col-md-3 text-center mt-4">
                <a href="editar-empleado.php?id_empleado=<?php echo $id_empleado; ?>" class="btn btn-primary">Editar empleado</a>
            </div>

            <div class="col-md-3 text-center mt-4">
                <a href="nota-empleado.php?id_empleado=<?php echo $id_empleado; ?>" class="btn btn-primary">Agregar bono/descuento</a>
            </div>

             <div class="col-md-3 text-center mt-4">
                <a href="doc-empleado.php?id_empleado=<?php echo $id_empleado; ?>" class="btn btn-primary">Gestionar notas</a>
            </div>

            <div class="col-md-3 text-center mt-4">
                <a href="" class="btn btn-primary">Contrato</a>
            </div>

        </div>
    </div>

    <?php require('footer.php'); ?>

    <?php
    $stmt_pagos_empleado->close();
} else {
    die('Error en la preparación de la consulta para obtener los pagos del empleado');
}
?>
