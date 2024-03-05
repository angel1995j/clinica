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
    <center><b>SOLICITUD DE INTERNAMIENTO</b></center><br><br><br>

Santiago Undameo, Michoacán a ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'<br>

Por medio de la presente y bajo mi entera responsabilidad, solicito a la dirección de esta institución sea recibido en calidad de “PACIENTE” al C. ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' para participar en la terapia de rehabilitación por presentar adicción actualmente su conducta viene poniendo en peligro su propia vida y está originando serios problemas familiares, sociales y labores.<br><br> <br><br>

<center><b>DATOS DEL PACIENTE</b></center>
Nombre: ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . '<br>
Edad: ' . $paciente['edad'] .'       <br>    Ocupación: ' . $paciente['ocupacion'] .'<br>
Edo. Civil: ' . $paciente['estadoCivil'] .'  <br>          Escolaridad: ' . $paciente['escolaridad'] .' <br>
Domicilio Actual: ' . $paciente['direccion'] .' <br>
Sustancia (s) psicoactiva (s) de consumo frecuente: ' . $paciente['sustanciaPsicoactiva'] .' <br>
Tiempo aproximado de consumirla (s) sustancia (s) psicoactiva (s): ' . $paciente['tiempoSustanciaPsicoactiva'] .' <br>
Enfermedades que ha padecido de 5 años a la fecha: ' . $paciente['enfermedades'] .' <br>
Hospitalizaciones recientes: ' . $paciente['hospitalizacionesRecientes'] .' <br>
Internamientos a algún Centro de Reclusión: ' . $paciente['centroReclusion'] .' <br>
Asistencia a grupos tradicionales de AA: ' . $paciente['asistenciaGrupos'] .' <br><br> <br><br>


<center><b>DATOS PERSONALES DEL SOLICITANTE</b></center><br>
(Familiar responsable)<br>
Nombre: ' . $paciente['nombreFamiliar'] . '
Parentesco: ' . $paciente['parentescoFamiliar'] . '<br>
Teléfono(s): ' . $paciente['telefonoFamiliar'] . '<br>
Identificación: ' . $paciente['identificacionFamiliar'] . '<br>
Domicilio: ' . $paciente['direccionFamiliar'] . '<br>
Mail: ' . $paciente['correoFamiliar'] . '<br><br>

<center><b>CLÁUSULAS</b></center><br>
1. Acepto que este centro utiliza el programa y sistema de Organización Mundial de Adictos Anónimos y la Norma 028 SSA Para la prevención, tratamiento y control de las adicciones; y  que nuestro familiar será iniciado en su tratamiento, por lo que no esperamos curación definitiva.<br>
2. El tiempo de permanencia queda sujeto a la rehabilitación alcanzada o si el familiar o en su caso el representante legal lo solicita en cualquier momento.<br>

3. Si el paciente muestra incapacidad física o mental para participar en la terapia de grupo, regresará con sus familiares para que le proporcione otro tipo de rehabilitación.<br>
4. Me comprometo a revisar la lista de artículos personales que el usuario necesita en su estancia de rehabilitación y los otorgaré en un plazo máximo de 48 horas a partir del momento de su ingreso.<br>
5. Acepto que, en caso de que mi familiar no cuente con servicios médicos y llegará a necesitar y recibir atención médica, los gastos corren por mi cuenta.<br>
6. Cualquier daño causado por el paciente a la Infraestructura de la institución será cargado a mi cuenta.<br>
7. Me responsabilizo y me comprometo a cubrir los gastos económicos que se llegaren a generar si el paciente dañara de gravedad física y/o psicológica a algún otro paciente o personal de la institución, así como a asumir la responsabilidad que se derive del comportamiento y/o acciones de mi familiar dentro de la institución.<br>
8. Estoy de acuerdo en pagar de manera anticipada todos y cada uno de los gastos de mi familiar, medicamentos, visitas a médicos u odontólogos, tienda; artículos personales y de aseo individual.<br>
9.-El familiar responsable manifiesta bajo protesta de decir verdad que se le ha explicado y entiendo perfectamente la programación a la cual el paciente está siendo sometido, la cual está basado en un fundamento emocional.<br>
10.- Al momento del ingreso manifiesta haber depositado la cantidad de $ ' . $pacienteDonacionIngreso['monto'] .' como donación de ingreso y la cantidad de $ ' . $pacienteDonacionAdicional['monto'] .'adicionales correspondientes a su PRIMER SEMANA de programación. La entiendo perfectamente que tanto este dinero como toda aportación mensual NO SERA REEMBOLSABLE. En caso de abandono, expulsión o cualquier otra situación en donde el residente no concluya o empiece su tratamiento.<br>
11.- Acepto plenamente que en caso de abandono y/o expulsión del programa de la Clínica  7 Ángeles Centro de Rehabilitación NO ES RESPONSABLE por ropa y/o artículos personales dejados dentro o fuera de la institución.<br>
12.- Así también tiene pleno conocimiento que en la Clínica 7 Ángeles Centro de Rehabilitación queda prohibida toda discriminación motivada por origen étnico o nacional, género, edad, discapacidades, condición social, condiciones de salud, religión, opiniones, preferencia sexual, estado civil o cualquier otra que atente  contra la dignidad humana y tenga por objeto anular o menoscabar los derechos y libertades de las personas.<br>
13. Acepto se me otorgue un crédito por el monto de $3,000.00 (tres mil pesos 00/100 M.N.) para los gastos mencionados en el punto que antecede (punto 8.)<br>
14. Se me hace saber que la enfermedad de la adicción en algunos casos contrae complicaciones físicas de gravedad que pueden presentarse repentinamente y causar enfermedad de gravedad o incluso la muerte, por lo que manifiesto que si esto sucediera LIBERO DE TODO TIPO DE RESPONSABILIDAD a los servidores, personal y/o directivos, igualmente acepto esta cláusula en caso de algún accidente donde mi familiar pudiera resultar con algún daño físico.<br>
15. Por actos de indisciplina, el paciente puede ser corregido e incluso podrá ser entregado a sus familiares, en casos de indisciplina grave o actos de violencia física, verbal o emocional.<br>
16. Después de que hayan transcurrido 30 días de internamiento del paciente acepto asistir los domingos de las 11:00 am las 2:00 pm, a una junta de información para las familias.<br><br>

HABIENDO EL PERSONAL DE LA CLÍNICA EXPLICADO CLARAMENTE EL ALCANCE Y CONTENIDO DE LA PRESENTE SOLICITUD Y UNA VEZ QUE COMO FAMILIAR RESPONSABLE HE ENTENDIDO TODAS Y CADA UNA DE ELLAS, ASI COMO EL ALCANCE LEGAL QUE TIENEN, COMO FAMILIAR O REPRESENTANTE LEGAL EN PLENO USO DE MIS FACULTADES MENTALES Y DEBIDO A QUE EN EL PRESENTE INSTRUMENTO NO EXISTE DOLO, ERROR, LESIÓN, MALA FE Y NINGÚN VICIO DEL CONSENTIMIENTO, LO  ACEPTO EN TODAS Y CADA UNA DE SUS PARTES Y LO RATIFICO FIRMANDO AL MARGEN Y AL CALCE PARA SU DEBIDA CONSTANCIA.
</div>

<div style="width:100%; text-align:center; margin-top:0%;">
 <img src="https://tecolotito-digital.com.mx/clinica/assets/images/pdf/firmas-solicitud-internamiento.png">
</div>


</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envia el PDF al navegador
$dompdf->stream('solicitud-de-internamiento.pdf', ['Attachment' => 0]);
?>
