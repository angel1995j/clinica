<?php
require "header.php"; 

$id_compra = $_GET['id_compra'];

if (!$id_compra) {
    die('ID del pago no proporcionado');
}

// Conecta a la base de datos y obtén los datos del pago
require('global.php');
$link = bases();
$sql_pago = "SELECT * FROM compras WHERE id_compra = $id_compra";
$resultado_pago = $link->query($sql_pago);
$pago = $resultado_pago->fetch_assoc();

?>

<!--SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!--- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="compras.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i> Volver a todas las compras</a>

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
                                <p><strong>Monto:</strong> <?php echo $pago['monto']; ?></p>
                                <p><strong>Concepto:</strong> <?php echo $pago['concepto']; ?></p>
                                <p><strong>Quién Compra:</strong> <?php echo $pago['quien_compra']; ?></p>
                                <p><strong>Fecha de Aplicación:</strong> <?php echo $pago['fecha_aplicacion']; ?></p>
                                <p><strong>Comprobante:</strong> <?php echo $pago['comprobante']; ?></p>
                                <p><strong>Archivado:</strong> <?php echo $pago['archivado']; ?></p>
                                 <p><strong>Estatus:</strong> <?php echo $pago['estatus']; ?></p>
                                <p><strong>ID Usuario:</strong> <?php echo $pago['id_usuario']; ?></p>
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
