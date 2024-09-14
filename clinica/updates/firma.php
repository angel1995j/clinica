<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once("../global.php");

$link = bases();

if (isset($_POST['id_orden']) && isset($_FILES['firma'])) {
    $id_orden = intval($_POST['id_orden']);
    $firma = $_FILES['firma'];

    // Verificar si el archivo se subió correctamente
    if ($firma['error'] === UPLOAD_ERR_OK) {
        $filename = "firma_" . $id_orden . "_" . time() . ".png";
        $filepath = "../assets/docs/firmas/" . $filename;

        // Mover el archivo a la carpeta de destino
        if (move_uploaded_file($firma['tmp_name'], $filepath)) {
            // Insertar o actualizar la ruta de la firma en la base de datos
            $sqlUpdate = $link->prepare("UPDATE ordenes SET firma = ? WHERE id_orden = ?");
            $sqlUpdate->bind_param("si", $filepath, $id_orden);

            if ($sqlUpdate->execute()) {
                echo "Firma guardada correctamente en la base de datos.";
            } else {
                echo "Error al guardar la firma en la base de datos.";
            }

            $sqlUpdate->close();
        } else {
            echo "Error al mover el archivo de firma.";
        }
    } else {
        echo "Error al subir el archivo.";
    }
} else {
    echo "Datos incompletos.";
}
?>
