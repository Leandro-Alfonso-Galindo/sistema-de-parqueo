<?php 

include('../app/config.php');
include('../layout/admin/datos_usuario_sesion.php');

?>

<!DOCTYPE html>

<html lang="es">
<head>
  <?php include('../layout/admin/head.php') ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

    <!-- Menu superior y lateral -->

  <?php include('../layout/admin/menu.php') ?>

  <!-- Contenido -->

  <div class="content-wrapper">

    <div class="container">

        <br><h2>Edición de los datos del cliente</h2>

        <div class="row">
            <div class="col-md-10">
                
                <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Datos del cliente</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <?php
                $id_cliente_get = $_GET['id'];

                $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE id_cliente = '$id_cliente_get' AND estado = '1'");
                                    
                $query_clientes->execute();

                $datos_clientes = $query_clientes->fetchALL(PDO::FETCH_ASSOC);

                foreach($datos_clientes as $datos_cliente) {
                    $id_cliente = $datos_cliente['id_cliente'];
                    $nombre_cliente = $datos_cliente['nombre_cliente'];
                    $rut_ci_cliente = $datos_cliente['rut_ci_cliente'];
                    $placa_auto = $datos_cliente['placa_auto'];
                }

                ?>

                <!-- /.card-header -->
                <div class="card-body">
                    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Nombre del Cliente <span style="color: red">*</span> </label>
                            <input type="text" class="form-control" id="nombre_cliente" value="<?php echo $nombre_cliente;?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Rut/Ci del Cliente  <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="rut_ci_cliente" value="<?php echo $rut_ci_cliente;?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Placa del Auto  <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="placa_auto" value="<?php echo $placa_auto;?>">
                        </div>
                    </div>

                    <hr>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <a href="index.php" class="btn btn-default">Cancelar</a>
                                <button class="btn btn-success" id="btn_actualizar_cliente">
                                    Actualizar
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="respuesta_cliente">

                </div>
                                        
                </div>
                <!-- /.card-body -->
            </div>
                    
            
        </div>
                
            
        </div>

    </div>
  
  </div>

  <!-- Pie de página -->

  <?php include('../layout/admin/footer.php') ?>
  
</div>

<?php include('../layout/admin/footer_link.php') ?>

</body>
</html>

<script>
$('#btn_actualizar_cliente').click(function(){     
var nombre_cliente = $('#nombre_cliente').val();
var rut_ci_cliente = $('#rut_ci_cliente').val();
var placa_auto = $('#placa_auto').val();
var id_cliente = '<?php echo $id_cliente_get;?>';

if(nombre_cliente == "") {
    alert('Debe llenar el campo de nombre de cliente');
    $('#nombre_cliente').focus();
}else if(rut_ci_cliente == "") {
    alert('Debe llenar el campo de rut/ci de cliente');
    $('#rut_ci_cliente').focus();
}else if(placa_auto == "") {
    alert('Debe llenar el campo de placa de auto');
    $('#placa_auto').focus();
}else {
    var url = "controller_update.php";
    $.get(url, {nombre_cliente:nombre_cliente, rut_ci_cliente:rut_ci_cliente, placa_auto:placa_auto, id_cliente:id_cliente}, function(datos) {
        $('#respuesta_cliente').html(datos);
    });
}

});
</script>