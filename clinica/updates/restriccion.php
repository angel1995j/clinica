<?php
// Incluir el archivo de conexión
require('../global.php');

// Obtener los datos del formulario
$id_paciente = $_POST['id_paciente'];
$nuevas_restricciones = $_POST['restriccionesConsumo'];

// Realizar la actualización en la base de datos
$link = bases(); 

// Verificar si la conexión fue exitosa
if ($link) {
    // Escapar las variables para prevenir inyección de SQL (usa la función adecuada según la biblioteca que estés utilizando, por ejemplo, mysqli_real_escape_string o prepared statements)
    $id_paciente = mysqli_real_escape_string($link, $id_paciente);
    $nuevas_restricciones = mysqli_real_escape_string($link, $nuevas_restricciones);

    // Crear la consulta SQL para actualizar restriccionesConsumo
    $sql = "UPDATE pacientes SET restriccionesConsumo = '$nuevas_restricciones' WHERE id_paciente = '$id_paciente'";

    // Ejecutar la consulta
    $result = mysqli_query($link, $sql);

    // Verificar si la actualización fue exitosa
    if ($result) {
        // Redireccionar después de la actualización exitosa
        header("Location: ../tiendita_paciente.php?id_paciente=$id_paciente");
        exit;
    } else {
        // Manejar el error en caso de que la actualización falle
        echo "Error al actualizar en la base de datos: " . mysqli_error($link);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($link);
} else {
    // Manejar el error si la conexión no se estableció correctamente
    echo "Error al conectar a la base de datos.";
}
?>
