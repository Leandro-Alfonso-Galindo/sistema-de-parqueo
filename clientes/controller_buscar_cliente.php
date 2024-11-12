<?php

include("../app/config.php");

$placa = $_GET['placa'];
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
    <label for="" class="col-sm-2 col-form-label">Nombre:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control">
    </div>
    </div>

    <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">RUT/CI:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control">
    </div>
    </div>
    <?php

}else {

    //echo "El cliente es antiguo";
    ?>
    <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">Nombre:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $nombre_cliente;?>" readonly>
    </div>
    </div>

    <div class="form-group row">
    <label for="" class="col-sm-2 col-form-label">RUT/CI:</label>
    <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $rut_ci_cliente;?>" readonly>
    </div>
    </div>
    <?php

}

?>

