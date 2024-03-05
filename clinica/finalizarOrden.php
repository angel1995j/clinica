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

                        echo "<h1><strong>Se ha completado la orden con éxito, número de orden:</strong> $id_orden</p>";
                        echo "<h3><strong>Total de la compra del usuario:</strong> $total</h3>";
                        echo "<a href='pacientes.php' class='text-center btn btn-primary'>Volver a los pacientes</a>";

                        }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php";?>
