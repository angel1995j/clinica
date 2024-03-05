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

<div style="text-align: justify; font-family: Arial, sans-serif;"><br><br>
    <center><b>CONTRATO DE PRESTACIÓN DE SERVICIOS</b></center><br>

<b>CONTRATO DE PRESTACIÓN DE SERVICIOS</b> QUE SE CELEBRA EN LA LOCALIDAD DENOMINADA “LA REUNIÓN" UBICADA EN LA TENENCIA DE SANTIAGO UNDAMEO PERTENECIENTE AL MUNICIPIO DE MORELIA, MICHOACÁN DE OCAMPO A ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .', COMPARECEN POR UNA PARTE <b>FUNDACIÓN TENVAR S.C.</b> DENOMINADO <b>“CLÍNICA 7 ÁNGELES”</b> REPRESENTADA EN ESTE ACTO POR EL <b>C. DANTE TENTORY VARGAS</b> A QUIEN EN LO SUCESIVO SE LE DENOMINARÁ COMO <b>“EL PRESTADOR DE SERVICIOS” </b> Y POR LA OTRA EL C. <b>  ' . $paciente['nombreFamiliar'] . '</b> A QUIEN EN LO SUCESIVO SE LE DENOMINARA COMO <b>“EL CONTRATANTE”</b> EN CALIDAD DE <b>FAMILIAR RESPONSABLE Y/O REPRESENTANTE LEGAL DEL C.</b> <b>' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . '</b> Y QUE EN LO SUCESIVO SE LE DENOMINARÁ <b>“EL PACIENTE”,</b> ASÍ MISMO CUANDO ACTÚEN DE MANERA CONJUNTA SE LES CONOCERÁ COMO <b>“LAS PARTES”,</b> MISMAS QUE SE SUJETAN AL TENOR DE LAS CLÁUSULAS Y DECLARACIONES SIGUIENTES:<br><br><br>

<center><b>DECLARACIONES</center></b><br><br>

<b>I.- DECLARA “EL PRESTADOR DE SERVICIOS”:</b><br><br>
I.I. Que es persona física y que es su deseo obligarse en los términos y condiciones establecidas en el presente contrato. <br><br>
I.II. Que tiene su domicilio en carretera entrada a Santiago Undameo s/n en la localidad de la Reunión; ubicado en la Tenencia de Santiago Undameo, en el Municipio de Morelia, Michoacán, a 200 metros de la autopista Morelia-Pátzcuaro.<br><br>
I.III. Que encuentra debidamente inscrito en el Registro Federal de Contribuyentes bajo la clave: <b>FTE101220N80</b><br><br>
I.IV. Se compromete a brindar el tratamiento clínico en rehabilitación de adicciones que a continuación se manifiesta.<br><br>
I.V.- Que su establecimiento cuenta con todas las autorizaciones, licencias y permisos correspondientes para prestar el servicio aquí contratado.<br><br>
I.VI.-Que cuenta con los recursos técnicos, conocimientos y capacidades suficientes para obligarse en términos del presente contrato.<br><br><br>
<b>II. DECLARA “EL CONTRATANTE”:</b><br><br>
II.I. Que es persona física y que es su deseo obligarse en los términos y condiciones establecidas en el presente contrato. <br><br>
II.II. Tener como domicilio el inmueble ubicado la calle de  ' . $paciente['direccionFamiliar'] . ', mismo que señala para efectos del presente instrumento.<br><br>
II.III. Que se encuentra debidamente inscritos en el Registro Federal de Contribuyentes.<br><br>
II.IV– Manifiesta “EL CONTRATANTE” solicitar el tratamiento e internamiento clínico de rehabilitación en adicciones  de “EL PACIENTE” de nombre ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ', durante______ días comprendidos a partir del ________ de _____________________ de _________ al _________ de _________ de _________, para la desintoxicación física y tratamiento terapéutico de la(s) sustancia(s) adictiva(s) conocidas como  ' . $paciente['sustanciaPsicoactiva'] . ' y que actualmente “EL PACIENTE” consume.<br><br><br>
<b>III. DECLARAN “LAS PARTES”</b><br><br>
III.I. - Que es su deseo y voluntad celebrar el presente contrato por lo que se reconocen el carácter con el que se ostentan, sin que medie dolo, lesión, mala fe o cualquier vicio del consentimiento que pueda invalidar total o parcialmente.
III.II.-Declaran las partes que celebran el presente contrato de manera voluntaria, libre y responsable, conociendo el contenido y alcance legal de cada una de las cláusulas del mismo.
III.III.- Que con la celebración del presente contrato no se genera relación laboral alguna, así como ningún tipo de obligación en materia de Seguridad Social, Infonavit y ahorro para el retiro.<br><br><br>

