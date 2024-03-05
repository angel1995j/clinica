<?php
require "header.php";

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

?>



      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
        

        



          <div class="card mb-4 px-3 mt-5">
            
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-4 pt-3">
            <a href="pacientes.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a todos los pacientes</a>


              <!-- Boton de ayuda -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal de ayuda-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Página de inicio</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                 En esta sección podemos visualizar opciones importantes del paciente:<br><br>
                 <b>Ver Lista de pagos: </b>Desde esta sección podemos ver el detalle de los pagos realizados o pendientes por este paciente<br><br>
                 <b>Tiendita del paciente: </b>En esta sección podemos añadir restar saldo de la tiendita del paciente o ver sus movimientos<br><br>
                 <b>Editar historia clínica: </b>Desde aqui podemos editar la historia clinica inicial del paciente<br><br>
                 <b>Agenda del paciente: </b> Desde aqui podremos ver la agenda del paciente asi como añadirle citas<br><br>
                 <b>Peticiones del paciente: </b>Aqui podemos gestionar las peticiones hechas por el paciente<br><br>
                 <b>Editar datos generales: </b> Aqui podemos editar los datos iniciales generales del paciente<br><br>
                 <b>Generar enlace familiar: </b> Aqui podemos generar un enlace para el familiar, en donde el podrá ver su deuda asi como movimientos del paciente<br><br>
                 <b>Evolución del paciente: </b> Desde aqui podemos ver notas hechas por psicólogos, médicos y padrinos<br>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>   

            <div class="container">
            <h2 class="mt-5 text-center"><i class="fa fa-user-circle-o" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
            Paciente:  <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h2>


            <?php
                // Consulta para obtener la cantidad de pagos retrasados
                $sqlPagosRetrasados = "SELECT COUNT(*) AS pagosRetrasados FROM pago_paciente WHERE estatus = 'No Pagado' AND id_paciente = $id_paciente";
                $resultadoPagosRetrasados = $link->query($sqlPagosRetrasados);
                $filaPagosRetrasados = $resultadoPagosRetrasados->fetch_assoc();
                $pagosRetrasados = $filaPagosRetrasados['pagosRetrasados'];
                
                if ($pagosRetrasados > 0) {
                    echo '<div class="alert alert-danger text-center mt-4">';
                    echo 'Este usuario tiene ' . $pagosRetrasados . ' pagos retrasados';
                    echo '<br>';
                    echo '<span class="text-green"><br><a href="https://api.whatsapp.com/send?phone=' . $paciente['telefonoFamiliar'] . '&text=Hola%2C%20le%20escribimos%20desde%20Clinicas%207%20Angeles%20para%20informaci%C3%B3n%20acerca%20de%20su%20familiar%20%20%F0%9F%98%81" style="color:green; font-weight:700;">ENVIAR RECORDATORIO POR WHATSAPP</a></span>';
                    echo '</div>';
                }
                ?>

            <div class="row mt-5">
            

                <div class="col-md-3 col-sm-4">
                  <a href="pagos-individual.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Ver Listado de Pagos</a>
                </div>

                 <div class="col-md-3 col-sm-4">
                  <a href="tiendita_paciente.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Tiendita Paciente</a>
                </div>
                
                <div class="col-md-3 col-sm-4">
                  <a href="historia-clinica.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Editar Historia clinica inicial</a>
                </div>


                <div class="col-md-3 col-sm-4">
                  <a href="agenda-paciente.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Ver Agenda del paciente</a>
                </div>

                <div class="col-md-3 col-sm-4 mt-3">
                  <a href="peticiones.php" class="btn btn-primary">Peticiones del paciente</a>
                </div>

                <div class="col-md-3 col-sm-4 mt-3">
                  <a href="editar-paciente.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Editar datos generales</a>
                </div>

                <div class="col-md-3 col-sm-4 mt-3">
                  <a href="perfil-familiar.php?id_paciente=<?php echo $id_paciente;?>&codigoUnico=<?php echo $paciente['codigoUnico'];?>" class="btn btn-primary" target="_blank">Generar enlace familiar</a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3">
                  <a href="evolucion-paciente.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary">Evolución del paciente</a>
                </div>



            </div>
              

            </div>




            </div>          
          
 







          </div>
       
<?php require "footer.php";?> 