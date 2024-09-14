<?php
// Verifica si se reciben los datos del formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recupera los datos del formulario
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $descripcion_solicitud = isset($_POST['descripcion_solicitud']) ? $_POST['descripcion_solicitud'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';

    // Valida que los datos no estén vacíos
    if (empty($id_usuario) || empty($descripcion_solicitud) || empty($fecha)) {
        die('Error: Todos los campos son obligatorios.');
    }

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();  // Conexión usando la función bases()

    // Escapa los datos para evitar inyección SQL
    $descripcion_solicitud = $link->real_escape_string($descripcion_solicitud);
    $fecha = $link->real_escape_string($fecha);
    $archivado = "no";  // Definimos archivado como 'no'

    // Inserta la solicitud principal en la tabla solicitudes
    $sql_solicitud = "INSERT INTO solicitudes (descripcion, fecha, archivado, id_usuario) VALUES ('$descripcion_solicitud', '$fecha', '$archivado', $id_usuario)";

    if ($link->query($sql_solicitud) === TRUE) {
        // Obtén el ID de la nueva solicitud
        $id_solicitud = $link->insert_id;

        // Inserta los ítems en detalle_solicitudes
        $descripcion_items = $_POST['descripcion_item'];
        $cantidades = $_POST['cantidad'];
        $unidades = $_POST['unidad_medida'];

        // Prepara la consulta para insertar en detalle_solicitudes
        $sql_detalle = $link->prepare("INSERT INTO detalle_solicitudes (id_solicitud, descripcion_item, cantidad, unidad_medida) VALUES (?, ?, ?, ?)");

        foreach ($descripcion_items as $index => $descripcion_item) {
            $cantidad = $cantidades[$index];
            $unidad_medida = $unidades[$index];

            // Escapa cada ítem para evitar inyección SQL
            $descripcion_item = $link->real_escape_string($descripcion_item);
            $unidad_medida = $link->real_escape_string($unidad_medida);

            // Ejecuta la inserción de los detalles
            $sql_detalle->bind_param('isds', $id_solicitud, $descripcion_item, $cantidad, $unidad_medida);
            $sql_detalle->execute();
        }

        // Redirige después de insertar
        header("Location: ../solicitudes.php?mensaje=Solicitud+agregada+correctamente");
        exit();
    } else {
        // Ocurrió un error en la inserción de la solicitud principal
        die('Error al insertar la solicitud: ' . $link->error);
    }

    // Cierra la conexión a la base de datos
    $link->close();
} else {
    // Si no se reciben datos por POST, redirecciona a una página de error o vuelve atrás
    header("Location: index.php"); // Cambia "index.php" por la página deseada
    exit();
}
?>
