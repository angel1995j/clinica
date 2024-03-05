<?php
require "global.php";
$link = bases();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifica si el formulario ha sido enviado
    if (isset($_POST['current_password']) && isset($_POST['new_password']) && isset($_POST['confirm_password'])) {
        // Recupera los datos del formulario
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        // Obtén el ID del usuario logueado
        session_start();
        $id_usuario_logueado = isset($_SESSION['id_usuario']) ? $_SESSION['id_usuario'] : 0;

        // Verifica que la contraseña actual sea correcta
        $sql_verify_password = "SELECT contrasena FROM usuarios WHERE id_usuario = $id_usuario_logueado";
        $result_verify_password = $link->query($sql_verify_password);

        if ($result_verify_password->num_rows > 0) {
            $row = $result_verify_password->fetch_assoc();
            $hashed_current_password = $row['contrasena'];

            // Verifica la contraseña actual
            if (password_verify($current_password, $hashed_current_password)) {
                // La contraseña actual es correcta, verifica que las nuevas contraseñas coincidan
                if ($new_password == $confirm_password) {
                    // Hashea la nueva contraseña
                    $hashed_new_password = password_hash($new_password, PASSWORD_DEFAULT);

                    // Actualiza la contraseña en la base de datos
                    $sql_update_password = "UPDATE usuarios SET contrasena = '$hashed_new_password' WHERE id_usuario = $id_usuario_logueado";

                    if ($link->query($sql_update_password) === TRUE) {
                        echo "Contraseña actualizada con éxito.";
                    } else {
                        echo "Error al actualizar la contraseña: " . $link->error;
                    }
                } else {
                    echo "Las nuevas contraseñas no coinciden.";
                }
            } else {
                echo "Contraseña actual incorrecta.";
            }
        }
    }
}
session_start();
// Determina el rol del usuario logueado
$rol_usuario = isset($_SESSION['rol']) ? $_SESSION['rol'] : '';

// Incluye el archivo de encabezado correspondiente según el rol
if ($rol_usuario == 'SuperAdministrador') {
    require "header.php";
} elseif ($rol_usuario == 'Recepcion') {
    require "header-recepcion.php";
} elseif ($rol_usuario == 'Tiendita') {
    require "header-tiendita.php";
} elseif ($rol_usuario == 'Vendedor') {
    require "header-vendedor.php";
} elseif ($rol_usuario == 'Padrino' || $rol_usuario == 'Psicologo' || $rol_usuario == 'Medico') {
    require "header-apoyo.php";
}

?>

<div class="container-fluid py-4 mt-5">
    <div class="card mb-4 mt-5 px-3">
        <div class="row d-flex mt-5">
            <h3>Cambiar mi contraseña</h3>
            <div class="col-12 mb-4">
                <form method="POST" action="">
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Contraseña actual</label>
                        <input type="password" class="form-control" name="current_password" required>
                    </div>
                    <div class="mb-3">
                        <label for="new_password" class="form-label">Nueva contraseña</label>
                        <input type="password" class="form-control" name="new_password" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Repetir nueva contraseña</label>
                        <input type="password" class="form-control" name="confirm_password" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require "footer.php";
?>
