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
$id_egreso = isset($_GET['id_egreso']) ? intval($_GET['id_egreso']) : 0;

if (!$id_egreso) {
    die('ID de la nota no proporcionado');
}

// Conecta a la base de datos y obtén los datos de la nota
require('../global.php');
$link = bases();

// Consulta los datos de la nota
$sql = "SELECT * FROM hojas_egreso WHERE id_egreso = $id_egreso";
$resultado = $link->query($sql);

if ($resultado->num_rows == 0) {
    die('No se encontró la nota con el ID proporcionado');
}

$nota = $resultado->fetch_assoc();

// Consulta los datos del paciente
$id_paciente = $nota['id_paciente'];
$sql_paciente = "SELECT nombre, edad, sexo, aPaterno, aMaterno, direccion FROM pacientes WHERE id_paciente = $id_paciente";
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
                    <h1 style="font-family: Arial, sans-serif;">CARTA COMPROMISO</h1>
                </td>
            </tr>
        </table>
    </div>

    <div class="content" style="text-align:justify;">
        <p>EL QUE SUSCRIBE,:<b> ' . $paciente['nombre'] . '  ' . $paciente['aPaterno'] . ' ' . $paciente['aMaterno'] . '</b></p>
        <p>

            QUIEN EL DÍA DE HOY
            ' . $nota['fecha'] . ' DOY POR CONCLUIDO MI TIEMPO DE ESTANCIA Y TRATAMIENTO
            RESIDENCIAL EN LA CLINICA 7 ANGELES, INSTITUCION ESPECIALIZADA EN EL TRATAMIENTO DE LAS
            ADICCIONES. <br>
            CONOCIENDO LOS RIESGOS QUE CONLLEVA MI REINCORPORACION HABITUAL A LA
            SOCIEDAD UNA VEZ EGRESADO DE ESTA INSTITUCION, ME COMPROMETO A APEGARME DE
            FORMA DISCIPLINADA Y PUNTUAL A MI PLAN DE VIDA, EL CUAL INCLUYE LOS LINEAMIENTOS
            REVISADOS EN LAS AREAS: PERSONAL, SALUD, FAMILIAR, LABORAL, EDUCATIVA, OCIO Y
            RECREACIÓN, GRUPOS DE AYUDA MUTUA, AL PLAN DE SEGUIMIENTO AMBULATORIO DISEÑADO
            PARA DARLE CONTINUIDAD A MI TRATAMIENTO Y APOYAR AL MANTENIMIENTO DE MI
            CONDUCTA DE ABSTINENCIA, ASI COMO TRABAJAR DE FORMA MAS OPORTUNA Y EFICAZ EN
            ESTRATEGIAS PARA LA PREVENCION DE RECAIDAS.<br><br>
            LO ANTERIOR IMPLICA LOS SIGUIENTES PUNTOS:
            <ul>
            <li> BÚSQUEDA Y ASISTENCIA A UN GRUPO DE AYUDA MUTUA (AA-NA).</li>
            <li> APEGO AL PLAN DE SEGUIMIENTO SUGERIDO POR LA CLÍNICA “7 ÁNGELES”.</li>
            <li> DARLE CONTINUIDAD A MI TRATAMIENTO PSIQUIÁTRICO (EN SU CASO).</li>
            <li> CUMPLIR EN MEDIDA DE LO POSIBLE, EL PLAN DE VIDA DISEÑADO DURANTE LA TERAPIA
            PSICOLÓGICA INDIVIDUAL.</li>
            </ul>

        </p>
        
    </div>

    



    <div style="width: 100%; text-align: center; margin-top: 1%;">
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 50%; text-align: center; border: none;">
                    <div style="text-align:center;"><br><br><br>
                        TESTIGO
                       <br><br>
                        _______________________<br>
                        NOMBRE Y FIRMA
                        
                    </div>
                </td>
                <td style="width: 50%; text-align: center; border: none;">
                    <div style="text-align:center;"><br><br><br><br><br>
                        PSICÓLOGO
                       <br><br>
                        _______________________<br>NOMBRE Y FIRMA<BR><BR> Cedula Profesional:_________
                        
                    </div>
                </td>
            </tr>
        </table>

        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 100%; text-align: center; border: none;">
                    <div style="text-align:center;"><br><br><br>
                        PACIENTE
                       <br><br>
                        _______________________<br>
                        NOMBRE Y FIRMA
                        
                    </div>
                </td>

            </tr>
        </table>

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
