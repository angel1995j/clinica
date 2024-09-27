<?php require "header.php";?> 

<!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

        <div class="col-6 mb-4">

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoUsuario">
            Añadir nuevo empleado
          </button>

          <a href="usuarios-archivados.php" class="btn boton-secundario" style="margin-left: 2%;">Ver archivados</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Sección de usuarios</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui podemos gestionar los usuarios registrados en el sistema, por ejemplo podemos modificar su clave de acceso quitarles acceso etc.

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>



         <!-- Modal -->
            <div class="modal fade" id="nuevoUsuario" tabindex="-1" aria-labelledby="nuevoUsuarioLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nuevo usuario</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <div class="container mt-5">
                      <!-- Formulario Bootstrap -->
                      <form action="inserts/usuarios.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                          <label for="nombre_usuario" class="col-sm-4 col-form-label">Nombre de Usuario:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="nombre_usuario" required>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <label for="contrasena" class="col-sm-4 col-form-label">Contraseña:</label>
                          <div class="col-sm-8">
                            <input type="password" class="form-control" name="contrasena" required>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <label for="nombre" class="col-sm-4 col-form-label">Nombre:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="nombre" required>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <label for="aPaterno" class="col-sm-4 col-form-label">Apellido Paterno:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="aPaterno" required>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <label for="aMaterno" class="col-sm-4 col-form-label">Apellido Materno:</label>
                          <div class="col-sm-8">
                            <input type="text" class="form-control" name="aMaterno" required>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <label for="telefono" class="col-sm-4 col-form-label">Número de Teléfono:</label>
                          <div class="col-sm-8">
                            <input type="tel" class="form-control" name="telefono">
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <label for="fecha_ingreso" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                          <div class="col-sm-8">
                            <input type="date" class="form-control" name="fecha_ingreso" required>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="rol" class="col-sm-4 col-form-label">Rol:</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="rol">
                                    <option value="SuperAdministrador">SuperAdministrador</option>
                                    <option value="Administracion">Administración</option>
                                    <option value="rrhh">Recursos Humanos</option>
                                    <option value="Salud">Jefe de Salud</option>
                                    <option value="Proteccion">Jefe de Protección</option>
                                    <option value="Recepcion">Recepción</option>
                                    <option value="Psicologo">Psicólogo</option>
                                    <option value="Medico">Médico</option>
                                    <option value="Cocina">Cocina</option>
                                    <option value="Tiendita">Tiendita</option>
                                    <option value="Padrino">Padrino</option>
                                    <option value="Vendedor">Vendedor</option>
                                </select>
                            </div>
                        </div>


                        <div class="form-group row mt-3">
                          <label for="archivado" class="col-sm-4 col-form-label">Archivado:</label>
                          <div class="col-sm-8">
                            <select class="form-select" name="archivado">
                              <option value="no" selected>No</option>
                              <option value="si">Sí</option>
                            </select>
                          </div>
                        </div>

                        <div class="form-group row mt-3">
                          <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Agregar</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- END Modal -->




        


        
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
              <h6>Todos los usuarios</h6>
            </div>



       

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                     <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Nombre</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Usuario</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Rol</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Fecha Ingreso</th>

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

            let url = "loads/usuarios.php" 
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
