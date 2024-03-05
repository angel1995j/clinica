<?php
require_once('../dompdf/autoload.inc.php');

use Dompdf\Dompdf;
use Dompdf\Options;



// Inicializa Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
// Habilita la carga de imágenes desde URLs remotas
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options);

// Recupera el ID del paciente desde GET
$id_paciente = isset($_GET['id_paciente']) ? intval($_GET['id_paciente']) : 0;


if (!$id_paciente) {
    die('ID del paciente no proporcionado');
}

// Conecta a la base de datos y obtén los datos del paciente
require('../global.php');
$link = bases();
$sql = "SELECT * FROM pacientes WHERE id_paciente = $id_paciente";
$donacionIngreso = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente AND observaciones = 'donación de ingreso'";
$donacionAdicional = "SELECT * FROM pago_paciente WHERE id_paciente = $id_paciente AND observaciones = 'donaciones adicionales'";

$resultadoDonacionIngreso = $link->query($donacionIngreso);
$resultadoDonacionAdicional = $link->query($donacionAdicional);
$resultado = $link->query($sql);

$paciente = $resultado->fetch_assoc();
$pacienteDonacionIngreso = $resultadoDonacionIngreso->fetch_assoc();
$pacienteDonacionAdicional = $resultadoDonacionAdicional->fetch_assoc();

$espacio = " ";

$anioActual = date("Y");

// Obtiene el mes actual (sin ceros a la izquierda)
$meses = array(
    1 => "enero",
    2 => "febrero",
    3 => "marzo",
    4 => "abril",
    5 => "mayo",
    6 => "junio",
    7 => "julio",
    8 => "agosto",
    9 => "septiembre",
    10 => "octubre",
    11 => "noviembre",
    12 => "diciembre"
);

// Obtiene el número del mes actual (1 al 12)
$numeroMes = date("n");

// Obtiene el nombre completo del mes actual en español
$nombreMes = $meses[$numeroMes];


// Obtiene el día del mes actual
$diaActual = date("j");






// HTML para el contenido del PDF (credencial)
$html = '<html> 
<head>
        
</head>
<body>
<div style="width:100%; text-align:center; margin-top:-6%;">
 <img src="https://tecolotito-digital.com.mx/clinica/assets/images/pdf/header.png">
</div>

<div style="text-align: justify; font-family: Arial, sans-serif;">
    <center><b>REGLAMENTO DE VISITA FAMILIAR</b></center><br><br><br>

<b>PRIMERO.- </b>El máximo de personas para la visita del paciente será de un máximo de cuatro personas (privilegiando el acceso a familiares directos en primero y segundo grado en línea recta y ascendente).<br><br>

<b>SEGUNDO.-</b> En estricto cumplimiento  a la normatividad aplicable y atendiendo a las medidas  de seguridad queda estrictamente prohibido el ingreso de personas menores de once años  de edad a las instalaciones de la Clínica.<br><br>

<b>TERCERO.- </b>Todos los artículos o pertenencias que sean destinados para el paciente deberán encontrarse en bolsas  transparentes (No deberán encontrarse dentro de maletas, mochilas o bolsas negras), siendo que estarán sujetas a revisión del personal de la Clínica.<br><br>

<b>CUARTO.-</b> Se restringe el acceso a FAMILIARES que acudan bajo los influjos de alguna sustancia ilegal y/o bajo el influjo del alcohol o no acaten el presente reglamento.<br><br>

<b>QUINTO.-</b> Se prohíbe estrictamente la introducción de “comida chatarra”, únicamente está permitido el ingreso de comida casera. Se realizará una revisión de alimentos a fin de evitar la introducción de sustancias u objetos no permitidos, aquellos que no sean autorizados se quedarán en control con el personal a cargo y a su salida le serán devueltos.<br><br>

<b>SEXTO:</b> El acceso a la instalaciones únicamente será en el horario establecido por la Clínica, siendo éste de las 11:00 a 11:50 A.M., evite la pena de negarle el ingreso en caso de intentar ingresar en horarios distintos.<br><br>

<b>SÉPTIMO:</b> Se prohíbe el acceso de sustancias adictivas legales o ilegales.<br><br>

<b>OCTAVO:</b> Durante su visita deberán permanecer solo en las áreas destinadas para el desarrollo de la misma, las cuales serán señaladas previamente por el personal a cargo. (Comedor, área jardín externo a comedor y cancha).<br><br>

<b>NOVENO:</b> Deberá respetar las reglas de convivencia establecidas en el reglamento (no palabras altisonantes, gritos, etc.) y abstenerse de comportamientos exhibicionistas (besos, tocamientos, etc. en el caso de parejas).<br><br>

<b>DÉCIMO:</b> Evitar dar información o noticias negativas que preocupen a su familiar o lo distraigan de su internamiento generando en él o ella, deseos de abandono<br><br>

<b>DÉCIMO PRIMERO:</b> La visita familiar puede ser suspendida por el personal a cargo, en caso de incumplimiento de estas indicaciones.<br><br>

<b>DÉCIMO SEGUNDO:</b> Acudir con una credencial con fotografía vigente que lo acredite como el familiar autorizado para la visita familiar. <br><br>

<b>DÉCIMO TERCERO:</b> En caso de requerir un baño deberá solicitar la información al personal de la Clínica, el cual le informará cual está disponible para el uso de los familiares que acuden a visita familiar.<br><br>

Así también se hacen las siguientes recomendaciones:<br><br>
a) No compartir o comentar noticias o información que alteren la estabilidad del usuario.<br>
b) Evitar hablar con el usuario sobre la duración del tratamiento.<br>
c) No introducir cigarros y encendedores de cualquier tipo.<br>
d)No tomar ningún tipo de  fotografías ni videos.<br><br>
Esperamos su total comprensión y apoyo para el cabal cumplimiento del presente reglamento, agradeciendo de antemano su disposición y estricto apego a las disposiciones.

<center><b>
<br><br>
ATENTAMENTE<br><br>

CLÍNICA 7 ÁNGELES<br>
FUNDACIÓN TENVAR S.C.
</b>
</center>


</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envia el PDF al navegador
$dompdf->stream('solicitud-de-internamiento.pdf', ['Attachment' => 0]);
?>
