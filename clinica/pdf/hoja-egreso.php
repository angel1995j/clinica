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
                    <h1 style="font-family: Arial, sans-serif;">HOJA DE EGRESO</h1>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <p>NOMBRE DEL PACIENTE:<b> ' . $paciente['nombre'] . '  ' . $paciente['aPaterno'] . ' ' . $paciente['aMaterno'] . '</b></p>
        <p>EDAD:<b> ' . $paciente['edad'] . ' &nbsp;&nbsp;</b> SEXO: <b> ' . $paciente['sexo'] . '&nbsp;&nbsp;</b> 
           DOMICILIO: <b> ' . $paciente['direccion'] . '&nbsp;&nbsp;</b>
          FECHA:<b> ' . $nota['fecha'] . '&nbsp;&nbsp;</b>  HORA:<b> ' . $nota['hora'] . '&nbsp;&nbsp;</b></p>

          <p>MOTIVOS DE EGRESO:: <b>' . $nota['motivos_egreso'] . ' </b><br>*REALIZAR LA NOTIFICACIÓN A SU FAMILIAR O REPRESENTANTE LEGAL</p>
        
    </div>

    <div style="border: 1px solid; padding:2%;">

    <div class="content">
        <div class="section-title">DIAGNÓSTICO DE INGRESO:</div>
        <p>' . $nota['diagnostico_ingreso'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">PERIODO DE INTERNAMIENTO:</div>
        <p>' . $nota['periodo_internamiento'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">TRATAMIENTO LLEVADO A CABO:</div>
        <p>' . $nota['tratamiento_llevado_cabo'] . '<br>TRATAMIENTO MULTIDISCIPLINARIO QUE CONSTA DE VALORACIÓN MEDICO PSIQUIÁTRICA Y VALORACIÓN PSICOLÓGICA; ADEMÁS
DE TERAPIAS CON ENFOQUE EN ALCOHÓLICOS ANÓNIMOS, TERAPIAS ESPIRITUALES, CAPOEIRA, YOGA, EQUINO TERAPIA,
PSICODRAMA Y ARTETERAPIA, ETC.</p>
    </div>

    <div class="content">
        <div class="section-title">ESTUDIOS REALIZADOS:</div>
        <p>' . $nota['estudios_realizados'] . ' <br><b>Egg:</b>    ' . $nota['egg'] . ' <b>Laboratorio:</b>   ' . $nota['laboratorio'] . ' <b>rx:</b> ' . $nota['rx'] . ' <b>Pruebas Psicológicas:</b>  ' . $nota['pruebas_psicologicas'] . ' <b>Otros:</b>  ' . $nota['otros'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">EVOLUCIÓN Y MANEJO DURANTE LA ESTANCIA:</div>
        <p>' . $nota['evolucion_manejo_estancia'] . '</p>
    </div>

    <div class="content">
        <div class="section-title">DESCRIPCIÓN DEL ESTADO GENERAL:</div>
        <p>' . $nota['descripcion_estado_general'] . '</p>
    </div>


    <div class="content">
        <div class="section-title">EXPLORACIÓN FÍSICA AL EGRESO:</div>
        <p>' . $nota['exploracion_fisica_egreso'] . '</p>
    </div>

     <div class="content">
        <div class="section-title">PROBLEMAS CLÍNICOS PENDIENTES:</div>
        <p>' . $nota['problemas_clinicos_pendientes'] . '</p>
    </div>

     <div class="content">
        <div class="section-title">RECOMENDACIONES PARA SEGUIMIENTO DE CASO:</div>
        <p>' . $nota['recomendaciones_seguimiento'] . '</p>
    </div>

     <div class="content">
        <div class="section-title">PRONÓSTICO:</div>
        <p>' . $nota['pronostico'] . '</p>
    </div>

     <div class="content">
        <div class="section-title">OBSERVACIONES GENERALES ACERCA DEL USUARIO:</div>
        <p>' . $nota['observaciones_generales'] . '</p>
    </div>



    



    <div style="width: 100%; text-align: center; margin-top: 1%;">
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 50%; text-align: center; border: none;">
                    <div style="text-align:center;"><br><br><br>
                        RESPONSABLE DEL ESTABLECIMIENTO
                       <br><br>
                        _______________________<br>
                        NOMBRE Y FIRMA
                        
                    </div>
                </td>
                <td style="width: 50%; text-align: center; border: none;">
                    <div style="text-align:center;"><br><br><br><br><br>
                        RESPONSABLE DEL TRATAMIENTO
                       <br><br>
                        _______________________<br>NOMBRE Y FIRMA<BR><BR> Cedula Profesional:_________
                        
                    </div>
                </td>
            </tr>
        </table>
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
