<?php

include("../app/config.php");

$nombre = $_POST['nombre'];
$email = $_POST['email'];
$rol = $_POST['rol'];
$id_user = $_POST['id_user'];

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


$sentencia = $pdo->prepare("UPDATE tb_usuarios
SET rol = :rol
WHERE id = :id");

$sentencia->bindParam('rol', $rol);
$sentencia->bindParam('id', $id_user);


if($sentencia->execute()) {
    echo "Se asigno el rol de manera correcta";
    ?>
    <script>location.href = "../roles/asignar.php";</script>
    <?php
}else{
    echo "Error al actualizar el rol al usuario";
}

?>