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

        <br><h2>Listado de Clientes</h2>

        <div class="row">
            <div class="col-md-10">
                
                <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Clientes registrados</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                <table border="1" class="table table-bordered table-sm table-striped">

                    <th><center>Nro</center></th>
                    <th>Nombre del cliente</th>
                    <th>Rut/Ci del cliente</th>
                    <th>Placa del auto</th>
                    <th><center>Acción</center></th>    

                    <?php 
                    $contador_cliente = 0;
                    $query_clientes = $pdo->prepare("SELECT * FROM tb_clientes WHERE estado = '1'");
                    
                    $query_clientes->execute();
                    
                    $datos_clientes = $query_clientes->fetchALL(PDO::FETCH_ASSOC);
                    
                    foreach($datos_clientes as $datos_cliente) {
                        $contador_cliente = $contador_cliente + 1;
                        $id_cliente = $datos_cliente['id_cliente'];
                        $nombre_cliente = $datos_cliente['nombre_cliente'];
                        $rut_ci_cliente = $datos_cliente['rut_ci_cliente'];
                        $placa_auto = $datos_cliente['placa_auto'];
                    
                    ?>
                    <tr>

                    <td><center><?php echo $contador_cliente ?></center></td>
                    <td><?php echo $nombre_cliente ?></td>
                    <td><?php echo $rut_ci_cliente ?></td>
                    <td><?php echo $placa_auto ?></td>
                    <td>
                    <center>
                        <a href="update.php?id=<?php echo $id_cliente;?>" class="btn btn-success">Editar</a>
                    </center>
                    </td>

                    </tr>
                    <?php
                    }
                    ?>

                </table>
                                        
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
$('#btn_registrar').click(function(){     
var nro_espacio = $('#nro_espacio').val();
var estado_espacio = $('#estado_espacio').val();
var observacion = $('#observacion').val();

if(nro_espacio == "") {
    alert('Debe llenar el campo nro de espacio');
    $('#nro_espacio').focus();
}else {
    var url = "controller_create.php";
    $.get(url, {nro_espacio:nro_espacio, estado_espacio:estado_espacio, observacion:observacion}, function(datos) {
        $('#respuesta').html(datos);
    });
}

});
</script>