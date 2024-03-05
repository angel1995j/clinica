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
    <center><b>REGLAMENTO INTERNO DEL PACIENTE</b></center><br><br><br>
    PRIMERO.- DERECHOS DE LOS USUARIOS Y DE LAS USUARIAS DE COMUNIDAD.<br><br>


I.I -Que se les llame por su nombre .<br><br>
I.II Recibir un trato digno y humanitario.<br><br>
I.III No discriminación en razón de sexo, orientación sexual, religión, raza o situación económica. <br><br>
I.IV. Recibir asistencia en el desarrollo de sus actividades durante su internamiento por parte del personal de la Clínica <br><br>
I.V Contar con actividades artísticas y recreativas. <br><br>
I.VI. Recibir tres alimentos al día, una colación matutina, o dos en caso de dieta especial.<br><br>
I.VII Recibir visitas familiares después de la tercera semana de internamiento y ligado a evolución. <br><br>
I. VIII Solicitar audiencia y orientación del equipo profesional de la Clínica. <br><br>
I.IX. Contar con un expediente clínico actualizado. <br><br>
I.X. Solicitar la revisión de sus tratamientos. <br><br>
I.XI. Ser tratado sin violencia física o moral que atente contra su dignidad.<br><br><br><br>

<b>SEGUNDO: OBLIGACIONES DE LOS USUARIOS Y DE LAS USUARIAS DE COMUNIDAD TERAPEUTICA</b><br><br>
II.I El paciente deberá desempeñar un comportamiento adecuado durante su estancia en la Clínica, el cual está basado en una convivencia respetuosa, de armonía, con una constante comunicación y confianza necesarios para un ambiente de bienestar.<br><br>
II.II El paciente deberá cumplir con el horario de actividades, mismo que comprende de las 7:00 a.m. y concluye a las 22:00 horas (Siendo que su horario para levantarse será a las 7:00 a.m. y la hora de dormir será a las 22:00 horas).<br><br>


II.III El Paciente deberá de presentar ropa, cabello, uñas y dientes debidamente aseados. <br><br>
II.IV Deberá mantener su habitación debidamente ordenada y limpia, siendo que tendrá que mantener su cama tendida, su ropa, calzado, objetos personales y de aseo debidamente ordenados. No se admite el ingreso de todo tipo de alimentos a las habitaciones, siendo que está estrictamente prohibido fumar en las habitaciones.<br><br>
II.V. Se obliga a participar en todo tipo de actividades de faena en los horarios y áreas que le sean asignadas por el personal de la Clínica.<br><br>
II.VI Se obliga a participar en todo tipo de actividades que le sean requeridas para su proceso de rehabilitación, como actividades artísticas, deportivas, culturales, de esparcimiento y convivencia.<br><br>
II.VII Queda estrictamente prohibido el contacto físico entre los pacientes; así también quedan prohibidas todo tipo de relación sentimental dentro de las instalaciones de la Clínica.<br><br>
II.VIII Queda estrictamente prohibido proporcionar dirección y/o teléfono a otros pacientes y/o terceros no autorizados por la Clínica.<br><br>
II.IX En caso de presentar algún malestar en su salud el paciente deberá de comunicarlo de inmediato al personal de control interno de la Clínica para su pronta atención.<br><br>
II.X Deberá apegarse a consumir sus medicamentos autorizados por la Clínica, en el horario en que le sea indicado por parte del  personal debidamente autorizado.<br><br>
II.XI Se obliga a tener un trato digno, respetuoso y tolerante con los otros pacientes con los prestadores de servicios interno y/o externos, con sus familiares o familiares de terceros; así como un lenguaje apropiado en la comunicación con terceros.<br><br>
II.XII En el horario que corresponda al servicio de suministro y consumo de alimentos  deberá cumplir con  el reglamento del  comedor.<br><br>
II.XIII Queda prohibido el ingreso de dispositivos electrónicos y de almacenamiento como memorias USB, teléfonos celulares, reproductores de MP3, MP4 así como sus variantes o formatos análogos, grabadoras de audio y video, televisores, pantallas, computadoras, I-Pods, tabletas; así como cualquier dispositivo similar.<br><br>


