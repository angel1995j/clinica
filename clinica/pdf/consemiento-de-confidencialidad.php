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
    <center><b>CONSENTIMIENTO DE CONFIDENCIALIDAD</b></center><br><br><br>

Santiago Undameo, Michoacán a ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'<br><br><br>

Por este conducto se extiende el compromiso y obligación de confidencialidad con respecto del las acciones y modalidades de tratamiento de la información y documentación que la Clínica recopile sobre usted como fotos de su imagen personal, su voz, imágenes asociadas con sensación de movimiento con o sin sonido incorporado, videogramas, fonogramas, así como la fijación en cualquier soporte material de sus datos e información personales y/o sensible; siendo que podrá ejercer sus derechos de Acceso, rectificación, oposición o cancelación  de su información personal; así como los procedimientos a seguir en caso de que usted tenga alguna duda o queja para comunicarse a esta Clínica.<br><br>
Así también se hace manifiesta la obligatoriedad que por disposición expresa de la normatividad aplicable protegeremos la confidencialidad de la información que la Clínica custodia, respetando y tutelando plenamente sus derechos humanos y derechos de la personalidad, siendo que éstos son entendidos  como los bienes constituidos por determinadas proyecciones, físicas o psíquicas del ser humano, relativas a su integridad física y mental, que las atribuye para sí o para algunos sujetos de derecho, y que son individualizadas por el ordenamiento jurídico. Adicionalmente se ratifica el compromiso de proteger su derecho a la vida privada e intima el cual materializa al momento que se protege del conocimiento ajeno a la familia, domicilio, papeles o posesiones y todas aquellas conductas que se llevan a efecto en lugares no abiertos al público, cuando no son de interés público o no se han difundido por el titular del derecho y no están destinados al conocimiento de terceros o a su divulgación.<br><br>
En caso de cualquier caso de modificación o cambio significativo que se realice al  presente documento se le comunicará por escrito.<br><br>
En razón de lo antes expuesto el suscrito C.<b> ' . $paciente['nombreFamiliar'] . '</b> manifiesto que he recibido y aceptado el presente consentimiento de confidencialidad, mismo que firmo de manera libre y voluntaria en las instalaciones de la Clínica ubicada en la carretera Santiago Undameo número cuatro, en la Tenencia de Santiago Undameo de la Autopista Morelia-Pátzcuaro, perteneciente al Municipio de Morelia, Michoacán.


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
