<?php require "header.php";?> 

<?php
    // Recuperar el id_usuario de la sesión
    session_start();
    if (isset($_SESSION['id_usuario'])) {
        $id_usuario_logueado = $_SESSION['id_usuario'];
        // Agregar un campo oculto para el id_usuario
        echo '<input type="hidden" name="id_usuario" value="' . $id_usuario_logueado . '">';
    } else {
        // Manejar el caso en que el id_usuario no esté en la sesión
        echo '<p>Error: No se pudo obtener el id_usuario logueado.</p>';
    }
?>


<!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

        <div class="col-6 mb-4">

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoEmpleado">
            Añadir nueva solicitud
          </button>
          <a href="solicitudes-archivadas.php" class="btn boton-secundario" style="margin-left: 2%;">Ver archivadas</a>
        </div>


        <div class="col-6">
            <!-- Boton de ayuda -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal de ayuda-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Página de solicitudes</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui se añaden nuevas solicitudes para ser resueltas por administración, estas solicitudes son cosas requeridas por ejemplo compras de insumos.

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>


         <!-- Modal -->
        <div class="modal fade" id="nuevoEmpleado" tabindex="-1" aria-labelledby="nuevoProductoLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Añadir nueva solicitud</h1> 
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
    <div class="container mt-5">
        <!-- Formulario Bootstrap -->
        <form action="inserts/solicitudes.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_logueado; ?>">

            <!-- Información general de la solicitud -->
            <div class="form-group row mt-3">
                <label for="descripcion" class="col-sm-4 col-form-label">Descripción de la solicitud:</label>
                <div class="col-sm-8">
                    <textarea class="form-control" name="descripcion_solicitud" rows="2"></textarea>
                </div>
            </div>

            <div class="form-group row mt-3">
                <label for="fecha" class="col-sm-4 col-form-label">Fecha:</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="fecha" required>
                </div>
            </div>

            <!-- Detalles de la solicitud (lista de productos) -->
            <div id="items-container">
                <div class="form-group row mt-3">
                    <label class="col-sm-4 col-form-label">Descripción del ítem:</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" name="descripcion_item[]" required>
                    </div>
                </div>
                <div class="form-group row mt-3">
                    <label class="col-sm-4 col-form-label">Cantidad:</label>
                    <div class="col-sm-8">
                        <input type="number" class="form-control" name="cantidad[]" step="0.01" required>
                    </div>
                </div>
                <div class="form-group row mt-3">
                  <label class="col-sm-4 col-form-label">Unidad de Medida:</label>
                  <div class="col-sm-8">
                      <select class="form-select" name="unidad_medida[]">
                          <option value="pieza">Pieza</option>
                          <option value="kilogramo">Kilogramo</option>
                          <option value="gramo">Gramo</option>
                          <option value="litro">Litro</option>
                          <option value="mililitro">Mililitro</option>
                          <option value="caja">Caja</option>
                          <option value="bolsa">Bolsa</option>
                          <option value="docena">Docena</option>
                      </select>
                  </div>
              </div>

            </div>

            <button type="button" class="btn btn-success mt-3" id="add-item">Agregar otro artículo</button>

            <div class="form-group row mt-3">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Agregar Solicitud</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <script>
                document.getElementById('add-item').addEventListener('click', function() {
                    let itemsContainer = document.getElementById('items-container');
                    let newItemHtml = `
                        <div class="form-group row mt-3" style="border-top: 1px solid black; padding-top:5%;">
                            <label class="col-sm-4 col-form-label">Descripción del ítem:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="descripcion_item[]" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-sm-4 col-form-label">Cantidad:</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="cantidad[]" step="0.01" required>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-sm-4 col-form-label">Unidad de Medida:</label>
                            <div class="col-sm-8">
                               <select class="form-select" name="unidad_medida[]">
                                <option value="pieza">Pieza</option>
                                <option value="kilogramo">Kilogramo</option>
                                <option value="gramo">Gramo</option>
                                <option value="litro">Litro</option>
                                <option value="mililitro">Mililitro</option>
                                <option value="caja">Caja</option>
                                <option value="bolsa">Bolsa</option>
                                <option value="docena">Docena</option>
                               </select>
                            </div>
                        </div>
                    `;
                    itemsContainer.insertAdjacentHTML('beforeend', newItemHtml);
                });
            </script>

             
            </div>
          </div>
        </div>


        
        <div class="row">

                <div class="col-4 d-flex">
                    <label for="num_registros" class="col-form-label">Mostrar: </label>
                
                    <select name="num_registros" id="num_registros" class="form-select">
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
              
                    <label for="num_registros" class="col-form-label">registros </label>
                </div>

              <div class="col-4"></div>

                <div class="col-4 d-flex">
                    <label for="campo" class="col-form-label">Buscar:&nbsp;&nbsp;</label>
               
                    <input type="text" name="campo" id="campo" class="form-control">
                </div>
            </div>




        <div class="col-12 mt-5">
          <div class="card mb-4 px-3">
            <div class="card-header pb-0">
              <h6>Todos los empleados</h6>
            </div>



       

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                     <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Descripción</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Fecha</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Accciones</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7"></th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>

                  <tbody id="content">

                   </tbody>

                  
                </table>
              </div>


              <div class="row">
                <div class="col-6 text-left">
                    <label id="lbl-total"></label>
                </div>

                <div class="col-6" id="nav-paginacion"></div>

                <input type="hidden" id="pagina" value="1">
                <input type="hidden" id="orderCol" value="0">
                <input type="hidden" id="orderType" value="asc">
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


 <script>
        /* Llamando a la función getData() */
        getData()

        /* Escuchar un evento keyup en el campo de entrada y luego llamar a la función getData. */
        document.getElementById("campo").addEventListener("keyup", function() {
            getData()
        }, false)
        document.getElementById("num_registros").addEventListener("change", function() {
            getData()
        }, false)


        /* Peticion AJAX */
        function getData() {
            let input = document.getElementById("campo").value
            let num_registros = document.getElementById("num_registros").value
            let content = document.getElementById("content")
            let pagina = document.getElementById("pagina").value
            let orderCol = document.getElementById("orderCol").value
            let orderType = document.getElementById("orderType").value

            if (pagina == null) {
                pagina = 1
            }

            let url = "loads/solicitudes.php"
            let formaData = new FormData()
            formaData.append('campo', input)
            formaData.append('registros', num_registros)
            formaData.append('pagina', pagina)
            formaData.append('orderCol', orderCol)
            formaData.append('orderType', orderType)

            fetch(url, {
                    method: "POST",
                    body: formaData
                }).then(response => response.json())
                .then(data => {
                    content.innerHTML = data.data
                    document.getElementById("lbl-total").innerHTML = 'Mostrando ' + data.totalFiltro +
                        ' de ' + data.totalRegistros + ' registros'
                    document.getElementById("nav-paginacion").innerHTML = data.paginacion
                }).catch(err => console.log(err))
        }

        function nextPage(pagina){
            document.getElementById('pagina').value = pagina
            getData()
        }

        let columns = document.getElementsByClassName("sort")
        let tamanio = columns.length
        for(let i = 0; i < tamanio; i++){
            columns[i].addEventListener("click", ordenar)
        }

        function ordenar(e){
            let elemento = e.target

            document.getElementById('orderCol').value = elemento.cellIndex

            if(elemento.classList.contains("asc")){
                document.getElementById("orderType").value = "asc"
                elemento.classList.remove("asc")
                elemento.classList.add("desc")
            } else {
                document.getElementById("orderType").value = "desc"
                elemento.classList.remove("desc")
                elemento.classList.add("asc")
            }

            getData()
        }

    </script>




<?php require "footer.php";?> 
