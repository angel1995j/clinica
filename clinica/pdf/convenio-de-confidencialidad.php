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
    <center><b>CONVENIO DE CONFIDENCIALIDAD</b></center><br><br><br>


CONVENIO DE CONFIDENCIALIDAD QUE CELEBRAN POR UNA PARTE LA PERSONA <b> ' . $paciente['nombreFamiliar'] .'</b> EN REPRESENTACIÓN DE <b> ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' </b> A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ  “EL CLIENTE”; Y POR OTRA PARTE FUNDACIÓN TENVAR S.C. representada por el C.DANTE TENTORY VARGAS EN SU CARÁCTER DE PRESTADOR DE SERVICIOS EN MATERIA DE TRATAMIENTO DE REHABILITACIÓN DE ADICCIONES, A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ  “EL PRESTADOR DEL  SERVICIO”, DENOMINADAS EN CONJUNTO COMO “LAS PARTES”, DE CONFORMIDAD CON LAS SIGUIENTES DECLARACIONES Y CLAUSULAS:
<br><br>

<center><b>DECLARACIONES</b><br><br></center><br><br>

   <b>Declara “EL CLIENTE” bajo protesta de decir verdad lo siguiente:</b><br><br><br>
Que es una persona física  de nacionalidad MEXICANA,  tiene la capacidad suficiente para suscribir el presente convenio y obligarse en los términos del mismo.<br><br>

Siendo su domicilio el ubicado en la calle <b> ' . $paciente['direccionFamiliar'] .', México .</b><br><br>

Que tiene la calidad de familiar/tutor/responsable del paciente <b> ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' </b>mismo que será sujeto a tratamiento de rehabilitación en la Clínica 7 Ángeles carretera Santiago Undameo número cuatro, en la Tenencia de Santiago Undameo de la Autopista Morelia-Patzcuaro, perteneciente al Municipio de Morelia, Michoacán.<br><br>



Declara “EL PRESTADOR DEL  SERVICIO” bajo protesta de decir verdad:
Es una persona física  de nacionalidad MEXICANA,  y tiene la capacidad suficiente para suscribir el presente convenio y obligarse en los términos del mismo.<br><br>

Señala como domicilio carretera Santiago Undameo número cuatro, en la Tenencia de Santiago Undameo de la Autopista Morelia-Pátzcuaro, perteneciente al Municipio de Morelia, Michoacán; México “EL PRESTADOR DEL SERVICIO” se obliga a comunicar a “EL CLIENTE” por escrito cualquier cambio respecto de su domicilio en un término que no podrá exceder de tres días contados a partir del cambio, a falta de esta comunicación “EL CLIENTE” considerará para todos los efectos legales el domicilio señalado en este apartado.<br><br>

Contar con todas las autorizaciones necesarias para celebrar el presente convenio y cumplir con las obligaciones que se derivan del mismo. No se genera relación laboral alguna, así como ningún tipo de obligación en materia de seguridad social, ahorro para el retiro o subcuenta de vivienda.<br><br>

Con la celebración y cumplimiento de  este convenio no viola  convenio, licencia, sentencia u orden relevante de la  cual sea parte o conforme a la cual se encuentre vinculada autorización alguna a la que este sujeto o ley, reglamento, circular o decreto alguno que le sea aplicable.<br><br>

Contar con la suficiente capacidad, experiencia, habilidades y conocimientos para desempeñar con eficiencia y calidad los servicios personales independientes aquí contratados, obligándose a poner en su desempeño la atención, cuidado y esmero apropiados, conduciendo de manera legal y profesional, así como a cumplir con las disposiciones de seguridad, salud y medio ambiente que provengan de las disposiciones normativas aplicables y del reglamento interior de trabajo que estuviere vigente en el lugar donde desempeñe la prestación de los servicios personales. Reconoce que “EL CLIENTE” tiene en exclusiva la facultad de administrar, organizar, dirigir, controlar, sancionar, coordinar y supervisar los servicios contratados, por lo tanto corresponde a él validar el buen funcionamiento y desarrollo de los servicios pactados, obligándose al buen mantenimiento  y conservación de los instrumentos que se le puedan proporcionar, para  el buen desempeño de los servicios contratados.<br><br>






III.    Declaran ambas partes:<br><br>
Que se reconocen mutuamente la personalidad con la que actúan y es su deseo obligarse en los términos del presente convenio.<br><br>

Que en virtud de la posible celebración de un convenio de confidencialidad, las partes puede llegar a tener acceso a información confidencial incluyendo datos personales, razón por la cual, como una forma de salvaguardar la confidencialidad y los datos aquí referidos se celebra este convenio.
<br><br>

