<?php
require('../global.php');
$link = bases();

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_historial', 'monto', 'comprobante', 'fecha_agregado', 'fecha_pagado', 'observaciones', 'forma_pago', 'estatus', 'archivado', 'id_paciente', 'id_usuario'];

/* Nombre de la tabla */
$table = "historial_saldo";

// Obtener el id_paciente de la URL
$id_paciente = isset($_POST['id_paciente']) ? $link->real_escape_string($_POST['id_paciente']) : null;

/* Filtrado */
$where = ($id_paciente !== null) ? "id_paciente = '$id_paciente' AND archivado = 'si'" : 'archivado = "si"';

 
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
    $orderType = isset($_POST['orderType']) ? $_POST['orderType'] : 'asc';

    $sOrder = "ORDER BY " . $columns[intval($orderCol)] . ' ' . $orderType;
}

/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
WHERE $where
$sOrder
$sLimit";

$resultado = $link->query($sql);
$num_rows = $resultado->num_rows;

/* Consulta para total de registro filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $link->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registro filtrados */
$sqlTotal = "SELECT COUNT(id_historial) FROM $table WHERE estatus = 'No Pagado' AND archivado = 'no'";
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
        $output['data'] .= '<td class="text-center">' . $row['observaciones'] . '</td>';
        $output['data'] .= '<td class="text-center">' . $row['fecha_agregado'] . '</td>';
        $output['data'] .= '<td class="text-center">' . $row['monto'] . '</td>';
        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="detalle-saldo.php?id_historial=' . $row['id_historial'] . '" target="_blank">Ver detalles</a></span></td>';
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

