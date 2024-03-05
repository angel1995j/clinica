<?php
require "header.php";
require "global.php";
$link = bases();

?>

<!--SECCION GENERAL -->
<div class="container-fluid py-4 mt-5">
    <div class="card-body px-0 pt-0 pb-4 pt-3 mt-5">
        <a href="cocina.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i>
             Volver a la cocina</a>  

    <div class="card mb-4 px-3 mt-5">
    

    <?php
    // Recuperar el id_producto desde la URL
    $id_producto = $_GET['id_producto'];

    // Consulta para obtener los datos del producto con el id especificado
    $sql = "SELECT * FROM productos WHERE id_producto = $id_producto";
    $resultado = $link->query($sql);

    // Verificar si se encontraron resultados
    if ($resultado->num_rows > 0) {
        $producto = $resultado->fetch_assoc();

    ?>

    <h2 class="mt-5 text-center mb-4"><i class="fa fa-product-hunt" aria-hidden="true"></i>&nbsp;&nbsp;&nbsp;
            Editar producto </h2>


    <form action="updates/producto-cocina.php?id_producto=<?php echo $producto['id_producto']; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="titulo">Titulo:</label>
                    <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $producto['titulo']; ?>" required>
                </div>
                <!-- Resto de los campos del lado izquierdo -->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="comprobante">Imagen:</label>
                    <input type="file" class="form-control" id="imagen" name="imagen">
                    <input type="hidden" class="form-control" id="imagen_actual" name="imagen_actual" value="<?php echo $producto['imagen']; ?>">
                </div>
                <!-- Resto de los campos del lado derecho -->
            </div>
        </div>

        <div class="row mt-3">
             <input type="hidden" class="form-control" id="precio_venta" name="precio_venta" value="<?php echo $producto['precio_venta']; ?>">
              
            <div class="col-md-6">
                <div class="form-group">
                   <label for="precio_compra">Precio compra:</label>
                    <input type="text" class="form-control" id="precio_compra" name="precio_compra" value="<?php echo $producto['precio_compra']; ?>">
                </div>
                <!-- Resto de los campos del lado derecho -->
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="descripcion">Descripción:</label>
                    <input type="text" class="form-control" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion']; ?>">
                </div>
                <!-- Resto de los campos del lado izquierdo -->
            </div>
            <div class="col-md-6">
                <div class="form-group">
                   <label for="stock">Stock:</label>
                    <input type="text" class="form-control" id="stock" name="stock" value="<?php echo $producto['stock']; ?>">
                </div>
                <!-- Resto de los campos del lado derecho -->
            </div>
        </div>

        <input type="hidden" name="estatus" value="Pagado">
        <input type="hidden" name="id_producto" value="<?php echo $id_producto; ?>">

        <div class="form-group mt-3">
            <button type="submit" class="btn btn-primary">Actualizar producto</button>
        </div>
    </form>

    <?php
    } else {
        echo "No se encontraron datos para el producto con ID: $id_producto";
    }
    ?>

</div>


</div>

</div>

<?php require "footer.php";?>
