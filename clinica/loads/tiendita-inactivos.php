<?php
require('../global.php');
$link = bases();

/* Un arreglo de las columnas a mostrar en la tabla */
$columns = ['id_producto', 'precio_venta', 'stock', 'titulo', 'descripcion' , 'precio_compra' , 'imagen', 'tipo_producto'];

/* Nombre de la tabla */
$table = "productos";

$id = 'id_producto';

$campo = isset($_POST['campo']) ? $link->real_escape_string($_POST['campo']) : null;

/* Filtrado */
$where = 'WHERE tipo_producto = "tiendita" AND estatus ="0"';

if (!empty($campo)) {
    // Si se proporciona un valor en el campo de búsqueda, agregamos una condición a $where
    $where .= " AND (titulo LIKE '%$campo%' OR descripcion LIKE '%$campo%' OR precio_venta LIKE '%$campo%')";
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
$sOrder = "ORDER BY id_producto DESC";

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

    
        $output['data'] .= '<div class="col-4">';
        $output['data'] .= '<div class="card"> <img src="assets/images/products/'. $row['imagen'] . '" class="imagen-producto" alt="...">';
        
        $output['data'] .= '<div class="card-body"><h5 class="card-title">' . $row['titulo'] . '</h5>';
        $output['data'] .= '<p class="card-text"><b>Precio:' . $row['precio_venta'] . '</b></p>';
        
        $output['data'] .= ' <div class="d-flex"> <a href="editar-producto-tiendita.php?id_producto=' . $row['id_producto'] . '" class="btn btn-outline-secondary m-1">Editar</a>';
        $output['data'] .= '<a href="updates/activar-producto.php?id_producto=' . $row['id_producto'] . '" class="btn btn-outline-danger m-1">Activar</a></div>';
        
        $output['data'] .= '</div></div></div>';
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

    if(($pagina - 4) > 1){
        $numeroInicio = $pagina - 4;
    }

    $numeroFin = $numeroInicio + 9;

    if($numeroFin > $totalPaginas){
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
