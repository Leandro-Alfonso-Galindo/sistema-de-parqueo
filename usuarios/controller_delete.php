<?php

include("../app/config.php");

$id_user = $_GET['id_user'];
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");
$estado_inactivo = '0';

$sentencia = $pdo->prepare("UPDATE tb_usuarios
SET estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id = :id");

$sentencia->bindParam('estado', $estado_inactivo);
$sentencia->bindParam('fyh_eliminacion', $fechaHora);
$sentencia->bindParam('id', $id_user);


if($sentencia->execute()) {
    echo "Se elimino el registro de manera correcta";
    ?>
    <script>location.href = "../usuarios";</script>
    <?php
}else{
    echo "Error al eliminar el registro";
}

?>