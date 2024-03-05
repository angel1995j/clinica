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
    <center><b>3.5.1. ANEXO UNO<br>FORMATO CONTRATO DE PRESTACIÓN DE SERVICIOS</b></center><br><br><br>

El C. <b>' . $paciente['nombreFamiliar'] . ' </b> en calidad de contratante y familiar/ representante legal/tutor de “EL PACIENTE”, en correlación con lo dispuesto en la cláusula cinco del contrato principal; mismo que en su parte conducente señala que “EL CONTRATANTE” se obliga a cubrir  todos y cada uno de los gastos extraordinarios, relativos a los siguientes bienes y/o servicios que a continuación se relacionan:
<br><br> <br><br>

<style type="text/css">
.tg  {border-collapse:collapse;border-spacing:0;}
.tg td{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  overflow:hidden;padding:10px 5px;word-break:normal;}
.tg th{border-color:black;border-style:solid;border-width:1px;font-family:Arial, sans-serif;font-size:14px;
  font-weight:normal;overflow:hidden;padding:10px 5px;word-break:normal;}
.tg .tg-0lax{text-align:left;vertical-align:top}
.tg .tg-amwm{font-weight:bold;text-align:center;vertical-align:top}
</style>
<table class="tg">
<thead>
  <tr>
    <th class="tg-0lax"><span style="font-weight:400;font-style:normal;text-decoration:none">1 (CONCEPTO)</span></th>
    <th class="tg-amwm"><span style="font-weight:700;font-style:normal;text-decoration:none;color:#000;background-color:transparent">2    (PRECIO)</span></th>
  </tr>
</thead>
<tbody>
  <tr>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">MEDICAMENTO</span></td>
    <td class="tg-0lax">COSTO VARIABLE DE ACUERDO CON EL TIPO DE MEDICAMENTO</td>
  </tr>
  <tr>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">TIENDA INTERNA (Precio Sugerido)</span></td>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">$ 300.00 Pesos</span></td>
  </tr>
  <tr>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">Una Sesión de Psicoterapia Familiar</span></td>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">$ 300.00 Pesos</span></td>
  </tr>
  <tr>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">Lista de Enseres</span></td>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">Precio Variante</span></td>
  </tr>
  <tr>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">Artículos de Aseo Personal</span></td>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal">Precio Variante</span></td>
  </tr>
  <tr>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">Material de Curación</span></td>
    <td class="tg-0lax"><span style="font-weight:700;font-style:normal;text-decoration:none">Precio Variante</span></td>
  </tr>
</tbody>
</table>

<br><br><br>



<div style="width:100%; text-align:center; margin-top:0%;">
 Los conceptos extraordinarios podrán variar de acuerdo al tipo de proveedor o la demanda comercial, en caso de alguna modificación o incremento se notificará a la parte contratante por escrito para su respectiva aceptación.<br><br><br><br>

 ________________________<br><br>
 <b>NOMBRE Y FIRMA DEL<br> CONTRATANTE</b>


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
