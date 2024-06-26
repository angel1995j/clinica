<?php
require('../global.php');
$link = bases();

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['o.id_consumo', 'o.concepto', 'o.monto', 'o.fecha_consumo', 'o.id_paciente', 'o.id_usuario'];

/* Nombre de la tabla */
$table_orden = "consumo";

$id_paciente = 'o.id_paciente';

$campo = isset($_POST['campo']) ? $link->real_escape_string($_POST['campo']) : null;

/* Filtrado */
$where = '';

if (!empty($campo)) {
    // Si se proporciona un valor en el campo de búsqueda, agregamos una condición a $where
    $where .= " AND (o.concepto LIKE '%$campo%')";
}

/* Agrega la condición para archivado = 'no' */
$where .= "";

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
FROM $table_orden AS o
WHERE 1 $where
$sOrder
$sLimit";
$resultado = $link->query($sql);

if (!$resultado) {
    die('Error en la consulta: ' . $link->error);
}

$num_rows = 0;

if ($resultado instanceof mysqli_result) {
    $num_rows = $resultado->num_rows;
}

/* Resto del código */

/* Consulta para total de registros filtrados */
$sqlFiltro = "SELECT FOUND_ROWS()";
$resFiltro = $link->query($sqlFiltro);
$row_filtro = $resFiltro->fetch_array();
$totalFiltro = $row_filtro[0];

/* Consulta para total de registros filtrados */
$sqlTotal = "SELECT COUNT(id_consumo) FROM $table_orden AS o";
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

    $output['data'] .= '<td class="concepto">';
    $concepto = isset($row['concepto']) ? $row['concepto'] : 'Concepto no disponible';
    $output['data'] .= $concepto;
    $output['data'] .= '</td>';

    $output['data'] .= '<td class="text-center">';
    $fechaConsumo = isset($row['fecha_consumo']) ? $row['fecha_consumo'] : 'Fecha no disponible';
    $output['data'] .= $fechaConsumo;
    $output['data'] .= '</td>';

    $output['data'] .= '<td class="text-center">';
    $total = isset($row['monto']) ? $row['monto'] : 'Total no disponible';
    $output['data'] .= $total;
    $output['data'] .= '</td>';
    // Resto del código...
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
