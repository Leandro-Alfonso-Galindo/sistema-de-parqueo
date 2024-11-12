<?php

include("../app/config.php");

$placa = $_GET['placa'];
$id_map = $_GET['id_map'];
$placa = strtoupper($placa); //Convierte todo a mayuscula


$id_cliente = '';
$nombre_cliente = '';
$rut_ci_cliente = '';


$query_buscars = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1' AND placa_auto = '$placa'");

$query_buscars->execute();

$buscars = $query_buscars->fetchALL(PDO::FETCH_ASSOC);
foreach($buscars as $buscar) {
    $id_cliente = $buscar['id_cliente'];
    $nombre_cliente = $buscar['nombre_cliente'];
    $rut_ci_cliente = $buscar['rut_ci_cliente'];
}

if($nombre_cliente == "") {

    //echo "El cliente es nuevo";
    ?>
    <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label">Nombre:<span style="color: red">*</span></label>
        <div class="col-sm-9">
            <input id="nombre_cliente<?php echo $id_map;?>" type="text" class="form-control">
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label">RUT/CI: <span style="color: red">*</span></label>
        <div class="col-sm-9">
            <input id="rut_ci<?php echo $id_map;?>" type="text" class="form-control">
        </div>
    </div>
    <?php

}else {

    //echo "El cliente es antiguo";
    ?>
    <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label">Nombre:<span style="color: red">*</span></label>
        <div class="col-sm-9">
            <input id="nombre_cliente<?php echo $id_map;?>" type="text" class="form-control" value="<?php echo $nombre_cliente;?>">
        </div>
    </div>

    <div class="form-group row">
        <label for="" class="col-sm-3 col-form-label">RUT/CI:<span style="color: red">*</span></label>
        <div class="col-sm-9">
            <input id="rut_ci<?php echo $id_map;?>" type="text" class="form-control" value="<?php echo $rut_ci_cliente;?>">
        </div>
    </div>
    <?php

}
//BUSCA LA PLACA EN LA TABLA TICKETS
$contador_ticket = 0;
$query_tickets = $pdo->prepare("SELECT * FROM tb_tickets WHERE estado = '1' AND placa_auto = '$placa' AND estado_ticket = 'OCUPADO'");

$query_tickets->execute();

$datos_tickets = $query_tickets->fetchALL(PDO::FETCH_ASSOC);
foreach($datos_tickets as $datos_ticket) {
    $contador_ticket = $contador_ticket + 1;
}
if($contador_ticket == "0") {
    //echo "No hay ningun registro igual";
    ?>
    <script>
        $('#btn_registrar_ticket<?php echo $id_map;?>').removeAttr('disabled');
    </script>
    <?php
}else{
    //echo "Este vehículo ya esta dentro del parqueo";
    ?>
    <div class="alert alert-danger">
    Este vehículo ya esta dentro del parqueo
    </div>
    <script>
        $('#btn_registrar_ticket<?php echo $id_map;?>').attr('disabled', 'disabled');
    </script>

<?php
}


?>

