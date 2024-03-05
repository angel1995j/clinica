<?php require "header.php";?> 

      <!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

        

        <div class="col-8 mb-4 mt-3" style="text-align:left;">
          <!--<a href="carrito.php" class="btn btn-primary">Nuevo consumo</a>-->
          
            <a href="medicina.php" class="btn boton-secundario">Ver productos activos</a> 
        </div>

        <div class="col-4">
            <!-- Boton de ayuda -->
           <button type="button" class="btn boton-ayuda" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-question-circle" aria-hidden="true"></i>
          </button>

          <!-- Modal de ayuda-->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Sección de Médicina</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Aqui podemos gestionar todos los productos referentes al medicamento, se puede añadir o retirar el stock, archivar productos asi como añadir nuevos productos, de la misma manera se pueden revisar todos los consumos que se han tenidos.

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="nuevoProducto" tabindex="-1" aria-labelledby="nuevoProductoLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Agregar nuevo producto</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="container mt-5">

                <!-- Formulario Bootstrap -->
                <form action="inserts/medicina.php" method="post" enctype="multipart/form-data">
                  
                  <input type="hidden" step="0.01" class="form-control" name="precio_venta" required>


                    <div class="form-group row mt-3">
                        <label for="stock" class="col-sm-4 col-form-label">Stock:</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" class="form-control" name="stock" required>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="titulo" class="col-sm-4 col-form-label">Título:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="titulo" required>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="descripcion" class="col-sm-4 col-form-label">Descripción:</label>
                        <div class="col-sm-8">
                            <textarea class="form-control" name="descripcion" rows="4" required></textarea>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="precio_compra" class="col-sm-4 col-form-label">Precio de Compra:</label>
                        <div class="col-sm-8">
                            <input type="number" step="0.01" class="form-control" name="precio_compra" required>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <label for="imagen" class="col-sm-4 col-form-label">Imagen:</label>
                        <div class="col-sm-8">
                            <input type="file" class="form-control-file" name="imagen" accept="image/*" required>
                        </div>
                    </div>

                    <div class="form-group row mt-3">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary">Insertar Producto</button>
                        </div>
                    </div>
                </form>
            </div>
              </div>
             
            </div>
          </div>
        </div>



        <div class="col-12">
          <div class="card mb-4 px-3">
            <div class="card-header pb-0">
              <h6>Productos de médicamento</h6>
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

            let url = "loads/medicina-inactivos.php"
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