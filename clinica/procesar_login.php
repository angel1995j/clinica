<?php
session_start();
require "global.php";
$link = bases();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtiene las credenciales ingresadas por el usuario
    $nombre_usuario = $link->real_escape_string($_POST['nombre_usuario']);
    $contrasena = $link->real_escape_string($_POST['contrasena']);

    // Consulta para obtener el hash almacenado y el rol en la base de datos
    $consulta = "SELECT id_usuario, nombre_usuario, contrasena, rol FROM usuarios WHERE nombre_usuario = '$nombre_usuario'";
    $resultado = $link->query($consulta);

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        $hash_almacenado = $usuario['contrasena'];

        // Verifica la contraseña ingresada con el hash almacenado 
        if (password_verify($contrasena, $hash_almacenado)) {
             $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['nombre_usuario'] = $usuario['nombre_usuario'];
            $_SESSION['rol'] = $usuario['rol']; // Nueva línea para establecer la variable de sesión del rol


            // Contraseña válida y usuario autenticado
            switch ($usuario['rol']) {
                case 'SuperAdministrador':
                    header("Location: index.php");
                    break;

                case 'Administracion':
                    header("Location: index.php");
                    break;
                        
                case 'Cocina':
                    header("Location: index_cocina.php");
                    break;
                case 'Recepcion':
                    header("Location: index_recepcion.php");
                    break;
                case 'Tiendita':
                    // Usuario con rol "Tiendita" se redirige a la página específica para Tiendita
                    header("Location: index_tiendita.php");
                    break;
                case 'Padrino':
                case 'Psicologo':
                case 'Medico':
                    header("Location: index_apoyo.php");
                    break;
                case 'Vendedor':
                    header("Location: index_vendedor.php");
                    break;
                default:
                    // Si el rol no coincide con ninguno de los anteriores, puedes manejarlo según tus necesidades
                    echo "Rol desconocido";
                    break;
            }
            // Importante: Asegúrate de agregar un exit() después de cada redirección para evitar ejecución adicional del código.
            exit();
        } else {
            echo "Credenciales incorrectas";
        }
    } else {
        echo "Credenciales incorrectas";
    }
}

$link->close();
?>
