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

// Decodifica el campo fechas_horas
$fechas_horas = json_decode($nota['fechas_horas'], true);

// Formatea las fechas y horas en una cadena de texto
$fechas_formateadas = '';
if (!empty($fechas_horas)) {
    foreach ($fechas_horas as $fh) {
        $fechas_formateadas .= '<li>' . $fh['fecha'] . ' - ' . $fh['hora'] . '</li>';
    }
}

$fechas_formateadas = '<ul>' . $fechas_formateadas . '</ul>';

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
                    <h1 style="font-family: Arial, sans-serif;">PROGRAMA TERAPÉUTICO DE SEGUIMIENTO</h1>
                </td>
            </tr>
        </table>
    </div>

    <div class="content">
        <p>La reinserción del usuario a su vida “normal”, es decir la reincorporación a sus
actividades cotidianas en las diversas áreas (social, familiar, laboral, escolar, etc.),
así como la experimentación de situaciones nuevas y/o anteriores, son fuentes
generadoras de estrés y ansiedad. Si no hay un manejo adecuado, lo anterior
puede llevar al usuario a una posible recaída.
Al terminar la fase de internamiento, se recomienda ampliamente continuar un
proceso de seguimiento dirigido a prevenir las posibles recaídas. El usuario que
egresa de la clínica aún se encuentra vulnerable ante situaciones estresantes que
puedan acontecer en su día a día, por lo que en esta etapa se busca cumplir con
los siguientes objetivos:
<ul>
<li> Conocer qué efectos ha tenido el tratamiento en la vida del usuario una vez
que ha concluido el periodo de internamiento.</li>
<li> Monitorear el mantenimiento del cambio en la conducta de consumo y las
consecuencias asociadas que se derivan de este cambio.</li>
<li> Reforzar las habilidades de afrontamiento en situaciones de riesgo y
resolución de problemas y favorecer la exposición a situaciones nuevas,
similares a las entrenadas en sesión, en las que el usuario compruebe las
destrezas aprendidas en las sesiones de tratamiento.</li>
<li> Conocer los avances en cuanto a las metas establecidas al finalizar el
tratamiento.</li>
<li> Detectar aquellas áreas que necesiten ser reforzadas para prevenir una
recaída.</li>
<li> Explorar la ausencia o presencia de factores de riesgo y/o protección para
promoverlos o erradicarlos según sea el caso.</li>
<li> Ejercitar y fortalecer los recursos psicológicos que apoyan el mantenimiento
de la abstinencia y el nuevo estilo de vida, tales como: autoeficacia,
autoestima, autoconcepto, motivación, entre otros.</li>
<li> Promover la adquisición y mantenimiento de hábitos saludables en
sustitución de aquellas conductas dañinas que se desarrollaban en el estilo
de vida anterior al tratamiento.</li>
<li> Realizar una prueba de antidoping para detectar cualquier tipo de droga en
el sistema del usuario.</li>
</ul>
En términos generales, el plan de seguimiento busca proteger al usuario de una
posible recaída y prolongar en el tiempo los efectos del programa de
internamiento, además pretende seguir desarrollando las estrategias y habilidades
necesarias para enfrentar situaciones que le surjan al usuario.
El seguimiento, en su primera etapa, consta de dos internamientos parciales, el
primero entre los 10 días y el segundo entre los 20 días posteriores al egreso;
dichos internamientos se llevarán a cabo a las 11:00 horas previo acuerdo con el
usuario y la familia, permaneciendo en la clínica alrededor de 48 horas, egresando

INSTITUCIÓN PRIVADA ESPECIALIZADA EN EL TRATAMIENTO DE LAS ADICCIONES
a las 11:00 horas del día correspondiente. Cada uno de estos seguimientos tendrá
un costo de $700 por dia e incluyen la estancia, todas las actividades.

Una vez concluidos los internamientos de fin de semana, el usuario debe acudir
cada quince días a la Clínica para recibir terapia psicológica individual y asistir al
grupo de apoyo. Cada uno de estos seguimientos tiene un costo de $500.00
El esquema de seguimiento presentado anteriormente no es rígido, en realidad es
flexible y personalizado, se puede adecuar a las posibilidades y necesidades de
cada usuario y su familia.
Las fechas de seguimiento SIN INTERNAMIENTO se detallan a continuación:</p>
        
    </div>

    <div style="border: 1px solid; padding:2%;">

    <div class="content">
        <div class="section-title">Fechas para seguimiento del usuario:</div>
        <p> ' . $fechas_formateadas . '</p>
    </div>

    </div>



    



    <div style="width: 100%; text-align: center; margin-top: 1%;">
        <table width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="width: 50%; text-align: center; border: none;">
                    <div style="text-align:center;">
                       
                        
                    </div>
                </td>
                <td style="width: 50%; text-align: center; border: none;">
                    <div style="text-align:center;">
                        Morelia, Mich. A ___ de______ de______
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
