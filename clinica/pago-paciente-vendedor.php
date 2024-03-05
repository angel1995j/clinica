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

                <h1 class="mb-4 mt-3">Completa el esquema de pagos del paciente: <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h1>

               <form action="inserts/pagos-paciente-vendedor.php?id_paciente=<?php echo $id_paciente; ?>" method="POST">
                    <div class="mb-3">
                        <label for="monto">Monto:</label>
                        <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                    </div>

                    <div class="mb-3">
                        <label for="observaciones">Concepto:</label>
                        <input type="text" class="form-control" id="observaciones" name="observaciones" value="Mensualidad">
                    </div>

                    <div class="mb-3">
                        <label for="cantidad_registros">Cantidad de Registros:</label>
                        <input type="number" class="form-control" id="cantidad_registros" name="cantidad_registros" required>
                    </div>

                    <div class="mb-3">
                        <label for="periodicidad">Periodicidad:</label>
                        <select class="form-control mt-2" id="periodicidad" name="periodicidad" required>
                            <option value="semanal">Semanal</option>
                            <option value="quincenal">Quincenal</option>
                            <option value="1 mes">1 Mes</option>
                            <option value="2 meses">2 Meses</option>
                            <option value="3 meses">3 Meses</option>
                            <option value="4 meses">4 Meses</option>
                            <option value="5 meses">5 Meses</option>
                            <option value="6 meses">6 Meses</option>
                            <option value="7 meses">7 Meses</option>
                            <option value="8 meses">8 Meses</option>
                            <option value="9 meses">9 Meses</option>
                            <option value="10 meses">10 Meses</option>
                            <option value="11 meses">11 Meses</option>
                            <option value="12 meses">12 Meses</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Crear Pagos</button>
                </form>
                
              </div>

            


            
              

            </div>




            </div>          
          
 







          </div>
       
</div>
        

     
 


<!-- SECCION GENERAL -->



   





<?php require "footer.php";?> 