<b>CLÁUSULAS</b><br><br>
<b>PRIMERA. "EL CONTRATANTE”</b> manifiesta estar de acuerdo en que, al quedar su familiar en calidad de PACIENTE, ACEPTA Y SE HACE TOTALMENTE RESPONSABLE de lo que a continuación se describe:<br><br>
a) “EL CONTRATANTE” conoce y acepta que este centro utiliza el programa y sistema de organización mundial de alcohólicos y narcóticos anónimos y de que “EL PACIENTE”, solamente será iniciado en su tratamiento, por lo que no esperan y saben que “EL PACIENTE” no tendrá curación definitiva.<br><br>

b) “EL CONTRATANTE” acepta que sí, “EL PACIENTE” llegará a mostrar incapacidad física o mental, o mostrare que se encuentra carente de adaptación a participar en la terapia de grupo, regresará con sus familiares para que le brinden otro tipo de rehabilitación.<br><br>

c) “EL CONTRATANTE” acepta y manifiesta que se le hace saber que la enfermedad de adicción en algunos casos conlleva complicaciones físicas de gravedad y que pueden presentarse repentinamente e incluso causar la muerte. Por lo anterior, si esto llegase a suceder con "EL PACIENTE", "EL CONTRATANTE” LIBERA DE TOTALMENTE DE CUALQUIER TIPO DE RESPONSABILIDAD a los directivos y personal que labora en la institución. Igualmente "EL CONTRATANTE acepta esta cláusula en caso de algún accidente donde “EL PACIENTE” pudiese resultar con alguna lesión o daño físico.<br><br>

d) "EL CONTRATANTE" manifiesta estar plenamente consciente de que las instalaciones de dicha institución no son las de un centro de reclusión por lo que; si “EL PACIENTE” de nombre ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . ' logrará salir de las instalaciones  y sufriera algún daño o lo causare, no existirá responsabilidad alguna en contra de la institución y “EL CONTRATANTE” no se reserva el derecho de determinar algún tipo de responsabilidad en contra de esta institución, propietario, representante legal o de alguno de sus trabajadores.
<br><br>

e) “EL CONTRATANTE" acepta que "EL PACIENTE" contará con una cama individual en una habitación individual o compartida según lo determinen los especialistas en virtud de sexo, grupo etario, cuidado o salud del paciente.<br><br>

f) “EL CONTRATANTE" reconoce estar informado y acepta que las sesiones terapéuticas, psicológicas, psiquiátricas, de consejería familiar o individual según sea el caso, podrán ser videograbadas única y exclusivamente para fines de calidad en el servicio.<br><br>


g) "EL CONTRATANTE" reconoce la necesidad de "EL PACIENTE" de contar con artículos básicos de higiene y vestimenta los cuales se compromete a proveer de acuerdo al Anexo 1, así mismo, reconoce y acepta que en caso de no otorgarlos cuando le sean solicitados autoriza a “EL PRESTADOR DE SERVICIOS” a proveerlos para ser posteriormente pagados por “EL CONTRATANTE”.<br><br>

h) Las pertenencias de “EL PACIENTE” serán resguardadas hasta 30 días naturales posteriores a que este haya egresado, por lo que en caso de no ser solicitadas y recogidas por parte de “EL CONTRATANTE” o de “EL PACIENTE” durante el periodo establecido, “EL PRESTADOR DE SERVICIOS” no se hace responsable del extravío de los objetos dejados dentro de la institución.<br><br>

