<?php require "header.php";?> 

<!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

        <div class="col-6 mb-4">

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoEmpleado">
            Añadir nuevo empleado
          </button>
          <a href="empleados-archivados.php" class="btn boton-secundario" style="margin-left: 2%;">Ver archivados</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Página de empleados</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui se gestionan todos los empleados, se puede ver su quincena, editar sus datos generales o añadir una nota, en esta nota se pueden añadir bonificaciones o disminución de sus percepciones.

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
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nuevo empleado</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container mt-5">


               <!-- Formulario Bootstrap -->
              <form action="inserts/empleados.php" method="post" enctype="multipart/form-data">
                <div class="form-group row">
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
                    <label for="numero_telefono" class="col-sm-4 col-form-label">Número de Teléfono:</label>
                    <div class="col-sm-8">
                        <input type="tel" class="form-control" name="numero_telefono">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="fecha_ingreso" class="col-sm-4 col-form-label">Fecha de Ingreso:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="fecha_ingreso" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="puesto" class="col-sm-4 col-form-label">Puesto:</label>
                    <div class="col-sm-8">
                        <select class="form-control" name="puesto">
                            <option value="psicologia">Psicología</option>
                            <option value="padrino">Padrino</option>
                            <option value="madrina">Madrina</option>
                            <option value="administrativo">Administrativo</option>
                            <option value="recepcion">Recepción</option>
                            <option value="recursos humanos">Recursos humanos</option>
                            <option value="cocina">Cocina</option>
                            <option value="ventas">Ventas</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="salario_neto" class="col-sm-4 col-form-label">Salario Neto:</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" class="form-control" name="salario_neto" required>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="otros_conceptos" class="col-sm-4 col-form-label">Otros Conceptos:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="otros_conceptos" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="monto_otros_conceptos" class="col-sm-4 col-form-label">Monto Otros Conceptos:</label>
                    <div class="col-sm-8">
                        <input type="number" step="0.01" class="form-control" name="monto_otros_conceptos">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="contactos" class="col-sm-4 col-form-label">Contactos de emergencia:<br><small>*Inserte 2 o más</small></label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="contactos" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="datos_familiares" class="col-sm-4 col-form-label">Datos Familiares:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="datos_familiares" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="domicilio" class="col-sm-4 col-form-label">Domicilio:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="domicilio" rows="4"></textarea>
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="fecha_antidoping" class="col-sm-4 col-form-label">Fecha de Antidoping:</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" name="fecha_antidoping">
                    </div>
                </div>

                <div class="form-group row mt-3">
                    <label for="referencias_laborales" class="col-sm-4 col-form-label">Referencias Laborales:</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" name="referencias_laborales" rows="4"></textarea>
                    </div>
                </div>

                <input type="hidden" class="form-control" name="archivado" value="no">
                <input type="hidden" class="form-control" name="fecha_salida" value="">
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
                     <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Empleado</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Fecha Ingreso</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Puesto</th>

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

            let url = "loads/empleados.php"
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