II:XIV Mostrar buena conducta y acatar las normas disciplinarias, evitando el maltrato interno entre los demás usuarios y personal de la Clínica.<br><br>
II.XV Acatar y cumplir las correcciones disciplinarias que se impongan por parte del personal de la Clínica.<br><br>
II.XVI Deberá evitar el uso de palabras y/o señas ofensivas, degradantes, obscenas, discriminatorias o lascivas entre los demás usuarios, pacientes, familiares, empleados de la Clínica o con terceros.<br><br>
II.XVII Deberá de evitar todo tipo de maltrato físico, verbal, emocional entre los demás usuarios, pacientes, familiares, empleados de la Clínica o con terceros.<br><br>
II.XVIII Al cumplir el primer mes de estancia en la Clínica se permitirá su primera visita familiar previa valoración de su psicólogo tratante ( siendo los horarios de visita aquellos que están comprendidos de las 11:00 AM a las 14:00 Hrs), los días  establecidos para la visita familiar corresponden a un domingo cada quince días.<br><br>
II.XIX Queda estrictamente prohibido el intercambio de pertenencias entre los pacientes.<br><br>
II.XX Cuidar y hacer uso responsable de las pertenencias propias de los demás, así como, de las instalaciones, materiales y equipos propiedad de la Clínica.<br><br>
II.XXI Queda totalmente prohibida la introducción, consumo, posesión y comercio de bebidas alcohólicas, estupefacientes, psicotrópicos, sustancias tóxicas y en general instrumentos cuyo uso pueda afectar la salud del usuario o de la usuaria y la seguridad en el área.<br><br> En caso de que se incurra en estas faltas se expulsará a él o las personas involucradas, previo levantamiento del ACTA LEGAL correspondiente.<br><br>
II.XXII Queda prohibido a los usuarios, usuarias y al personal del Instituto realizar entre ellos cualquier transacción comercial (compra-venta), intercambios y regalos de cualquier índole.<br><br>
II.XXIII En el proceso terapéutico es de suma importancia favorecer el reconocimiento y ejecución de conductas positivas y a su vez también favorecer el reconocimiento y evitación de conductas negativas.<br><br>




 
II. XXIV Los usuarios y las usuarias tienen derecho a la confidencialidad y el anonimato. Se debe evitar proporcionar información a personas no autorizadas por su responsable legal. Los asuntos referidos en terapia relativos a su individualidad, familia, relaciones externas, ocupación, etc., son de uso terapéutico y debe mantenerse en ese contexto. Queda prohibido utilizar la información de los usuarios en pláticas personales, redes sociales, etc.<br><br>
II.XXV El paciente tiene pleno conocimiento y acepta que para facilitar la supervisión de usuarios y de usuarias existen cámaras de vigilancia en diferentes espacios de la comunidad terapéutica, las cuales realizan grabaciones temporales que permanecen bajo resguardo del personal de la Clínica las cámaras son de utilidad también para salvaguardar la integridad del personal, usuarios y usuarias.<br><br>
En caso de cualquier caso de modificación o cambio significativo que se realice al  presente documento se le comunicará por escrito.
En razón de lo antes expuesto el suscrito C.' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' manifiesto que he recibido y aceptado en su totalidad el presente Reglamento Interno, mismo que firmo de manera libre y voluntaria en las instalaciones de la Clínica ubicada en la carretera Santiago Undameo número cuatro, en la Tenencia de Santiago Undameo, perteneciente al Municipio de Morelia, Michoacán.

<center><b>
<br><br>
ACEPTO DE CONFORMIDAD<br><br><br><br>
_____________________<br>

NOMBRE Y FIRMA DEL PACIENTE</b><br>

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