<b>SEGUNDA.</b> “EL PRESTADOR DE SERVICIOS” brindará información referente a “EL PACIENTE” única y exclusivamente a “EL CONTRATANTE” o a personas que con previo oficio y bajo el consentimiento  escrito de "EL CONTRATANTE" sean autorizadas. Sin embargo, en caso de recibir una solicitud de información oficial por parte de las autoridades competentes en la materia, "EL PRESTADOR DE SERVICIOS" se encuentra facultado para brindar dicha información.<br><br>
<b>TERCERA.</b> El costo del tratamiento clínico integral con duración de tres meses asciende a la cantidad de $ 90,000.00 (Noventa mil pesos 00/100 M.N.), de los cuales "EL PRESTADOR DE SERVICIOS" otorga una beca a “EL PACIENTE” de $___________________ cantidad con letra (__________________________________________pesos 00/100 M.N.) equivalente al ______ % del costo total del tratamiento.<br><br>

<b>CUARTA.</b> "EL CONTRATANTE" deberá pagar la cantidad total de $______________________ con letra ( _______________________________________________pesos 00/100 M.N) por los servicios recibidos por  "EL PRESTADOR DE SERVICIOS”, en caso de no efectuarse el pago en su totalidad "EL CONTRATANTE” se hará acreedor a un interés mensual del 5% sobre el saldo pendiente de la deuda hasta la liquidación total de acuerdo al plan de pagos en el Anexo 2; aunado a lo anterior, en caso de gestiones de cobranza "EL CONTRATANTE" asumirá los costos que se devenguen de dicha acción.<br><br>



<b>QUINTA. DE LA RESCISIÓN DEL CONTRATO.</b><br><br>
a) La rescisión por parte de "EL CONTRATANTE" antes del ingreso de “EL PACIENTE” a la clínica, generará una multa por gastos administrativos y operativos el cual será del 40%  (cuarenta por ciento) del primer pago realizado.<br><br>
b) La rescisión por parte de "EL CONTRATANTE” durante el proceso de rehabilitación de "EL PACIENTE" una vez que esto se encuentre internado, Inhabilitará la beca otorgada por "EL PRESTADOR DE SERVICIOS” y el "EL CONTRATANTE” deberá pagar el costo de $1,000.00 (mil pesos 00/100 M.N.) por día que "EL PACIENTE" haya durado internado en la clínica.<br><br>

<b>SEXTA.</b> El costo del tratamiento que se establece en el presente contrato cubre los gastos generados durante el periodo en el que "EL PACIENTE" se encuentre como interno a partir del ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'.
<br>
<br><br><br>
<table class="tg" width="100%" border="1">
<thead>
  <tr>
    <th class="tg-0pky">Hospedaje</th>
    <th class="tg-0pky">Consultas psiquiátricas.</th>
    <th class="tg-0pky">Grupos de autoayuda</th>
    <th class="tg-0pky">Terapias alternativas</th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-0lax">Alimentación</td>
    <td class="tg-0lax">Psicoterapia individual.</td>
    <td class="tg-0lax">-AA</td>
    <td class="tg-0lax">- Yoga</td>
  </tr>
  <tr>
    <td class="tg-0lax">-Desayuno</td>
    <td class="tg-0lax">Psicoterapia grupal.</td>
    <td class="tg-0lax">-NA</td>
    <td class="tg-0lax">- Expresión corporal</td>
  </tr>
  <tr>
    <td class="tg-0lax">- Comida</td>
    <td class="tg-0lax">Atención familiar</td>
    <td class="tg-0lax">Estudios de laboratorio básicos.</td>
    <td class="tg-0lax">-Capoeira</td>
  </tr>
  <tr>
    <td class="tg-0lax">-Cena</td>
    <td class="tg-0lax">Psicoterapia familiar.</td>
    <td class="tg-0lax">- Hematología</td>
    <td class="tg-0lax">- Risoterapia</td>
  </tr>
  <tr>
    <td class="tg-0lax">Cuidados continuos</td>
    <td class="tg-0lax">Consejería.</td>
    <td class="tg-0lax">-Química Clínica de 6 elementos</td>
    <td class="tg-0lax">- Aromaterapia</td>
  </tr>
  <tr>
    <td class="tg-0lax">Asistencia y monitoreo 24 hrs.</td>
    <td class="tg-0lax">Talleres Familiares</td>
    <td class="tg-0lax">-EGO (examen general de orina)</td>
    <td class="tg-0lax">- Equino terapia</td>
  </tr>
  <tr>
    <td class="tg-0lax">Consultas médicas.</td>
    <td class="tg-0lax">Conferencias familiares</td>
    <td class="tg-0lax">-Prueba de embarazo (si aplica).</td>
    <td class="tg-0lax">-Taller de lectura y de artes plásticas</td>
  </tr>
