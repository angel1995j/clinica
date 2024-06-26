<?php
require "header.php";
require('global.php');
$link = bases();

// Número de resultados por página
$results_per_page = 50;

// Obtener el número de la página actual desde GET, por defecto será 1
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

// Calcular el offset para la consulta SQL
$offset = ($page - 1) * $results_per_page;

// Obtener los valores enviados por POST
$fecha_inicio = isset($_POST['fecha_inicio']) ? $_POST['fecha_inicio'] : '';
$fecha_fin = isset($_POST['fecha_fin']) ? $_POST['fecha_fin'] : '';
$tipo_pago = isset($_POST['tipo_pago']) ? $_POST['tipo_pago'] : 'Todos';

// Construir la consulta SQL según los criterios
$sql = "SELECT * FROM pago_paciente WHERE archivado = 'no' AND estatus = 'Pagado'";

if ($fecha_inicio) {
    $sql .= " AND fecha_pagado >= '$fecha_inicio'";
}

if ($fecha_fin) {
    $sql .= " AND fecha_pagado <= '$fecha_fin'";
}

if ($tipo_pago && $tipo_pago != 'Todos') {
    $sql .= " AND observaciones LIKE '%$tipo_pago%'";
}

// Añadir limit y offset para la paginación
$sql .= " LIMIT $results_per_page OFFSET $offset";

$result = $link->query($sql);

// Obtener el total de registros que coinciden con los criterios de búsqueda
$sqlTotal = "SELECT COUNT(*) as total FROM pago_paciente WHERE archivado = 'no' AND estatus = 'Pagado'";

if ($fecha_inicio) {
    $sqlTotal .= " AND fecha_pagado >= '$fecha_inicio'";
}

if ($fecha_fin) {
    $sqlTotal .= " AND fecha_pagado <= '$fecha_fin'";
}

if ($tipo_pago && $tipo_pago != 'Todos') {
    $sqlTotal .= " AND observaciones LIKE '%$tipo_pago%'";
}

$resultTotal = $link->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $results_per_page);

$totalVentas = 0;
?>

<div class="container-fluid">
    <!-- Row 1 -->
    <div class="row">

        <a href="ventas.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a ventas</a>


        <!-- Button trigger modal -->
        <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal" style="text-align: right;">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Página de ventas</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <b>Módulo de ventas:</b> En esta sección se pueden ver todas las ventas que ha tenido el año a manera de texto, también se visualiza una gráfica con el número de mes y el monto obtenido en cada mes<br><br>
                        <b>Secciones de desglose:</b> Se visualizan secciones de los movimientos recientes de manera detallada, se muestra el total de ingresos y egresos de manera detallada
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <h2>Resultados de tu búsqueda<br></h2>
            <div class="card mb-4 px-3">
                <div class="card-header pb-0 mt-3">
                    <h6>Ventas específicas</h6>
                </div>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <!--- INICIA CONTENIDO DE TABLA -->
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Monto</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Descuento</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Total</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Fecha Pagado</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Observaciones</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Forma de Pago</th>

                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $totalVentas += $row['total'];
                                                echo '<tr>';
                                                //echo '<td>' . $row['id_pago'] . '</td>';
                                                echo '<td>' . number_format($row['monto'], 2) . '</td>';
                                                echo '<td>' . $row['descuento'] . '</td>';
                                                echo '<td>' . number_format($row['total'], 2) . '</td>';
                                                //echo '<td>' . $row['comprobante'] . '</td>';
                                                //echo '<td>' . $row['numero_pago'] . '</td>';
                                                //echo '<td>' . $row['fecha_agregado'] . '</td>';
                                                echo '<td>' . $row['fecha_pagado'] . '</td>';
                                                //echo '<td>' . $row['periodicidad'] . '</td>';
                                                echo '<td>' . $row['observaciones'] . '</td>';
                                                echo '<td>' . $row['forma_pago'] . '</td>';
                                                
                                                //echo '<td>' . $row['estatus'] . '</td>';
                                                echo '<td><a href="detalle-pago.php?id_pago=' . $row['id_pago'] . '" target="_blank">Ver más </a></td>';

                                                //echo '<td>' . $row['estatus'] . '</td>';
                                                //echo '<td>' . $row['archivado'] . '</td>';
                                                //echo '<td>' . $row['id_paciente'] . '</td>';
                                                //echo '<td>' . $row['id_usuario'] . '</td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="15" class="text-center">No hay registros que coincidan con los criterios de búsqueda.</td></tr>';
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- CIERRA CONTENIDO DE TABLA -->
                    </div>
                </div>

                <!-- Botón para ver más -->
                <?php if ($page < $totalPages): ?>
                    <div class="row mt-3">
                        <div class="col-md-12 text-center">
                            <a href="ventas-individual.php?page=<?php echo $page + 1; ?>" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mostrar el total de ventas -->
    <div class="row container mt-5">
        <div class="col-12">
            <h3>Total de ventas: $<?php echo number_format($totalVentas, 2); ?></h3>
        </div>
    </div>

    <?php 
    $link->close();
    require "footer.php";
    ?> 
