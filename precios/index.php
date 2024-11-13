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

        <br><h2>Listado de Precios</h2>

        <div class="row">
            <div class="col-md-10">
                
                <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Precios establecidos</h3>

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
                    <th>Cantidad</th>
                    <th>Detalle</th>
                    <th>Precio</th>
                    <th><center>Acción</center></th>    

                    <?php 
                    $contador_precio = 0;
                    $query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE estado = '1'");
                    
                    $query_precios->execute();
                    
                    $datos_precios = $query_precios->fetchALL(PDO::FETCH_ASSOC);
                    
                    foreach($datos_precios as $datos_precio) {
                        $contador_precio = $contador_precio + 1;
                        $id_precio = $datos_precio['id_precio'];
                        $cantidad = $datos_precio['cantidad'];
                        $detalle = $datos_precio['detalle'];
                        $precio = $datos_precio['precio'];
                    
                    ?>
                    <tr>

                    <td><center><?php echo $contador_precio; ?></center></td>
                    <td><center><?php echo $cantidad; ?></center></td>
                    <td><center><?php echo $detalle; ?></center></td>
                    <td><center><?php echo $precio; ?></center></td>
                    <td>
                    <center>
                        <a href="update.php?id=<?php echo $id_precio;?>" class="btn btn-success">Editar</a>
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