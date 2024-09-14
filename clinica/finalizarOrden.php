<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require "header.php";
require_once("global.php");

$link = bases();

// Obtener la lista de pacientes desde la base de datos
$sqlPacientes = "SELECT id_paciente, nombre, aPaterno, aMaterno FROM pacientes WHERE estatus = 1";
$resultPacientes = $link->query($sqlPacientes);
?>

<div class="container-fluid py-4 mt-5">
    <div class="row mt-5">
        <div class="col-12">
            <div class="card mb-4 px-3">
                <div class="card-header pb-0">
                    <h6>Detalles de la orden</h6>
                </div>

                <div class="row mt-5">
                    <?php
                    if (isset($_GET['id_orden']) && isset($_GET['total'])) {
                        $id_orden = intval($_GET['id_orden']);
                        $total = floatval($_GET['total']);

                        // Consulta preparada para evitar inyección SQL
                        $sqlOrden = $link->prepare("SELECT id_paciente FROM ordenes WHERE id_orden = ?");
                        $sqlOrden->bind_param("i", $id_orden);
                        $sqlOrden->execute();

                        // Obtener el resultado
                        $sqlOrden->bind_result($id_paciente);
                        if ($sqlOrden->fetch()) {
                            echo "<h1><strong>Se ha completado la orden con éxito, número de orden:</strong> $id_orden</h1>";
                            echo "<h3><strong>Total de la compra del usuario: </strong>$$total</h3>";
                            echo "<a href='tiendita_paciente.php?id_paciente=$id_paciente' class='text-center btn btn-primary'>Volver a tiendita paciente</a>";
                        } else {
                            echo "<h1>Orden no encontrada.</h1>";
                        }

                        $sqlOrden->close(); // Cerrar la consulta
                    } else {
                        echo "<h1>Datos incompletos en la URL.</h1>";
                    }
                    ?>
                </div>

                <!-- Sección para agregar la firma digital -->
                <div class="row">
                    <div class="col-12">
                        <h5 class="mt-5">Firma aquí:</h5>
                        <!-- Ajustar el tamaño del canvas -->
                        <canvas id="signature-pad" class="border" style="width:100%; height:300px;" width="600" height="300"></canvas>
                        <button id="clear" class="btn btn-secondary mt-3">Limpiar</button>
                        <button id="save" class="btn btn-success mt-3">Guardar Firma</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require "footer.php";?>

<!-- Mueve la inclusión de la librería de SignaturePad aquí, al final del body -->
<script src="https://cdn.jsdelivr.net/npm/signature_pad@4.1.7/dist/signature_pad.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    var canvas = document.getElementById('signature-pad');
    var signaturePad = new SignaturePad(canvas);

    // Ajustar la resolución del canvas al tamaño visual
    function resizeCanvas() {
        var ratio = Math.max(window.devicePixelRatio || 1, 1);
        canvas.width = canvas.offsetWidth * ratio;
        canvas.height = canvas.offsetHeight * ratio;
        canvas.getContext("2d").scale(ratio, ratio);
        signaturePad.clear(); // Esto borra el contenido previo al redimensionar
    }

    // Redimensionar el canvas al cargar la página
    resizeCanvas();
    window.addEventListener('resize', resizeCanvas);

    // Limpiar la firma
    document.getElementById('clear').addEventListener('click', function () {
        signaturePad.clear();
    });

    // Guardar la firma
    document.getElementById('save').addEventListener('click', function () {
        if (signaturePad.isEmpty()) {
            alert("Por favor, firme antes de guardar.");
        } else {
            // Convertir la firma a un blob en lugar de base64
            var dataURL = signaturePad.toDataURL('image/png');
            var blob = dataURLToBlob(dataURL);

            // Crear un FormData y agregar los datos
            var formData = new FormData();
            formData.append('id_orden', <?php echo json_encode($id_orden); ?>); // Asegúrate de que sea JSON seguro
            formData.append('firma', blob, 'firma.png');

            // Enviar usando AJAX
            fetch('updates/firma.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                var idPaciente = <?php echo json_encode($id_paciente); ?>;
               window.location.href = 'tiendita_paciente.php?id_paciente=' + idPaciente;
                
                console.log(data); // Para debug
            })
            .catch(error => {
                console.error('Error al guardar la firma:', error);
            });
        }
    });

    // Función para convertir dataURL a Blob
    function dataURLToBlob(dataURL) {
        var byteString = atob(dataURL.split(',')[1]);
        var mimeString = dataURL.split(',')[0].split(':')[1].split(';')[0];
        var ab = new ArrayBuffer(byteString.length);
        var ia = new Uint8Array(ab);
        for (var i = 0; i < byteString.length; i++) {
            ia[i] = byteString.charCodeAt(i);
        }
        return new Blob([ab], { type: mimeString });
    }
});

</script>
</body>
</html>
