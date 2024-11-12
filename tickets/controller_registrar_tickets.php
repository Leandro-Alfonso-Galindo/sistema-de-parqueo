<?php

include("../app/config.php");


$placa = $_GET['placa'];
$placa = strtoupper($placa); //Convierte todo a mayuscula
$nombre_cliente = $_GET['nombre_cliente'];
$rut_ci = $_GET['rut_ci'];
$cuviculo = $_GET['cuviculo'];
$fecha_ingreso = $_GET['fecha_ingreso'];
$hora_ingreso = $_GET['hora_ingreso'];
$user_sesion = $_GET['user_sesion'];
$estado_ticket = "OCUPADO";


date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");

$sentencia = $pdo->prepare('INSERT INTO tb_tickets
(placa_auto, nombre_cliente, rut_ci, cuviculo, fecha_ingreso, hora_ingreso, estado_ticket, user_sesion, fyh_creacion, estado)
VALUES (:placa_auto, :nombre_cliente, :rut_ci, :cuviculo, :fecha_ingreso, :hora_ingreso, :estado_ticket,:user_sesion, :fyh_creacion, :estado)');

$sentencia->bindParam('placa_auto',$placa);
$sentencia->bindParam('nombre_cliente',$nombre_cliente);
$sentencia->bindParam('rut_ci',$rut_ci);
$sentencia->bindParam('cuviculo',$cuviculo);
$sentencia->bindParam('fecha_ingreso',$fecha_ingreso);
$sentencia->bindParam('hora_ingreso',$hora_ingreso);
$sentencia->bindParam('estado_ticket',$estado_ticket);
$sentencia->bindParam('user_sesion',$user_sesion);
$sentencia->bindParam('fyh_creacion',$fechaHora);
$sentencia->bindParam('estado',$estado_del_registro);


if($sentencia->execute()){
    echo 'Registro exitoso';
    ?>
    <script>location.href = "tickets/generar_ticket.php"</script>
    <?php
}else{
    echo 'Error al registrar a la base de datos';
}

?>