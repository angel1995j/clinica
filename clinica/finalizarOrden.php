<?php
require "header.php";
require_once("global.php");

$link = bases();

// Obtener la lista de pacientes desde la base de datos
$sqlPacientes = "SELECT id_paciente, nombre, aPaterno, aMaterno FROM pacientes WHERE estatus = 1";
$resultPacientes = $link->query($sqlPacientes);

?>

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="card-header pb-0">
                    <h6>Detalles de la orden</h6>
                </div>

                <div class="row mt-5">
                    <?php
                    if (isset($_GET['id_orden']) && isset($_GET['total'])) {
                        $id_orden = $_GET['id_orden'];
                        $total = $_GET['total'];

                        // Aquí asumimos que el id_paciente está en la URL o en la orden. Puedes modificar según tu lógica.
                        $sqlOrden = "SELECT id_paciente FROM ordenes WHERE id_orden = $id_orden";
                        $resultOrden = $link->query($sqlOrden);

                        if ($resultOrden->num_rows > 0) {
                            $rowOrden = $resultOrden->fetch_assoc();
                            $id_paciente = $rowOrden['id_paciente'];
                            
                            echo "<h1><strong>Se ha completado la orden con éxito, número de orden:</strong> $id_orden</h1>";
                            echo "<h3><strong>Total de la compra del usuario: </strong>$$total</h3>";
                            echo "<a href='tiendita_paciente.php?id_paciente=$id_paciente' class='text-center btn btn-primary'>Volver a tiendita paciente</a>";
                        } else {
                            echo "<h1>Orden no encontrada.</h1>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php";?>
