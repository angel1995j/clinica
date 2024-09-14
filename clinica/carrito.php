<?php
session_start();
require_once("global.php");

$link = bases();

$id_paciente = isset($_GET["id_paciente"]) ? intval($_GET["id_paciente"]) : 0;

// Definir una variable JavaScript para almacenar el valor de $id_paciente
echo '<script>var idPaciente = ' . json_encode($id_paciente) . ';</script>';

// Obtener el próximo crédito con fecha de fin más cercana en el futuro
$fecha_actual = date('Y-m-d');
$sqlCreditosSimilares = "SELECT * FROM credito WHERE id_paciente = $id_paciente AND operacion = 'Generación de límite de crédito' AND fecha_fin > '$fecha_actual' ORDER BY fecha_fin ASC LIMIT 1";
$resultadoCreditosSimilares = $link->query($sqlCreditosSimilares);
$credito_proximo = $resultadoCreditosSimilares->fetch_assoc();

if (!isset($_SESSION["items_carrito"])) {
    $_SESSION["items_carrito"] = array();
}

// Obtener el código de producto ingresado
$codigo_producto = isset($_GET['codigo_producto']) ? $link->real_escape_string($_GET['codigo_producto']) : '';

// Definir la cantidad de productos por página
$productos_por_pagina = 12; 

// Obtener el número de la página actual desde la URL (por defecto será 1 si no se especifica)
$pagina_actual = isset($_GET['pagina']) ? intval($_GET['pagina']) : 1;
$pagina_actual = ($pagina_actual > 0) ? $pagina_actual : 1;

// Calcular el índice del primer producto para la consulta SQL
$inicio = ($pagina_actual - 1) * $productos_por_pagina;

// Contar el total de productos, aplicando el filtro de código si está presente
$sqlContarProductos = "SELECT COUNT(*) AS total FROM productos WHERE tipo_producto = 'tiendita' AND stock > 1";
if (!empty($codigo_producto)) {
    $sqlContarProductos .= " AND codigo LIKE '%$codigo_producto%'";
}
$resultadoContar = $link->query($sqlContarProductos);
$total_productos = $resultadoContar->fetch_assoc()['total'];

