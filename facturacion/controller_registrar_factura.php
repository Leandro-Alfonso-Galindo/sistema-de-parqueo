<?php

include('../app/config.php');
include('literal.php');

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");
$dia = date("d");
$mes = date("m");
if($mes == "1") $mes = "Enero";
if($mes == "2") $mes = "Febrero";
if($mes == "3") $mes = "Marzo";
if($mes == "4") $mes = "Abril";
if($mes == "5") $mes = "Mayo";
if($mes == "6") $mes = "Junio";
if($mes == "7") $mes = "Julio";
if($mes == "8") $mes = "Agosto";
if($mes == "9") $mes = "Septiembre";
if($mes == "10") $mes = "Octubre";
if($mes == "11") $mes = "Noviembre";
if($mes == "12") $mes = "Diciembre";

$ano = date("Y");


$id_informacion = $_GET['id_informacion'];
$nro_factura = $_GET['nro_factura'];
$id_cliente = $_GET['id_cliente'];

/////////////////////// recuperar el departamento o ciudad de la tabla informaciones //////////////////////
$query_info = $pdo->prepare("SELECT * FROM tb_informaciones WHERE id_informacion = '$id_informacion' AND estado = '1'");
                                                  
$query_info->execute();

$infos = $query_info->fetchALL(PDO::FETCH_ASSOC);
foreach($infos as $info) {
$departamento_ciudad = $info['departamento_ciudad'];
}

$fecha_factura = $departamento_ciudad . ", " . $dia . " de " . $mes . " del " . $ano;
///////////////////////

$fecha_ingreso = $_GET['fecha_ingreso'];
$hora_ingreso = $_GET['hora_ingreso'];

$fecha_salida = date("d/m/Y");
$fecha_salida_para_calcular = date("Y/m/d");
$hora_salida = date("H:i");

////////////////////// Calcula el tiempo de parqueo en horas //////////////////////
$c_hora_ingreso = strtotime($hora_ingreso);
$c_hora_salida = strtotime($hora_salida);
$diferencia_hora = ($c_hora_salida - $c_hora_ingreso) / 3600;
round($diferencia_hora, 2);

$hora_calulada = ((int)$diferencia_hora);

$diferencia_minutos = ($c_hora_salida - $c_hora_ingreso) / 60;
$calculando = $hora_calulada * 60;
$minutos_calculado = $diferencia_minutos - $calculando;

//////////////////////////////////////////////////////////////////////////

////////////////////// Calcula el tiempo de parqueo en dias //////////////////////
$dato1 = new DateTime($fecha_ingreso);
$dato2 = new DateTime($fecha_salida_para_calcular);
$dias_calculado = $dato1->diff($dato2);
$dias_calculado->days;

if(($dias_calculado->days)=="0") {
    $tiempo = $hora_calulada . " horas con " . $minutos_calculado . " minutos";
}else {
    $tiempo = $dias_calculado->days." dias con ". $hora_calulada . " horas con " . $minutos_calculado . " minutos";
}

//////////////////////////////////////////////////////////////////////////

$cuviculo = $_GET['cuviculo'];
$detalle = "Servicio de Parqueo de " . $tiempo;

////////////////////// Calcular el precio del cliente en horas //////////////////////
$precio_hora = 0;
$query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$hora_calulada' AND detalle = 'HORAS' AND estado = '1'");
                    
$query_precios->execute();

$datos_precios = $query_precios->fetchALL(PDO::FETCH_ASSOC);

foreach($datos_precios as $datos_precio) {
    $precio_hora = $datos_precio['precio'];
}
 
/////////////////////////////////////////////////////
////////////////////// Calcular el precio del cliente en dias //////////////////////
$precio_dia = 0;
$query_precios_dias = $pdo->prepare("SELECT * FROM tb_precios WHERE cantidad = '$dias_calculado->days' AND detalle = 'DIAS' AND estado = '1'");
                    
$query_precios_dias->execute();
 
$datos_precios_dias = $query_precios_dias->fetchALL(PDO::FETCH_ASSOC);

foreach($datos_precios_dias as $datos_precios_dia) {
    $precio_dia = $datos_precios_dia['precio'];
}
$precio_final = $precio_dia + $precio_hora;
/////////////////////////////////////////////////////

$cantidad = 1;

$total = ($precio_final * $cantidad);
$monto_total = $total;

$monto_literal = numtoletras($monto_total);
$user_sesion = $_GET['user_sesion'];

//////////////////////// Recuperar clientes //////////////////////////////
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente' AND estado = '1'");
                    
$query_clientes->execute();

$datos_clientes = $query_clientes->fetchALL(PDO::FETCH_ASSOC);

foreach($datos_clientes as $datos_cliente) {
    $nombre_cliente = $datos_cliente['nombre_cliente'];
    $rut_ci_cliente = $datos_cliente['rut_ci_cliente'];
    $placa_auto = $datos_cliente['placa_auto'];
}
//////////////////////////////////////////////////////
$qr = "Factura realizada por el sistema de parqueo al cliente ".$nombre_cliente." con RUT/CI: ".$rut_ci_cliente.",
con el vehiculo de nro de placa: ".$placa_auto." y esta factura se genero en ".$fecha_factura." a las: ".$hora_salida."";



$sentencia = $pdo->prepare('INSERT INTO tb_facturaciones
(id_informacion, nro_factura, id_cliente, fecha_factura, fecha_ingreso, hora_ingreso, fecha_salida, hora_salida, tiempo, cuviculo, detalle, precio, cantidad, total, monto_total, monto_literal, user_sesion, qr, fyh_creacion, estado)
VALUES (:id_informacion,:nro_factura,:id_cliente,:fecha_factura,:fecha_ingreso,:hora_ingreso,:fecha_salida,:hora_salida,:tiempo,:cuviculo,:detalle,:precio,:cantidad,:total,:monto_total,:monto_literal,:user_sesion,:qr,:fyh_creacion,:estado)');

$sentencia->bindParam(':id_informacion',$id_informacion);
$sentencia->bindParam(':nro_factura',$nro_factura);
$sentencia->bindParam(':id_cliente',$id_cliente);
$sentencia->bindParam(':fecha_factura',$fecha_factura);
$sentencia->bindParam(':fecha_ingreso',$fecha_ingreso);
$sentencia->bindParam(':hora_ingreso',$hora_ingreso);
$sentencia->bindParam(':fecha_salida',$fecha_salida);
$sentencia->bindParam(':hora_salida',$hora_salida);
$sentencia->bindParam(':tiempo',$tiempo);
$sentencia->bindParam(':cuviculo',$cuviculo);
$sentencia->bindParam(':detalle',$detalle);
$sentencia->bindParam(':precio',$precio_final);
$sentencia->bindParam(':cantidad',$cantidad);
$sentencia->bindParam(':total',$total);
$sentencia->bindParam(':monto_total',$monto_total);
$sentencia->bindParam(':monto_literal',$monto_literal);
$sentencia->bindParam(':user_sesion',$user_sesion);
$sentencia->bindParam(':qr',$qr);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);

if($sentencia->execute()){
    echo 'success';
    ?>
    <script>
        location.href = "facturacion/factura.php";
    </script>
    <?php
}else{
    echo 'error al registrar a la base de datos';
}

?>