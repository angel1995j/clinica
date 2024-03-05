<?php
require "header-apoyo.php";

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();
$sql_paciente = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";

$resultado_paciente = $link->query($sql_paciente);

$paciente = $resultado_paciente->fetch_assoc();

// Obtén los registros de la tabla "agenda" para el paciente actual con fecha próxima y los datos de usuario
$hoy = date('Y-m-d H:i:s');
$sql_agenda = "SELECT agenda.*, usuarios.nombre AS nombre_usuario, usuarios.aPaterno AS aPaterno_usuario, usuarios.rol AS rol_usuario 
               FROM agenda 
               INNER JOIN usuarios ON agenda.id_usuario = usuarios.id_usuario
               WHERE agenda.id_paciente = $id_paciente AND agenda.fecha > '$hoy' 
               ORDER BY agenda.fecha";
$resultado_agenda = $link->query($sql_agenda);

// Obtén la lista de usuarios con rol Padrino o Psicologo
$sql_usuarios = "SELECT id_usuario, CONCAT(nombre, ' ', aPaterno, ' - ', rol) AS nombre_rol FROM usuarios WHERE rol IN ('Padrino', 'Psicologo', 'Medico')";
$resultado_usuarios = $link->query($sql_usuarios);

?>

<!--SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        


        <a href="pacientes-apoyo.php" class="text-secondary mt-3">
            <i class="fa fa-undo" aria-hidden="true"></i> Volver a todos los pacientes
        </a>
 






        <div class="col-12 mt-4">
            <div class="card mb-4 px-3">
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Agenda del paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?></h2>

                        <div class="row">
                            <div class="col-lg-12 d-flex align-items-stretch">
                                <div class="card w-100 mt-3">
                                    <div class="card-body p-4">
                                        <div class="mb-4">
                                            <h5 class="card-title fw-semibold">Agenda del paciente</h5>
                                        </div>

                                        <div class="container mt-5">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Fecha</th>
                                                            <th>Observaciones</th>
                                                            <th>Cita con</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php while ($fila_agenda = $resultado_agenda->fetch_assoc()) : ?>
                                                            <tr>
                                                                <td><?php echo $fila_agenda['fecha']; ?></td>
                                                                <td>
                                                                    <span class="badge badge-sm bg-success">
                                                                        <?php echo $fila_agenda['observaciones']; ?>
                                                                    </span>
                                                                </td>
                                                                <td><?php echo $fila_agenda['nombre_usuario'] . " " . $fila_agenda['aPaterno_usuario']. " - " . $fila_agenda['rol_usuario']; ?></td>
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

                    </div>

                </div>

            </div>
        </div>

    </div>
</div>

<?php
require "footer.php";
?>
