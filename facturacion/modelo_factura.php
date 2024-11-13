<?php

// Include the main TCPDF library (search for installation path).
require_once('../app/templates/TCPDF-main/tcpdf.php');
include('../app/config.php');

//CARGAR EL ENCABEZADO
$query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1'");

$query_informacions->execute();

$informacions = $query_informacions->fetchALL(PDO::FETCH_ASSOC);
foreach($informacions as $informacion) {
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
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, array(79, 175), true, 'UTF-8', false);

// set document information
$pdf->setCreator(PDF_CREATOR);
$pdf->setAuthor('Sistema de Parqueo');
$pdf->setTitle('Sistema de Parqueo');
$pdf->setSubject('Sistema de Parqueo');
$pdf->setKeywords('TCPDF, PDF, example, test, guide');

// remove default header/footer
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

// set default monospaced font
$pdf->setDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->setMargins(5, 5, 5);

// set auto page breaks
$pdf->setAutoPageBreak(true, 5);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
	require_once(dirname(__FILE__).'/lang/eng.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->setFont('Helvetica', '', 7);

// add a page
$pdf->AddPage();

$html = '
<div>
	<p style="text-align: center">
		<b>'.$nombre_parqueo.'</b> <br>
		'.$actividad_empresa.' <br>
		SUCURSAL '.$sucursal.' <br>
		'.$direccion.' <br>
		ZONA: '.$zona.' <br>
		TELÉFONO: '.$telefono.' <br>
		'.$departamento_ciudad.' - '.$pais.' <br>
			--------------------------------------------------------------------------------- <br>
        <div style="text-align: left">
            <b >FACTURA Nro.</b> 000001 <br>
            ----------------------------------------------------------------------------------- <br>
			<b>DATOS DEL CLIENTE</b> <br>
			<b>SEÑOR(A)</b> EJEMPLO <br>
			<b>RUT/CI:</b> 123456789 <br>
            <b>Fecha de la Factura:</b> La Ligua, 12 de Noviembre de 2024 <br>
			----------------------------------------------------------------------------------- <br>
			<b>De:</b> 12/11/2024  <b>Hora:</b> 18:00 <br>
            <b>A:</b> 12/11/2024  <b>Hora:</b> 20:00 <br>
            <b>Tiempo:</b> 2 horas en el cuviculo 10<br>
            ----------------------------------------------------------------------------------- <br>
            <table border="1" cellPadding="2">
                <tr>
                    <td style="text-align: center" width="99px"><b>Detalle</b></td>
                    <td style="text-align: center" width="45px"><b>Precio</b></td>
                    <td style="text-align: center" width="45px"><b>Cantidad</b></td>
                    <td style="text-align: center" width="45px"><b>Total</b></td>
                </tr>
                <tr>
                    <td style="text-align: center">
                        Servicio de parqueo de 2 horas
                    </td>
                    <td style="text-align: center">
                        CLP $100
                    </td>
                    <td style="text-align: center">
                        1
                    </td>
                    <td style="text-align: center">
                        CLP $100
                    </td>
                </tr>
            </table>
            <p style="text-align: right">
                <b>Monto Total:</b> 
            </p>
            <p>
                <b>Son: Cien 00/100 CLP</b>
            </p>
            ----------------------------------------------------------------------------------- <br>
			<b>USUARIO</b>: LEANDRO GALINDO 
            <p style="text-align: center">
                <img src="https://upload.wikimedia.org/wikipedia/commons/d/d7/Commons_QR_code.png" alt="" width="70px">
            </p>
            <p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS, EL USO ILEGITIMO SERA SANCIONADO POR LA LEY"</p>
            <p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA</b></p>
			
		</div>
		
	</p>

</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');







//Close and output PDF document
$pdf->Output('example_002.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>