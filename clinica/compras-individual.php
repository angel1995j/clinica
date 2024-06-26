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
$tipo_compra = isset($_POST['tipo_compra']) ? $_POST['tipo_compra'] : 'Todos';
$estatus = isset($_POST['estatus']) ? $_POST['estatus'] : 'Pagada';

/// Construir la consulta SQL según los criterios
$sql = "SELECT * FROM compras WHERE archivado = 'no'";

if ($fecha_inicio) {
    $sql .= " AND fecha_aplicacion >= '$fecha_inicio'";
}

if ($fecha_fin) {
    $sql .= " AND fecha_aplicacion <= '$fecha_fin'";
}

// Añadir filtro para tipo_compra si no es 'Todos'
if ($tipo_compra && $tipo_compra !== 'Todas') {
    $sql .= " AND tipo_compra = '$tipo_compra'";
}

if ($estatus) {
    $sql .= " AND estatus = '$estatus'";
}

// Añadir limit y offset para la paginación
$sql .= " LIMIT $results_per_page OFFSET $offset";


$result = $link->query($sql);

// Obtener el total de registros que coinciden con los criterios de búsqueda
$sqlTotal = "SELECT COUNT(*) as total FROM compras WHERE archivado = 'no'";

if ($fecha_inicio) {
    $sqlTotal .= " AND fecha_aplicacion >= '$fecha_inicio'";
}

if ($fecha_fin) {
    $sqlTotal .= " AND fecha_aplicacion <= '$fecha_fin'";
}

if ($tipo_compra && $tipo_compra != 'Todas') {
    $sqlTotal .= " AND tipo_compra = '$tipo_compra'";
}

if ($estatus) {
    $sqlTotal .= " AND estatus = '$estatus'";
}

$resultTotal = $link->query($sqlTotal);
$totalRows = $resultTotal->fetch_assoc()['total'];
$totalPages = ceil($totalRows / $results_per_page);

$totalCompras = 0;
?>

<div class="container-fluid">
    <!-- Row 1 -->
    <div class="row">

        <a href="compras.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a compras</a>

        <!-- Button trigger modal -->
        <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#comprasModal" style="text-align: right;">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
        </button>

        <!-- Modal -->
        <div class="modal fade" id="comprasModal" tabindex="-1" role="dialog" aria-labelledby="comprasModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="comprasModalLabel">Filtrar Compras</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Muestra el resultado de tus compras filtradas en el precio anterior
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 mt-4">
            <h2>Resultados de tu búsqueda<br></h2>
            <div class="card mb-4 px-3">
                <div class="card-header pb-0 mt-3">
                    <h6>Compras específicas</h6>
                </div>

                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <!--- INICIA CONTENIDO DE TABLA -->
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Concepto</th>
                                           
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Tipo Compra</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Monto</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Fecha Aplicación</th>
                                            <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Detalles</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if ($result && $result->num_rows > 0) {
                                            while ($row = $result->fetch_assoc()) {
                                                $totalCompras += $row['monto'];
                                                echo '<tr>';
                                                echo '<td>' . $row['concepto'] . '</td>';
                                                //echo '<td>' . $row['quien_compra'] . '</td>';
                                                //echo '<td>' . $row['cuenta_compra'] . '</td>';
                                                echo '<td>' . $row['tipo_compra'] . '</td>';
                                                echo '<td>' . number_format($row['monto'], 2) . '</td>';
                                                echo '<td>' . $row['fecha_aplicacion'] . '</td>';
                                                //echo '<td>' . $row['comprobante'] . '</td>';
                                                //echo '<td>' . $row['estatus'] . '</td>';
                                                echo '<td><a href="detalle-compra.php?id_compra=' . $row['id_compra'] . '" target="_blank">Ver más</a></td>';
                                                echo '</tr>';
                                            }
                                        } else {
                                            echo '<tr><td colspan="9" class="text-center">No hay registros que coincidan con los criterios de búsqueda.</td></tr>';
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
                            <a href="compras-individual.php?page=<?php echo $page + 1; ?>" class="btn btn-primary">Ver más</a>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Mostrar el total de compras -->
    <div class="row container mt-5">
        <div class="col-12">
            <h3>Total de compras: $<?php echo number_format($totalCompras, 2); ?></h3>
        </div>
    </div>

    <?php 
    $link->close();
    require "footer.php";
    ?> 
