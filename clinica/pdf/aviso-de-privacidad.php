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
    <center><b>AVISO DE PRIVACIDAD</b></center><br><br><br>
    El presente aviso de privacidad corresponde al website<br><br>https://www.sieteangeles.com.mx/<br><br>


De acuerdo con la Ley General de Protección de Datos Personales en Posesión de Sujetos Obligados, se entiende como “Datos Personales” cualquier información concerniente a una persona física identificada o identificable. Para efectos del presente Aviso de Privacidad, de manera enunciativa más no limitativa, se entenderán como “Datos Personales”.<br><br>
USUARIOS: El acceso y/o uso de este portal de “CEmprende” creadora del sitio web atribuye la condición de “USUARIO”; que acepta desde dicho acceso y/o uso, las Condiciones Generales de Uso aquí reflejadas. Por todo ello el  usuario otorga su consentimiento para los  efectos  legales  a que haya  lugar.<br><br>

USO DEL PORTAL: “CLÍNICA 7 ÁNGELES” proporciona el acceso a multitud de informaciones, servicios, programas o datos (en adelante, "los contenidos") en Internet administrado por CEmprende; mismo que opera el sitio web  o sus licenciantes a los que el “USUARIO” pueda tener acceso. El “USUARIO” asume la responsabilidad del uso del portal. Dicha responsabilidad se extiende al registro que fuese necesario para acceder a determinados servicios o contenidos. En dicho registro el “USUARIO” será responsable de aportar información veraz y lícita. El “USUARIO” se compromete a hacer un uso adecuado de los contenidos y servicios (como por ejemplo servicios de foros) que “CLÍNICA 7 ÁNGELES”” ofrece a través de su portal y con carácter enunciativo pero no limitativo, a no emplearlos para  incurrir en actividades ilícitas, ilegales o contrarias a la buena fe y al orden público;  difundir contenidos o propaganda de carácter racista, xenófobo, pornográfico-ilegal, de apología del terrorismo o atentatorio contra los derechos humanos;  provocar daños en los sistemas físicos y lógicos de “CLÍNICA 7 ÁNGELES””, de sus proveedores o de terceras personas, introducir o difundir en la red virus informáticos o cualesquiera otros sistemas físicos o lógicos que sean susceptibles de provocar los daños anteriormente mencionados;  intentar acceder y, en su caso, utilizar las cuentas de correo electrónico de otros usuarios y modificar o manipular sus mensajes. <br><br>




“CLÍNICA 7 ÁNGELES” se reserva el derecho de retirar todos aquellos comentarios y aportaciones que vulneren el respeto a la dignidad de la persona, que sean discriminatorios, xenófobos, racistas, pornográficos, que atenten contra la juventud o la infancia, el orden o la seguridad pública o que, a su juicio, no resultan adecuados para su publicación. En cualquier caso, “CLÍNICA 7 ÁNGELES” no será responsable de las opiniones vertidas por los usuarios a través de los foros, chats, u otras herramientas de participación.
Con fundamento en lo dispuesto en los artículos 17 y 18 de la Ley General de Protección de Datos Personales en Posesión de Sujetos Obligados se informa  que las facultades del responsable para llevar a cabo el tratamiento de los datos personales aquí recabados.
Los datos personales recabados en el presente website,  serán incluidos en los archivos digitales de “CLÍNICA 7 ÁNGELES”. Su domicilio esta ubicado en   Carretera a Santiago Undameo número 4, Código Postal 58343 Santiago Undameo, Morelia, Michoacán, México.<br><br>
 
La finalidad  de recabar datos  de  carácter personal es únicamente con fines de contacto, estadística y envío de información de los servicios que ofrece la clínica, sin que en ningún momento se recaben datos personales sensibles. Para el  caso  de que se pretenda utilizar los  datos  personales  con  fines distintos  a los  aquí  expuesto “CLÍNICA 7 ÁNGELES” deberá  solicitar nuevamente  el  consentimiento  del  titular  de los  datos  personales.<br><br>

