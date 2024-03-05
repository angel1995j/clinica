<?php
require('../global.php');
$link = bases();

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_paciente', 'nombre', 'aPaterno', 'aMaterno', 'fechaIngreso'];

/* Nombre de la tabla */
$table = "pacientes";

$id = 'id_paciente';

$campo = isset($_POST['campo']) ? $link->real_escape_string($_POST['campo']) : null;

/* Filtrado */
$where = 'WHERE archivado = "si"';

if (!empty($campo)) {
    // Si se proporciona un valor en el campo de búsqueda, agregamos una condición a $where
    $where .= " AND (nombre LIKE '%$campo%' OR aPaterno LIKE '%$campo%' OR aMaterno LIKE '%$campo%')";
}

/* Limit */
$limit = 10;
$pagina = isset($_POST['pagina']) ? $link->real_escape_string($_POST['pagina']) : 0;

if (!$pagina) {
    $inicio = 0;
    $pagina = 1;
} else {
    $inicio = ($pagina - 1) * $limit;
}

$sLimit = "LIMIT $inicio, $limit";

/**
 * Ordenamiento
 */
/* Ordenamiento por id_paciente de manera descendente */
$sOrder = "ORDER BY id_paciente DESC";

/* Consulta */
$sql = "SELECT SQL_CALC_FOUND_ROWS " . implode(", ", $columns) . "
FROM $table
$where
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
$sqlTotal = "SELECT count($id) FROM $table ";
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
        // Obtener el próximo pago a vencer
        $id_paciente = $row['id_paciente'];
        $sql_proximo_pago = "SELECT fecha_agregado FROM pago_paciente WHERE id_paciente = $id_paciente AND estatus = 'No Pagado' AND fecha_pagado IS NOT NULL ORDER BY fecha_pagado LIMIT 1";
        $resultado_proximo_pago = $link->query($sql_proximo_pago);

        // Verificar si hay resultados antes de intentar acceder a las propiedades
        if ($resultado_proximo_pago && $resultado_proximo_pago->num_rows > 0) {
            $proximo_pago = $resultado_proximo_pago->fetch_assoc();
            $fecha_agregado = $proximo_pago['fecha_agregado'];
        } else {
            $fecha_agregado = '';
        }

        $output['data'] .= '<tr>';
        $output['data'] .= '<td class="nombre-alumno">' . $row['nombre'] . $espacio . $row['aPaterno'] . $espacio . $row['aMaterno'] . '</td>';
        $output['data'] .= '<td>' . $fecha_agregado . '</td>';
        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="badge badge-sm ' . ($fecha_agregado ? 'bg-success' : 'bg-danger') . '">' . ($fecha_agregado ? 'Pagado' : 'No Pagado') . '</span></td>';

        // Asegurarse de que "programa" esté definido en la fila antes de intentar acceder
        $output['data'] .= '<td class="text-center programa"><span class="badge badge-sm bg-primary">' . (isset($row['programa']) ? $row['programa'] : '') . '</span></td>';

        // Asegurarse de que "id_alumno" esté definido en la fila antes de intentar acceder
        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="docs-paciente.php?id_paciente=' . $row['id_paciente'] . '">Ver documentos</a></span></td>';
        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="perfil.php?id_paciente=' . $row['id_paciente'] . '">Ver perfil</a></span></td>';
        $output['data'] .= '<td class="align-middle text-center text-sm"><span class="text-secondary text-xs font-weight-bold"><a class="btn boton-secundario" href="updates/activar-pacientes.php?id_paciente=' . (isset($row['id_paciente']) ? $row['id_paciente'] : '') . '">Activar paciente</a></span></td>';
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