En virtud de lo anterior, las partes pactan las siguientes:<br><br><br>
<center><b>C  L  A  U  S  U  L  A  S</b></center><br><br>
PRIMERA.- INFORMACIÓN CONFIDENCIAL. Para efectos del presente Convenio, se entenderá por Información Confidencial, cualquier información no pública escrita, oral, gráfica, visual o tangible, o contenida en medios escritos, electrónicos o electromagnéticos, discos ópticos, microfilmes, películas o cualesquier otros instrumentos similares, proporcionada en cualquier momento hasta la fecha de celebración de uno o más documentos definitivos, que en su caso puedan ser negociados entre las partes con relación a cualquier operación que involucre a “EL CLIENTE” y sus negocios, incluyendo, de forma enunciativa mas no limitativa, notas, listados, datos o información sobre clientes, información técnica, financiera y comercial relativa a nombres de clientes, socios o distribuidores potenciales, información demográfica, propuestas de negocios, reportes, planes, proyecciones de mercado, datos, ideas, conceptos, estudios, resúmenes, equipos, programas, estadística, folletos, procesos, políticas, know-how, fotografías, sistemas, programas de computación, mapas, regulación, normas, logística y cualquier otra información industrial, comercial o de cualquier otra índole, junto con secretos industriales, fórmulas, mecanismos, patrones, métodos, técnicas, procesos de análisis, documentos de trabajo, compilaciones, comparaciones, estudios u otros documentos preparados que las partes se intercambien o que cualquiera de sus subsidiarias, afiliadas, sociedades controladas o controladoras intercambien o proporcionen con relación a dichos documentos o en virtud de cualquier Operación.<br><br>
Las partes convienen en conceder a partir de esta fecha, trato confidencial y de acceso restringido a toda la Información Confidencial a la que pudieran tener acceso con motivo de la prestación de los Servicios, comprometiéndose a mantener en su poder únicamente la Información Confidencial estrictamente necesaria para la prestación de los mismos, así como a conservarla en su poder el tiempo que sea estrictamente necesario.<br><br>
Las partes convienen en que “EL PRESTADOR DEL SERVICIO” conservará la titularidad de los derechos de propiedad intelectual respecto de las metodologías que aplique para la ejecución de sus servicios, toda vez que las mismas se han creado de manera previa y no es factible considerarlos como obra por encargo. <br><br>
SEGUNDA.- OBJETO DEL CONVENIO. El presente convenio tiene por objeto, establecer los lineamientos aplicables al intercambio de Información Confidencial, que realicen las partes en virtud del desarrollo de diversos proyectos y negocios en que participen. 
Salvo en los casos expresamente establecidos en este convenio, ninguna de las partes podrá divulgar, ni revelar a persona alguna en forma total o parcial la Información Confidencial proporcionada directa o indirectamente por una de ellas, sus subsidiarias o sus filiales, sin el consentimiento previo y por escrito de la parte propietaria de la Información Confidencial. Asimismo, la Información Confidencial no podrá ser utilizada por ninguna de las partes para su propio beneficio o el beneficio de terceros. <br><br>
TERCERA.- PROPIEDAD DE LA INFORMACIÓN. Las partes reconocen que la Información Confidencial que manejen entre ellas es propiedad exclusiva de la parte que entregue dicha información, de ser aplicable deberá entregarla junto con un documento en el que se haga constar que es propietaria de la Información Confidencial proporcionada. Bajo ninguna circunstancia se entenderá que la Información Confidencial que se maneje por las partes es propiedad de ambas, o que en virtud de la celebración del presente convenio existe algún tipo de representación entre las partes. Las partes reconocen que la celebración del presente convenio no les confiere a ninguna de ellas respecto de la Información Confidencial de su contraparte, derechos o licencias de propiedad industrial o intelectual, sobre la misma. <br><br>






