<?php
require "header.php";
require "global.php";

$link = bases();

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Consulta para obtener datos existentes de la historia_clinica
$sqlConsulta = "SELECT * FROM historia_clinica WHERE id_paciente = $id_paciente";
$resultadoConsulta = $link->query($sqlConsulta);
$datosHistoriaClinica = $resultadoConsulta->fetch_assoc();



// Consulta para obtener datos del paciente
$sqlPaciente = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
$resultadoPaciente = $link->query($sqlPaciente);
$datosPaciente = $resultadoPaciente->fetch_assoc();

?>

<!--SECCION GENERAL -->

<!-- End Navbar -->

<div class="container-fluid py-4 mt-5">

    <div class="row mt-5">
        <a href="perfil.php?id_paciente=<?php echo $id_paciente; ?>" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
            Volver a perfil del paciente</a>

            <h2 class="text-center mt-3">Historia clinica del paciente: <?php echo $datosPaciente['nombre']. " ".$datosPaciente['aPaterno'] ?></h2>

    

        <div class="col-12 mt-5">
            <div class="card mb-4 px-3">

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Historia Clínica</h2>
                        <form action="updates/historia_clinica.php" method="POST">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">

                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group mt-3">
                                        <label for="fecha">Fecha de Consulta:</label>
                                        <input type="date" class="form-control" id="fecha" name="fecha"
                                            value="<?php echo $datosHistoriaClinica['fecha_consulta'] ?? ''; ?>"
                                            required>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="alergias">Alergias:</label>
                                        <textarea class="form-control" id="alergias" name="alergias"
                                            rows="4"><?php echo $datosHistoriaClinica['alergias'] ?? ''; ?></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="operaciones">Operaciones Previas:</label>
                                        <textarea class="form-control" id="operaciones" name="operaciones"
                                            rows="4"><?php echo $datosHistoriaClinica['operaciones_previas'] ?? ''; ?></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="hospitalizaciones">Hospitalizaciones Previas:</label>
                                        <textarea class="form-control" id="hospitalizaciones" name="hospitalizaciones"
                                            rows="4"><?php echo $datosHistoriaClinica['hospitalizaciones_previas'] ?? ''; ?></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="padecimientos">Padecimientos Actuales:</label>
                                        <textarea class="form-control" id="padecimientos" name="padecimientos"
                                            rows="4"><?php echo $datosHistoriaClinica['padecimientos_actuales'] ?? ''; ?></textarea>
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mt-3">
                                        <label for="diagnostico">Diagnóstico:</label>
                                        <textarea class="form-control" id="diagnostico" name="diagnostico"
                                            rows="4" required><?php echo $datosHistoriaClinica['diagnostico'] ?? ''; ?></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="tratamiento">Tratamiento:</label>
                                        <textarea class="form-control" id="tratamiento" name="tratamiento"
                                            rows="4" required><?php echo $datosHistoriaClinica['tratamiento'] ?? ''; ?></textarea>
                                    </div>

                                    <div class="form-group mt-3">
                                        <label for="bioquimica">Resultados de Bioquímica:</label>
                                        <textarea class="form-control" id="bioquimica" name="bioquimica"
                                            rows="4"><?php echo $datosHistoriaClinica['resultados_bioquimica'] ?? ''; ?></textarea>
                                    </div>

                                    

                                    <div class="form-group mt-3">
                                        <label for="historiaFamiliar">Historia Familiar de Enfermedades:</label>
                                        <textarea class="form-control" id="historiaFamiliar" name="historiaFamiliar"
                                            rows="4"><?php echo $datosHistoriaClinica['historia_familiar_enfermedades'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                            </div>
                            <br><br>
                            <button type="submit" class="btn btn-primary">Guardar</button><br><br>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <?php
        require "footer.php";
        ?>
