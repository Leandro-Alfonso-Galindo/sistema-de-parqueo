<?php

include("../app/config.php");

$cuviculo = $_GET['cuviculo'];
$estado_espacio = "OCUPADO";

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


$sentencia = $pdo->prepare("UPDATE tb_mapeos SET 
estado_espacio = :estado_espacio,
fyh_actualizacion = :fyh_actualizacion
WHERE id_map = :id_map");

$sentencia->bindParam('id_map', $cuviculo);
$sentencia->bindParam('estado_espacio', $estado_espacio);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);


if($sentencia->execute()) {
    echo "Se actualizó el registro de manera correcta";
    ?>
    <!-- <script>location.href = "../usuarios";</script>
    <?php
}else{
    echo "Error al actualizar el registro";
}

?>