<?php
require "header.php";

// Verifica si se recibió un ID de paciente válido desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;

if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();
$sql_paciente = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
$resultado_paciente = $link->query($sql_paciente);

// Verifica si se encontraron datos para el paciente
if ($resultado_paciente->num_rows === 0) {
    die('No se encontraron datos para el paciente con ID ' . $id_paciente);
}

$paciente = $resultado_paciente->fetch_assoc();
?>

<!--SECCION GENERAL -->

<div class="container-fluid py-4 mt-5">


    <div class="row mt-5">
        <div class="col-12 mt-4">
            <div class="card mb-4 px-3">

                <a href="perfil.php?id_paciente=<?php echo $paciente['id_paciente']; ?>" class="text-secondary mt-3">
                    <i class="fa fa-undo" aria-hidden="true"></i> Volver a perfil del paciente
                </a>

              

                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container mt-3">
                        <h2>Editar Paciente: <?php echo $paciente['nombre'] . " " . $paciente['aPaterno']; ?></h2>

                        <!-- Formulario de edición -->
                        <form action="updates/paciente.php" method="POST">
                            <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="<?php echo $paciente['nombre']; ?>" required>
                            </div>

                            <div class="form-group">
                                <label for="aPaterno">Apellido Materno:</label>
                                <input type="text" class="form-control" name="aMaterno" value="<?php echo $paciente['aMaterno']; ?>" required>
                            </div>


                            <div class="form-group">
                                <label for="aPaterno">Apellido Paterno:</label>
                                <input type="text" class="form-control" name="aPaterno" value="<?php echo $paciente['aPaterno']; ?>" required>
                            </div>


                         
                            <div class="form-group">
                                <label for="fechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="text" class="form-control" name="fechaNacimiento" value="<?php echo $paciente['fechaNacimiento']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="sexo">Sexo:</label>
                                <input type="text" class="form-control" name="sexo" value="<?php echo $paciente['sexo']; ?>" >
                            </div>


                            <div class="form-group">
                                <label for="edad">Edad:</label>
                                <input type="text" class="form-control" name="edad" value="<?php echo $paciente['edad']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="edad">direccion:</label>
                                <input type="text" class="form-control" name="direccion" value="<?php echo $paciente['direccion']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="telefono" class="form-control" name="telefono" value="<?php echo $paciente['telefono']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="edad">Nacionalidad:</label>
                                <input type="text" class="form-control" name="nacionalidad" value="<?php echo $paciente['nacionalidad']; ?>" >
                            </div>


                            <div class="form-group">
                                <label for="ocupacion">Ocupación:</label>
                                <input type="text" class="form-control" name="ocupacion" value="<?php echo $paciente['ocupacion']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="ingresosPrevios">Ingresos Previos:</label>
                                <input type="text" class="form-control" name="ingresosPrevios" value="<?php echo $paciente['ingresosPrevios']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="fechasIngresosPrevios">Fechas Ingresos Previos:</label>
                                <input type="text" class="form-control" name="fechasIngresosPrevios" value="<?php echo $paciente['fechasIngresosPrevios']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="institucionRefiere">Institución que refiere:</label>
                                <input type="text" class="form-control" name="institucionRefiere" value="<?php echo $paciente['institucionRefiere']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="nombreReferencia">Nombre de Referencia:</label>
                                <input type="text" class="form-control" name="nombreReferencia" value="<?php echo $paciente['nombreReferencia']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="fechaIngreso">Fecha de Ingreso:</label>
                                <input type="text" class="form-control" name="fechaIngreso" value="<?php echo $paciente['fechaIngreso']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="horaIngreso">Hora de Ingreso:</label>
                                <input type="text" class="form-control" name="horaIngreso" value="<?php echo $paciente['horaIngreso']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="hojaReferencia">Hoja de Referencia:</label>
                                <input type="text" class="form-control" name="hojaReferencia" value="<?php echo $paciente['hojaReferencia']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="tipoIngreso">Tipo de Ingreso:</label>
                                <input type="text" class="form-control" name="tipoIngreso" value="<?php echo $paciente['tipoIngreso']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="revisionFisicaGeneral">Revisión Física General:</label>
                                <input type="text" class="form-control" name="revisionFisicaGeneral" value="<?php echo $paciente['revisionFisicaGeneral']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="vestimentaIngreso">Vestimenta de Ingreso:</label>
                                <input type="text" class="form-control" name="vestimentaIngreso" value="<?php echo $paciente['vestimentaIngreso']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="pertenenciasIngreso">Pertenencias de Ingreso:</label>
                                <input type="text" class="form-control" name="pertenenciasIngreso" value="<?php echo $paciente['pertenenciasIngreso']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="ultimoConsumo">Último Consumo:</label>
                                <input type="text" class="form-control" name="ultimoConsumo" value="<?php echo $paciente['ultimoConsumo']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="intoxicado">Intoxicado:</label>
                                <input type="text" class="form-control" name="intoxicado" value="<?php echo $paciente['intoxicado']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="estatus">Estatus:</label>
                                <input type="text" class="form-control" name="estatus" value="<?php echo $paciente['estatus']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="nombreFamiliar">Nombre del Familiar:</label>
                                <input type="text" class="form-control" name="nombreFamiliar" value="<?php echo $paciente['nombreFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="edadFamiliar">Edad del Familiar:</label>
                                <input type="text" class="form-control" name="edadFamiliar" value="<?php echo $paciente['edadFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="ocupacionFamiliar">Ocupación del Familiar:</label>
                                <input type="text" class="form-control" name="ocupacionFamiliar" value="<?php echo $paciente['ocupacionFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="parentescoFamiliar">Parentesco del Familiar:</label>
                                <input type="text" class="form-control" name="parentescoFamiliar" value="<?php echo $paciente['parentescoFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="direccionFamiliar">Dirección del Familiar:</label>
                                <input type="text" class="form-control" name="direccionFamiliar" value="<?php echo $paciente['direccionFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="identificacionFamiliar">Identificación del Familiar:</label>
                                <input type="text" class="form-control" name="identificacionFamiliar" value="<?php echo $paciente['identificacionFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="correoFamiliar">Correo del Familiar:</label>
                                <input type="text" class="form-control" name="correoFamiliar" value="<?php echo $paciente['correoFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="telefonoFamiliar">Teléfono del Familiar:</label>
                                <input type="text" class="form-control" name="telefonoFamiliar" value="<?php echo $paciente['telefonoFamiliar']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="sustanciaPsicoactiva">Sustancia Psicoactiva:</label>
                                <input type="text" class="form-control" name="sustanciaPsicoactiva" value="<?php echo $paciente['sustanciaPsicoactiva']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="tiempoSustanciaPsicoactiva">Tiempo de Sustancia Psicoactiva:</label>
                                <input type="text" class="form-control" name="tiempoSustanciaPsicoactiva" value="<?php echo $paciente['tiempoSustanciaPsicoactiva']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="enfermedades">Enfermedades:</label>
                                <input type="text" class="form-control" name="enfermedades" value="<?php echo $paciente['enfermedades']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="hospitalizacionesRecientes">Hospitalizaciones Recientes:</label>
                                <input type="text" class="form-control" name="hospitalizacionesRecientes" value="<?php echo $paciente['hospitalizacionesRecientes']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="centroReclusion">Centro de Reclusión:</label>
                                <input type="text" class="form-control" name="centroReclusion" value="<?php echo $paciente['centroReclusion']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="asistenciaGrupos">Asistencia a Grupos:</label>
                                <input type="text" class="form-control" name="asistenciaGrupos" value="<?php echo $paciente['asistenciaGrupos']; ?>" >
                            </div>

                            <div class="form-group">
                                <label for="restriccionesConsumo">Restricciones de Consumo:</label>
                                <input type="text" class="form-control" name="restriccionesConsumo" value="<?php echo $paciente['restriccionesConsumo']; ?>" >
                            </div>



                            <!-- Continúa agregando los campos restantes -->

                            <button type="submit" class="btn btn-primary mt-3">Guardar Cambios</button>
                        </form>

                        <!-- Resto de tu código HTML -->

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>
