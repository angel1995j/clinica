<?php
require "header.php"; 

$id_solicitud = $_GET['id_solicitud'];

if (!$id_solicitud) {
    die('ID de la solicitud no proporcionado');
}

// Conecta a la base de datos y obtén los datos de la solicitud
require('global.php');
$link = bases();
$sql_solicitud = "SELECT * FROM solicitudes WHERE id_solicitud = $id_solicitud";
$resultado_solicitud = $link->query($sql_solicitud);
$solicitud = $resultado_solicitud->fetch_assoc();

// Recupera el nombre del usuario asociado al id_usuario en la tabla usuarios
$id_usuario = $solicitud['id_usuario'];
$sql_nombre_usuario = "SELECT nombre_usuario FROM usuarios WHERE id_usuario = $id_usuario";
$resultado_nombre_usuario = $link->query($sql_nombre_usuario);
$datos_usuario = $resultado_nombre_usuario->fetch_assoc();

// Recupera los ítems asociados a la solicitud desde la tabla detalle_solicitudes
$sql_detalle = "SELECT * FROM detalle_solicitudes WHERE id_solicitud = $id_solicitud";
$resultado_detalle = $link->query($sql_detalle);
?>

<!-- SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 px-3 mt-5">
        <!-- INICIA CONTENIDO DE TABLA -->
        <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="solicitudes.php" class="text-secondary mt-3">
                <i class="fa fa-undo" aria-hidden="true"></i> Volver a todas las solicitudes</a>

            <div class="container">
                <h2 class="text-center mb-4">Detalle de Solicitud</h2>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <h5 class="card-title">Información de Solicitud</h5>
                            </div>
                        </div>
                        <div class="card mt-3">
                            <div class="card-body">
                                <p><strong>Descripción:</strong> <?php echo $solicitud['descripcion']; ?></p>
                                <p><strong>Fecha:</strong> <?php echo $solicitud['fecha']; ?></p>
                                <p><strong>Archivado:</strong> <?php echo $solicitud['archivado']; ?></p>
                                <p><strong>Usuario:</strong> <?php echo $datos_usuario['nombre_usuario']; ?></p>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="card bg-success text-white text-center mt-5">
                            <div class="card-body">
                                <h5 class="card-title">Detalles de Ítems</h5>
                            </div>
                        </div>

                        <div class="card mt-3">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Descripción del Ítem</th>
                                            <th>Cantidad</th>
                                            <th>Unidad de Medida</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while ($detalle = $resultado_detalle->fetch_assoc()): ?>
                                            <tr>
                                                <td><?php echo $detalle['descripcion_item']; ?></td>
                                                <td><?php echo $detalle['cantidad']; ?></td>
                                                <td><?php echo $detalle['unidad_medida']; ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- FIN CONTENIDO DE TABLA -->
    </div>
</div>
<!-- SECCION GENERAL -->

<?php require "footer.php"; ?>