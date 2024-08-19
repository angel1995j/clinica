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

                <h1 class="mb-4 mt-3">Donaciones adicionales: <?php echo $paciente['nombre']. " " . $paciente['aPaterno'];?></h1>
                <form action="inserts/pago-adicional.php?id_paciente=<?php echo $id_paciente; ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="monto">Monto:</label>
                        <input type="text" class="form-control" id="monto" name="monto" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="comprobante">Comprobante (imagen o archivo):</label>
                        <input type="file" class="form-control-file" id="comprobante" name="comprobante" accept="image/*">
                    </div>

                    <div class="form-group mt-3">
                        <label for="fecha_agregado">Fecha de Agregado:</label>
                        <input type="text" class="form-control" id="fecha_agregado" name="fecha_agregado" value="<?php echo date('Y-m-d'); ?>" readonly>
                    </div>

                    <div class="form-group mt-3">
                        <label for="fecha_pagado">Fecha de Pagado:</label>
                        <input type="date" class="form-control" id="fecha_pagado" name="fecha_pagado">
                    </div>

                    <div class="form-group mt-3">
                        <label for="observaciones">Observaciones:</label>
                        <input type="text" class="form-control" name="observaciones" id="observaciones" value="donaciones adicionales">

                    </div>

                    <div class="form-group mt-3">
                        <label for="estatus">Estatus:</label>
                        <select class="form-control" id="estatus" name="estatus">
                            <option value="Pagado">Pagado</option>
                            <option value="No Pagado">No Pagado</option>
                        </select>
                    </div>


                    <div class="form-group mt-3">
                        <label for="forma_pago">Forma de pago:</label>
                       <select class="form-control" id="forma_pago" name="forma_pago">
                            <option value="Efectivo">Efectivo</option>
                            <option value="Tarjeta">Tarjeta</option>
                            <option value="Transferencia Cuenta Lenin">Transferencía Cuenta Lenin</option>
                            <option value="Transferencia Cuenta Dante">Transferencía Cuenta Dante</option>
                            <option value="Deposito Cuenta Dante">Déposito Cuenta Dante</option>
                            <option value="Deposito Cuenta Lenin">Déposito Cuenta Lenin</option>
                            <option value="Envio de efectivo">Envío de efectivo</option>
                        </select>
                    </div>
                    

                    <input type="hidden" name="id_paciente" value="<?php echo $_GET['id_paciente']; ?>">

                    <button type="submit" class="btn btn-primary mt-3">Guardar Pago</button>
                </form>

                
              </div>

              <a href="pagos-individual.php?id_paciente=<?php echo $id_paciente; ?>" class="btn btn-danger mt-3">
                Ir a los pagos del paciente
              </a>

            
              

            </div>




            </div>          
          
 







          </div>
       
</div>
        

     
 


<!-- SECCION GENERAL -->



   





<?php require "footer.php";?> 
