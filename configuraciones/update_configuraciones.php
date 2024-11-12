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

        <br><h2>Actualización de la información</h2>

        <div class="row">
            <div class="col-md-12">
                
                <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Registre los datos con mucho cuidado</h3>

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
                            <label for="">Nombre del Parqueo <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="nombre_parqueo" value="<?php echo $nombre_parqueo;?>">
                        </div>
                        <div class="col-md-4">
                            <label for="">Actividad de la Empresa <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="actividad_empresa" value="<?php echo $actividad_empresa;?>">
                        </div>
                        <div class="col-md-4">
                            <label for="">Sucursal <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="sucursal" value="<?php echo $sucursal;?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="">Dirección <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="direccion" value="<?php echo $direccion;?>">
                        </div>
                        <div class="col-md-6">
                            <label for="">Zona <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="zona" value="<?php echo $zona;?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="">Teléfono <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="telefono" value="<?php echo $telefono;?>">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="">Departamento o Ciudad <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="departamento_ciudad" value="<?php echo $departamento_ciudad;?>">
                        </div>
                    
                        <div class="col-md-4">
                            <label for="">Pais <span style="color: red">*</span></label>
                            <input type="text" class="form-control" id="pais" value="<?php echo $pais;?>">
                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-md-6">
                            <a href="informaciones.php" class="btn btn-default btn-block">Cancelar</a>
                        </div>
                        <div class="col-md-6">
                            <button id="btn_actualizar_informacion" class="btn btn-success btn-block">
                                Actualizar
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
$('#btn_actualizar_informacion').click(function(){     
    var nombre_parqueo = $('#nombre_parqueo').val();
    var actividad_empresa = $('#actividad_empresa').val();
    var sucursal = $('#sucursal').val();
    var direccion = $('#direccion').val();
    var zona = $('#zona').val();
    var telefono = $('#telefono').val();
    var departamento_ciudad = $('#departamento_ciudad').val();
    var pais = $('#pais').val();
    var id_informacion = '<?php echo $id_informacion_get;?>';

    if(nombre_parqueo == "") {
        alert('Debe llenar el campo nombre de parqueo');
        $('#nombre_parqueo').focus();
    }else if(actividad_empresa == "") {
        alert('Debe llenar el campo actividad de la empresa');
        $('#actividad_empresa').focus();
    }else if(sucursal == "") {
        alert('Debe llenar el campo sucursal');
        $('#sucursal').focus();
    }else if(direccion == "") {
        alert('Debe llenar el campo direccion');
        $('#direccion').focus();
    }else if(zona == "") {
        alert('Debe llenar el campo zona');
        $('#zona').focus();
    }else if(telefono == "") {
        alert('Debe llenar el campo telefono');
        $('#telefono').focus();
    }else if(departamento_ciudad == "") {
        alert('Debe llenar el campo departamento o ciudad');
        $('#departamento_ciudad').focus();
    }else if(pais == "") {
        alert('Debe llenar el campo pais');
        $('#pais').focus();
    }else {
        var url = "controller_update_informaciones.php";
        $.get(url, 
        {
            nombre_parqueo:nombre_parqueo, actividad_empresa:actividad_empresa, 
            sucursal:sucursal, direccion:direccion, zona:zona,
            telefono:telefono, departamento_ciudad:departamento_ciudad, pais:pais,
            id_informacion:id_informacion
        }, 
        function(datos) {
            $('#respuesta').html(datos);
        });
    }

});
</script>