La Transferencia  de los datos personales  nacionales o internacionales podrán llevarse a cabo sin el consentimiento del titular cuando la transferencia sea necesaria o legalmente exigida para la salvaguarda de un interés público, o para la procuración o administración de justicia; cuando la transferencia sea precisa para el reconocimiento, ejercicio o defensa de un derecho en un proceso judicial, y cuando la transferencia sea precisa para el mantenimiento o cumplimiento de una relación jurídica entre el responsable y el titular.<br><br>

Los titulares de los datos personales podrán limitar el uso o divulgación de sus datos personales, en relación con una o varias de las finalidades del Tratamiento de Datos Personales (como correos publicitarios),  enviando  la solicitud respectiva  mediante el siguiente correo electrónico clinica7angeles@gmail.com, <br><br>






o mediante el acceso a los vínculos que se cargan o llegan a cargar en las páginas de internet de ““CLÍNICA 7 ÁNGELES”.” o en la información promocional que en algún momento dado  que se haga llegar.<br><br>

Mecanismos para la  negativa del  consentimiento<br><br>

“CLÍNICA 7 ÁNGELES” podrá negar el acceso total o parcial a los Datos Personales o a la realización de la rectificación, cancelación u oposición al tratamiento de los mismos, en  el caso de que el solicitante no sea el titular o el representante legal no esté debidamente acreditado para ello, o en el supuesto de que en las bases de datos de “CLÍNICA 7 ÁNGELES” no se encuentren los Datos Personales del Titular; o cuando se lesionen los derechos de un tercero o en su caso exista impedimento legal o resolución emitida por una autoridad competente. <br><br>

En su calidad  de titular de sus datos personales otorga su consentimiento  y autorización al responsable  del tratamiento de los datos  para la inclusión de los mismos en los archivos en referencia. En cualquier caso el Titular de los datos personales que están sujetos  a tratamiento podrán ejercitar sus derechos  de  Acceso, Rectificación, Cancelación y Oposición (ARCO) dirigiéndose por escrito a “CLÍNICA 7 ÁNGELES” en el  domicilio que  ya  quedó  señalado o bien y con carácter previo a tal actuación solicitarlas mediante correo electrónico clinica7angeles@gmail.com que el  responsable del tratamiento de los  datos  dispone para tal efecto. El  Titular de los datos personales para efecto  de  que realice  la solicitud  aquí expuesta  ya  sea  por  escrito  o  por  medio  electrónico  deberá presentar  en su  solicitud las siguiente información y documentación: Nombre completo y domicilio del titular de los Datos Personales, u otro medio para comunicarle la respuesta a su solicitud, documentos que acrediten la identidad o la representación legal del titular de los datos Personales, descripción clara y precisa de los Datos Personales respecto de los que se busca ejercer alguno de los derechos antes mencionados; así como cualquier otro elemento o documento que facilite la localización de los Datos Personales. <br><br>

Las cookies son archivos de texto que son descargados automáticamente y almacenados en un disco duro del equipo de cómputo del usuario al navegar en una determinada página de internet, los cuales tienen como  función que el servidor de internet recuerde algunos datos del usuario. Por medio de este Aviso de Privacidad te informamos que “CLÍNICA 7 ÁNGELES” utiliza ciertos cookies para obtener información de preferencias del usuario, como almacenar sesiones e historial de navegación. “CLÍNICA 7 ÁNGELES” puede utilizar dichas cookies con el objetivo de identificar o prevenir operaciones de comercio electrónico que pudieran ser fraudulentas o de procedencia irregular o ilícita. <br><br>
En   caso  de  que  se  genere algún  cambio  en el  procedimiento o medios  por el  cual “CLÍNICA 7 ÁNGELES” realice cambios o actualizaciones en el presente aviso  de  privacidad, el cual  se hará el  conocimiento a través del  presente website o por correo electrónico.<br><br>
En caso de que los  titulares de los  datos personales  consideren  que ha sido  vulnerado sus datos personales podrá  acudir al Instituto Federal de Acceso a la  Información y Protección de Datos Personales con el objeto de solicitar la  tutela  efectiva  de sus derechos en materia de datos personales.<br><br>
La última fecha de actualización del presente  aviso  de  privacidad  fue realizada  el  día 24 veinticuatro de marzo  de 2023 dos mil veintitrés.


</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envia el PDF al navegador
$dompdf->stream('solicitud-de-internamiento.pdf', ['Attachment' => 0]);
?>
