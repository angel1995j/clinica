<?php
require "header-apoyo.php";

 $id_paciente  = $_GET['id_paciente'];


 // Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;


if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('global.php');
$link = bases();
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";

$resultado = $link->query($sql);

$paciente = $resultado->fetch_assoc();

$sql_historia = "SELECT * FROM historia_clinica WHERE id_paciente = $id_paciente";
$resultado_historia = $link->query($sql_historia);

?>



      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
        

        



          <div class="card mb-4 px-3 mt-5">
            
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="pacientes-apoyo.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a todos los pacientes</a>
              

            <div class="container">
            <h2 class="mt-5 text-center"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
            Paciente:  <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h2>


            

            <div class="row mt-5">
            

                
                <div class="col-md-3 col-sm-3 mb-3">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalHistoriaClinica">
                      Ver Historia clínica inicial
                    </button>
                </div>


                <div class="col-md-3 col-sm-3 mb-3">
                  <a href="agenda-paciente-apoyo.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Ver Agenda del paciente</a>
                </div>

                <div class="col-md-3 col-sm-3">
                  <a href="evolucion-paciente-apoyo.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Registro de evolución</a>
                </div>

                <div class="col-md-3 col-sm-3">
                  <a href="notas-psicologicas-apoyo.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Notas psicológicas</a> 
                </div>

                <div class="col-md-3 col-sm-3">
                  <a href="notas-consejeria-apoyo.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Notas de consejería</a>
                </div>

                <div class="col-md-3 col-sm-3">
                  <a href="documentos-egreso-apoyo.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Documentos de egreso</a>
                </div>



            </div>
              

            </div>




            </div>    




            <!-- Modal para mostrar la historia clínica -->
          <div class="modal fade" id="modalHistoriaClinica" tabindex="-1" role="dialog" aria-labelledby="modalHistoriaClinicaLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="modalHistoriaClinicaLabel">Historia Clínica del Paciente</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <?php if ($resultado_historia->num_rows > 0) : ?>
                    <div class="row">
                      <?php while ($fila_historia = $resultado_historia->fetch_assoc()) : ?>
                        <div class="col-md-12">
                          <div class="card mb-3">
                            <div class="card-body">
                              <p class="card-text"><b>Fecha Consulta:</b> <?php echo $fila_historia['fecha_consulta']; ?></p>
                              <p class="card-text"><b>Alergias:</b> <?php echo $fila_historia['alergias']; ?></p>
                              <p class="card-text"><b>Operaciones Previas:</b> <?php echo $fila_historia['operaciones_previas']; ?></p>
                              <p class="card-text"><b>Tratamiento:</b> <?php echo $fila_historia['tratamiento']; ?></p>
                            
                              <p class="card-text"><b>Resultados Bioquímica:</b> <?php echo $fila_historia['resultados_bioquimica']; ?></p>
                              <p class="card-text"><b>Hospitalizaciones Previas:</b> <?php echo $fila_historia['hospitalizaciones_previas']; ?></p>
                              <p class="card-text"><b>Padecimientos Actuales:</b> <?php echo $fila_historia['padecimientos_actuales']; ?></p>
                              <p class="card-text"><b>Historia Familiar:</b> <?php echo $fila_historia['historia_familiar_enfermedades']; ?></p>
                            </div>
                          </div>
                        </div>
                      <?php endwhile; ?>
                    </div>

                  <?php else : ?>
                    <p>No hay registros de historia clínica para este paciente.</p>
                  <?php endif; ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>      
          
 







          </div>
       

<?php require "footer.php"; ?>
