<?php
session_start(); // Inicia la sesión si no está iniciada
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recupera los datos del formulario
    $monto = $_POST['monto'];
    $fecha_agregado = date("Y-m-d"); // Fecha actual
    $fecha_pagado = $_POST['fecha_pagado'];
    $observaciones = $_POST['observaciones'];
    $estatus = $_POST['estatus'];
    $archivado = "no";
    $id_paciente = $_GET['id_paciente'];
    $comprobante = "";
    $forma_pago = $_POST['forma_pago'];

    // Recupera el id_usuario de la sesión actual
    $id_usuario = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : null;

    // Procesa la imagen
    if(isset($_FILES['comprobante']) && $_FILES['comprobante']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = $_FILES['comprobante']['name'];
        $ruta_temporal = $_FILES['comprobante']['tmp_name'];
        $ruta_destino = '../assets/docs/comprobantes/' . $nombre_imagen; // Ruta donde deseas guardar la imagen en tu servidor

        // Mueve la imagen a la carpeta de destino
        if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
            $comprobante = $nombre_imagen; // Guarda el nombre de la imagen en la base de datos
        } else {
            echo "Error al mover el archivo de imagen.";
        }
    }

    // Conecta a la base de datos y realiza la inserción
    require('../global.php');
    $link = bases();

    // Prepara la consulta preparada
    $sql_insert = "INSERT INTO pago_paciente (monto, comprobante, fecha_agregado, fecha_pagado, observaciones, estatus, archivado, id_paciente, id_usuario, forma_pago) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $link->prepare($sql_insert)) {
        // Vincula los parámetros
        $stmt->bind_param("sssssssiis", $monto, $comprobante, $fecha_agregado, $fecha_pagado, $observaciones, $estatus, $archivado, $id_paciente, $id_usuario, $forma_pago);

        // Ejecuta la consulta
        if ($stmt->execute()) {
            echo "Registro de pago exitoso";
            header("Location: ../pago-paciente-adicional-vendedor.php?id_paciente=$id_paciente");
            //pago-paciente-adicional.php
        } else {
            echo "Error: " . $stmt->error;
        }

        // Cierra la consulta preparada
        $stmt->close();
    } else {
        echo "Error en la preparación de la consulta";
    }

    // Cierra la conexión a la base de datos
    $link->close();
}
?>