// Obtener los productos para la página actual, aplicando el filtro de código si está presente
$sqlProductos = "SELECT * FROM productos WHERE tipo_producto = 'tiendita' AND stock > 1";
if (!empty($codigo_producto)) {
    $sqlProductos .= " AND codigo LIKE '%$codigo_producto%'";
}
$sqlProductos .= " ORDER BY id_producto ASC LIMIT $inicio, $productos_por_pagina";
$resultadoProductos = $link->query($sqlProductos);

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

        $(document).ready(function() {
        // Manejar el evento click en el botón de reinicio
        $("#resetFilter").click(function () {
            // Limpiar el campo de búsqueda
            $("#codigo_producto").val('');
            
            // Enviar el formulario para restablecer los resultados
            $("#searchForm").submit();
        });
        
        // Agregar un evento 'input' al campo de búsqueda
        searchInput.on('input', function() {
            // Enviar el formulario automáticamente
            searchForm.submit();
        });
        });

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
        <div class="col-md-12 mt-3">
            <div><h2 class="text-center mb-4">Selecciona productos de la tiendita</h2></div>

            <div class="text-center">
            <form id="searchForm" method="get" action="">
            <input type="hidden" name="id_paciente" value="<?php echo htmlspecialchars($id_paciente); ?>">
            <input type="text" id="codigo_producto" name="codigo_producto" placeholder="Buscar producto">
            <button type="submit" class="btn btn-primary">Buscar</button>
            <button type="button" id="resetFilter" class="btn btn-danger">Reiniciar filtro</button>
             </form>

             </div>


            <!-- Mostrar información de crédito del paciente -->
            <h4 class="mt-5 text-center">
                <?php
                if (!empty($credito_proximo) && isset($credito_proximo['saldo'])) {
                    if ($credito_proximo['saldo'] > 0) {
                        echo "Este usuario cuenta con saldo a favor de: $" . $credito_proximo['saldo'];
                    } elseif ($credito_proximo['saldo'] < 0) {
                        echo "Este usuario tiene un límite de: $" . abs($credito_proximo['saldo']);
                    } else {
                        echo "Este usuario no tiene saldo ni deuda.";
                    }
                    echo "<br>Su saldo vence el " . date('d-m-Y', strtotime($credito_proximo['fecha_fin'])) . ".";
                } else {
                    echo "No se pudo obtener información de crédito para este usuario.";
                }

                $saldo_de_paciente = $credito_proximo['saldo'];
                ?>
            </h4><br><br>
            <div class="row">
                <?php
                if ($resultadoProductos) {
                    while ($k = $resultadoProductos->fetch_assoc()) {
                        ?>
                        <div class="col-md-3 mb-4">
                            <div class="card">
                                <img src="assets/images/products/<?php echo htmlspecialchars($k["imagen"]); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($k["nombre"]); ?>">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($k["nombre"]); ?></h5>
                                    <p class="card-text">Precio: $<?php echo htmlspecialchars($k["precio_venta"]); ?></p>
                                    <p class="card-text">Stock: <?php echo htmlspecialchars($k["cantidad"]); ?></p>
                                    <form id="addToCartForm<?php echo $k['id_producto']; ?>" method="POST" action="carrito.php">
                                        <input type="hidden" name="accion" value="agregar">
                                        <input type="hidden" name="cod" value="<?php echo $k['id_producto']; ?>">
                                        <input type="number" name="txtcantidad" min="1" max="<?php echo $k['cantidad']; ?>" value="1" class="form-control mb-2">
                                        <button type="button" class="btn btn-primary addToCartButton" data-product-id="<?php echo $k['id_producto']; ?>">Agregar al carrito</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>No se encontraron productos.</p>";
                }
                ?>
            </div>

            <!-- Mostrar paginación -->
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <?php
                    for ($i = 1; $i <= $total_paginas; $i++) {
                        $active_class = ($i == $pagina_actual) ? ' active' : '';
                        echo '<li class="page-item' . $active_class . '"><a class="page-link" href="?pagina=' . $i . '&codigo_producto=' . htmlspecialchars($codigo_producto) . '&id_paciente=' . htmlspecialchars($id_paciente) . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>


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

                <?php
                // Calcular el umbral permitido
                $umbral = 10;
                // Verificar si el saldo es suficiente (o si falta menos de $umbral)
                $saldo_suficiente = ($totprecio <= ($saldo_de_paciente + $umbral));
                ?>

                <form method="GET" action="checkout.php" id="checkoutForm">
                    <?php if ($id_paciente != 0): ?>
                        <input type="hidden" name="id_paciente" value="<?php echo $id_paciente; ?>">
                    <?php endif; ?>

                    <?php foreach ($_SESSION["items_carrito"] as $item): ?>
                        <input type="hidden" name="vai_nom[]" value="<?php echo $item["vai_nom"]; ?>">
                        <input type="hidden" name="vai_cod[]" value="<?php echo $item["vai_cod"]; ?>">
                        <input type="hidden" name="txtcantidad[]" value="<?php echo $item["txtcantidad"]; ?>">
                        <input type="hidden" name="vai_pre[]" value="<?php echo $item["vai_pre"]; ?>">
                        <input type="hidden" name="totprecio" value="<?php echo number_format($totprecio, 2); ?>">
                    <?php endforeach; ?>

                    <!-- Agregar la condición para deshabilitar el botón si no hay saldo suficiente -->
                    <button type="submit" class="btn btn-success" <?php if (!$saldo_suficiente) echo "disabled"; ?>>
                        <?php
                        if (!$saldo_suficiente) {
                            echo "Saldo insuficiente - No se puede pagar";
                        } else {
                            echo "Pagar";
                        }
                        ?>
                    </button>
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
