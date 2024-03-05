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
    <center><b>HOJA DE INGRESO</b></center><br>


<table width="100%">
    <tr>
        <td width="50%" style="text-align:left;"><b>Hora de Ingreso:</b> ' . $paciente['horaIngreso'] .' </td>
        <td width="50%" style="text-align:left;"><b>Fecha de ingreso:</b> ' . $paciente['fechaIngreso'] .' </h3></td>
    </tr>
</table><br><br>


<b>1. Datos del usuario: </b><br><br>

Nombre completo del usuario: ' . $paciente['nombre'] . $espacio . $paciente['aPaterno'] . $espacio . $paciente['aMaterno'] . '  <br> <br>

<table width="100%" border="1">
    <tr>
        <td width="33%" style="text-align:left;">Sexo: ' . $paciente['sexo'] .' </td>
        <td width="33%" style="text-align:left;">Fecha de nacimiento: ' . $paciente['fechaNacimiento'] .' </h3></td>
        <td width="33%" style="text-align:left;">Edad: ' . $paciente['edad'] .' </h3></td>
    </tr>
</table>
<table width="100%" border="1">
    <tr>
        <td width="33%" style="text-align:left;">Dirección: ' . $paciente['direccion'] .' </td>
        <td width="33%" style="text-align:left;">Teléfono(s): ' . $paciente['telefono'] .' </h3></td>
        <td width="33%" style="text-align:left;">Nacionalidad: ' . $paciente['nacionalidad'] .' </h3></td>
    </tr>
</table>

<table width="100%" border="1">
    <tr>
        <td width="33%" style="text-align:left;">Estado civil: ' . $paciente['estadoCivil'] .' </td>
        <td width="33%" style="text-align:left;">Escolaridad: ' . $paciente['escolaridad'] .' </h3></td>
        <td width="33%" style="text-align:left;">Ocupación: ' . $paciente['ocupacion'] .' </h3></td>
    </tr>
</table>


<table width="100%" border="1">
    <tr>
        <td width="70%" style="text-align:left;">¿Cuántos ingresos previos ha tenido en el establecimiento?: ' . $paciente['ingresosPrevios'] .' </td>
        <td width="50%" style="text-align:left;">Fecha(s): ' . $paciente['fechasIngresosPrevios'] .' </h3></td>
    </tr>
</table>

<table width="100%" border="1">
    <tr>
        <td width="33%" style="text-align:left;">¿Lo refiere alguna institución?: ' . $paciente['institucionRefiere'] .' </td>
        <td width="33%" style="text-align:left;">¿Presenta hoja de referencia?: ' . $paciente['hojaReferencia'] .' </h3></td>
        <td width="33%" style="text-align:left;">Tipo de ingreso actual: ' . $paciente['tipoIngreso'] .' </h3></td>
    </tr>
</table><br><br>


<b>2. Datos del familiar o representante legal </b><br><br>
Nombre: ' . $paciente['nombreFamiliar']. '  <br> <br>

<table width="100%" border="1">
    <tr>
        <td width="33%" style="text-align:left;">Edad: ' . $paciente['edadFamiliar'] .' </td>
        <td width="33%" style="text-align:left;">Ocupación: ' . $paciente['ocupacionFamiliar'] .' </h3></td>
        <td width="33%" style="text-align:left;">Parentesco: ' . $paciente['parentescoFamiliar'] .' </h3></td>
    </tr>
</table>

<table width="100%" border="1">
    <tr>
        <td width="33%" style="text-align:left;">Dirección: ' . $paciente['direccionFamiliar'] .' </td>
        <td width="33%" style="text-align:left;">Teléfono(s): ' . $paciente['telefonoFamiliar'] .' </h3></td>
    </tr>
</table><br><br>


<b>REVISIÓN FÍSICA GENERAL</b>' . $paciente['revisionFisicaGeneral'] .' <br><br>

<b>VESTIMENTA CON LA QUE INGRESA</b>' . $paciente['vestimentaIngreso'] .' <br><br>

<b>ARTÍCULOS Y PERTENENCIAS QUE SE RESGUARDAN</b> ' . $paciente['pertenenciasIngreso'] .' <br><br>

<b>ÚLTIMA VEZ QUE CONSUMIÓ</b> ' . $paciente['ultimoConsumo'] .' 

<b>          LLEGA INTOXICADO</b> ' . $paciente['intoxicado'] .' <br><br>


</body>
</html>';

// Carga el HTML en Dompdf y genera el PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Envia el PDF al navegador
$dompdf->stream('solicitud-de-internamiento.pdf', ['Attachment' => 0]);
?>
