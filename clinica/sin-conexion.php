<?php
require "header.php";
require "global.php";
$link = bases();
?>

    <!-- End Navbar --><br><br>

     <div class="col-12 mt-5">
            <!-- Boton de ayuda -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal" style="text-align: right;">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal de ayuda-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Sección de sin conexión</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui se pueden descargar a formato excel todas las secciones existentes en el sistema para trabajar con esos datos sin conexión.

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>



    <div class="container-fluid py-4 mt-5">


      

        
          <div class="card mb-4 mt-5 px-3">
           <div class="row d-flex mt-5">
            <div class="col-2">
              <a href="" class="btn btn-primary">Pacientes</a>
            </div>

            <div class="col-2">
              <a href="" class="btn btn-primary">Pagos</a>
            </div>

            <div class="col-2">
              <a href="" class="btn btn-primary">Tiendita</a>
            </div>


            <div class="col-2">
              <a href="" class="btn btn-primary">Empleados</a>
            </div>

            <div class="col-2">
              <a href="" class="btn btn-primary">Stock</a>
            </div>

            <div class="col-2">
              <a href="" class="btn btn-primary">Compras</a>
            </div>


            <div class="col-2 mt-5">
              <a href="" class="btn btn-primary">Ventas</a>
            </div>


            <div class="col-2 mt-5">
              <a href="" class="btn btn-primary">CRM</a>
            </div>


            <div class="col-2 mt-5">
              <a href="" class="btn btn-primary">Vendedores</a>
            </div>
 
            
            
          </div>


<br><br>


        </div>
  

<?php
require "footer.php";
?>