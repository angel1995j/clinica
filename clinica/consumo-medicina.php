<?php
session_start();
require_once("global.php");

$link = bases();

// Inicializar el carrito si no está establecido
if (!isset($_SESSION["items_carrito"])) {
    $_SESSION["items_carrito"] = array();
}

// Manejo de acciones del carrito
if (!empty($_POST["accion"])) {
    switch ($_POST["accion"]) {
        case "agregar":
            // Validar que la cantidad y el código del producto estén presentes
            if (!empty($_POST["txtcantidad"]) && !empty($_POST["cod"])) {
                // Validar que la cantidad sea un número entero positivo
                if (is_numeric($_POST["txtcantidad"]) && intval($_POST["txtcantidad"]) > 0) {
                    $cantidad = intval($_POST["txtcantidad"]);
                } else {
                    echo "Cantidad inválida";
                    break;
                }

                // Escapar el código del producto para prevenir inyecciones SQL
                $cod = $link->real_escape_string($_POST["cod"]);
                $codproducto = $link->query("SELECT * FROM productos WHERE id_producto='$cod'");

                // Verificar si la consulta devolvió resultados
                if ($codproducto && $codproducto->num_rows > 0) {
                    $producto = $codproducto->fetch_assoc();

                    $items_array = array($producto["id_producto"] => array(
                        'vai_nom'     => $producto["titulo"],
                        'vai_cod'     => $producto["id_producto"],
                        'txtcantidad' => $cantidad,
                        'vai_pre'     => $producto["precio_compra"],
                        'vai_img'     => $producto["imagen"]
                    ));

                    if (!empty($_SESSION["items_carrito"])) {
                        if (array_key_exists($producto["id_producto"], $_SESSION["items_carrito"])) {
                            // Sumar la cantidad existente con la nueva cantidad
                            $_SESSION["items_carrito"][$producto["id_producto"]]["txtcantidad"] += $cantidad;
                        } else {
                            // Combinar arrays de manera adecuada
                            $_SESSION["items_carrito"] = array_merge($_SESSION["items_carrito"], $items_array);
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
        $eliminarcode = $link->real_escape_string($_POST["eliminarcode"]);
        if (array_key_exists($eliminarcode, $_SESSION["items_carrito"])) {
            unset($_SESSION["items_carrito"][$eliminarcode]);
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

// Variables de paginación
$productos_por_pagina = 6;
$pagina_actual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$pagina_actual = max($pagina_actual, 1); // Asegurar que la página actual sea al menos 1
$offset = ($pagina_actual - 1) * $productos_por_pagina;

// Filtro de búsqueda
$filtro = "";
$buscar = "";
if (isset($_GET['buscar']) && !empty(trim($_GET['buscar']))) {
    $buscar = trim($_GET['buscar']);
    // Asegúrate de que 'codigo' es el nombre correcto del campo en tu base de datos
    $filtro = "AND codigo LIKE '%" . $link->real_escape_string($buscar) . "%'";
}

// Consulta para obtener el número total de productos con el filtro aplicado
$consulta_total_productos = "SELECT COUNT(*) as total FROM productos WHERE tipo_producto = 'medicina' AND stock > 1 $filtro";
$resultado_total = $link->query($consulta_total_productos);

if ($resultado_total) {
    $total_productos = $resultado_total->fetch_assoc()['total'];
} else {
    $total_productos = 0;
}

// Consulta para obtener productos con paginación y filtro
$productos_query = "SELECT * FROM productos WHERE tipo_producto = 'medicina' AND stock > 1 $filtro ORDER BY id_producto ASC LIMIT $productos_por_pagina OFFSET $offset";
$productos_array = $link->query($productos_query);

// Número total de páginas
$total_paginas = ceil($total_productos / $productos_por_pagina);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicamentos</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Asegúrate de que jQuery esté cargado antes de usarlo -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>

    <!-- Agrega los archivos CSS y JS de Select2 -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            // Manejar el evento de agregar al carrito
            $(".addToCartButton").click(function () {
                var productId = $(this).data('product-id');
                var cantidad = $("#txtcantidad_" + productId).val();

                // Validar que la cantidad sea un número válido
                if (cantidad === '' || isNaN(cantidad) || parseInt(cantidad) <= 0) {
                    alert("Por favor, ingresa una cantidad válida.");
                    return;
                }

                $.ajax({
                    type: 'POST',
                    url: 'consumo-medicina.php',
                    data: {
                        accion: 'agregar',
                        cod: productId,
                        txtcantidad: cantidad
                    },
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function () {
                        alert("Error al agregar el producto al carrito.");
                    }
                });
            });

            // Manejar el evento de eliminar del carrito
            $(".eliminarButton").click(function () {
                var productId = $(this).data('product-id');

                $.ajax({
                    type: 'POST',
                    url: 'consumo-medicina.php',
                    data: {
                        accion: 'eliminar',
                        eliminarcode: productId
                    },
                    success: function (response) {
                        console.log(response);
                        window.location.reload();
                    },
                    error: function () {
                        alert("Error al eliminar el producto del carrito.");
                    }
                });
            });

            $('#id_paciente').select2({
                placeholder: "Selecciona un paciente",
                allowClear: true
            });


        });
    </script>
</head>
<body>

<div class="container mt-5">
    <div class="row">

        <div class="col-md-12">
            <div class="mt-2"><h2 class="text-center mb-4">Productos disponibles en stock de medicamento</h2></div>

            <div class="text-center">
                <form method="GET" action="">
                    <div class="input-group mb-4">
                        <input type="text" name="buscar" class="form-control" placeholder="Buscar por código" value="<?php echo htmlspecialchars($buscar); ?>">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row">

                <?php
                // Verificar si la consulta de productos fue exitosa
                if ($productos_array && $productos_array->num_rows > 0) {
                    while ($k = $productos_array->fetch_assoc()) {
                        ?>
                        <div class="col-md-3 mb-4 mt-2">
                            <div class="card">
                                <img src="assets/images/products/<?php echo htmlspecialchars($k["imagen"]); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($k["titulo"]); ?>" style="height: 150px; object-fit: cover;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($k["titulo"]); ?></h5>
                                    <p class="card-text"><?php echo "$" . number_format($k["precio_compra"], 2); ?></p>
                                    <div class="mb-3">
                                        <input type="number" id="txtcantidad_<?php echo $k["id_producto"]; ?>" value="1" min="1" class="form-control">
                                    </div>
                                    <button type="button" class="btn btn-primary addToCartButton" data-product-id="<?php echo $k["id_producto"]; ?>">Agregar al Carrito</button>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                } else {
                    ?>
                    <div class="col-12">
                        <div class="alert alert-info text-center" role="alert">
                            No se encontraron productos que coincidan con tu búsqueda.
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

            <!-- Paginación -->
            <div class="pagination justify-content-center mt-4">
                <ul class="pagination">
                    <?php if ($pagina_actual > 1): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina_actual - 1; ?>&buscar=<?php echo urlencode($buscar); ?>">Anterior</a>
                        </li>
                    <?php endif; ?>

                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item <?php echo $i == $pagina_actual ? 'active' : ''; ?>">
                            <a class="page-link" href="?pagina=<?php echo $i; ?>&buscar=<?php echo urlencode($buscar); ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <?php if ($pagina_actual < $total_paginas): ?>
                        <li class="page-item">
                            <a class="page-link" href="?pagina=<?php echo $pagina_actual + 1; ?>&buscar=<?php echo urlencode($buscar); ?>">Siguiente</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

        </div>

        <div class="col-md-12 mt-5">
            <h2>Detalles de la orden.</h2>
            <?php
            if (isset($_SESSION["items_carrito"]) && !empty($_SESSION["items_carrito"])) {
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
                            <td><?php echo htmlspecialchars($item["vai_nom"]); ?></td>
                            <td><?php echo htmlspecialchars($item["vai_cod"]); ?></td>
                            <td><?php echo htmlspecialchars($item["txtcantidad"]); ?></td>
                            <td><?php echo "$" . number_format($item["vai_pre"], 2); ?></td>
                            <td><?php echo "$" . number_format($item_price, 2); ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm eliminarButton" data-product-id="<?php echo htmlspecialchars($item["vai_cod"]); ?>">Eliminar</button>
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

                <form method="POST" action="inserts/checkout-medicina.php">
                    <?php
                    foreach ($_SESSION["items_carrito"] as $item):
                        ?>
                        <input type="hidden" name="vai_nom[]" value="<?php echo htmlspecialchars($item["vai_nom"]); ?>">
                        <input type="hidden" name="vai_cod[]" value="<?php echo htmlspecialchars($item["vai_cod"]); ?>">
                        <input type="hidden" name="txtcantidad[]" value="<?php echo htmlspecialchars($item["txtcantidad"]); ?>">
                        <input type="hidden" name="vai_pre[]" value="<?php echo htmlspecialchars($item["vai_pre"]); ?>">
                    <?php endforeach; ?>

                    <div class="mb-3">
                        <label for="id_paciente">Seleccionar Paciente:</label>
                         <select name="id_paciente" id="id_paciente" class="form-control" required>
                            <?php
                            $pacientes_query = $link->query("SELECT id_paciente, nombre, aPaterno, aMaterno FROM pacientes WHERE archivado = 'No'");
                            if ($pacientes_query && $pacientes_query->num_rows > 0) {
                                while ($paciente = $pacientes_query->fetch_assoc()) {
                                    $nombre_completo = htmlspecialchars($paciente['nombre'] . ' ' . $paciente['aPaterno'] . ' ' . $paciente['aMaterno']);
                                    echo "<option value='" . htmlspecialchars($paciente['id_paciente']) . "'>$nombre_completo</option>";
                                }
                            } else {
                                echo "<option value=''>No hay pacientes disponibles</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="concepto">Descripción:</label>
                        <input type="text" name="concepto" class="form-control" required>
                    </div>

                    <input type="hidden" name="totprecio" value="<?php echo number_format($totprecio, 2); ?>">

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

<!-- Incluir Bootstrap JS al final para mejorar la carga de la página -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
