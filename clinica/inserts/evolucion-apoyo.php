<?php
// Verifica si se reciben los datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Recupera los datos del formulario
    $id_paciente = isset($_POST['id_paciente']) ? intval($_POST['id_paciente']) : 0;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : '';
    $evaluacion = isset($_POST['evaluacion']) ? $_POST['evaluacion'] : '';
    $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : '';
    $id_usuario = isset($_POST['id_usuario']) ? intval($_POST['id_usuario']) : 0;
    $imagen = ''; // Inicializa la variable de la imagen

    // Valida que los datos no estén vacíos
    if (empty($id_paciente) || empty($descripcion) || empty($evaluacion) || empty($fecha) || empty($id_usuario)) {
        die('Error: Todos los campos son obligatorios.');
    }

    // Conecta a la base de datos
    require('../global.php');
    $link = bases();

    // Procesa la imagen
    if(isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $nombre_imagen = $_FILES['imagen']['name'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        $ruta_destino = '../assets/images/evolucion/' . $nombre_imagen; // Reemplaza con la ruta donde deseas guardar la imagen

        // Mueve la imagen a la carpeta de destino
        if(move_uploaded_file($ruta_temporal, $ruta_destino)) {
            $imagen = $nombre_imagen; // Guarda el nombre de la imagen en la base de datos
        } else {
            die("Error al mover el archivo de imagen.");
        }
    }

    // Escapa los datos para evitar inyección SQL
    $descripcion = $link->real_escape_string($descripcion);
    $evaluacion = $link->real_escape_string($evaluacion);
    $fecha = $link->real_escape_string($fecha);

    // Inserta la nueva evolución en la tabla evolucion
    $sql_insert = "INSERT INTO evolucion (descripcion, evaluacion, fecha, id_paciente, id_usuario, imagen) 
                   VALUES ('$descripcion', '$evaluacion', '$fecha', $id_paciente, $id_usuario, '$imagen')";

    if ($link->query($sql_insert) === TRUE) {
        // La inserción fue exitosa
         header("Location: ../evolucion-paciente-apoyo.php?id_paciente=$id_paciente"); 
        exit();
    } else {
        // Ocurrió un error en la inserción
        die('Error al insertar la evolución en la base de datos: ' . $link->error);
    }

    // Cierra la conexión a la base de datos
    $link->close();
} else {
    // Si no se reciben datos por POST, redirecciona a alguna página de error o vuelve atrás
    header("Location: ../evolucion-paciente-apoyo.php");
    exit();
}
?>
