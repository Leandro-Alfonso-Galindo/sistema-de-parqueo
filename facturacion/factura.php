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

//RESCATAR LA INFO DE LA FACTURA
$query_facturas = $pdo->prepare("SELECT * FROM tb_facturaciones WHERE estado = '1'");

$query_facturas->execute();

$facturas = $query_facturas->fetchALL(PDO::FETCH_ASSOC);
foreach($facturas as $factura) {
	$id_facturacion = $factura['id_facturacion'];
    $id_informacion = $factura['id_informacion'];
    $nro_factura = $factura['nro_factura'];
    $id_cliente = $factura['id_cliente'];
    $fecha_factura = $factura['fecha_factura'];
    $fecha_ingreso = $factura['fecha_ingreso'];
    $hora_ingreso = $factura['hora_ingreso'];
    $fecha_salida = $factura['fecha_salida'];
    $hora_salida = $factura['hora_salida'];
    $tiempo = $factura['tiempo'];
    $cuviculo = $factura['cuviculo'];
    $detalle = $factura['detalle'];
    $precio = $factura['precio'];
    $cantidad = $factura['cantidad'];
    $total = $factura['total'];
    $monto_total = $factura['monto_total'];
    $monto_literal = $factura['monto_literal'];
    $user_sesion = $factura['user_sesion'];
    $qr = $factura['qr'];
};

$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente' AND estado = '1'");
                    
$query_clientes->execute();

$datos_clientes = $query_clientes->fetchALL(PDO::FETCH_ASSOC);

foreach($datos_clientes as $datos_cliente) {
    $nombre_cliente = $datos_cliente['nombre_cliente'];
    $rut_ci_cliente = $datos_cliente['rut_ci_cliente'];
    $placa_auto = $datos_cliente['placa_auto'];
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
            <b >FACTURA Nro.</b> '.$nro_factura.' <br>
            ----------------------------------------------------------------------------------- <br>
			<b>DATOS DEL CLIENTE</b> <br>
			<b>SEÑOR(A)</b> '.$nombre_cliente.' <br>
			<b>RUT/CI:</b> '.$rut_ci_cliente.' <br>
            <b>Fecha de la Factura:</b> '.$fecha_factura.' <br>
			----------------------------------------------------------------------------------- <br>
			<b>De:</b> '.$fecha_ingreso.'  <b>Hora:</b> '.$hora_ingreso.' <br>
            <b>A:</b> '.$fecha_salida.' <b>Hora:</b> '.$hora_salida.' <br>
            <b>Tiempo:</b> '.$tiempo.'<br>
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
                        '.$detalle.'
                    </td>
                    <td style="text-align: center">
                        '.$precio.'
                    </td>
                    <td style="text-align: center">
                        '.$cantidad.'
                    </td>
                    <td style="text-align: center">
                        '.$total.'
                    </td>
                </tr>
            </table>
            <p style="text-align: right">
                <b>Monto Total:</b> $'.$monto_total.' CLP
            </p>
            <p>
                <b>Son:</b> '.$monto_literal.'
            </p>
            ----------------------------------------------------------------------------------- <br>
			<b>USUARIO</b>: '.$user_sesion.' <br><br><br><br><br><br><br>
            
            <p style="text-align: center">"ESTA FACTURA CONTRIBUYE AL DESARROLLO DEL PAIS, EL USO ILEGITIMO SERA SANCIONADO POR LA LEY"</p>
            <p style="text-align: center"><b>GRACIAS POR SU PREFERENCIA</b></p>
		</div>
		
	</p>

</div>
';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// set style for barcode
$style = array(
    'border' => false,
    'vpadding' => '3',
    'hpadding' => '3',
    'fgcolor' => array(0,0,0),
    'bgcolor' => false, //array(255,255,255)
    'module_width' => 1, // width of a single module in points
    'module_height' => 1 // height of a single module in points
);

$pdf->write2DBarcode($qr, 'QRCODE, L', 27, 115, 25, 25, $style);





//Close and output PDF document
$pdf->Output('factura.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
?>