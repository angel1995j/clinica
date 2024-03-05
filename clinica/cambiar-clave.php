<?php require "header.php";

require('global.php');
$link = bases();
$id_usuario = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if (!$id_usuario) {
    die('ID del vendedor no proporcionado');
}
$sql = "SELECT * FROM usuarios WHERE id_usuario = $id_usuario";

$resultado = $link->query($sql);

$vendedor = $resultado->fetch_assoc();
?> 



<!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

       


        <div class="col-12 mt-5">
          <div class="card mb-4 px-3">



       

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
            


              <div class="row">
                
              <h2>Actualizar Contraseña para el usuario <?php echo $vendedor['nombre'] . " " . $vendedor['aPaterno']; ?></h2>
                <form action="updates/cambiar-clave.php" method="post">
                    <div class="form-group  mt-5">
                        <label for="new_password">Nueva Contraseña:</label>
                        <input type="password" class="form-control" id="new_password" name="new_password" required>
                    </div>
                    <div class="form-group  mt-3">
                        <label for="confirm_password">Confirmar Contraseña:</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                    </div>
                    <input type="submit" class="btn btn-primary mt-3" value="Actualizar Contraseña">
                </form>

                
               </div>

            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->
          </div>



          
        </div>







          </div>
        </div>

        

      </div>
     
 

</div>
<!-- SECCION GENERAL -->


 




<?php require "footer.php";?> 
