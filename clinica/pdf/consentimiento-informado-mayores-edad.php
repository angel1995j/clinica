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
    <center><b>CONSENTIMIENTO INFORMADO PARA PERSONAS MAYORES DE EDAD</b></center><br><br><br>

El C. <b>' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' </b>; mexicano; con ' . $paciente['edad'] .' años de edad, de género ' . $paciente['sexo'] .'  en calidad de usuario de los servicios de rehabilitación privado prestados  por la Clínica 7 Ángeles; en este acto manifiesto que he sido informado por parte del personal de la Clínica en referencia; misma que se encuentra ubicada en Carretera a Santiago Undameo cuatro, Código Postal 58343 en la localidad de Santiago Undameo, Municipio de Morelia,  Michoacán, México; ofreciendo un centro de tratamiento contra los problemas de consumo de alcohol y/o drogas  con el objeto de detener su consumo mediante un ambiente controlado que me permite enfocarse completamente a un proceso de rehabilitación y bajo un modelo de tratamiento mixto, multidisciplinario e integral, cuyo objetivo consiste en tratar áreas específicas del ser humano como la parte física, emocional, espiritual y mental; luego entonces el suscrito acepta alejarse de los estímulos de la vida diaria durante un periodo de ______ días.<br><br>


Manifiesto y acepto que de manera voluntaria participaré activamente durante todas las etapas y actividades del proceso de mi tratamiento; lo que implica proporcionar información veraz, oportuna y fidedigna al momento de las evaluaciones; así también me obligo a realizar todas las actividades asignadas por el consejero, médico, psicólogo o trabajador social; adicionalmente cumpliré y apegaré mi conducta con todas y cada una de las disposiciones previstas en el Reglamento Interno. <br><br>
Manifiesto y acepto que de manera voluntaria participaré a todas las sesiones de seguimiento una vez terminado el tratamiento del suscrito; lo anterior con el objeto de lograr mi recuperación y mantener la abstinencia a las adicciones motivo del presente tratamiento; así también asumo y consiento que en caso necesario; y de no obtener los resultados esperados, se comunique al suscrito información por escrito con respecto de un tratamiento alternativo para el  tratamiento de mi adicción.<br><br>
Por otra parte me obligo a pagar por concepto de cuota trimestral la cantidad de ______________________________________00/100  M.N.; para cubrir todos los servicios de hospedaje, alimentación y tratamiento apropiado durante mi estancia en la clínica. En caso de cancelar mi estancia antes de haber cumplido con el periodo de tratamiento, luego entonces estoy de acuerdo en liquidar el pago de acuerdo a la tarifa por día natural, ello de acuerdo a lo preceptuado en la cláusula primera del contrato de prestación de servicios.<br><br>


