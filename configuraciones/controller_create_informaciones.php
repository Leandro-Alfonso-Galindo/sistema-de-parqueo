<?php

include("../app/config.php");

$nombre_parqueo = $_GET['nombre_parqueo'];
$actividad_empresa = $_GET['actividad_empresa'];
$sucursal = $_GET['sucursal'];
$direccion = $_GET['direccion'];
$zona = $_GET['zona'];
$telefono = $_GET['telefono'];
$departamento_ciudad = $_GET['departamento_ciudad'];
$pais = $_GET['pais'];


date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


//echo $nombres."-".$email."-".$password_user;

$sentencia = $pdo->prepare("INSERT INTO tb_informaciones
    (nombre_parqueo, actividad_empresa, sucursal, direccion, zona, telefono, departamento_ciudad, pais, fyh_creacion, estado) 
    values(:nombre_parqueo, :actividad_empresa, :sucursal, :direccion, :zona, :telefono, :departamento_ciudad, :pais, :fyh_creacion, :estado)");

$sentencia->bindParam('nombre_parqueo', $nombre_parqueo);
$sentencia->bindParam('actividad_empresa', $actividad_empresa);
$sentencia->bindParam('sucursal', $sucursal);
$sentencia->bindParam('direccion', $direccion);
$sentencia->bindParam('zona', $zona);
$sentencia->bindParam('telefono', $telefono);
$sentencia->bindParam('departamento_ciudad', $departamento_ciudad);
$sentencia->bindParam('pais', $pais);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);


if($sentencia->execute()){
    echo "Registro satisfactorio"; 
    ?>
    <script>location.href = "informaciones.php";</script>
    <?php
}else{
    echo "No se pudo registrar a la base de datos";
}

?>