<?php
require "header.php";
require "global.php";
$link = bases();

if (isset($_GET['id_contacto'])) {
    $id_contacto = $_GET['id_contacto'];

    // Consulta SQL para obtener los detalles del contacto
    $sql = "SELECT * FROM contactos WHERE id_contacto = $id_contacto";
    $result = $link->query($sql);

    // Verifica si hay resultados
    if ($result->num_rows > 0) {
        $contacto = $result->fetch_assoc();
        ?>
        <div class="container-fluid py-4 mt-5">
            <div class="row mt-5">
                <a href="crm.php" class="text-secondary mt-3"><i class="fa fa-undo" aria-hidden="true"></i> Volver al CRM</a>

                <div class="col-12 mt-3">
                    <h1>Editar Contacto <?php echo $contacto['nombre']; ?></h1>
                    <!-- Formulario de edición Bootstrap -->
                    <form action="updates/contacto.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id_contacto" value="<?php echo $contacto['id_contacto']; ?>">

                        <div class="mb-3">
                            <label for="nombre" class="form-label">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" value="<?php echo $contacto['nombre']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="aPaterno" class="form-label">Apellido Paterno:</label>
                            <input type="text" class="form-control" name="aPaterno" value="<?php echo $contacto['aPaterno']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="aMaterno" class="form-label">Apellido Materno:</label>
                            <input type="text" class="form-control" name="aMaterno" value="<?php echo $contacto['aMaterno']; ?>" required>
                        </div>

                        <div class="mb-3">
                            <label for="telefono" class="form-label">Teléfono:</label>
                            <input type="tel" class="form-control" name="telefono" value="<?php echo $contacto['telefono']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="fecha_ingreso" class="form-label">Fecha de ingreso:</label>
                            <input type="date" class="form-control" name="fecha_ingreso" value="<?php echo $contacto['fecha_ingreso']; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="estado" class="form-label">Estado:</label>
                            <select class="form-select" name="estado" required>
                                <option value="Suscriptor" <?php echo ($contacto['estado'] == 'Suscriptor') ? 'selected' : ''; ?>>Suscriptor</option>
                                <option value="Lead" <?php echo ($contacto['estado'] == 'Lead') ? 'selected' : ''; ?>>Lead</option>
                                <option value="Lead calificado" <?php echo ($contacto['estado'] == 'Lead calificado') ? 'selected' : ''; ?>>Lead calificado</option>
                                <option value="Oportunidad" <?php echo ($contacto['estado'] == 'Oportunidad') ? 'selected' : ''; ?>>Oportunidad</option>
                                <option value="Ganado" <?php echo ($contacto['estado'] == 'Ganado') ? 'selected' : ''; ?>>Ganado</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="intensidad" class="form-label">Intensidad:</label>
                            <select class="form-select" name="intensidad">
                                <option value="Interesado" <?php echo ($contacto['intensidad'] == 'Interesado') ? 'selected' : ''; ?>>Interesado</option>
                                <option value="Muy interesado" <?php echo ($contacto['intensidad'] == 'Muy interesado') ? 'selected' : ''; ?>>Muy interesado</option>
                                <option value="Poco interesado" <?php echo ($contacto['intensidad'] == 'Poco interesado') ? 'selected' : ''; ?>>Poco interesado</option>
                                <option value="No contesta" <?php echo ($contacto['intensidad'] == 'No contesta') ? 'selected' : ''; ?>>No contesta</option>
                                <option value="Mal momento" <?php echo ($contacto['intensidad'] == 'Mal momento') ? 'selected' : ''; ?>>Mal momento</option>
                                <option value="En espera" <?php echo ($contacto['intensidad'] == 'En espera') ? 'selected' : ''; ?>>En espera</option>
                            </select>
                        </div>


                        <div class="mb-3">
                            <label for="observaciones" class="form-label">Observaciones:</label>
                            <textarea class="form-control" name="observaciones" rows="4"><?php echo $contacto['observaciones']; ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="archivado" class="form-label">Archivado:</label>
                            <select class="form-select" name="archivado">
                                <option value="no" <?php echo ($contacto['archivado'] == 'no') ? 'selected' : ''; ?>>No</option>
                                <option value="si" <?php echo ($contacto['archivado'] == 'si') ? 'selected' : ''; ?>>Sí</option>
                            </select>
                        </div>

                        <!-- Agrega los demás campos según sea necesario -->

                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    } else {
        echo "Contacto no encontrado.";
    }
} else {
    echo "ID de contacto no proporcionado.";
}

require "footer.php";
?>
