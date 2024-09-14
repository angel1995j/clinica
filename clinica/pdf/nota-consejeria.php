<?php
require_once('../dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;

// Inicializa Dompdf con opciones
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Recupera el ID de la nota desde GET
$id_consejeria = isset($_GET['id_consejeria']) ? intval($_GET['id_consejeria']) : 0;

if (!$id_consejeria) {
    die('ID de la nota no proporcionado');
}

// Conecta a la base de datos y obtén los datos de la nota
require('../global.php');
$link = bases();

// Consulta los datos de la nota
$sql = "SELECT * FROM notas_consejeria WHERE id_consejeria = $id_consejeria";
$resultado = $link->query($sql);

if ($resultado->num_rows == 0) {
    die('No se encontró la nota con el ID proporcionado');
}

$nota = $resultado->fetch_assoc();

// Consulta los datos del paciente
$id_paciente = $nota['id_paciente'];
$sql_paciente = "SELECT nombre, edad, sexo, aPaterno, aMaterno FROM pacientes WHERE id_paciente = $id_paciente";
$resultado_paciente = $link->query($sql_paciente);

if ($resultado_paciente->num_rows == 0) {
    die('No se encontró el paciente con el ID proporcionado');
}

$paciente = $resultado_paciente->fetch_assoc();

// HTML para el contenido del PDF
$html = '
<html> 
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { text-align: left; margin-bottom: 20px; display: inline-block; }
        .header img { width: 70px; text-align:left; }
        .section-title { font-weight: bold; margin-top: 20px; }
        .content { margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; }
        .table td { padding: 8px; border: 1px solid #000; }
    </style>
</head>
<body>
    <div style="width: 100%; text-align: center; margin-top: 1%;">
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 30%; text-align: left; border: none;">
                    <img src="https://tecolotito-digital.com.mx/clinica/assets/images/logos/Logo-azul.jpg" alt="Logo" width="110">
                </td>
                <td style="width: 70%; text-align: left; border: none;">
                    <h1 style="font-family: Arial, sans-serif;">NOTA DE CONSEJERIA</h1>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <p>NOMBRE DEL PACIENTE:<b> ' . $paciente['nombre'] . '  ' . $paciente['aPaterno'] . ' ' . $paciente['aMaterno'] . '</b></p>
        <p>EDAD:<b> ' . $paciente['edad'] . ' &nbsp;&nbsp;</b> SEXO: <b> ' . $paciente['sexo'] . '&nbsp;&nbsp;</b> 
          FECHA:<b> ' . $nota['fecha'] . '&nbsp;&nbsp;</b>  HORA:<b> ' . $nota['hora'] . '&nbsp;&nbsp;</b></p>

          <p>OBJETIVO TERAPEUTICO DE CONSEJERIA: <b>' . $nota['objetivo'] . ' </b></p>
        
    </div>

    <div style="border: 1px solid; padding:2%;">

    <div class="content">
        <div class="section-title">RESUMEN DE LA SESIÓN (ASPECTOS TRABAJADOS EN SESION)</div>
        <p>' . $nota['resumen'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">RESULTADOS DE LA SESIÓN DE CONSEJERIA (CONDUCTA Y DISPOSICIÓN)</div>
        <p>' . $nota['resultados'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">ASPECTOS QUE SE ESPERAN TRABAJAR EN LA SIGUIENTE SESIÓN</div>
        <p>' . $nota['aspectos_esperados'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">TAREAS ASIGNADAS AL USUARIO</div>
        <p>' . $nota['tareas'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">ASPECTOS TRABAJADOS CON EL USUARIO PARA REINSERCIÓN SOCIAL</div>
        <p>' . $nota['aspectos_trabajados'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">OBSERVACIONES</div>
        <p>' . $nota['observaciones'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">FECHA DE LA PROXIMA SESIÓN: ' . $nota['fecha_proxima'] . '</div>
        
    </div>

    <div style="text-align:center;"><br><br><br>
        NOMBRE Y FIRMA DEL CONSEJERO
       <br><br>
        _______________________<br>
        
    </div>


    </div>

</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envía el PDF al navegador
$dompdf->stream('nota-psicologica.pdf', ['Attachment' => 0]);

?>
