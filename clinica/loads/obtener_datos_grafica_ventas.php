<?php
require('../global.php');
$link = bases();

$sql = "SELECT SUM(total) AS total_venta, MONTH(fecha_venta) AS mes
        FROM venta
        WHERE fecha_venta IS NOT NULL
        GROUP BY YEAR(fecha_venta), MONTH(fecha_venta)";

$resultado = $link->query($sql);

$datos = [];
while ($fila = $resultado->fetch_assoc()) {
    $datos[] = $fila;
}

$link->close();

echo json_encode($datos);
?>
