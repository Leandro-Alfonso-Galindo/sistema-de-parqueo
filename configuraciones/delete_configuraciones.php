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

        <br><h2>Eliminación de la información</h2>

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-outline card-danger">
                <div class="card-header">
                    <h3 class="card-title">¿Esta seguro de eliminar este registro?</h3>

                    <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    </div>
                    <!-- /.card-tools -->
                </div>

                <?php
                $id_informacion_get = $_GET['id'];

                $query_informacions = $pdo->prepare("SELECT * FROM tb_informaciones WHERE estado = '1' AND id_informacion = '$id_informacion_get'");

                $query_informacions->execute();

                $informacions = $query_informacions->fetchALL(PDO::FETCH_ASSOC);
                foreach($informacions as $informacion) {
                    $id_informacion = $informacion['id_informacion'];
                    $nombre_parqueo = $informacion['nombre_parqueo'];
                    $actividad_empresa = $informacion['actividad_empresa'];
                    $sucursal = $informacion['sucursal'];
                    $direccion = $informacion['direccion'];
                    $zona = $informacion['zona'];
                    $telefono = $informacion['telefono'];
                    $departamento_ciudad = $informacion['departamento_ciudad'];
                    $pais = $informacion['pais'];
                }
                ?>

                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Nombre del Parqueo </label>
                            <input type="text" class="form-control" id="nombre_parqueo" value="<?php echo $nombre_parqueo;?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Actividad de la Empresa </label>
                            <input type="text" class="form-control" id="actividad_empresa" value="<?php echo $actividad_empresa;?>" readonly>
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal </label>
                            <input type="text" class="form-control" id="sucursal" value="<?php echo $sucursal;?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Dirección /label>
                            <input type="text" class="form-control" id="direccion" value="<?php echo $direccion;?>" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="">Zona </label>
                            <input type="text" class="form-control" id="zona" value="<?php echo $zona;?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Teléfono </label>
                            <input type="text" class="form-control" id="telefono" value="<?php echo $telefono;?>" readonly> 
                        </div>
                    
                        <div class="col-md-4">
                            <label for="">Departamento o Ciudad </label>
                            <input type="text" class="form-control" id="departamento_ciudad" value="<?php echo $departamento_ciudad;?>" readonly>
                        </div>
                    
                        <div class="col-md-4">
                            <label for="">Pais </label>
                            <input type="text" class="form-control" id="pais" value="<?php echo $pais;?>" readonly>
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="informaciones.php" class="btn btn-default btn-block">Cancelar</a>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_borrar_informacion" class="btn btn-danger btn-block">
                                Borrar
                            </button>
                        </div>
                    </div>
                    <div id="respuesta">

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
$('#btn_borrar_informacion').click(function(){     
    
    var id_informacion = '<?php echo $id_informacion_get;?>';

    
    var url = "controller_delete_informaciones.php";
    $.get(url, {id_informacion:id_informacion}, function(datos) {
        $('#respuesta').html(datos);
    });
    
});
</script>