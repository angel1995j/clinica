<?php
require('global.php');
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['rol'])) {
    header("Location: login.php");
    exit();
}

// Verificar el rol del usuario
$user_role = $_SESSION['rol'];
if ($user_role == 'SuperAdministrador') {
    require "header.php";
} else {
    require "header-recepcion.php";
}

// Obtener id_paciente de la URL
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;
if ($id_paciente == 0) {
    echo "Paciente no encontrado.";
    exit();
}

// Conexión a la base de datos
$link = bases();

// Consulta para obtener las peticiones del paciente
$sql = "SELECT id_peticion, detalle, quien_procesa, monto, estatus 
        FROM peticion_paciente 
        WHERE id_paciente = ?";
$stmt = $link->prepare($sql);
$stmt->bind_param("i", $id_paciente);
$stmt->execute();
$stmt->bind_result($id_peticion, $detalle, $quien_procesa, $monto, $estatus);

?>

<!--SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-6">
            <h4>Peticiones del Paciente</h4>
        </div>
        <div class="col-6 text-right" style="text-align: right;">
            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPeticionModal">
                Agregar Petición
            </button>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="card-header pb-0">
                    <h6>Lista de Peticiones</h6>
                </div>

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">ID Petición</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Detalle</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Quién Procesa</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Monto</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Estatus</th>
                                    <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $has_rows = false;
                                while ($stmt->fetch()): 
                                    $has_rows = true;
                                    $estatus_class = ($estatus == 'resuelta') ? 'text-success' : 'text-danger';
                                ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($id_peticion); ?></td>
                                        <td><?php echo htmlspecialchars($detalle); ?></td>
                                        <td><?php echo htmlspecialchars($quien_procesa); ?></td>
                                        <td><?php echo htmlspecialchars($monto); ?></td>
                                        <td class="<?php echo $estatus_class; ?>"><?php echo htmlspecialchars($estatus); ?></td>
                                        <td>
                                            <a href="updates/marcar-peticion.php?id_peticion=<?php echo $id_peticion; ?>&id_paciente=<?php echo $id_paciente; ?>" class="btn btn-secondary btn-sm" style="margin-left: 1%;">Marcar como Resuelta</a>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                                <?php if (!$has_rows): ?>
                                    <tr>
                                        <td colspan="6">No se encontraron peticiones para este paciente.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para agregar nueva petición -->
<div class="modal fade" id="addPeticionModal" tabindex="-1" role="dialog" aria-labelledby="addPeticionModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addPeticionModalLabel">Agregar Nueva Petición</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="inserts/peticion.php" method="POST">
                <div class="modal-body">
                    <div class="form-group mt-3">
                        <label for="detalle">Detalle</label>
                        <textarea class="form-control" id="detalle" name="detalle" required></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="quien_procesa">Quién Procesa</label>
                        <select class="form-control" id="quien_procesa" name="quien_procesa" required>
                            <option value="administracion">Administración</option>
                            <option value="recepcion">Recepción</option>
                            <option value="medico">Médico</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="monto">Monto</label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto">
                    </div>
                    <div class="form-group mt-3">
                        <label for="estatus">Estatus</label>
                        <select class="form-control" id="estatus" name="estatus" required>
                            <option value="resuelta">Resuelta</option>
                            <option value="no resuelta">No Resuelta</option>
                        </select>
                    </div>
                    <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- SECCION GENERAL -->

<?php 
$stmt->close();
$link->close();
require "footer.php";
?>
