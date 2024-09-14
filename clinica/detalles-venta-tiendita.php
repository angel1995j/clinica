<?php
require "header.php"; 

$id_orden = $_GET['id_orden'];

if (!$id_orden) {
    die('ID del orden no proporcionado');
}

// Conecta a la base de datos y obtén los datos del pago
require('global.php');
$link = bases();

// Consulta para obtener la información de la orden
$sql_pago = "SELECT * FROM ordenes WHERE id_orden = $id_orden";
$resultado_pago = $link->query($sql_pago);
$pago = $resultado_pago->fetch_assoc();

// Consulta para obtener los detalles de la orden y el nombre del producto
// Consulta para obtener los detalles de la orden y el nombre del producto
$sql_detalles = "
    SELECT 
        do.id_detalle, do.id_orden, do.cantidad, do.precio_unitario, do.subtotal, p.titulo
    FROM 
        detalles_orden do
    JOIN 
        productos p ON do.id_producto = p.id_producto
    WHERE 
        do.id_orden = $id_orden";
        
$resultado_detalles = $link->query($sql_detalles);

if (!$resultado_detalles) {
    die("Error en la consulta SQL: " . $link->error);
}

?>

<!--SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="movimientos_tiendita_paciente.php?id_paciente=<?php echo $pago['id_paciente']; ?>" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i> Volver a los movimientos</a>

            <div class="container">
                <h2 class="text-center mb-4">Detalle de Compra</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Información de Compra</h5>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Total:</strong> <?php echo $pago['total']; ?></p>
                                <p><strong>Firma:</strong> 
                                    <img src ="<?php echo '' . str_replace('../', '', $pago['firma']); ?>" alt="Firma" width="780">
                                </p>


                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detalles de la Orden -->
                <div class="row mt-4">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Productos</h5>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Producto</th>
                                            <th>Cantidad</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($detalle = $resultado_detalles->fetch_assoc()) { ?>
                                            <tr>
                                                <td><?php echo $detalle['titulo']; ?></td>
                                                <td><?php echo $detalle['cantidad']; ?></td>
                                                <td><?php echo $detalle['precio_unitario']; ?></td>
                                                <td><?php echo $detalle['subtotal']; ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!--- FIN CONTENIDO DE TABLA -->
    </div>
</div>
<!-- SECCION GENERAL -->

<?php require "footer.php"; ?>
