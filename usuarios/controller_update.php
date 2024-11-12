<?php

include("../app/config.php");

$id_user = $_GET['id_user'];
$nombres = $_GET['nombres'];
$email = $_GET['email'];
$password_user = $_GET['password_user'];
date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


$sentencia = $pdo->prepare("UPDATE tb_usuarios
SET nombres = :nombres,
email = :email,
password_user = :password_user,
fyh_actualizacion = :fyh_actualizacion
WHERE id = :id");

$sentencia->bindParam('id', $id_user);
$sentencia->bindParam('nombres', $nombres);
$sentencia->bindParam('email', $email);
$sentencia->bindParam('password_user', $password_user);
$sentencia->bindParam('fyh_actualizacion', $fechaHora);


if($sentencia->execute()) {
    echo "Se actualizó el registro de manera correcta";
    ?>
    <script>location.href = "../usuarios";</script>
    <?php
}else{
    echo "Error al actualizar el registro";
}

?>