Ratifico que en este acto he sido informado plenamente con respecto a todas las acciones, procedimientos, riesgos, costos, expectativas de beneficios y características del tratamiento; en consecuencia, manifiesto mi total conformidad para cumplir con los requerimientos necesarios para su correcta aplicación.<br><br>
Por parte de la Clínica
La clínica manifiesta por conducto de su representante legal que brindará un servicio de atención con calidad y oportunidad que facilite la recuperación y la reinserción del usuario a una vida productiva, garantizando en todo momento el respeto a su integridad,  bienestar físico y emocional, dignidad, y tutela efectiva a sus derechos humanos, en estricto apego a la normatividad aplicable a nivel municipal, estatal, federal  y a los tratados internacionales. <br><br>
Ahora bien, en caso de que el usuario desee suspender o cancelar el tratamiento antes del periodo de conclusión, la Clínica se compromete a no mantenerlo de forma involuntaria; así como proporcionarle la orientación e información necesaria  para continuar con su proceso de rehabilitación en otra institución o instancia.<br><br>
En este acto se manifiesta que toda la información proporcionada por el usuario, por sus familiares y/o tutor es de carácter confidencial; siendo que solo tendrá acceso a ésta el personal multidisciplinario involucrado en el tratamiento y/o proceso terapéutico; en consecuencia no se transmitirá, revelará y/o proporcionará ningún tipo de información personal, privada y/o intima a terceros; salvo consentimiento expreso y por escrito  del usuario. Es de considerar las excepciones los casos previstos  por la  legislación y normatividad aplicable o por mandamiento de la autoridad facultada para ello. Adicionalmente durante todo el periodo que dure el tratamiento no se fijarán en ningún soporte material o  se realizarán grabaciones de audio, video o fotogramas; sin que el  personal del  establecimiento explique de manera puntual  y detallada la finalidad de dichas acciones, sin que medie previo consentimiento por escrito por parte del usuario.<br><br>
En caso de que el usuario presente una condición médica previa al ingreso, el establecimiento generará continuidad al tratamiento médico o farmacológico suministrando los medicamentos en las dosis y horarios  indicados, siempre y cuando éstos sean proporcionados  por el personal de control interno previamente autorizado y firmado por el médico de la Clínica; siendo que quedará respaldado con la nota médica; existan los estudios y recetas avaladas por un médico certificado y que no se contraindique con el tratamiento recibido durante su estancia en la Clínica. En caso de que el usuario requiera estudios complementarios, auxiliares de diagnóstico, o un servicio médico especializado se informará de manera inmediata  al respecto y se notificará a sus familiares o tutor. En el supuesto de que el usuario requiera atención médica inmediata y urgente, se informará de inmediato a sus familiares o tutor, siendo que el usuario será trasladado a un hospital del segundo nivel de atención ya sea público o privado.<br><br>
La Clínica y todo su personal quedarán liberados y eximidos de toda responsabilidad civil, penal y/o administrativa contrarios a cualquier disposición normativa a nivel municipal, estatal o federal por acciones u omisiones cometidas por el usuario de manera directa o indirecta, previo, durante y posterior al tratamiento. Así también la Clínica queda liberada de cualquier lesión temporal, permanente ya sean parciales o total, así como cualquier daño y/o perjuicio presente o futuro que 




se derive por acciones u omisiones cometidas por el usuario contra La Clínica y todo su personal, con respecto de otros usuarios y/o proveedores de la Clínica. En el caso de que el usuario, sus familiares o tutor presentan alguna duda con respecto al proceso de rehabilitación o cualquier otro asunto relacionado con el mismo, la Clínica se compromete a realizar cualquier aclaración o proporcionar información adicional relativa al estado de salud del usuario y la evolución de su respectivo tratamiento, con una periodicidad semanal por parte del psicólogo tratante.<br><br>
Finalmente la Clínica se obliga a proporcionar y explicar de manera detallada los derechos y obligaciones que se desprenden del reglamento  interno de la Clínica, siendo que será debidamente informado al usuario, familiar, tutor o representante.
Se hace constar la lectura total y aceptación plena del contenido del presente documento a siendo ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'en las instalaciones de la Clínica la cual se encuentra ubicada en la carretera Santiago Undameo número cuatro, en la Tenencia de Santiago Undameo, perteneciente al Municipio de Morelia, Michoacán; firman al margen y al calce


<table width="100%" style="border:4px solid black;">
    <tr>
        <td width="50%" style="text-align:center;border-right:4px solid black;"><br>
        <b>   NOMBRE Y FIRMA DEL USUARIO <br><br><br>
         _____________________________<br><br><br>
        </td>
        
        <td width="50%" style="text-align:center;"><br>
        <b>   NOMBRE Y FIRMA DEL FAMILIAR <br><br><br>
         _____________________________<br><br><br>
        </td>

    </tr>
</table><br><br>
<table width="100%" style="border:4px solid black;">
    <tr>
        <td width="50%" style="text-align:center;border-right:4px solid black;"><br>
        <b>       NOMBRE Y FIRMA DE TESTIGO <br><br><br>
         _____________________________<br><br><br>
        </td>
        
        <td width="50%" style="text-align:center;"><br>
        <b>   NOMBRE Y FIRMA DE TESTIGO <br><br><br>
         _____________________________<br><br><br>
        </td>

    </tr>
</table><br><br>


<table width="100%" style="border:4px solid black;">
    <tr>
        <td width="50%" style="text-align:center;border-right:4px solid black;"><br>
        <b>       FUNDACIÓN TENVAR S.C.<br>DIRECTOR <br><br><br>
         _____________________________<br><br><br>
        </td>
        
        <td width="50%" style="text-align:center;"><br>
        <br><br><br><br><br><br>
        </td>

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
