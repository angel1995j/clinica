<!-- process_update_password.php -->
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verifica si las contraseñas coinciden
    if ($_POST['new_password'] === $_POST['confirm_password']) {
        // Hashea la nueva contraseña (opcional, pero se recomienda para seguridad)
        $hashedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

        // Realiza la actualización en la base de datos (ajusta según tu estructura de base de datos)
        require('../global.php'); // Reemplaza esto con tu lógica de conexión
        $link = bases();

        session_start();
        $id_usuario = $_SESSION['id_usuario'];

        $sqlActualizarPassword = "UPDATE usuarios SET contrasena = ? WHERE id_usuario = ?";
        $stmt = $link->prepare($sqlActualizarPassword);
        $stmt->bind_param("si", $hashedPassword, $id_usuario);

        if ($stmt->execute()) {
            // Éxito en la actualización
            echo "Contraseña actualizada con éxito.";
            header("Location: ../usuarios.php");
            exit();
        } else {
            // Error en la actualización
            echo "Error al actualizar la contraseña: " . $stmt->error;
        }

        // Cierra la conexión y el statement
        $stmt->close();
        $link->close();
    } else {
        // Contraseñas no coinciden
        echo "Las contraseñas no coinciden. Vuelve e inténtalo de nuevo.";
    }
} else {
    // Acceso no autorizado
    echo "Acceso no autorizado.";
}
?>
