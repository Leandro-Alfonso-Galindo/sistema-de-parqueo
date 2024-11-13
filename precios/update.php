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

        <br><h2>Actualización de Precios</h2>

        <div class="row">
            <div class="col-md-10">
                
                <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Llene los datos cuidadosamente</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                <?php
                $id_precio_get = $_GET['id'];
                $query_precios = $pdo->prepare("SELECT * FROM tb_precios WHERE id_precio = '$id_precio_get' AND estado = '1'");
                    
                $query_precios->execute();
                
                $datos_precios = $query_precios->fetchALL(PDO::FETCH_ASSOC);
                
                foreach($datos_precios as $datos_precio) {
                    $id_precio = $datos_precio['id_precio'];
                    $cantidad = $datos_precio['cantidad'];
                    $detalle = $datos_precio['detalle'];
                    $precio = $datos_precio['precio'];
                }
                ?>
                    
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Cantidad <span style="color:red">*</span> </label>
                            <input type="number" class="form-control" id="cantidad" value="<?php echo $cantidad;?>">
                        </div>
                    </div>  
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Detalle <span style="color:red">*</span> </label>
                            <select name="" id="detalle" class="form-control">
                                <?php
                                if($detalle == "HORAS") { ?>
                                    <option value="HORAS">HORAS</option>
                                    <option value="DIAS">DIAS</option>
                                <?php 
                                }else if($detalle == "DIAS") { ?>
                                    <option value="DIAS">DIAS</option>
                                    <option value="HORAS">HORAS</option>                                   
                               <?php 
                               }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="">Precio <span style="color:red">*</span> </label>
                            <input type="number" class="form-control" id="precio" value="<?php echo $precio;?>">
                        </div>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <a href="index.php" class="btn btn-default">Cancelar</a>
                        <button class="btn btn-success" id="btn_actualizar_precio">Actualizar precio</button>
                    </div>
                </div>

                <script>
                    $('#btn_actualizar_precio').click(function(){
                        var cantidad =  $('#cantidad').val();
                        var detalle =  $('#detalle').val();
                        var precio =  $('#precio').val();
                        var id_precio = <?php echo $id_precio_get;?>;

                        if(cantidad == "") {
                            alert("Debe llenar el campo cantidad");
                            $('#cantidad'),focus();
                        }else if(precio == "") {
                            alert("Debe llenar el campo precio");
                            $('#precio'),focus();
                        }else {

                            var url = "controller_update.php";
                            $.get(url, {cantidad:cantidad , detalle:detalle , precio:precio, id_precio:id_precio}, function(datos) {
                                $('#respuesta_precio').html(datos);
                            });

                        }
                    });
                </script>

                <div id="respuesta_precio">

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