</tbody>
</table>


<br><br><br>


<b>SÉPTIMA. </b>
"EL CONTRATANTE” el C.<b>' . $paciente['nombreFamiliar'] . ' </b> ACEPTA Y SE OBLIGA a cubrir todos los gastos extraordinarios de "EL PACIENTE" generados por concepto de medicamentos, salidas recreativas, áreas de miscelánea, dentista, atención médica especializada no mencionada en la cláusula 6, cualquier servicio a producto que sea autorizado previamente; ya que no se incluyen en el costo del tratamiento, así como cualquier desperfecto o daño que "EL PACIENTE" genere a las instalaciones o en perjuicio de cualquier persona (paciente a empleado) que se encuentre dentro de la institución.<br><br>

<b>OCTAVA.</b> En caso de que "EL PACIENTE" egrese de la Clínica sin liquidar el adeudo total de los servicios contratados a la fecha pactada o de su programación de egreso,  "EL PACIENTE" familiar y/o obligado solidario, previo a su salida de  las instalaciones del centro de rehabilitación se deberá  garantizar el pago total del adeudo mediante los mecanismos que la Clínica determine. A su vez "EL PRESTADOR DE SERVICIOS” podrá poner a disposición de las autoridades competentes a “EL PACIENTE” si lo considerase necesario o en caso de que este sea abandonado por parte de "EL CONTRATANTE".<br><br>

<b>NOVENA.</b> "EL CONTRATANTE" acepta que, habiendo explicado claramente las normas y sus responsabilidades, derechos y obligaciones, encontrándose en pleno uso de sus facultades mentales, comprende en su totalidad cada una de ellas y las acepta en todas y cada una de sus partes. <br><br>

<b>DÉCIMA.</b> “LAS PARTES” acuerdan que para la interpretación y cumplimiento del presente contrato se someterán a la jurisdicción de los Tribunales competentes de la Ciudad de Morelia, Michoacán; por lo que renuncia a cualquier otro fuero que por razón de sus domicilios presentes o futuros les llegara a corresponder.<br><br>

<b>DÉCIMA PRIMERA:</b> “EL CONTRATANTE” en este acto manifiesta bajo protesta de decir verdad, que los recursos que utilizará para pagar las obligaciones que emanen de este contrato, así como de la cesión de derechos, objeto del presente contrato, tienen un origen lícito
<br><br>


Estando de acuerdo las partes de los alcances del presente instrumento jurídico y manifestando que en el presente no existe dolo, lesión, error, mala fe, ni ningún otro vicio del consentimiento que pudiera invalidar el presente, lo firman “LAS PARTES” por triplicado al calce y al margen para los efectos legales a que haya lugar, en Santiago Undameo, Morelia, Michoacán a los ' . $diaActual .' de ' . $nombreMes .' de ' . $anioActual .'.<br><br><br>




<table width="100%" style="border:4px solid black;">
    <tr>
        <td width="50%" style="text-align:center;border-right:4px solid black;"><br>
        <b>“EL PRESTADOR DE SERVICIOS”<br><br><br>
         _____________________________<br>
        CLÍNICA 7 ÁNGELES <br>
        Por conducto del C.<br>
        DANTE TENTORY VARGAS</b><br><br>

        </td>
        
        <td width="50%" style="text-align:center;"><br>
        <b>“EL CONTRATANTE”<br><br><br>
         _____________________________<br>
         NOMBRE Y FIRMA <br>
       FAMILIAR RESPONSABLE O REPRESENTANTE LEGAL
       </b><br><br>

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
