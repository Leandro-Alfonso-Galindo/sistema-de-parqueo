<?php

include("../app/config.php");

$id_cliente = $_GET['id_cliente'];
$nombre_cliente = $_GET['nombre_cliente'];
$rut_ci_cliente = $_GET['rut_ci_cliente'];
$placa_auto = $_GET['placa_auto'];
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


$sentencia = $pdo->prepare("UPDATE tb_clientes SET 
nombre_cliente = :nombre_cliente,
rut_ci_cliente = :rut_ci_cliente,
placa_auto = :placa_auto,
fyh_actualizacion = :fyh_actualizacion
WHERE id_cliente = :id_cliente");

$sentencia->bindParam(':id_cliente', $id_cliente);
$sentencia->bindParam(':nombre_cliente', $nombre_cliente);
$sentencia->bindParam(':rut_ci_cliente', $rut_ci_cliente);
$sentencia->bindParam(':placa_auto', $placa_auto);
$sentencia->bindParam(':fyh_actualizacion', $fechaHora);


if($sentencia->execute()) {
    echo "Se actualizó el registro de manera correcta";
    ?>
    <script>location.href = "index.php";</script>
    <?php
}else{
    echo "Error al actualizar el registro";
}

?>