<?php
require('../global.php');
$link = bases();

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['p.id_pago', 'p.monto', 'p.descuento', 'p.fecha_agregado', 'p.estatus', 'pac.nombre', 'pac.aPaterno', 'pac.aMaterno'];

/* Nombre de las tablas */
$table_paciente = "pacientes";
$table_pago = "pago_paciente";

$id_paciente = 'pac.id_paciente';

$campo = isset($_POST['campo']) ? $link->real_escape_string($_POST['campo']) : null;

/* Filtrado */
$where = '';

if (!empty($campo)) {
    // Si se proporciona un valor en el campo de búsqueda, agregamos una condición a $where
    $where .= " AND (pac.nombre LIKE '%$campo%' OR pac.aPaterno LIKE '%$campo%' OR pac.aMaterno LIKE '%$campo%')";
}

/* Agrega la condición para archivado = 'no' */
$where .= " AND p.archivado = 'no'";

/* Limit */
$limit = isset($_POST['registros']) ? $link->real_escape_string($_POST['registros']) : 10;
$pagina = isset($_POST['pagina']) ? $link->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio , $limit";

/**
 * Ordenamiento
 */
$sOrder = "";
if (isset($_POST['orderCol'])) {
    $orderCol = $_POST['orderCol'];
    $orderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'desc';

    $sOrder = "ORDER BY " . $columns[intval($orderCol)] . ' ' . $orderType;
}

/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table_pago AS p
JOIN $table_paciente AS pac ON p.id_paciente = pac.id_paciente
$where
$sOrder
$sLimit";
$resultado = $link->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registros filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $link->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registros filtrados */
$sqlTotal = "SELECT count(p.id_pago) FROM $table_pago AS p WHERE p.archivado = 'no'";
$resTotal = $link->query($sqlTotal);
$row_total = $resTotal->fetch_array();
$totalRegistros = $row_total[0];

/* Mostrado resultados */
$output = [];
$output['totalRegistros'] = $totalRegistros;
$output['totalFiltro'] = $totalFiltro;
$output['data'] = '';
$output['paginacion'] = '';
$espacio = " ";

if ($num_rows > 0) {
    while ($row = $resultado->fetch_assoc()) {
        $output['data'] .= '<tr>';

        $output['data'] .= '<td class="nombre-alumno">';
        $output['data'] .= $row['nombre'] . $espacio . $row['aPaterno'] . $espacio . $row['aMaterno'] . '</td>';

        $output['data'] .= '<td class="text-center">' . $row['fecha_agregado'] . '</td>';
        // Verificación del estatus para aplicar el color adecuado
        if ($row['estatus'] == 'No Pagado') {
            $output['data'] .= '<td class="text-center"><span class="badge badge-sm bg-danger">' . $row['estatus'] . '</span></td>';
        } else {
            $output['data'] .= '<td class="text-center"><span class="badge badge-sm bg-success">' . $row['estatus'] . '</span></td>';
        }
        $output['data'] .= '<td class="text-center">' . $row['monto'] . '</td>';


        $output['data'] .= '<td class="text-center"><span class="badge badge-sm ' . ($row['descuento'] > 1 ? 'bg-danger' : 'bg-success') . '">' . $row['descuento'] . '</span></td>';



        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="reportar-pago.php?id_pago=' . $row['id_pago'] . '">Reportar pago</a></span></td>';

        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="updates/archivar-pago.php?id_pago=' . $row['id_pago'] . '">Archivar pago</a></span></td>';

        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="detalle-pago.php?id_pago=' . $row['id_pago'] . '" target="_blank">Ver detalles</a></span></td>';

        $output['data'] .= '</tr>';
    }
} else {
    $output['data'] .= '<tr>';
    $output['data'] .= '<td colspan="7">Sin resultados</td>';
    $output['data'] .= '</tr>';
}

if ($output['totalRegistros'] > 0) {
    $totalPaginas = ceil($output['totalRegistros'] / $limit);

    $output['paginacion'] .= '<nav>';
    $output['paginacion'] .= '<ul class="pagination">';

    $numeroInicio = 1;

    if (($pagina - 4) > 1) {
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if ($numeroFin > $totalPaginas) {
        $numeroFin = $totalPaginas;
    }

    for ($i = $numeroInicio; $i <= $numeroFin; $i++) {
        if ($pagina == $i) {
            $output['paginacion'] .= '<li class="page-item active"><a class="page-link" href="#">' . $i . '</a></li>';
        } else {
            $output['paginacion'] .= '<li class="page-item"><a class="page-link" href="#" onclick="nextPage(' . $i . ')">' . $i . '</a></li>';
        }
    }

    $output['paginacion'] .= '</ul>';
    $output['paginacion'] .= '</nav>';
}

echo json_encode($output, JSON_UNESCAPED_UNICODE);
?>
