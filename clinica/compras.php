<?php require "header.php";?> 

<!--SECCION GENERAL -->

    <!-- End Navbar -->

    <div class="container-fluid py-4 mt-5">
      <div class="row mt-5">

        <div class="col-8 mb-4">

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#nuevaCompra">
            Añadir nueva compra
          </button>
          <a href="compras-por-pagar.php" class="btn btn-primary" style="margin-left: 2%;">Por pagar</a>

          <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#comprasModal">
                Filtrar Compras
            </button>

          <a href="compras-inactivas.php" class="btn boton-secundario" style="margin-left: 2%;">Ver archivadas</a>
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
                  <h5 class="modal-title" id="exampleModalLabel">Página de compras</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Desde aqui se pueden añadir nuevas compras, revisar las compras por pagar asi como gestionar todas las comprar registradas , se coloca concepto nombre de quien compra y través de que cuenta realizo esa compra.

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
        </div>


         <!-- Modal -->

         <!-- Modal -->
<div class="modal fade" id="nuevaCompra" tabindex="-1" aria-labelledby="nuevaCompraLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="nuevaCompraLabel">Agregar nueva compra</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container mt-5">
                    <!-- Formulario Bootstrap -->
                    <form action="inserts/compras.php" method="post" enctype="multipart/form-data">
                        <div class="form-group row">
                            <label for="concepto" class="col-sm-4 col-form-label">Concepto:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="concepto" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="quien_compra" class="col-sm-4 col-form-label">Quién Compra:</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" name="quien_compra" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="cuenta_compra" class="col-sm-4 col-form-label">Método de pago:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="cuenta_compra" required>
                                    <option value="Cuenta Lenin">Cuenta Lenin</option>
                                    <option value="Cuenta Dante">Cuenta Dante</option>
                                    <option value="Efectivo">Efectivo</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="tipo_compra" class="col-sm-4 col-form-label">Tipo de Compra:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="tipo_compra" required>
                                    <option value="Despensa">Despensa</option>
                                    <option value="Gastos generales">Gastos generales</option>
                                    <option value="Mantenimiento">Mantenimiento</option>
                                    <option value="Tiendita">Tiendita</option>
                                    <option value="Gastos operativos">Gastos operativos</option>
                                    <option value="Viaticos">Viaticos</option>
                                    <option value="Medicamento general">Medicamento general</option>
                                    <option value="otras compras">Otras compras</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="monto" class="col-sm-4 col-form-label">Monto:</label>
                            <div class="col-sm-8">
                                <input type="number" step="0.01" class="form-control" name="monto" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="fecha_aplicacion" class="col-sm-4 col-form-label">Fecha de Aplicación:</label>
                            <div class="col-sm-8">
                                <input type="date" class="form-control" name="fecha_aplicacion" required>
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="comprobante" class="col-sm-4 col-form-label">Comprobante (Imagen):</label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" name="comprobante" accept="image/*" >
                            </div>
                        </div>

                        <div class="form-group row mt-3">
                            <label for="estatus" class="col-sm-4 col-form-label">Estatus:</label>
                            <div class="col-sm-8">
                                <select class="form-control" name="estatus" required>
                                    <option value="Pagada">Pagada</option>
                                    <option value="No Pagada">No Pagada</option>
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

<!-- END MODAL -->


<!-- MODAL DE FILTRADO -->

<!-- Modal -->
<div class="modal fade" id="comprasModal" tabindex="-1" role="dialog" aria-labelledby="comprasModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="comprasModalLabel">Filtrar Compras</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="compras-individual.php" method="POST">
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha Inicio:</label>
                        <input type="date" id="fecha_inicio" name="fecha_inicio" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="fecha_fin">Fecha Fin:</label>
                        <input type="date" id="fecha_fin" name="fecha_fin" class="form-control">
                    </div>
                    <div class="form-group mt-3">
                        <label for="tipo_compra">Tipo de Compra:</label>
                        <select id="tipo_compra" name="tipo_compra" class="form-control">
                            <option value="Todas">Todas</option>
                            <option value="Despensa">Despensa</option>
                            <option value="Gastos generales">Gastos generales</option>
                            <option value="Mantenimiento">Mantenimiento</option>
                            <option value="Tiendita">Tiendita</option>
                            <option value="Gastos operativos">Gastos operativos</option>
                            <option value="Viaticos">Viaticos</option>
                            <option value="Medicamento general">Medicamento general</option>
                            <option value="otras compras">Otras compras</option>
                        </select>
                    </div>
                    <div class="form-group mt-3">
                        <label for="estatus">Estatus:</label>
                        <select id="estatus" name="estatus" class="form-control">
                            <option value="Pagada">Pagada</option>
                            <option value="No Pagada">No Pagada</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary mt-3">Buscar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL DE FILTRADO -->




        
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
              <h6>Todas las compras</h6>
            </div>



       

        <div class="tab-content" id="nav-tabContent">
          <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
            
            <!--- INICIA CONTENIDO DE TABLA -->

            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                     <th class="text-uppercase text-xxs font-weight-bolder opacity-7">Concepto</th>
                      <th class="text-uppercase text-xxs font-weight-bolder opacity-7 ps-2">Quién compra y cuenta</th>
                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Monto</th>

                      <th class="text-center text-uppercase text-xxs font-weight-bolder opacity-7">Fecha pago</th>

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

            let url = "loads/compras.php"
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
