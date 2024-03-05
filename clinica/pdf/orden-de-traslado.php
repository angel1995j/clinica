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

$traslado = "SELECT * FROM traslado_paciente WHERE id_paciente = $id_paciente";

$resultadoDonacionIngreso = $link->query($donacionIngreso);
$resultadoDonacionAdicional = $link->query($donacionAdicional);
$resultado = $link->query($sql);
$resultado_traslado = $link->query($traslado);

$paciente = $resultado->fetch_assoc();
$pacienteDonacionIngreso = $resultadoDonacionIngreso->fetch_assoc();
$pacienteDonacionAdicional = $resultadoDonacionAdicional->fetch_assoc();
$pacienteTraslado = $resultado_traslado->fetch_assoc();

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

<div style="text-align: justify; font-family: Arial, sans-serif;"><br><br>
    <center><b>ORDEN DE TRASLADO</b></center><br>


<table width="100%">
    <tr>
        <td width="50%" style="text-align:right;">Santiago Undameo, Morelia; Michoacán a: ' . $paciente['fechaIngreso'] .' </td>
    </tr>
</table><br><br>


<b>Encargado de traslados<br>
P R E S E N T E.
</b><br><br>

Por medio del presente se le instruye para que con todas las medidas de seguridad necesarias y pertinentes al caso en concreto y con el apoyo de los C.' . $pacienteTraslado['nombreEncargado'] . $espacio . $pacienteTraslado['personasApoyo'] . '  <br> <br>
se lleve a cabo el traslado del C.' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' a quien en lo sucesivo se le denominará como “EL PACIENTE”, del municipio de ' . $paciente['municipioPaciente'] .', a esta clínica de rehabilitación que se encuentra ubicada en la localidad de Santiago Undameo, perteneciente al municipio de Morelia, Estado de Michoacán de Ocampo, el cual se deberá realizar a bordo de la unidad móvil de traslado de  marca: ' . $paciente['marcaVehiculo'] .', tipo: ' . $paciente['tipoVehiculo'] .', Modelo: ' . $paciente['modeloVehiculo'] .' y placas de circulación número: ' . $paciente['placasVehiculo'] .', con la finalidad de que “EL PACIENTE” sea internado en esta clínica toda vez que presenta adicción a las siguientes sustancias: ' . $paciente['sustanciaPsicoactiva'] .' .<br><br>
    Es importante mencionar, que el presente traslado se realiza a petición y bajo la autorización del C.' . $paciente['nombreFamiliar'] .', quien en este acto se identifica con ' . $paciente['identificacionFamiliar'] .';  bajo protesta de decir verdad, manifiesta en este momento tener el parentesco de ' . $paciente['parentescoFamiliar'] .' con “EL PACIENTE”; así como el deseo de que su familiar sea internado en esta clínica y asume totalmente las responsabilidades que pudieran derivar de este acto con independencia de su naturaleza. Es obligatorio para todos los ocupantes de la unidad terrestre unidad el uso de los cinturones de seguridad.
La dirección a donde se hará el traslado es: ' . $pacienteTraslado['direccionTraslado'] .'  de la ciudad ' . $pacienteTraslado['municipioPaciente'] .', así mismo el costo del traslado será de $' . $pacienteTraslado['costoTraslado'] .' pesos (' . $pacienteTraslado['costoTrasladoTexto'] .' 00/100 M.N.) <br><br>
Se hace de manifiesto que el conductor se encuentra debidamente identificado y cuenta con licencia para conducir del presente vehículo; y  está previamente adiestrado y bajo capacitación específica, en el traslado de pacientes con adicciones.
Agradeciendo a las autoridades Civiles y Militares las atenciones que se sirvan al portador de la presente.<br><br><br>


<table width="100%">
    <tr>
        
        <td width="50%" style="text-align:center;"><br><b><br>LA CLÍNICA<br><br><br>_______________________<br>FUNDACIÓN TENVAR S.C.<br>
DANTE TENTORY VARGAS<br>
DIRECTOR DE CLÍNICA 7 ÁNGELES</b></td>

<td width="50%" style="text-align:center;"><b>FAMILIAR/ ACOMPAÑANTE <br>RESPONSABLE<br><br>_______________________<br>NOMBRE Y FIRMA</b></td>

    </tr>
</table><br><br>


</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envia el PDF al navegador
$dompdf->stream('solicitud-de-internamiento.pdf', ['Attachment' => 0]);
?>
