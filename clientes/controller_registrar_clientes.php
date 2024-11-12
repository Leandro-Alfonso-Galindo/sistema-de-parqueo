<?php

include("../app/config.php");

$nombre_cliente = $_GET['nombre_cliente'];
$rut_ci = $_GET['rut_ci'];
$placa = $_GET['placa'];

date_default_timezone_set("America/Argentina/Buenos_Aires");
$fechaHora = date("Y-m-d h:i:s");

//BUSCA SI EL CLIENTE YA ESTA REGISTRADO
$contador_cliente = 0;
$query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1' AND placa_auto = '$placa'");

$query_clientes->execute();

$datos_clientes = $query_clientes->fetchALL(PDO::FETCH_ASSOC);

foreach($datos_clientes as $datos_cliente) {
    $contador_cliente = $contador_cliente + 1;
}
if($contador_cliente == "0") {
    echo "No hay ningun registro igual";

    $sentencia = $pdo->prepare("INSERT INTO tb_clientes
    (nombre_cliente, rut_ci_cliente, placa_auto, fyh_creacion, estado) 
    values(:nombre_cliente,:rut_ci_cliente,:placa_auto, :fyh_creacion, :estado)");

    $sentencia->bindParam('nombre_cliente', $nombre_cliente);
    $sentencia->bindParam('rut_ci_cliente', $rut_ci);
    $sentencia->bindParam('placa_auto', $placa);
    $sentencia->bindParam('fyh_creacion', $fechaHora);
    $sentencia->bindParam('estado', $estado_del_registro);


    if($sentencia->execute()){
        echo "Registro satisfactorio"; 
        ?>
        <!-- <script>location.href = "../roles/asignar.php";</script> -->
        <?php
    }else{
        echo "No se pudo registrar a la base de datos";
    }

}else{
echo "Este cliente ya se encuentra registrado";
    
}

//echo $nombres."-".$email."-".$password_user;



?>