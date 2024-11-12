<?php

include("../app/config.php");

$nombre = $_GET['nombre'];
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


//echo $nombres."-".$email."-".$password_user;

$sentencia = $pdo->prepare("INSERT INTO tb_roles
    (nombre, fyh_creacion, estado) 
    values(:nombre, :fyh_creacion, :estado)");

$sentencia->bindParam('nombre', $nombre);
$sentencia->bindParam('fyh_creacion', $fechaHora);
$sentencia->bindParam('estado', $estado_del_registro);


if($sentencia->execute()){
    echo "Registro satisfactorio"; 
    ?>
    <script>location.href = "../roles";</script>
    <?php
}else{
    echo "No se pudo registrar a la base de datos";
}

?>