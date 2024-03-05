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
    <center><b>CONSENTIMIENTO INFORMADO PARA MENORES DE EDAD</b></center><br><br><br>
    Por parte del usuario:<br><br>


Por medio de la presente, yo: <b>' . $paciente['nombreFamiliar'] .' </b>;  declaro haber sido informado que el establecimiento, ubicado en: CARRETERA SANTIAGO UNDAMEO NUMERO 4, ofrece un tratamiento residencial, por un tiempo de: _______ DÍAS con la finalidad de brindar atención para el consumo de alcohol y/o drogas al menor ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' de sexo: ' . $paciente['sexo'] .' con ' . $paciente['edad'] .' años de edad. En mi carácter de tutor y/o responsable legal es mi deseo que reciba el tratamiento brindado por esta clínica, el cual se basa en un modelo mixto, multidisciplinario e integral, cuyo objetivo consiste en tratar áreas específicas que son la parte física, emocional, espiritual y mental.
.<br><br>


Estoy de acuerdo en participar y apoyar a que el menor participe activamente durante todo el proceso del tratamiento, lo que implica proporcionar información veraz y fidedigna al momento de la evaluación, realizar las actividades asignadas por el consejero, médico y/o psicólogo, hacer del conocimiento del menor los puntos que establece el reglamento interno respecto a su comportamiento y la asistencia a las sesiones de seguimiento una vez terminado el tratamiento, todo ello en beneficio de lograr la abstinencia y facilitar la recuperación del menor. Acepto de que en caso necesario y al no obtener los resultados esperados, se me proporcione información por escrito respecto a otro tipo de alternativas de atención.<br><br>

Tengo conocimiento de que la relación del menor con el personal del establecimiento será únicamente profesional.
Por otra parte, me comprometo a cumplir con una cuota trimestral de: _________________ 00/100 M.N. En beneficio de que el menor tenga acceso a servicios dignos y apropiados durante mi estancia. <br><br>

En el caso de cancelar mi permanencia antes de haber cumplido con el período de tratamiento, estoy de acuerdo en: realizar el pago por día como se establece en la cláusula primera del contrato de prestación de servicios.<br><br>

Ratifico que he sido informado respecto a las características del tratamiento, los procedimientos, los riesgos que implica, los costos, así como los beneficios esperados, y estoy de acuerdo en los requerimientos necesarios para su aplicación.<br><br>




<br><br>

Por parte del establecimiento:<br><br>

El establecimiento se compromete a brindar un servicio de atención de calidad que facilite la recuperación y la reinserción del usuario a una vida productiva, garantizando en todo momento el respeto a su integridad y haciendo valer sus derechos. Por ello, en el caso de que el usuario desee suspender el tratamiento antes de que éste finalice, el centro se compromete a no mantenerlo de forma involuntaria y a brindarle la información y la orientación necesaria para continuar con el proceso de rehabilitación en otra instancia.<br><br>

Se pone de manifiesto que toda información brindada por el usuario es de carácter confidencial y sólo tendrán acceso a ésta el equipo multidisciplinario involucrado en el proceso terapéutico, por lo que no se revelará a ningún otro individuo, si no es bajo el consentimiento escrito del usuario, exceptuando los casos previstos por la ley y autoridades sanitarias. Así mismo, durante el tratamiento no se realizarán grabaciones de audio, video o fotografías, sin que el personal del establecimiento explique su finalidad y sin previo consentimiento escrito por parte del usuario.<br><br>

En el caso de que el usuario presente una condición médica previa al ingreso, el establecimiento dará continuidad al tratamiento médico o farmacológico, suministrando los medicamentos en las dosis y horarios indicados, siempre y cuando éstos sean proporcionados por el personal de control interno previamente autorizado y firmado por el médico de esta institución, quedando como respaldo la nota médica, existan los estudios y recetas avaladas por un médico certificado y no se contraindique con el tratamiento recibido durante la estancia. En caso de que el usuario requiera estudios complementarios o el servicio de un médico especializado, se le informará al respecto y se dará aviso a los familiares. En el caso de que el usuario requiera atención médica urgente, se dará aviso inmediato a los familiares y se trasladará a algún hospital del segundo nivel de atención.<br><br>

Por otro lado, el establecimiento se exime de toda responsabilidad por los actos en contra de la ley en que el usuario se haya visto involucrado, previo y posterior al tratamiento.<br><br>

En el caso de que el usuario o sus familiares presenten alguna duda respecto al proceso de rehabilitación o a cualquier otro asunto relacionado con el mismo, el establecimiento se compromete a aclararla y a proporcionar información relativa al estado de salud del usuario y evolución del tratamiento, con una periodicidad semanal por parte de su psicólogo tratante.<br><br>


Finalmente, el establecimiento se compromete a proporcionar y a dar lectura del reglamento interno del establecimiento al usuario, familiar y/o responsable legal.<br><br>
Se hace constar la lectura total y aceptación plena del contenido del presente documento a siendo ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'en las instalaciones de la Clínica la cual se encuentra ubicada en la carretera Santiago Undameo número cuatro, en la Tenencia de Santiago Undameo, perteneciente al Municipio de Morelia, Michoacán; y habiendo sido informado y aceptando los compromisos anteriormente expuestos y, firman el presente consentimiento:<br><br><br><br>


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
