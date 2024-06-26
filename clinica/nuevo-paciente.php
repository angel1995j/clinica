<?php require "header.php";?> 

<!-- SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="card-header pb-0">
                    <h6>Ingresa los datos del paciente que va ingresar a la clinica, por favor rellena todos los datos</h6>
                </div>

                <!--- INICIA CONTENIDO DE TABLA -->
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="container">
                        <h2 class="mt-5">Ingresa los datos del ingreso</h2>
                        <form action="inserts/pacientes.php" method="POST">
                            <div class="row mt-3">
                                <!-- Hora de Ingreso y Fecha de Ingreso -->
                                <div class="form-group col-6">
                                    <label>Hora de Ingreso:</label>
                                    <input type="time" class="form-control" id="horaIngreso" name="horaIngreso">
                                </div>
                                <div class="form-group col-6">
                                    <label>Fecha de Ingreso:</label>
                                    <input type="date" class="form-control" id="fechaIngreso" name="fechaIngreso">
                                </div>
                            </div>  

                            <!-- Datos del Usuario -->
                            <h3 class="mt-5">Ingresa los datos del usuario</h3>
                            <div class="row mt-3">
                                <div class="form-group col-md-6 col-sm-12">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" placeholder="Nombre completo" name="nombre">
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label>Apellido Paterno</label>
                                    <input type="text" class="form-control" placeholder="Apellido Paterno" name="aPaterno">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Apellido Materno</label>
                                    <input type="text" class="form-control" placeholder="Apellido Materno" name="aMaterno">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Sexo:</label>
                                    <select class="form-control" name="sexo">
                                        <option value="Masculino">Masculino</option>
                                        <option value="Femenino">Femenino</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Fecha de nacimiento:</label>
                                    <input type="date" class="form-control" id="fechaNacimiento" name="fechaNacimiento" onchange="calcularEdad()">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Edad:</label>
                                    <input type="number" class="form-control" id="edad" placeholder="Edad" name="edad" readonly>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Dirección:</label>
                                    <input type="text" class="form-control" placeholder="Dirección" name="direccion">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Teléfono(s):</label>
                                    <input type="text" class="form-control" placeholder="Teléfono(s)" name="telefono">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Nacionalidad:</label>
                                    <input type="text" class="form-control" placeholder="Nacionalidad" name="nacionalidad">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Estado civil:</label>
                                    <select class="form-control" name="estadoCivil">
                                        <option value="Soltero(a)">Soltero(a)</option>
                                        <option value="Casado(a)">Casado(a)</option>
                                        <option value="Divorciado(a)">Divorciado(a)</option>
                                        <option value="Viudo(a)">Viudo(a)</option>
                                        <option value="Unión libre">Unión libre</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Escolaridad:</label>
                                    <select class="form-control" name="escolaridad">
                                        <option value="Primaria">Primaria</option>
                                        <option value="Secundaria">Secundaria</option>
                                        <option value="Preparatoria">Preparatoria</option>
                                        <option value="Licenciatura">Licenciatura</option>
                                        <option value="Posgrado">Posgrado</option>
                                        <option value="Otro">Otro</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Ocupación:</label>
                                    <input type="text" class="form-control" placeholder="Ocupación" name="ocupacion">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>¿Cuántos ingresos previos ha tenido en el establecimiento?</label>
                                    <input type="number" class="form-control" placeholder="Cantidad" name="ingresosPrevios">
                                    <br>
                                    <label>¿Lo refiere alguna institución?</label>
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" name="institucionRefiere" value="Si"> Si
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="institucionRefiere" value="No"> No
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group col-md-6 col-sm-12">
                                    <label class="mt-3">Fecha(s) de Ingresos previos:</label>
                                    <input type="text" class="form-control" placeholder="Fecha(s)" name="fechasIngresosPrevios">
                                    <label class="mt-3">¿Cuál?</label>
                                    <input type="text" class="form-control" placeholder="Nombre de la institución" name="nombreReferencia">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>¿Presenta hoja de referencia?</label>
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" name="hojaReferencia" value="Si"> Si
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="hojaReferencia" value="No"> No
                                        </label>
                                    </div>
                                    <p>*EN CASO AFIRMATIVO ANEXAR AL EXPEDIENTE</p>
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Tipo de ingreso actual:</label>
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipoIngreso" value="Voluntario"> Voluntario
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipoIngreso" value="Involuntario"> Involuntario
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="tipoIngreso" value="Obligatorio"> Obligatorio
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group mt-3 col-md-6 col-sm-12">
                                    <label>Sustancia (s) psicoactiva (s) de consumo frecuente:</label>
                                    <input type="text" class="form-control" placeholder="Sustancia (s) psicoactiva (s)" name="sustanciaPsicoactiva">
                                </div>
                                <div class="form-group mt-3 col-md-6 col-sm-12">
                                    <label>Tiempo aproximado de consumirla (s) sustancia (s) psicoactiva (s):</label>
                                    <input type="text" class="form-control" placeholder="Tiempo de consumo" name="tiempoSustanciaPsicoactiva">
                                </div>
                                <div class="form-group mt-3 col-md-6 col-sm-12">
                                    <label>Enfermedades que ha padecido de 5 años a la fecha:</label>
                                    <input type="text" class="form-control" placeholder="Enfermedades" name="enfermedades">
                                </div>
                                <div class="form-group mt-3 col-md-6 col-sm-12">
                                    <label>Hospitalizaciones recientes:</label>
                                    <input type="text" class="form-control" placeholder="Hospitalizaciones recientes" name="hospitalizacionesRecientes">
                                </div>
                                <div class="form-group mt-3 col-md-6 col-sm-12">
                                    <label>Internamientos a algún Centro de Reclusión:</label>
                                    <input type="text" class="form-control" placeholder="Centro de Reclusión" name="centroReclusion">
                                </div>
                                <div class="form-group mt-3 col-md-6 col-sm-12">
                                    <label>Asistencia a grupos tradicionales de AA:</label>
                                    <input type="text" class="form-control" placeholder="Asistencia a AA" name="asistenciaGrupos">
                                </div>
                            </div> <!-- END ROW -->

                            <!-- Datos del Familiar o Representante Legal -->
                            <h3 class="mt-5">Ingresa los datos del Familiar o Representante Legal</h3>
                            <div class="row mt-3">
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Nombre:</label>
                                    <input type="text" class="form-control" placeholder="Nombre del familiar/representante" name="nombreFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Edad:</label>
                                    <input type="text" class="form-control" placeholder="Edad del familiar/representante" name="edadFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Identificacion:</label>
                                    <input type="text" class="form-control" placeholder="Identificación" name="identificacionFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Ocupación:</label>
                                    <input type="text" class="form-control" placeholder="Ocupación del familiar/representante" name="ocupacionFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Parentesco:</label>
                                    <input type="text" class="form-control" placeholder="Parentesco" name="parentescoFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Dirección:</label>
                                    <input type="text" class="form-control" placeholder="Dirección del familiar/representante" name="direccionFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Teléfono(s):</label>
                                    <input type="text" class="form-control" placeholder="Teléfono(s) del familiar/representante" name="telefonoFamiliar">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Correo Electrónico:</label>
                                    <input type="text" class="form-control" placeholder="Correo Electrónico" name="correoFamiliar">
                                </div>
                            </div> <!-- END ROW -->

                            <!-- Revisión Física General -->
                            <h3 class="mt-5">Ingresa los datos de la revisión Física General</h3>
                            <div class="form-group mt-3">
                                <label>Revisión física general:</label>
                                <textarea class="form-control" rows="4" placeholder="Anotar tatuajes, perforaciones, golpes, cicatrices, etc." name="revisionFisicaGeneral"></textarea>
                            </div>

                            <!-- Vestimenta con la que ingresa -->
                            <div class="form-group mt-3">
                                <label>Vestimenta con la que ingresa:</label>
                                <textarea class="form-control" rows="4" placeholder="Descripción de la vestimenta" name="vestimentaIngreso"></textarea>
                            </div>

                            <!-- Artículos y Pertenencias -->
                            <div class="form-group mt-3">
                                <label>Artículos y Pertenencias que se resguardan:</label>
                                <textarea class="form-control" rows="4" placeholder="Lista de artículos y pertenencias" name="pertenenciasIngreso"></textarea>
                            </div>

                            <!-- Última vez que consumió -->
                            <div class="row">
                                <div class="form-group mt-3 col-md-6 col-sm-12 mt-3">
                                    <label>Última vez que consumió:</label>
                                    <input type="date" class="form-control" placeholder="Fecha de último consumo" name="ultimoConsumo">
                                </div>
                                <div class="form-group col-md-6 col-sm-12 mt-3">
                                    <label>Llega intoxicado:</label>
                                    <div>
                                        <label class="radio-inline">
                                            <input type="radio" name="llegaIntoxicado" value="Si"> Si
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="llegaIntoxicado" value="No"> No
                                        </label>
                                    </div>
                                </div>
                            </div> <!-- END ROW -->

                            <!-- Botón de enviar -->
                            <button type="submit" class="btn btn-primary mt-3">INICIAR PROCESO</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function calcularEdad() {
    var fechaNacimiento = document.getElementById("fechaNacimiento").value;
    var fechaNac = new Date(fechaNacimiento);
    var hoy = new Date();
    var edad = hoy.getFullYear() - fechaNac.getFullYear();
    var mes = hoy.getMonth() - fechaNac.getMonth();
    if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
        edad--;
    }
    document.getElementById("edad").value = edad;
}
</script>

<!-- SECCION GENERAL -->
<?php require "footer.php";?>
