<?php require "header-tiendita.php";?> 

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

        

        <div class="col-12 mb-4 mt-3" style="text-align:right;">
          <!--<a href="carrito.php" class="btn btn-primary">Nuevo consumo</a>-->
          <!-- <a href="consumos.php" class="btn boton-secundario">Ver consumos</a>-->
         <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevoEmpleado">
            Añadir nueva solicitud
          </button>-->


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
                <form action="inserts/solicitudes-tiendita.php" method="post" enctype="multipart/form-data">
                  <input type="hidden" name="id_usuario" value="<?php echo $id_usuario_logueado; ?>">

                  <div class="form-group row mt-3">
                      <label for="descripcion" class="col-sm-4 col-form-label">Descripción de solicitud:</label>
                      <div class="col-sm-8">
                          <textarea class="form-control" name="descripcion" rows="7"></textarea>
                      </div>
                  </div>

                  <div class="form-group row mt-3">
                      <label for="fecha" class="col-sm-4 col-form-label">Fecha:</label>
                      <div class="col-sm-8">
                          <input type="date" class="form-control" name="fecha" required>
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

            
        </div>


       


        <div class="col-12">
          <div class="card mb-4 px-3">
            <div class="card-header pb-0">
              <h6>Productos de tiendita</h6>
            </div>

             <div class="row mt-5">

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




        <div class="tab-content" id="nav-tabContent">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="row mt-5">

                  <div id="content" class="row">

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
              </div>
            </div>
            <!-- CIERRA CONTENIDO DE TABLA -->
          </div>









          </div>
        </div>

  </div>







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

            let url = "loads/tiendita-minimo.php"
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