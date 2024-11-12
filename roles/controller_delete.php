<?php

include("../app/config.php");

$id_rol = $_GET['id_rol'];
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");
$estado_inactivo = '0';

$sentencia = $pdo->prepare("UPDATE tb_roles
SET estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id_rol = :id_rol");

$sentencia->bindParam('estado', $estado_inactivo);
$sentencia->bindParam('fyh_eliminacion', $fechaHora);
$sentencia->bindParam('id_rol', $id_rol);


if($sentencia->execute()) {
    echo "Se elimino el registro de manera correcta";
    ?>
    <script>location.href = "../roles";</script>
    <?php
}else{
    echo "Error al eliminar el registro";
}

?>