<?php
// Incluye el archivo global.php
require('../global.php');

// Conecta a la base de datos
$link = bases();

// Recupera los datos del formulario
$id_empleado = $_POST['id_empleado'];
$tipo_documento = $_POST['tipo_documento'];
$fecha = $_POST['fecha'];
$observaciones = $_POST['observaciones'];

// Manejo del archivo subido
$archivo = $_FILES['archivo'];
$archivo_nombre = $archivo['name'];
$archivo_tmp = $archivo['tmp_name'];
$archivo_error = $archivo['error'];
$archivo_destino = '../assets/docs/empleados/' . basename($archivo_nombre);

// Verifica si hubo un error al subir el archivo
if ($archivo_error === UPLOAD_ERR_OK) {
    // Mueve el archivo subido al destino deseado
    if (move_uploaded_file($archivo_tmp, $archivo_destino)) {
        // Prepara la consulta SQL para insertar los datos
        $sql_insert = "INSERT INTO docs_empleado (id_empleado, tipo_documento, fecha, observaciones, archivo) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $link->prepare($sql_insert)) {
            // Vincula los parámetros
            $stmt->bind_param("issss", $id_empleado, $tipo_documento, $fecha, $observaciones, $archivo_nombre);

            // Ejecuta la consulta
            if ($stmt->execute()) {
                echo "Documento agregado exitosamente";
                header("Location: ../quincena-empleado.php?id_empleado=$id_empleado");
                exit();
            } else {
                echo "Error: " . $stmt->error;
            }

            // Cierra la consulta preparada
            $stmt->close();
        } else {
            echo "Error en la preparación de la consulta";
        }
    } else {
        echo "Error al mover el archivo subido";
    }
} else {
    echo "Error en la subida del archivo";
}

// Cierra la conexión a la base de datos
$link->close();
?>
