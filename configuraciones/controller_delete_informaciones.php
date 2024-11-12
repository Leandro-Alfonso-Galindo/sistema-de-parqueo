<?php

include("../app/config.php");

$id_informacion = $_GET['id_informacion'];
$estado_inactivo = '0';

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");


//echo $nombres."-".$email."-".$password_user;

$sentencia = $pdo->prepare("UPDATE tb_informaciones SET
estado = :estado,
fyh_eliminacion = :fyh_eliminacion
WHERE id_informacion = :id_informacion");

$sentencia->bindParam('fyh_eliminacion', $fechaHora);
$sentencia->bindParam('id_informacion', $id_informacion);
$sentencia->bindParam('estado', $estado_inactivo);


if($sentencia->execute()){
    echo "Registro satisfactorio"; 
    ?>
    <script>location.href = "informaciones.php";</script>
    <?php
}else{
    echo "No se pudo registrar a la base de datos";
}

?>