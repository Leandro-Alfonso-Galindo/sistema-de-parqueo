<?php

include("../app/config.php");

$id_ticket = $_GET['id'];
$cuviculo = $_GET['cuviculo'];
$estado_inactivo = '0';

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


//echo $nombres."-".$email."-".$password_user;

$sentencia = $pdo->prepare("UPDATE tb_tickets SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id_ticket = :id_ticket");

$sentencia->bindParam('fyh_eliminacion', $fechaHora);
$sentencia->bindParam('id_ticket', $id_ticket);
$sentencia->bindParam('estado', $estado_inactivo);


if($sentencia->execute()) {
    $estado_espacio = "LIBRE";

    //actualizando el estado del cuviculo de ocupado a libre
    $sentencia2 = $pdo->prepare("UPDATE tb_mapeos SET
    estado_espacio = :estado_espacio,
    fyh_actualizacion = :fyh_actualizacion
    WHERE nro_espacio = :nro_espacio");

    $sentencia2->bindParam('estado_espacio', $estado_espacio);
    $sentencia2->bindParam('fyh_actualizacion', $fechaHora);
    $sentencia2->bindParam('nro_espacio', $cuviculo);

    if($sentencia2->execute()) {
        echo "Se actualizo el estado del cuviculo";
        echo "eliminacion de registro satisfactoria"; 
        ?>
        <script>location.href = "../principal.php";</script>
        <?php
    } else {
        echo "Error al actualizar el campo nro de espacio";
    }
    
}else{
    echo "Error borrar de la base de datos";
}

?>