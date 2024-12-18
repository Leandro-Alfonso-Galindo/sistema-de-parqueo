<?php
//============================================================+
// File name   : example_004.php
// Begin       : 2008-03-04
// Last Update : 2013-05-14
//
// Description : Example 004 for TCPDF class
//               Cell stretching
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package com.tecnick.tcpdf
 * @abstract TCPDF - Example: Cell stretching
 * @author Nicola Asuni
 * @since 2008-03-04
 */

// Include the main TCPDF library (search for installation path).
require_once('../app/templates/TCPDF-main/tcpdf.php');
include('../app/config.php');


//cargar el encabezado
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' ");
$query_informacions->execute();
$informacions = $query_informacions->fetchAll(PDO::FETCH_ASSOC);
foreach($informacions as $informacion){
    $id_informacion = $informacion['id_informacion'];
    $nombre_parqueo = $informacion['nombre_parqueo'];
    $actividad_empresa = $informacion['actividad_empresa'];
    $sucursal = $informacion['sucursal'];
    $direccion = $informacion['direccion'];
    $zona = $informacion['zona'];
    $telefono = $informacion['telefono'];
    $departamento_ciudad = $informacion['departamento_ciudad'];
    $pais = $informacion['pais'];
}


// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de Parqueo');
$pdf->setTitle('Reporte de Informaciones');
$pdf->setSubject('TCPDF Tutorial');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

$PDF_HEADER_TITLE = $nombre_parqueo;
$PDF_HEADER_STRING = $direccion.' Telf: '.$telefono;
$PDF_HEADER_LOGO = "../public/imagenes/auto.jpg";
// set default header data
$pdf->setHeaderData($PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, $PDF_HEADER_TITLE, $PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->setHeaderMargin(PDF_MARGIN_HEADER);
$pdf->setFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->setAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 11);

// add a page
$pdf->AddPage();

// create some HTML content
$html = '
<P><b>Reporte del Listado de Informaciones</b></P>
<table border="1" cellpadding="4">
<tr>
<td style="background-color: #c0c0c0;text-align: center" width="35px">Nro</td>
<td style="background-color: #c0c0c0;text-align: center" width="95px">Nombre del Parqueo</td>
<td style="background-color: #c0c0c0;text-align: center" width="80px">Actividad de la Empresa</td>
<td style="background-color: #c0c0c0;text-align: center">Sucursal</td>
<td style="background-color: #c0c0c0;text-align: center">Dirección</td>
<td style="background-color: #c0c0c0;text-align: center">Zona</td>
<td style="background-color: #c0c0c0;text-align: center">Teléfono</td>
<td style="background-color: #c0c0c0;text-align: center">Departamento o Ciudad</td>
<td style="background-color: #c0c0c0;text-align: center">País</td>
</tr>
';
$contador = 0;
$query_informaciones = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' ");
$query_informaciones->execute();
$informaciones = $query_informaciones->fetchAll(PDO::FETCH_ASSOC);
foreach($informaciones as $informacione){
    $id_informacion = $informacione['id_informacion'];
    $nombre_parqueo = $informacione['nombre_parqueo'];
    $actividad_empresa = $informacione['actividad_empresa'];
    $sucursal = $informacione['sucursal'];
    $direccion = $informacione['direccion'];
    $zona = $informacione['zona'];
    $telefono = $informacione['telefono'];
    $departamento_ciudad = $informacione['departamento_ciudad'];
    $pais = $informacione['pais'];
    $contador = $contador + 1;

    $html .= '
    <tr>
    <td style="text-align: center">'.$contador.'</td>
    <td style="text-align: center">'.$nombre_parqueo.'</td>
    <td style="text-align: center">'.$actividad_empresa.'</td>
    <td style="text-align: center">'.$sucursal.'</td>
    <td style="text-align: center">'.$direccion.'</td>
    <td style="text-align: center">'.$zona.'</td>
    <td style="text-align: center">'.$telefono.'</td>
    <td style="text-align: center">'.$departamento_ciudad.'</td>
    <td style="text-align: center">'.$pais.'</td>
    </tr>
    ';


}

$html.='
</table>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

//Close and output PDF document
$pdf->Output('example_004.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+