CUARTA.- DATOS PERSONALES. Las partes se obligan a que todos los datos personales, según se definen en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares (LFPDPPP) y demás Tratados Internacionales, leyes y disposiciones normativas aplicables, que lleguen a remitirse entre ellas, serán tratados con la mayor cautela y de manera confidencial, resguardando en todo tiempo, manteniendo y estableciendo medidas de seguridad administrativas, técnicas y físicas que permitan proteger los datos personales contra daño, pérdida, alteración, destrucción o el uso, acceso o tratamiento no autorizado.<br><br>
“EL CLIENTE” comunica oficialmente a “EL PRESTADOR DEL  SERVICIO”, que para el tratamiento de datos personales maneja un Aviso de Privacidad. “EL PRESTADOR DEL  SERVICIO” se obliga a asumir en los mismos términos dicho Aviso de Privacidad, obligándose de igual forma a dar tratamiento de los datos personales que le sean transferidos por “EL CLIENTE”,  conforme a lo estipulado en dicho  Aviso de Privacidad, así como a cualquier tercero al que le transfiera por cualquier vía algún dato personal con dicho origen.  <br><br> 
En este orden de ideas, “EL PRESTADOR DEL  SERVICIO” tendrá el carácter de responsable de los Datos Personales que remita a “EL CLIENTE”, y por su parte “EL PRESTADOR DEL  SERVICIO”  tendrá el carácter única y exclusivamente de encargado de los mismos, obligándose de manera enunciativa más no limitativa a: 
Tratar únicamente los Datos Personales conforme a las instrucciones del responsable. <br><br>
Adoptar las medidas de seguridad legales, administrativas, físicas y técnicas necesarias que garanticen la protección de los Datos Personales que el Cliente le proporcione en las Bases de Datos que le entregue al amparo del presente contrato, evitando su alteración, pérdida, tratamiento, transferencia y/o acceso no autorizados.<br><br>
Guardar confidencialidad respecto del tratamiento de los Datos Personales. <br><br>
Suprimir los Datos Personales, una vez cumplida la relación jurídica entre las partes
Abstenerse de transferir los Datos Personales salvo en el caso de que el responsable así lo determine, la comunicación derive de una subcontratación, o cuando así lo requiera la autoridad competente. <br><br>
Las partes acuerdan que, en caso de incumplimiento, comprobada y/o dictaminada por la autoridad encargada de regular y velar por la Protección de Datos Personales según lo establece la LFPDPPP y su reglamento (“Instituto Nacional de Transparencia, Acceso a la Información y Protección de Datos Personales”), de conformidad a lo dispuesto en específico por la presente cláusula, la parte que incumpla se obliga a pagar a la parte afectada los daños y perjuicios que le cause.<br><br>
En caso de reclamo relacionado con el tratamiento de datos personales conforme al cumplimiento de este convenio, la Parte que incumpla deberá defender y sacar en paz y a salvo a la otra parte, así como en su caso a indemnizar al 100% (cien por ciento) de cualquier monto que este último tenga que pagar por multas y/o indemnizaciones, derivadas de procesos administrativos, civiles o transacciones que resuelvan el o los reclamos correspondientes. Las obligaciones a cargo de las partes, a que se refiere la presente Cláusula, permanecerán vigentes en forma indefinida posteriormente a la rescisión o terminación natural o anticipada del presente instrumento, por cualquier causa; en ningún caso el incumplimiento de alguna de las partes respecto a cualquiera de las obligaciones emanadas del presente instrumento, liberará a la otra de las obligaciones y términos contenidos en la presente cláusula.<br><br>

QUINTA. ACCESO RESTRINGIDO. Las partes sólo podrán revelar la Información Confidencial a sus empleados, asesores, representantes o cualquier persona dependiente de ellas que la requiera en forma justificada y únicamente para los fines para los cuales se le haya transmitido siempre y cuando dichas personas estén obligadas para con “EL PRESTADOR DEL  SERVICIO” por convenios de confidencialidad o directamente con “EL CLIENTE” a mantener la información de este convenio de manera confidencial y se les informe de la naturaleza confidencial de la Información que se revele y de sus obligaciones en relación con el uso de la misma.<br><br>
SEXTA. REQUERIMIENTOS DE AUTORIDAD. Si fuere requerido a las partes, por disposición de ley a la autoridad judicial o administrativa competente a través de mandato escrito de conformidad con la legislación aplicable, para revelar total o parcialmente la Información confidencial, conviene en informar, previo a dicha revelación, inmediatamente de tal situación a la otra parte, de tal manera que esta última esté en posibilidad de ejercer las medidas o recursos legales que a sus intereses convenga.Asimismo las partes se obligan a dar únicamente la información que le haya sido requerida, haciendo su mejor esfuerzo para que en caso de que la autoridad no haya delimitado la información solicitada, busque que se delimite a efecto de afectar en menor medida, la divulgación de la Información Confidencial.<br><br>




