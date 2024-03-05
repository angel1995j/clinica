<?php
session_start();
require_once("global.php");

$link = bases();

$id_paciente = isset($_GET["id_paciente"]) ? intval($_GET["id_paciente"]) : 0;

// Definir una variable JavaScript para almacenar el valor de $id_paciente
echo '<script>var idPaciente = ' . json_encode($id_paciente) . ';</script>';

if (!isset($_SESSION["items_carrito"])) {
    $_SESSION["items_carrito"] = array();
}

if (!empty($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case "agregar":
            if (!empty($_POST["txtcantidad"])) {
                $codproducto = $link->query("SELECT * FROM productos WHERE id_producto='" . $_POST["cod"] . "'");
                
                // Verificar si la consulta devolvió resultados
                if ($codproducto && $codproducto->num_rows > 0) {
                    $producto = $codproducto->fetch_assoc();
                    
                    $items_array = array($producto["id_producto"] => array(
                        'vai_nom'        => $producto["titulo"],
                        'vai_cod'        => $producto["id_producto"],
                        'txtcantidad'    => $_POST["txtcantidad"],
                        'vai_pre'        => $producto["precio_venta"],
                        'vai_img'        => $producto["imagen"]
                    ));

                    if (!empty($_SESSION["items_carrito"])) {
                        if (array_key_exists($producto["id_producto"], $_SESSION["items_carrito"])) {
                            $_SESSION["items_carrito"][$producto["id_producto"]]["txtcantidad"] += $_POST["txtcantidad"];
                        } else {
                            $_SESSION["items_carrito"] += $items_array;
                        }
                    } else {
                        $_SESSION["items_carrito"] = $items_array;
                    }
                } else {
                    echo "Producto no encontrado";
                }
            }
            break;

        case "eliminar":
            if (!empty($_SESSION["items_carrito"])) {
                if (array_key_exists($_POST["eliminarcode"], $_SESSION["items_carrito"])) {
                    unset($_SESSION["items_carrito"][$_POST["eliminarcode"]]);
                }

                if (empty($_SESSION["items_carrito"])) {
                    unset($_SESSION["items_carrito"]);
                }
            }
            break;

        case "vacio":
            unset($_SESSION["items_carrito"]);
            break;

        case "pagar":
            echo "<script> alert('Gracias por su compra');window.location= 'carrito.php' </script>";
            unset($_SESSION["items_carrito"]);
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <script>
        // Definir la función addToCart en el ámbito global
        function addToCart(productId) {
            var form = $("#addToCartForm" + productId);
            var cantidad = form.find('[name="txtcantidad"]').val();

            // Establecer el valor correcto para el campo 'cod'
            form.find('[name="cod"]').val(productId);

            // Verificar si el campo 'id_paciente' ya existe
            var idPacienteInput = form.find('[name="id_paciente"]');

            if (!idPacienteInput.length) {
                // Si no existe, agregar dinámicamente el campo 'id_paciente'
                form.append('<input type="hidden" name="id_paciente" value="' + idPaciente + '">');
            } else {
                // Si ya existe, simplemente actualizar su valor
                idPacienteInput.val(idPaciente);
            }

            // Enviar el formulario mediante AJAX usando jQuery
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    // Manejar la respuesta si es necesario
                    console.log(response);
                    window.location.reload();
                }
            });
        }

        // Asegúrate de que el código se ejecute después de que el documento esté listo
        $(document).ready(function () {
            // Asignar el evento onclick al botón después de que el documento esté listo
            $("button.addToCartButton").click(function () {
                var productId = $(this).data('product-id');
                addToCart(productId);
            });
        });

        function eliminarProducto(productId) {
            var form = $("#eliminarForm" + productId);

            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: form.serialize(),
                success: function (response) {
                    console.log(response);
                    window.location.reload();
                }
            });
        }
    </script>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-12 mt-5">
            <div class="mt-5"><h2 class="text-center mb-4">Productos de la tiendita</h2></div>
            <div class="row">
                <?php
                $productos_array = $link->query("SELECT * FROM productos WHERE tipo_producto = 'tiendita' ORDER BY id_producto ASC");
                if ($productos_array) {
                    while ($k = $productos_array->fetch_assoc()) {
                        ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <img src="assets/images/products/<?php echo $k["imagen"]; ?>" class="card-img-top" alt="<?php echo $k["titulo"]; ?>" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $k["titulo"]; ?></h5>
                                    <p class="card-text"><?php echo "$" . $k["precio_venta"]; ?></p>
                                    <form method="POST" action="carrito.php" id="addToCartForm<?php echo $k["id_producto"]; ?>">
                                        <input type="hidden" name="accion" value="agregar">
                                        <input type="hidden" name="cod" value="<?php echo $k["id_producto"]; ?>">
                                        <div class="mb-3">
                                            <input type="number" name="txtcantidad" value="1" min="1" class="form-control">
                                        </div>
                                        <button type="button" class="btn btn-primary addToCartButton" data-product-id="<?php echo $k["id_producto"]; ?>">Agregar al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>
        </div>

        <div class="col-md-12">
            <h2>Lista de productos a comprar.</h2>
            <?php
            if (isset($_SESSION["items_carrito"])) {
                $totcantidad = 0;
                $totprecio = 0;
                ?>
                <table class="table">
                    <thead>
                    <tr>
                        <th style="width:30%">Descripción</th>
                        <th style="width:10%">Código</th>
                        <th style="width:10%">Cantidad</th>
                        <th style="width:10%">Precio x unidad</th>
                        <th style="width:10%">Total</th>
                        <th style="width:10%">Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($_SESSION["items_carrito"] as $item):
                        $item_price = $item["txtcantidad"] * $item["vai_pre"];
                        $totcantidad += $item["txtcantidad"];
                        $totprecio += $item_price;
                        ?>
                        <tr>
                            <td><?php echo $item["vai_nom"]; ?></td>
                            <td><?php echo $item["vai_cod"]; ?></td>
                            <td><?php echo $item["txtcantidad"]; ?></td>
                            <td><?php echo "$" . $item["vai_pre"]; ?></td>
                            <td><?php echo "$" . number_format($item_price, 2); ?></td>
                            <td>
                                <form method="POST" action="carrito.php" id="eliminarForm<?php echo $item["vai_cod"]; ?>">
                                    <input type="hidden" name="accion" value="eliminar">
                                    <input type="hidden" name="eliminarcode" value="<?php echo $item["vai_cod"]; ?>">
                                    <?php if ($id_paciente != 0): ?>
                                        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-danger btn-sm" onclick="eliminarProducto('<?php echo $item["vai_cod"]; ?>')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                        <td colspan="2" align="right">Total</td>
                        <td><?php echo $totcantidad; ?></td>
                        <td></td>
                        <td><?php echo "$" . number_format($totprecio, 2); ?></td>
                        <td></td>
                    </tr>
                    </tbody>
                </table>

                <form method="GET" action="checkout.php">
                    <?php if ($id_paciente != 0): ?>
                        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                    <?php endif; ?>

                    <?php
                    foreach ($_SESSION["items_carrito"] as $item):
                        $item_price = $item["txtcantidad"] * $item["vai_pre"];
                        ?>
                        <input type="hidden" name="vai_nom[]" value="<?php echo $item["vai_nom"]; ?>">
                        <input type="hidden" name="vai_cod[]" value="<?php echo $item["vai_cod"]; ?>">
                        <input type="hidden" name="txtcantidad[]" value="<?php echo $item["txtcantidad"]; ?>">
                        <input type="hidden" name="vai_pre[]" value="<?php echo $item["vai_pre"]; ?>">
                        <input type="hidden" name="totprecio" value="<?php echo number_format($totprecio, 2); ?>">
                    <?php endforeach; ?>

                    <button type="submit" class="btn btn-success">Pagar</button>
                </form>
            <?php
            } else {
            ?>
                <div class="text-center"><h3>¡El carrito está vacío!</h3></div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
