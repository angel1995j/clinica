<?php
// Iniciar sesión para acceder a $_SESSION
session_start();

// Recupera el ID del usuario desde GET
$id_usuario_actual = isset($_GET['id_usuario']) ? intval($_GET['id_usuario']) : 0;

if ($id_usuario_actual === 0) {
    die('ID de usuario no proporcionado o inválido');
}

// Conecta a la base de datos
require('global.php');
$link = bases();

// Verifica si $_SESSION['id_usuario'] está definida
if (!isset($_SESSION['id_usuario'])) {
    die('ID del usuario logueado no disponible');
}

$id_usuario_logueado = $_SESSION['id_usuario'];

// Consulta el rol del usuario logueado
$sql_rol_usuario = "SELECT rol FROM usuarios WHERE id_usuario = $id_usuario_logueado";
$resultado_rol_usuario = $link->query($sql_rol_usuario);

// Verifica si la consulta fue exitosa
if ($resultado_rol_usuario === false) {
    die('Error al ejecutar la consulta para obtener el rol del usuario');
}

$datos_usuario_logueado = $resultado_rol_usuario->fetch_assoc();

// Dependiendo del rol del usuario logueado, carga el header correspondiente
if ($datos_usuario_logueado['rol'] == 'Proteccion') {
    require "header-proteccion.php";
} elseif ($datos_usuario_logueado['rol'] == 'Salud') {
    require "header-salud.php";
} else {
    require "header.php";
}

// Consulta SQL para obtener el nombre y aPaterno del usuario actual
$sql_usuario = "SELECT nombre, aPaterno FROM usuarios WHERE id_usuario = $id_usuario_actual";
$resultado_usuario = $link->query($sql_usuario);

// Verifica si la consulta fue exitosa y si se encontró el usuario
if ($resultado_usuario === false || $resultado_usuario->num_rows === 0) {
    die('Usuario no encontrado o error en la consulta');
}

$usuario = $resultado_usuario->fetch_assoc();
$nombre_usuario = $usuario['nombre'];
$aPaterno_usuario = $usuario['aPaterno'];

// Consulta SQL para obtener los pacientes relacionados con la agenda del usuario actual
$sql_agenda = "SELECT agenda.id_agenda, agenda.fecha, agenda.observaciones, pacientes.nombre, pacientes.aPaterno, pacientes.aMaterno 
               FROM agenda 
               INNER JOIN pacientes ON agenda.id_paciente = pacientes.id_paciente
               WHERE agenda.id_usuario = $id_usuario_actual 
               ORDER BY agenda.fecha DESC";

$resultado_agenda = $link->query($sql_agenda);

// Verifica si la consulta de la agenda fue exitosa
if ($resultado_agenda === false) {
    die('Error al ejecutar la consulta de la agenda');
}

?>

<!-- SECCION DE LISTADO -->
<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-12">
            <div class="container-fluid py-4">
                <!-- Mostrar el nombre del usuario -->
                <h2>Agenda de <?php echo $nombre_usuario . ' ' . $aPaterno_usuario; ?></h2>
                <div class="card mb-4 px-3 mt-5">
                    <!-- INICIA CONTENIDO DE TABLA -->
                    <div class="card-body px-0 pt-0 pb-4 pt-3">
                        <ul class="list-group mt-2">
                            <?php while ($fila_agenda = $resultado_agenda->fetch_assoc()) : ?>
                                <li class="list-group-item mt-3">
                                    <strong>Fecha de la cita:</strong> <?php echo $fila_agenda['fecha']; ?> <br>
                                    <strong>Observaciones:</strong> <?php echo $fila_agenda['observaciones']; ?> <br>
                                    <strong>Paciente:</strong> <?php echo $fila_agenda['nombre'] . " " . $fila_agenda['aPaterno'] . " " . $fila_agenda['aMaterno']; ?>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>