SÉPTIMA. TERMINACIÓN. En caso de que las partes den por terminadas sus relaciones de negocios o contractuales, sin importar la causa de dicha terminación, no las exime de cumplir todas las obligaciones a su cargo establecidas en el presente convenio. <br><br>
OCTAVA. DAÑOS Y PERJUICIOS. Para el caso de que cualquiera de las partes, incluyendo sus respectivos empleados, agentes, asesores, representantes y cualquier persona que la requiera de forma justificada, incumplan alguna de las estipulaciones del presente convenio, pagará a la parte propietaria de la Información Confidencial, todos los daños y perjuicios procedentes que tal incumplimiento le ocasione, sin perjuicio de las demás acciones legales que procedan por violación a los derechos de propiedad intelectual o industrial, incluyendo lo dispuesto por las fracción IV, V y VI del artículo 402  de la Ley Federal de Protección a la Propiedad Industrial y el delito de revelación de secretos contemplado en el artículo 213 y demás relativos del Código Penal para la Ciudad de México. <br><br>
NOVENA. COMPETENCIA DESLEAL. Las partes convienen en no efectuar cualquier tipo de competencia desleal en contra de la otra parte a través de la explotación de la Información <br><br>
DÉCIMA.- LEYES ESPECIALES. La Información Confidencial que sea revelada por las partes, quedará sujeta a lo dispuesto por el artículo 163 de la Ley Federal de Protección a la Propiedad Industrial y por lo tanto ambas partes quedarán sujetas a lo establecido por los artículos 164, 165, 166, 167, 168 y 169 de dicho ordenamiento legal, por lo que la parte receptora, no podrá divulgarlo sin la autorización expresa y por escrito de la parte reveladora, aceptando Las Partes, desde este momento, que la violación o incumplimiento de lo dispuesto en la presente cláusula, podrá actualizar los supuestos contemplados en las fracciones IV, V y VI del artículo 402  de la Ley Federal de Protección a la Propiedad Industrial en relación con el artículo 213 del Código Penal para la Ciudad de México y sus correlativos con el Código Penal Federal.De igual forma, el presente acuerdo se realiza en el contexto de La Ley Federal de Protección de Datos Personales en Posesión de los Particulares<br><br>
DÉCIMA PRIMERA.- AVISOS Y DOMICILIOS. Cualquier aviso o requerimiento bajo el presente deberá ser enviado por escrito y entregado a mano, enviado por correo aéreo con acuse de recibo, por telegrama, telex o telefax confirmados, o mediante servicio de mensajería. <br><br>
DÉCIMA SEGUNDA.- DAÑOS Y PERJUICIOS. Para el caso de que “EL CLIENTE”, incluyendo a sus empleados, agentes, asesores, representantes o cualquier persona incumplan alguna de las estipulaciones del presente Convenio, pagará a “EL PRESTADOR DEL  SERVICIO” una pena convencional hasta por el monto de las sanciones que en su caso pudiera imponer el Instituto Federal de  Acceso a la Información y Protección de Datos, por concepto de daños y perjuicios, sin perjuicio del derecho del Cliente de ejercitar las demás acciones legales que procedan por violación a los derechos de propiedad intelectual o industrial, incluyendo el delito de revelación de secretos y acceso ilícito a sistemas y equipos de informática contemplado en los artículos 210 y 211 y demás relativos del Código Penal para el Distrito Federal, y esto con independencia de las sanciones penales y administrativas establecidas en la Ley Federal de Protección de Datos Personales en Posesión de los Particulares.<br><br>
DÉCIMA TERCERA.- VIGENCIA. El presente contrato entrará en vigor a partir de la fecha de firma por ambas partes, y permanecerá vigente por un periodo de cinco años, aún después de terminada la relación de negocios atendiendo a lo dispuesto por la Cláusula Séptima anterior. <br><br>
DÉCIMA CUARTA.- JURISDICCIÓN. Para la interpretación y cumplimiento del presente Convenio las partes se someten expresamente a las leyes y los tribunales competentes en la Ciudad de Morelia, Michoacán renunciando a cualquier otra competencia que pudiere corresponderles por razón de sus domicilios presentes o futuros o por cualquier otra razón, reconociendo la inexistencia de cualquier vicio de la voluntad y del consentimiento que pudiese invalidar de manera total o parcial.
<br><br>







Leído que fue por las Partes y debidamente enteradas de todas y cada una de las cláusulas y del contenido y alcance legal del presente Convenio, lo suscriben por duplicado en en Santiago Undameo, Morelia, Michoacán a los ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'.<br><br><br>

<table width="100%" style="border:4px solid black;">
    <tr>
        <td width="50%" style="text-align:center;border-right:4px solid black;"><br>
        <b>       EL CLIENTE <br><br><br>
         _____________________________<br><br><br>
        </td>
        
        <td width="50%" style="text-align:center;"><br>
        <b>   EL PRESTADOR DEL  SERVICIO <br><br><br>
         _____________________________<br><br><br>
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
