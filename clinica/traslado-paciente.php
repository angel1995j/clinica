<?php require "header.php";?> 

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

                <h1 class="mb-4 mt-3">Completando orden de traslado del paciente: <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h1>
                <h5>Si no tiene orden de traslado deje vacios los campos</h5>

                <form action="inserts/traslados.php?id_paciente=<?php echo $id_paciente; ?>" method="POST">
                <div class="row">
                    <!-- Primera Columna -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nombreEncargado" class="form-label">Nombre del encargado de traslados:</label>
                            <input type="text" class="form-control" id="nombreEncargado" name="nombreEncargado" >
                        </div>
                        <div class="mb-3">
                            <label for="personasApoyo" class="form-label">Nombres completos de personas de apoyo para el traslado:</label>
                            <input type="text" class="form-control" id="personasApoyo" name="personasApoyo" >
                        </div>
                        <div class="mb-3">
                            <label for="municipioPaciente" class="form-label">Municipio del paciente:</label>
                            <input type="text" class="form-control" id="municipioPaciente" name="municipioPaciente" >
                        </div>
                        <div class="mb-3">
                            <label for="marcaVehiculo" class="form-label">Marca del vehículo utilizado para el traslado:</label>
                            <input type="text" class="form-control" id="marcaVehiculo" name="marcaVehiculo" >
                        </div>

                        <div class="mb-3 ">
                          <label for="costoTraslado" class="form-label">Costo de traslado en pesos:</label>
                          <input type="number" class="form-control" id="costoTraslado" name="costoTraslado" step="0.01" >
                      </div>

                    </div>

                    <!-- Segunda Columna -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="tipoVehiculo" class="form-label">Tipo de vehículo:</label>
                            <input type="text" class="form-control" id="tipoVehiculo" name="tipoVehiculo" >
                        </div>
                        <div class="mb-3">
                            <label for="modeloVehiculo" class="form-label">Modelo del vehículo utilizado para el traslado:</label>
                            <input type="text" class="form-control" id="modeloVehiculo" name="modeloVehiculo" >
                        </div>
                        <div class="mb-3">
                            <label for="placasVehiculo" class="form-label">Placas del vehículo utilizado para el traslado:</label>
                            <input type="text" class="form-control" id="placasVehiculo" name="placasVehiculo" >
                        </div>
                        <div class="mb-3">
                            <label for="direccionTraslado" class="form-label">Dirección de traslado :</label>
                            <input type="text" class="form-control" id="direccionTraslado" name="direccionTraslado">

                        </div>

                        <div class="mb-3">
                        <label for="costoTrasladoTexto" class="form-label">Costo de traslado en Texto:</label>
                        <input type="text" class="form-control" id="costoTrasladoTexto" name="costoTrasladoTexto" >
                         </div>

                    </div>
                </div>

                

                

                <button type="submit" class="btn btn-primary">Guardar</button>
            </form>
                
              </div>

            


            
              

            </div>




            </div>          
          
 







          </div>
       
</div>
        

     
 


<!-- SECCION GENERAL -->



   





<?php require "footer.php";?> 
