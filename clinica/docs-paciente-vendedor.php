<?php require "header-vendedor.php";?> 

<?php 
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

            <div class="card-body px-0 pt-0 pb-2">
              

            <div class="container">

              <div class="row">

                <h1 class="mb-4 mt-3">Documentos del paciente: <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h1>

               <!--  <h5 class="mt-5">Descargar todo </h5>
                <div class="col-12 text-center">
                   <a href="assets/docs/contratos_vacios/01 Solicitud Internamiento - Fundación Tenvar.docx" class="btn btn-primary">Descargar formato con todos los contratos</a>-->
                </div>
                
              </div> 

            <h5 class="mt-5">Presiona sobre el reporte que necesites imprimir</h5>


            <div class="row mt-5">
            

                <div class="col-md-3 col-sm-4 text-center">
                  <a href="pdf/solicitud-de-internamiento.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary" target="_blank">Solicitud de internamiento</a>
                </div>
                

                <div class="col-md-3 col-sm-4 text-center">
                  <a href="pdf/hoja-de-ingreso.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary" target="_blank">Hoja de ingreso</a>
                </div>

                <div class="col-md-3 col-sm-4 text-center">
                  <a href="pdf/orden-de-traslado.php?id_paciente=<?php echo $id_paciente;?>" class="btn btn-primary" target="_blank">Orden de traslado</a>
                </div>

                <div class="col-md-3 col-sm-4 text-center">
                  <a href="assets/docs/contratos_vacios/05 Anexo Dos Plan de Pagos Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Plan de pagos </a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/03 Contrato Prestación Servicios - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Contrato de prestación de servicios</a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/01 Solicitud Internamiento - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Solicitud de internamiento voluntario</a>
                </div>

                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/04 Anexo_Uno_ Formato_Contrato_Prestación_Servicios - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Contrato de prestación de servicios </a>
                </div>


                

                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/06 Reglamento Visita Familiar - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Reglamento visita familiar </a>
                </div>


              

                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/09 Consentimiento Confidencialidad - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Consentimiento de confidencialidad</a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/10 Consentimiento Informado Adultos - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Consentimiento informado adultos</a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/10.1 CONSENTIMIENTO INFORMADO PARA MENORES DE EDAD..docx" class="btn btn-primary" target="_blank">Consentimiento informado menores de edad</a>
                </div>



                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/11 Reglamento Interno Paciente - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Reglamento interno del paciente</a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/07 Aviso_Privacidad_Clínica_7_Ángeles - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Aviso de privacidad</a>
                </div>


                <div class="col-md-3 col-sm-4 mt-3 text-center">
                  <a href="assets/docs/contratos_vacios/08 Convenio de Confidencialidad - Fundación Tenvar.docx" class="btn btn-primary" target="_blank">Convenio de confidencialidad</a>
                </div>


            </div>
              

            </div>




            </div>          
          
 







          </div>
       
</div>
        

     
 


<!-- SECCION GENERAL -->



   





<?php require "footer.php";?> 
